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

		$hasil =  $this->db->select(['name','nip_btn'])
				 ->from('data_karyawan')
				 ->where('cd_office', $as_nik)
				 ->order_by('name', 'ASC')
				 ->get();
		$data['nilai'] = $hasil->result_array();


	$this->load->view('v_new_penilaian', $data);

	}
	public function getDepartemen() {

		$nik = $this->input->post('nik_dinilai');


		$res = $this->db->select(['departemen'])
					    ->from('data_karyawan')
					    ->where('nip_btn', $nik)
					    ->get();
	    $data['departemen'] = $res->result_array();

	    echo json_encode($data);
	}

	public function dptKaryawan() {

		$nik_sesi = $this->session->userdata('nip_btn');

		if ($nik_sesi == '00') {
			$of = 'HO';
		} elseif ($nik_sesi == '01') {
			$of = 'MRK';
		} elseif ($nik_sesi == '02') {
			$of = 'TGR';
		} elseif ($nik_sesi == '03') {
			$of = 'KRW';
		} else {
			$of = 'UNKNOW';
		}

		$depart = $this->input->post('departemen');

		$sql = $this->db->select(['nama_dinilai','nik_dinilai'])
						->from('data_matrix_ppk')
						// ->where('departemen' , $depart, 'AND')
						->where('office', $of)
						->group_by('nama_dinilai', 'departemen')
						->get();
		$data['namaDin'] = $sql->result_array();

		echo json_encode($data);
	}

  public function simpanSave() {
    $penilaiData = json_decode($this->input->post('penilaiData'), true);

    if (empty($penilaiData)) {
        echo json_encode(['status' => 'error', 'message' => 'Data kosong']);
        return;
    }

    foreach ($penilaiData as $penilaian) {
        $data = [
            'nama_dinilai' => $penilaian['dinilai'],
            'nik_dinilai' => $penilaian['nik_dinilai'],
            'nama_p1' => $penilaian['penilai1'],
            'nik_p1'  => $penilaian['nik_penilai1'],
            'nama_p2' => $penilaian['penilai2'],
            'nik_p2'  => $penilaian['nik_penilai2'],
            'nama_p3' => $penilaian['penilai3'],
            'nik_p3'  => $penilaian['nik_penilai3'],
            'pembaharuan' => date('Y-m-d H:i:s') // Menyimpan waktu input (opsional)
        ];

      $hasil =   $this->db->select(['periode_ppk', 'office', 'departemen', 'kode_organisasi', 'organisasi_ppk', 'posisi'])
        		 ->from('data_matrix_ppk')
        		 ->where('nik_dinilai', $data['nik_dinilai'])
        		 ->get();
      $sql  = $hasil->row_array();
      if (!empty($sql)) {
      	 $periode_ppk = $sql['periode_ppk'];
      	 $office      = $sql['office'];
      	 $departemen  = $sql['departemen'];
      	 $kode_organisasi = $sql['kode_organisasi'];
      	 $org_ppk         = $sql['organisasi_ppk'];
      	 $posisi          = $sql['posisi'];
      } else {
      	$periode_ppk = $office = $departemen = $kode_organisasi = $org_ppk = $posisi = null;
      }

      $hs = $this->db->select('kode_organisasi')
      				 ->from('data_matrix_ppk')
      				 ->where('nik_dinilai', $data['nik_p1'])
      				 ->get();
      $query = $hs->row_array();
      $kode_p1 = !empty($query) ? $query['kode_organisasi'] : null;

      $hd = $this->db->select('kode_organisasi')
      				 ->from('data_matrix_ppk')
      				 ->where('nik_dinilai', $data['nik_p2'])
      				 ->get();
      $dataset = $hd->row_array();
      $kode_p2 = !empty($query) ? $dataset['kode_organisasi'] : null;

      $hx = $this->db->select('kode_organisasi')
      				 ->from('data_matrix_ppk')
      				 ->where('nik_dinilai', $data['nik_p3'])
      				 ->get();
      $setda = $hx->row_array();
      $kode_p3 = !empty($setda) ? $setda['kode_organisasi'] : null;

      $fixaxi = [
      	'periode_ppk' => $periode_ppk,
      	'office'      => $office,
      	'departemen'  => $departemen,
      	'kode_organisasi' => $kode_organisasi,
      	'organisasi_ppk'  => $org_ppk,
      	'posisi'          => $posisi,
      	'nik_dinilai'     => $data['nik_dinilai'],
      	'nama_dinilai'    => $data['nama_dinilai'],
      	'kode_organisasi_p1' => $kode_p1,
      	'nik_p1'             => $data['nik_p1'],
      	'nama_p1'            => $data['nama_p1'],
      	'kode_organisasi_p2' => $kode_p2,
      	'nik_p2'             => $data['nik_p2'],
      	'nama_p2'            => $data['nama_p2'],
      	'kode_organisasi_p3' => $kode_p3,
      	'nik_p3'             => $data['nik_p3'],
      	'nama_p3'            => $data['nama_p3'],
      	'pembaharuan'        => $data['pembaharuan']
      ];

      $this->db->insert('data_matrix_ppk', $fixaxi);
    }

    echo json_encode(['status' => 'success']);
}

// public function update_multiple() {
//     // Ambil data dari form POST
//     $p1s = $this->input->post('penilai1');
//     $p2s = $this->input->post('penilai2');
//     $p3s = $this->input->post('penilai3');
//     $niks = $this->input->post('dinilai1');

//     // Pastikan semua input adalah array
//     if (!is_array($p1s)) $p1s = [];
//     if (!is_array($p2s)) $p2s = [];
//     if (!is_array($p3s)) $p3s = [];
//     if (!is_array($niks)) $niks = [];

//     // 1. Gabungkan semua NIK penilai dan hapus duplikat
//     $all_penilai_niks = array_unique(array_merge($p1s, $p2s, $p3s));

//     // 2. Ambil data penilai dari database
//     $this->db->select('nik_dinilai, kode_organisasi, nama_dinilai');
//     $this->db->from('data_matrix_ppk');
//     $this->db->where_in('nik_dinilai', $all_penilai_niks);
//     $query = $this->db->get();
//     $result = $query->result_array();

//     // 3. Buat mapping nik_dinilai => detail
//     $penilai_info_map = [];
//     foreach ($result as $row) {
//         $penilai_info_map[$row['nik_dinilai']] = [
//             'kode_organisasi' => $row['kode_organisasi'],
//             'nama_dinilai' => $row['nama_dinilai']
//         ];
//     }

//     // 4. Gabungkan data untuk tiap baris input
//     $data = [];

//     foreach ($niks as $index => $nik) {
//         $p1 = $p1s[$index] ?? null;
//         $p2 = $p2s[$index] ?? null;
//         $p3 = $p3s[$index] ?? null;

//         $data[] = [
//             'nik' => $nik,

//             'p1' => $p1,
//             'kode_organisasi_p1' => $penilai_info_map[$p1]['kode_organisasi'] ?? null,
//             'nama_p1' => $penilai_info_map[$p1]['nama_dinilai'] ?? null,

//             'p2' => $p2,
//             'kode_organisasi_p2' => $penilai_info_map[$p2]['kode_organisasi'] ?? null,
//             'nama_p2' => $penilai_info_map[$p2]['nama_dinilai'] ?? null,

//             'p3' => $p3,
//             'kode_organisasi_p3' => $penilai_info_map[$p3]['kode_organisasi'] ?? null,
//             'nama_p3' => $penilai_info_map[$p3]['nama_dinilai'] ?? null,

//             'pembaharuan' => date('Y-m-d H:i:s'),
//         ];
//     }

//     // Tampilkan hasil untuk debugging
//     echo '<pre>';
//     var_dump($data);
//     echo '</pre>';


	
// 	// $result = $this->M_matrix->update_multiple_matriks($data);

// 	// $this->session->set_flashdata('success', 'Data berhasil diperbarui!');


// 	// redirect('C_matrix_penilaian');
// }





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
		$aadc = $this->input->get('input_nik[]');
		$ap1  = $this->input->get('p1');
		$ap2  = $this->input->get('p2');
		$ap3  = $this->input->get('p3');

		// $nikArray = explode(',', $aadc);

		$dataNik = [
			'nik_dinilai' => $aadc,
			'nik_p1' => $ap1,
			'nik_p2' => $ap2,
			'nik_p3' => $ap3
 		];

		echo '<pre>';
		var_dump($nikArray);
		echo '</pre>';

		// Menghapus data berdasarkan array NIK
		// $this->db->where_in('nik_dinilai', $nikArray);
		// $this->db->delete('data_matrix_ppk');

		// $this->session->set_flashdata('hapus_berhasil', 'Data berhasil dihapus.');


		// redirect('C_matrix_penilaian');
	}

	public function edit_penilai() {

		$nik_string = $this->input->get('input_nik'); // "1234,5678,91011"
		$nik = explode(',', $nik_string); // jadi array: ['1234', '5678', '91011']
		
		$this->session->set_userdata('input_nik', $nik);
		
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

		$data['knx'] = $this->M_matrix->penilai($nik);
		$data['mmx'] = $this->M_matrix->data_matriks($ktr);
		$data['kmn'] = $this->M_matrix->data_all(); 
		

		
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

}
