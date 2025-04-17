<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class M_data_penilaian extends CI_model
{

	public function dataPenilaian($nik_sesi) {
    $cek = $this->db->query("SELECT cd_office FROM data_karyawan
    WHERE nip_btn = '$nik_sesi'");
    $fetch = $cek->row_array();
    $cd_office = $fetch['cd_office'];


		// menggunakan query builder pada codeigniter
		$data = $this->db->query("SELECT a.*, b.name, b.cd_grade, b.departemen
									FROM data_penilaian_ppk a
									LEFT JOIN data_karyawan b
									ON a.nik_dinilai = b.nip_btn
									WHERE a.nik_dinilai != ''
									AND b.cd_office = '$cd_office'
									ORDER BY cd_th_pap_prd DESC"); // WHERE office = '$office' AND name != '' (belum disesuaikan dengan database yang sebelumnya)
		return $data->result_array();
	}

  public function pilihDepart($nik_sesi) {
    $cek = $this->db->query("SELECT cd_office FROM data_karyawan
    WHERE nip_btn = '$nik_sesi'");
    $fetch = $cek->row_array();
    $cd_office = $fetch['cd_office'];

		$query = $this->db->query("SELECT a.departemen, b.cd_office
    FROM data_matrix_ppk a
    LEFT JOIN data_karyawan b ON a.nik_dinilai = b.nip_btn
    WHERE b.cd_office = '$cd_office'
    GROUP BY departemen");
		return $query->result_array();
	}

	public function get_depart($nik_sesi,$departemen) {

    $cek = $this->db->query("SELECT cd_office FROM data_karyawan
    WHERE nip_btn = '$nik_sesi'");
    $fetch = $cek->row_array();
    $cd_office = $fetch['cd_office'];
    
		$nik_sesi = $this->session->userdata('nip_btn');

		$query = $this->db->query("SELECT a.*, b.name, b.cd_grade, b.departemen
									FROM data_penilaian_ppk a
									LEFT JOIN data_karyawan b
									ON a.nik_dinilai = b.nip_btn
									WHERE a.nik_dinilai != ''
									AND b.cd_office = '$cd_office' AND b.departemen = '$departemen'
									ORDER BY cd_th_pap_prd DESC");
		return $query->result_array();
	}
}
