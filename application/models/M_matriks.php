<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class M_matriks extends CI_Model
{

	public function dataMatriks()
	{

		$nik_sesi = $this->session->userdata('nip_btn');

		$data_matriks = $this->db->query("SELECT a.nik_dinilai, a.nama_dinilai, a.departemen, b.cd_grade, a.office, a.organisasi_ppk, a.nik_p1 AS nik_atasan , a.nama_p1 AS nama_atasan FROM data_matrix_approve_cuti a LEFT JOIN data_karyawan b ON a.nik_dinilai = b.nip_btn  WHERE b.cd_office = '$nik_sesi'
-- LEFT JOIN data_karyawan c ON a.nik_p1 = c.nip_btn;
            ORDER BY a.office, a.nama_dinilai ASC;");

		return $data_matriks->result_array();
	}

	public function pilihDepart() {

		$nik_sesi = $this->session->userdata('nip_btn');

		$query = $this->db->query("SELECT a.departemen, b.cd_office FROM data_matrix_approve_cuti a LEFT JOIN data_karyawan b ON a.nik_dinilai = b.nip_btn WHERE b.cd_office = '$nik_sesi' GROUP BY departemen");
		return $query->result_array();
	}

	public function get_depart($departemen) {

		$nik_sesi = $this->session->userdata('nip_btn');

		$query = $this->db->query("SELECT a.nik_dinilai, a.nama_dinilai, a.departemen,
		b.cd_grade, a.office, a.organisasi_ppk, a.nik_p1 AS nik_atasan ,
		a.nama_p1 AS nama_atasan FROM data_matrix_approve_cuti a
		LEFT JOIN data_karyawan b ON a.nik_dinilai = b.nip_btn
		-- LEFT JOIN data_karyawan c ON a.nik_p1 = c.nip_btn;
		WHERE a.departemen = '$departemen' AND b.cd_office = '$nik_sesi'
    ORDER BY a.office, a.nama_dinilai ASC;");
		return $query->result_array();
	}
}
