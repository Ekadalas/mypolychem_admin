<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_matrix extends CI_Model
{

	public function dataMatrix()
	{
  $nik_sesi = $this->session->userdata('nip_btn');

  $cek = $this->db->query("SELECT cd_office FROM data_karyawan
  WHERE nip_btn = '$nik_sesi'");
  $fetch = $cek->row_array();
  $cd_office = $fetch['cd_office'];
  if ($cd_office == '000') {
    $office = 'HO';
  }elseif ($cd_office == '001') {
    $office = 'MRK';
  }elseif ($cd_office == '002') {
    $office = 'TGR';
  }elseif ($cd_office == '003') {
    $office = 'KRW';
  }

	$data_matrix = $this->db->query("SELECT *
	FROM data_matrix_ppk
	WHERE office = '$office'
	ORDER BY nama_dinilai ASC");

	return $data_matrix->result_array();
	}



}
