<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class M_monitoring_sls extends CI_model
{

	public function dataMonitoring($nik_sesi) {
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


		// menggunakan query builder pada codeigniter
		$data = $this->db->query("SELECT dk.periode_ppk, dk.nik_dinilai, dk.nama_dinilai, dk.office, dk.departemen, dk.kode_organisasi, dk.organisasi_ppk,
                                   (CASE WHEN dk.nik_p1 IS NOT NULL AND dk.nik_p1 != '' THEN 1 ELSE 0 END +
                                   CASE WHEN dk.nik_p2 IS NOT NULL AND dk.nik_p2 != '' THEN 1 ELSE 0 END +
                                   CASE WHEN dk.nik_p3 IS NOT NULL AND dk.nik_p3 != '' THEN 1 ELSE 0 END
                                    ) AS jumlah_penilai,
                                    COUNT(DISTINCT stg.nip_penilai) as progress_penilaian,
                                    stg.tanggal_input
                                    FROM data_matrix_sls as dk
                                    LEFT JOIN  stg_penilaian_ppk as stg ON  dk.nik_dinilai =  stg.nik_dinilai
                                    WHERE dk.office = '$office'
                                    GROUP BY dk.periode_ppk, stg.nik_dinilai, dk.nama_dinilai
                                    ORDER BY dk.nama_dinilai ASC");
		return $data->result_array();
	}

  public function pilihDepart($nik_sesi) {
    $cek = $this->db->query("SELECT cd_office FROM data_karyawan
    WHERE nip_btn = '$nik_sesi'");
    $fetch = $cek->row_array();
    $cd_office = $fetch['cd_office'];

		$query = $this->db->query("SELECT a.departemen, b.cd_office
    FROM data_matrix_sls a
    LEFT JOIN data_karyawan b ON a.nik_dinilai = b.nip_btn
    WHERE b.cd_office = '$cd_office'
    GROUP BY departemen");
		return $query->result_array();
	}

	public function get_monitor($nik_sesi,$departemen) {

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


		// menggunakan query builder pada codeigniter
		$data = $this->db->query("SELECT dk.periode_ppk, dk.nik_dinilai, dk.nama_dinilai, dk.office, dk.departemen, dk.kode_organisasi, dk.organisasi_ppk,
                                   (CASE WHEN dk.nik_p1 IS NOT NULL AND dk.nik_p1 != '' THEN 1 ELSE 0 END +
                                   CASE WHEN dk.nik_p2 IS NOT NULL AND dk.nik_p2 != '' THEN 1 ELSE 0 END +
                                   CASE WHEN dk.nik_p3 IS NOT NULL AND dk.nik_p3 != '' THEN 1 ELSE 0 END
                                    ) AS jumlah_penilai,
                                    COUNT(DISTINCT stg.nip_penilai) as progress_penilaian,
                                    stg.tanggal_input
                                    FROM data_matrix_sls as dk
                                    LEFT JOIN  stg_penilaian_ppk as stg ON  dk.nik_dinilai =  stg.nik_dinilai
                                    WHERE dk.office = '$office'
                                    AND dk.departemen = '$departemen'
                                    GROUP BY dk.periode_ppk, stg.nik_dinilai, dk.nama_dinilai
                                    ORDER BY dk.nama_dinilai ASC");
		return $data->result_array();
	}

  public function detail_penilai($nik_dinilai)
{
      $query_sql = "SELECT DISTINCT a.periode_ppk,
      a.nik_p1 AS nik_penilai,
      a.nama_p1 AS nama_penilai,
      'P1' AS kode_penilai,
      CASE
      WHEN b.nip_penilai IS NOT NULL THEN 'Sudah Menilai'
      ELSE 'Belum Menilai'
      END AS status
      FROM data_matrix_sls a
      LEFT JOIN stg_penilaian_ppk b
      ON a.nik_dinilai = b.nik_dinilai
      AND a.nik_p1 = b.nip_penilai
      WHERE a.nik_dinilai = ?
      AND a.nik_p1 IS NOT NULL

      UNION ALL

      SELECT DISTINCT a.periode_ppk,
      a.nik_p2 AS nik_penilai,
      a.nama_p2 AS nama_penilai,
      'P2' AS kode_penilai,
      CASE
      WHEN b.nip_penilai IS NOT NULL THEN 'Sudah Menilai'
      ELSE 'Belum Menilai'
      END AS status
      FROM data_matrix_sls a
      LEFT JOIN stg_penilaian_ppk b
      ON a.nik_dinilai = b.nik_dinilai
      AND a.nik_p2 = b.nip_penilai
      WHERE a.nik_dinilai = ?
      AND a.nik_p2 IS NOT NULL

      UNION ALL

      SELECT DISTINCT a.periode_ppk,
      a.nik_p3 AS nik_penilai,
      a.nama_p3 AS nama_penilai,
      'P3' AS kode_penilai,
      CASE
      WHEN b.nip_penilai IS NOT NULL THEN 'Sudah Menilai'
      ELSE 'Belum Menilai'
      END AS status
      FROM data_matrix_sls a
      LEFT JOIN stg_penilaian_ppk b
      ON a.nik_dinilai = b.nik_dinilai
      AND a.nik_p3 = b.nip_penilai
      WHERE a.nik_dinilai = ?
      AND a.nik_p3 IS NOT NULL
      ";


    // Pasang parameter $nik_dinilai 3 kali untuk 3 kondisi WHERE
    $query = $this->db->query($query_sql, array($nik_dinilai, $nik_dinilai, $nik_dinilai));

    return $query->result_array();
}

}
