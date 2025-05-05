<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_matrix_sls extends CI_Model
{

	public function dataMatrix()
	{
  $nik_sesi = $this->session->userdata('nip_btn');

  $cek = $this->db->query("SELECT cd_office FROM data_karyawan
  WHERE nip_btn = '$nik_sesi'");
  $fetch = $cek->row_array();
  $cd_office = $fetch['cd_office'];
  if ($cd_office == '00') {
    $office = 'HO';
  }elseif ($cd_office == '01') {
    $office = 'MRK';
  }elseif ($cd_office == '02') {
    $office = 'TGR';
  }elseif ($cd_office == '03') {
    $office = 'KRW';
  }

	$data_matrix = $this->db->query("SELECT a.id, a.periode_ppk ,a.nik_dinilai, a.nama_dinilai, b.departemen , b.unit_kerja, a.nama_p1, a.nama_p2, a.nama_p3 FROM data_matrix_sls a LEFT JOIN data_karyawan b ON a.nik_dinilai = b.nip_btn WHERE a.office = '$office' ORDER BY a.nama_dinilai ASC;");

	return $data_matrix->result_array();
	}


  public function data_matriks($ktr) {


    $sql = $this->db->query("SELECT *, b.cd_grade FROM data_matrix_sls a LEFT JOIN data_karyawan b ON a.nik_dinilai = b.nip_btn WHERE office = '$ktr' GROUP BY nik_dinilai ORDER BY nama_dinilai ASC"); 
    return $sql->result_array(); 
  }

  public function penilai($nik) {

		// Jika $nik adalah array, ubah jadi format string untuk IN (...)
		if (is_array($nik)) {
			$nik_string = "'" . implode("','", $nik) . "'"; // hasil: '1234','5678','9012'
		} else {
			$nik_string = "'$nik'"; // fallback kalau bukan array
		}

		$query = $this->db->query("SELECT id, nik_dinilai, nama_dinilai, nik_p1, nama_p1, nik_p2, nama_p2, nik_p3, nama_p3 FROM data_matrix_sls WHERE id IN ($nik_string)"); 
		return $query->result_array(); 
	}


  public function data_all() {
    $nik_sesi = $this->session->userdata('nip_btn');

		if ($nik_sesi == '00') {
			$where_office = '000';
		}elseif ($nik_sesi == '01') {
			$where_office = '001';
		}elseif ($nik_sesi == '02') {
			$where_office = '002';
		}elseif ($nik_sesi == '03') {
			$where_office = '003';
		}
    $query = $this->db->query("SELECT name, nip_btn FROM data_karyawan WHERE cd_office = '$where_office'  ORDER BY name ASC  ");
    return $query->result_array();
  }


  public function ubahPenilai($nik_awal, $pengganti, $p1, $p2, $p3) {
    // Eksekusi query untuk mendapatkan kode_organisasi berdasarkan $pengganti
    $query = $this->db->select('kode_organisasi, nama_dinilai')
                      ->from('data_matrix_ppk')
                      ->where('nik_dinilai', $pengganti)
                      ->get();
    $data = $query->row_array();
    if (!$data) {
        return false; // Data tidak ditemukan, hentikan proses
    }
    $code = $data['kode_organisasi'];
    $name = $data['nama_dinilai'];

    // Siapkan kondisi untuk update berdasarkan parameter yang diberikan
    $this->db->where('nik_dinilai', $nik_awal);
    if ($p1 !== null && $p2 === null && $p3 === null) {
        $cc = array('nik_p1' => $pengganti, 'nama_p1' => $name, 'kode_organisasi_p1' => $code);
    } elseif ($p1 === null && $p2 !== null && $p3 === null) {
        $cc = array('nik_p2' => $pengganti, 'nama_p2' => $name,  'kode_organisasi_p2' => $code);
    } elseif ($p1 === null && $p2 === null && $p3 !== null) {
        $cc = array('nik_p3' => $pengganti, 'nama_p3' => $name,  'kode_organisasi_p3' => $code);
    } else {
        return false;
    }

    
    // Lakukan update pada tabel data_matrix_ppk
    return $this->db->update('data_matrix_ppk', $cc);
  
  }

  public function nambah() {

    $nik_sesi = $this->session->userdata('nip_btn');
    $hasil =  $this->db->select('name')
         ->from('data_karyawan')
         ->where('cd_office', $nik_sesi)
         ->order_by('name', 'ASC')
         ->get();
    
    
  }

  // 

  public function update_multiple_matriks($data) {
    
    foreach ($data as $row) {
      $nik = $this->db->escape($row['nik']);
      $p1  = $this->db->escape($row['p1']);
      $p2  = $this->db->escape($row['p2']);
      $p3  = $this->db->escape($row['p3']);
  
      $nama_p1 = $this->db->escape($row['nama_p1']);
      $nama_p2 = $this->db->escape($row['nama_p2']);
      $nama_p3 = $this->db->escape($row['nama_p3']);
  
      $org_p1 = $this->db->escape($row['kode_organisasi_p1']);
      $org_p2 = $this->db->escape($row['kode_organisasi_p2']);
      $org_p3 = $this->db->escape($row['kode_organisasi_p3']);
      $pembaruan = $this->db->escape($row['pembaharuan']);
      
      // Query update lengkap
      $sql = "UPDATE data_matrix_sls
          SET nik_p1 = $p1,
            nama_p1 = $nama_p1,
            kode_organisasi_p1 = $org_p1,
            
            nik_p2 = $p2,
            nama_p2 = $nama_p2,
            kode_organisasi_p2 = $org_p2,
            
            nik_p3 = $p3,
            nama_p3 = $nama_p3,
            kode_organisasi_p3 = $org_p3,
            pembaharuan = $pembaruan
            
          WHERE id = $nik";
  
      // Eksekusi query
      $this->db->query($sql);
    }
  }
    
   public function organisasi() {

    $org = $this->db->query("SELECT organisasi_ppk FROM data_matrix_sls GROUP BY organisasi_ppk;"); 
    $HasOrg = $org->result_array(); 
   }



}
