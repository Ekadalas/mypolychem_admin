<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class M_izin extends CI_Model
{

	public function dataIzin()
	{
		$nik_sesi = $this->session->userdata('nip_btn');
		if ($nik_sesi == '000') {
			$kode_kantor = '000';
		}elseif ($nik_sesi == '001') {
			$kode_kantor = '001';
		}elseif ($nik_sesi == '002') {
			$kode_kantor = '002';
		}elseif ($nik_sesi == '003') {
			$kode_kantor = '003';
		}

		$data = $this->db->query("SELECT a.nip_btn, a.cd_absensi,
			a.date_input,a.date_start, a.date_end, a.lama_cuti as lama_izin, a.remark,
			a.status, b.name,b.cd_office,c.nama_p1 as nama_atasan,
			b.departemen , a.status_hrms, a.date_approval
			FROM data_izin a
			LEFT JOIN data_karyawan b ON a.nip_btn = b.nip_btn
			AND a.nip = b.nip
			LEFT JOIN data_matrix_approve_cuti c ON a.nip_btn = c.nik_dinilai
			WHERE b.cd_office = '$kode_kantor'
			ORDER BY b.name ASC,a.date_start DESC;");
		return $data->result_array();
	}

	// public function proses_data_izin($nobulan, $tahun, $nik_sesi) {


	// $data = $this->db->query("
 //    SELECT a.nip_btn, a.cd_absensi, a.date_start AS bulan , a.date_end, a.lama_cuti, a.remark, a.status, b.name, b.cd_office
 //    FROM data_izin a
 //    LEFT JOIN data_karyawan b ON a.nip_btn = b.nip_btn
 //    AND a.nip = b.nip
 //    WHERE b.cd_office = '$nik_sesi'
 //    AND MONTH(a.date_start) = '$nobulan'
 //    AND YEAR(a.date_start) = '$tahun'
 //    ORDER BY b.name");



	// 	return $data->result_array();
	// }

	public function proses_data_izin($nobulan, $tahun, $nik_sesi) {
    $sql = "
        SELECT a.nip_btn, a.cd_absensi, a.date_start, a.date_end, a.lama_cuti, a.remark, a.status, b.name,b.cd_office, b.departemen , a.status_hrms
        FROM data_izin a
        LEFT JOIN data_karyawan b ON a.nip_btn = b.nip_btn
        LEFT JOIN data_matrix_approve_cuti c ON a.nip_btn = c.nik_dinilai
        WHERE b.cd_office = ?
        AND MONTH(a.date_start) = ?
        AND YEAR(a.date_start) = ?
        ORDER BY b.name";

    $query = $this->db->query($sql, [$nik_sesi, $nobulan, $tahun]);
    return $query->result_array();
}

	public function Ambiltahun() {

		$query = $this->db->query("SELECT DISTINCT YEAR(date_start) AS tahun FROM data_izin");
		return $query->result_array();
	}



	public function dataIzinBelumDisetujui()
	{

		$nik_sesi = $this->session->userdata('nip_btn');
		if ($nik_sesi == '000') {
			$kode_kantor = '000';
		}elseif ($nik_sesi == '001') {
			$kode_kantor = '001';
		}elseif ($nik_sesi == '002') {
			$kode_kantor = '002';
		}elseif ($nik_sesi == '003') {
			$kode_kantor = '003';
		}


		$data = $this->db->query("SELECT a.id,a.nip_btn, a.cd_absensi,
			a.date_input,a.date_start, a.date_end, a.lama_cuti as lama_izin, a.remark,
			a.status, b.name,b.cd_office,c.nama_p1 as nama_atasan,
			b.departemen , a.status_hrms, a.date_approval
			FROM data_izin a
			LEFT JOIN data_karyawan b ON a.nip_btn = b.nip_btn
			AND a.nip = b.nip
			LEFT JOIN data_matrix_approve_cuti c ON a.nip_btn = c.nik_dinilai
			WHERE b.cd_office = '$kode_kantor'
			AND a.status = '0'
			ORDER BY b.name ASC,a.date_start DESC;");
		return $data->result_array();
	}


	public function update_status($nip_btn,$id){
		$nik_sesi = $this->session->userdata('nip_btn');
		$hasil = $this->db->query("UPDATE data_izin
		SET status = '2', nip_btn_approval = '$nik_sesi'
		WHERE nip_btn = '$nip_btn' AND id = '$id'");
		return $hasil;
	}

}
