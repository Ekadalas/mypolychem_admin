<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_login extends CI_Model
{
	public function in_login($nik){


	$this->db->where('nik',$nik); 
	$query = $this->db->get('data_karyawan');



		// $query = $this->db->query("SELECT * FROM data_karyawan WHERE nip_btn = '$nip_btn' AND BINARY password = '$hashedPassword'");
		// return $query
	}

	public function cek_log($nik, $password) {

		$data =  $this->db->query("SELECT * FROM data_karyawan WHERE nip_btn = '$nik' AND password = '$password' ");
		return $data;
	}
	
}
