<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_lokasi extends CI_Model
{
	
	public function ambilKordinat()
	{
		$query = $this->db->query("SELECT * FROM data_work_location");
		return $query->result_array();
	}

	public function InsertPlus($loc) {

		// $data = $this->db->query("INSERT INTO data_work_location (latitude_longitude, cd_office, nm_office) VALUES ('$koordinat', '$kantor', '$nama')"); 

		// return $data;

		$data = $this->db->insert('data_work_location', $loc);
		return $data;
	}

	public function editing($id) {

		$data = $this->db->query("SELECT * FROM data_work_location WHERE id = '$id'");
		return $data->result_array();
	}

	public function edit_lagi($dataEdit) {

				$this->db->set('latitude_longitude', $dataEdit['latitude_longitude']);
				$this->db->set('cd_office', $dataEdit['cd_office']);
				$this->db->set('nm_office', $dataEdit['nm_office']);
				$this->db->set('radius_absen', $dataEdit['radius_absen']);
				$this->db->WHERE('id', $dataEdit['id']);
		return $data = $this->db->update('data_work_location');


	}
}
