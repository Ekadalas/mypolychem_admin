<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_karyawan extends CI_Model
{

	public function dataKaryawan()
	{
  $nik_sesi = $this->session->userdata('nip_btn');

		if ($nik_sesi == '000') {
			$where_office = '000';
		}elseif ($nik_sesi == '001') {
			$where_office = '001';
		}elseif ($nik_sesi == '002') {
			$where_office = '002';
		}elseif ($nik_sesi == '003') {
			$where_office = '003';
		}

	$data_karyawan = $this->db->query("SELECT *
	FROM data_karyawan
	WHERE cd_office = '$where_office' AND cd_grade < '18'
	ORDER BY name ASC");

	return $data_karyawan->result_array();
	}


	public function reset_password($nip_btn){
		$hasil = $this->db->query("UPDATE data_karyawan
		SET password = '797cb93f8b1159e6dc68b2b7fddd6c55'
		WHERE nip_btn = '$nip_btn'");

		date_default_timezone_set('Asia/Jakarta'); // Set zona waktu
		$date_reset = date('Y-m-d H:i:s');
		$hasil = $this->db->query("INSERT INTO data_remark(nip_btn,remark,date_reset)
		VALUES('$nip_btn','Permintaan reset password','$date_reset')");

		return $hasil;
	}

	public function reset_device($nip_btn){
		$hasil = $this->db->query("UPDATE data_karyawan
		SET device = NULL
		WHERE nip_btn = '$nip_btn'");

		date_default_timezone_set('Asia/Jakarta'); // Set zona waktu
		$date_reset = date('Y-m-d H:i:s');
		$hasil = $this->db->query("INSERT INTO data_remark(nip_btn,remark,date_reset)
		VALUES('$nip_btn','Permintaan reset device','$date_reset')");

		return $hasil;
	}

}
