<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_matrix_penilaian extends CI_Controller
{

// ini data matrix ppk
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('M_matrix');
	}

	public function index() {

		$data['matrix'] = $this->M_matrix->dataMatrix();
		$this->load->view('v_matrix', $data);
	}

 public function tambah() {


  $nik_sesi = $this->session->userdata('nip_btn');

  if ($nik_sesi == '00') {
    $as_nik = '000';
  } elseif ($nik_sesi == '01') {
    $as_nik = '001';
  } elseif ($nik_sesi == '02') {
    $as_nik = '002'; 
  } elseif ($nik_sesi == '03') {
    $as_nik = '003'; 
  } else {
    $as_nik = 'UNKNOW';
  }

 

  $hashas = $this->db->query("SELECT departemen, nip_btn , name 
  		  FROM data_karyawan 
  		  WHERE cd_office = '$as_nik'
  		  AND level = 'user'
  		  GROUP by nip_btn 
  		  ORDER BY name ASC;"); 
    $data['nilai'] = $hashas->result_array();

   // var_dump($data['nilai']); 

  $this->load->view('v_new_penilaian', $data);

}


  public function getDepartemen() {

     $nik = $this->input->post('nik_dinilai');

      $res = "SELECT departemen
          FROM data_karyawan
          WHERE nip_btn = ?"; 
      $get_res = $this->db->query($res, array($nik)); 
      $data['departemen'] = $get_res->result_array();           

      echo json_encode($data);

  }


	public function dptKaryawan() {

		$nik_sesi = $this->session->userdata('nip_btn');

		if ($nik_sesi == '00') {
			$of = '000';
		} elseif ($nik_sesi == '01') {
			$of = '001';
		} elseif ($nik_sesi == '02') {
			$of = '002';
		} elseif ($nik_sesi == '03') {
			$of = '003';
		} else {
			$of = 'UNKNOW';
		}

		$depart = $this->input->post('departemen');

		$sql = $this->db->select(['name','nip_btn'])
						->from('data_karyawan')
						// ->where('departemen' , $depart, 'AND')
						->where('cd_office', $of , 'AND')
            ->where('level', 'user')
						->group_by('name', 'departemen')
						->get();
		$data['namaDin'] = $sql->result_array();

		echo json_encode($data);
	}

 public function simpanSave()
{
    
    $mapOffice = [
        '00' => 'HO',
        '01' => 'MRK',
        '02' => 'TGR',
        '03' => 'KRW',
    ];
    $nik_sesi = $this->session->userdata('nip_btn');
    $as_nik = isset($mapOffice[$nik_sesi]) ? $mapOffice[$nik_sesi] : 'UNKNOW';

    $penilaiData = json_decode($this->input->post('penilaiData'), true);
    if (empty($penilaiData) || !is_array($penilaiData)) {
        return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['status'=>'error','message'=>'Data kosong atau format salah']));
    }

    $allNiks = [];
    foreach ($penilaiData as $p) {
        $allNiks[] = $p['nik_dinilai'];
        $allNiks[] = $p['nik_penilai1'];
        $allNiks[] = $p['nik_penilai2'];
        $allNiks[] = $p['nik_penilai3'];
    }
    $allNiks = array_unique($allNiks);

    $rows = $this->db
        ->select('nik_dinilai, periode_ppk, office, departemen, kode_organisasi, organisasi_ppk, posisi')
        ->where_in('nik_dinilai', $allNiks)
        ->get('data_matrix_ppk')
        ->result_array();
    // mapping by nik
    $mapMatrix = [];
    foreach ($rows as $r) {
        $mapMatrix[$r['nik_dinilai']] = $r;
    }

    log_message('debug', '== MULAI simpanSave ==');

    $urutWaktu = "SELECT periode_ppk FROM data_matrix_ppk ORDER BY pembaharuan DESC LIMIT 1;";
    $filter    = $this->db->query($urutWaktu)->row_array();

    $batch = [];
    $now = date('Y-m-d H:i:s');
    foreach ($penilaiData as $p) {
        $dinilaiNik = $p['nik_dinilai'];
        $m = isset($mapMatrix[$dinilaiNik]) ? $mapMatrix[$dinilaiNik] : null;

        if ($m) {
           log_message('debug', "FOUND matrix untuk {$dinilaiNik}");
            $periode_ppk       = $m['periode_ppk'];
            $office            = $m['office'];
            $departemen        = $m['departemen'];
            $kode_organisasi   = $m['kode_organisasi'];
            $org_ppk           = $m['organisasi_ppk'];
            $posisi            = $m['posisi'];
        } elseif(empty($m)) {
           log_message('debug', "FALLBACK dipanggil untuk {$dinilaiNik}");
            $deptRow = $this->db
                            ->select('departemen')
                            ->where('nip_btn', $dinilaiNik)
                            ->from('data_karyawan')
                            ->get() 
                            ->row_array();
            log_message('debug', 'deptRow: '. print_r($deptRow, true));
            //$periode_ppk     = date('Y') . '02';
            $periode_ppk     = $filter['periode_ppk'] ?? date('Y') . '02'; 
            $office          = $as_nik;
            $departemen      = $deptRow['departemen'] ?? null;
            $kode_organisasi = null;
            $org_ppk         = null;
            $posisi          = null;
        }

        $getKodeOrg = function($nik) use ($mapMatrix) {
            if (isset($mapMatrix[$nik])) {
                return $mapMatrix[$nik]['kode_organisasi'];
            }
            return null;
        };

        $batch[] = [
            'periode_ppk'            => $periode_ppk,
            'office'                 => $office,
            'departemen'             => $departemen,
            'kode_organisasi'        => $kode_organisasi,
            'organisasi_ppk'         => $org_ppk,
            'posisi'                 => $posisi,
            'nik_dinilai'            => $dinilaiNik,
            'nama_dinilai'           => $p['dinilai'],
            'kode_organisasi_p1'     => $getKodeOrg($p['nik_penilai1']),
            'nik_p1'                 => $p['nik_penilai1'],
            'nama_p1'                => $p['penilai1'],
            'kode_organisasi_p2'     => $getKodeOrg($p['nik_penilai2']),
            'nik_p2'                 => $p['nik_penilai2'],
            'nama_p2'                => $p['penilai2'],
            'kode_organisasi_p3'     => $getKodeOrg($p['nik_penilai3']),
            'nik_p3'                 => $p['nik_penilai3'],
            'nama_p3'                => $p['penilai3'],
            'pembaharuan'            => $now,
        ];
    }

    $this->db->trans_start();
      $this->db->insert_batch('data_matrix_ppk', $batch);
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
        $status = ['status'=>'error','message'=>'Gagal menyimpan ke database'];
    } else {
        $status = ['status'=>'success'];
    }

    return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($status));
}

  


public function update_multiple() {

$p1s = $this->input->post('penilai1');
$p2s = $this->input->post('penilai2');
$p3s = $this->input->post('penilai3');
$niks = $this->input->post('dinilai1');


// 1. Gabungkan semua NIK dari p1, p2, p3 dan hapus duplikat
$all_penilai_niks = array_unique(array_merge($p1s, $p2s, $p3s));


// 2. Ambil kode_organisasi dan nama_dinilai dari DB
$this->db->select('nik_dinilai, kode_organisasi, nama_dinilai');
$this->db->from('data_matrix_ppk');
$this->db->where_in('nik_dinilai', $all_penilai_niks);
$query = $this->db->get();
$result = $query->result_array();

// 3. Buat map nik => detail
$penilai_info_map = [];
foreach ($result as $row) {
    $penilai_info_map[$row['nik_dinilai']] = [
        'kode_organisasi' => $row['kode_organisasi'],
        'nama_dinilai' => $row['nama_dinilai']
    ];
}

// 4. Gabungkan data ke array akhir
$data = [];

foreach ($niks as $index => $nik) {
    $p1 = $p1s[$index];
    $p2 = $p2s[$index];
    $p3 = $p3s[$index];

    $data[] = [
        'nik' => $nik,

        'p1' => $p1,
        'kode_organisasi_p1' => $penilai_info_map[$p1]['kode_organisasi'] ?? null,
        'nama_p1' => $penilai_info_map[$p1]['nama_dinilai'] ?? null,

        'p2' => $p2,
        'kode_organisasi_p2' => $penilai_info_map[$p2]['kode_organisasi'] ?? null,
        'nama_p2' => $penilai_info_map[$p2]['nama_dinilai'] ?? null,

        'p3' => $p3,
        'kode_organisasi_p3' => $penilai_info_map[$p3]['kode_organisasi'] ?? null,
        'nama_p3' => $penilai_info_map[$p3]['nama_dinilai'] ?? null,
		'pembaharuan' => date('Y-m-d H:i:s'),
	];
}


		// echo '<pre>';
		// var_dump($data);
		// echo '</pre>';

	$result = $this->M_matrix->update_multiple_matriks($data);

	$this->session->set_flashdata('success', 'Data berhasil diperbarui!');


	redirect('C_matrix_penilaian');


}

	public function hapus() {
		$id_apus = $this->input->post('input_id');

		if (!empty($id_apus)) {
		$this->db->where_in('id', $id_apus);
		$this->db->delete('data_matrix_ppk');

		echo json_encode(['status' => 'sukses']);	
		} else {

		echo json_encode(['status' => 'error', 'message' => 'Data tidak terhapus']);
		}
	}

	public function edit_penilai() {

		// $nik_string = $this->input->get('input_id'); // "1234,5678,91011"
		// $nik = explode(',', $nik_string); // jadi array: ['1234', '5678', '91011']
		
		// var_dump($nik);
		$nik = $this->input->get('input_id'); // Sudah array


		$this->session->set_userdata('input_id', $nik);
		
		$office = $this->session->userdata('nip_btn');
		if ($office == '000') {
			$ktr = 'HO'; 
		} elseif ($office == '001') {
			$ktr = 'MRK'; 
		} elseif ($office == '002') {
			$ktr = 'TGR'; 
		} elseif ($office == '003') {
			$ktr = 'KRW';
		} else {
			$ktr = 'UNKNOW'; 
		}

		$data['get_data_penilai'] = $this->M_matrix->penilai($nik);
		$data['get_data_matriks'] = $this->M_matrix->data_matriks($ktr);
		$data['get_data_karyawan'] = $this->M_matrix->data_all(); 
		

		
		$this->load->view('v_edit_penilai', $data);
		

	}
	


	public function alertNIK() {
        $input_nik = $this->input->post('input_nik'); // array dari checkbox

        if (!empty($input_nik)) {
            $nik_list = explode(', ', $input_nik);
            echo "NIK yang dipilih: " . $nik_list;
        } else {
            echo "Tidak ada NIK yang dipilih.";
        }
    }

    public function departemen_get_select() {

      $sql = "SELECT departemen, nip_btn , unit_kerja
          FROM data_karyawan 
          WHERE nip_btn = ?"; 
      $get_sql = $this->db->query($sql, array($nik)); 
      $data['depart'] = $get_sql->result_array();   
      $this->load->view('v_new_penilaian', $data);    
    }
}
