<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class M_cuti extends CI_Model
{

		public function dataCuti()
		{
		$nik_sesi = $this->session->userdata('nip_btn');

		$data_cuti = $this->db->query("SELECT DISTINCT
		a.nip_btn,b.name,b.departemen,b.cd_office,
		a.date_start,a.date_end,a.lama_cuti,a.remark,
		a.status,a.cd_vacation,a.status_hrms,a.date_input_cuti,
		a.date_approval,c.nik_p1 AS Nik_penyetuju,c.nama_p1 AS nama_penyetuju
		FROM
		data_cuti a
		LEFT JOIN
		data_karyawan b ON a.nip = b.nip AND a.nip_btn = b.nip_btn
		LEFT JOIN
		data_matrix_approve_cuti c ON a.nip_btn = c.nik_dinilai
		WHERE
		b.cd_office = $nik_sesi
		ORDER BY b.name,a.date_start DESC;");

		return $data_cuti->result_array();

		}

    public function proses_cuti($nik_sesi, $nobulan, $tahun) {

    $sql = "SELECT  DISTINCT
		a.nip_btn,
    b.name,
    b.departemen,
    b.cd_office,
    a.date_start,
    a.date_end,
    a.lama_cuti,
    a.remark,
    a.status,
    a.cd_vacation,
    a.status_hrms,
    a.date_input_cuti,
    a.date_approval,
		c.nik_p1 AS Nik_penyetuju,
    c.nama_p1 AS nama_penyetuju
        FROM data_cuti a
        LEFT JOIN data_karyawan b ON a.nip_btn = b.nip_btn
				LEFT JOIN
				    data_matrix_approve_cuti c ON a.nip_btn = c.nik_dinilai
        WHERE b.cd_office = ?
        AND MONTH(a.date_start) = ?
        AND YEAR(a.date_start) = ?
        ORDER BY b.name";

    $query = $this->db->query($sql, [$nik_sesi, $nobulan, $tahun]);
    return $query->result_array();
    }

    public function tahun() {
        $squery = $this->db->query("SELECT DISTINCT YEAR(date_start) AS tahun FROM data_cuti");
        return $squery->result_array();
    }


		public function dataCutiBelumDisetujui($nip)
		{

			if ($nip == '000') {
				$kode_kantor = '000';
			}elseif ($nip == '001') {
				$kode_kantor = '001';
			}elseif ($nip == '002') {
				$kode_kantor = '002';
			}elseif ($nip == '003') {
				$kode_kantor = '003';
			}

		$data_cuti = $this->db->query("SELECT DISTINCT
		a.id,a.nip_btn,b.name,b.departemen,b.cd_office,
		a.date_start,a.date_end,a.lama_cuti,a.remark,
		a.status,a.cd_vacation,a.status_hrms,a.date_input_cuti,
		a.date_approval,c.nik_p1 AS Nik_penyetuju,c.nama_p1 AS nama_penyetuju
		FROM
		data_cuti a
		LEFT JOIN
		data_karyawan b ON a.nip = b.nip AND a.nip_btn = b.nip_btn
		LEFT JOIN
		data_matrix_approve_cuti c ON a.nip_btn = c.nik_dinilai
		WHERE
		b.cd_office = $nip
		AND a.status = '0'
		ORDER BY b.name,a.date_start DESC;");

		return $data_cuti->result_array();

		}

		public function update_status($nip,$nip_btn,$id){
			$hasil = $this->db->query("UPDATE data_cuti
			SET status = '2', nip_btn_approval = '$nip'
			WHERE nip_btn = '$nip_btn' AND id = '$id'");
			return $hasil;
		}
}
