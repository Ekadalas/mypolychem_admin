<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class M_data_rekan_kerja extends CI_Model
{

public function get_data_rekan_kerja() {

    
     $nik_sesi = $this->session->userdata('nip_btn');

    $cek = $this->db->query("SELECT cd_office FROM data_karyawan
    WHERE nip_btn = '$nik_sesi'");
    $fetch = $cek->row_array();
    $cd_office = $fetch['cd_office'];

    if ($cd_office == '00') {
        $office = 'HO';
    } elseif ($cd_office == '01') {
        $office = 'MRK';
    } elseif ($cd_office == '02') {
        $office = 'TGR';
    } elseif ($cd_office == '03') {
        $office = 'KRW';
    }

	$data_rekan_kerja = $this->db->query("SELECT DISTINCT    a.periode_sls, a.code_org_dinilai, a.code_org_penilai, b.office
	FROM data_matrix_sls_rekan_kerja a
	LEFT JOIN data_matrix_sls b ON a.code_org_dinilai = b.kode_organisasi
	WHERE b.office = '$office'
	ORDER BY a.code_org_dinilai ASC, a.code_org_penilai ASC;");

	return $data_rekan_kerja->result_array();

        
}


public function get_by_ids($ids)
{
    if (empty($ids)) {
        return [];
    }

    $this->db->select('*');
    $this->db->from('data_matrix_sls_rekan_kerja');   // nama tabel Anda
    $this->db->where_in('id', $ids);
    $query = $this->db->get();
    
    return $query->result_array();
}



}
