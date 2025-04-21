<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data_pertanyaan extends CI_Model
{

	
    public function getDataSelectGrade() 
    {
    // Mengambil data grade dari database
    $data = $this->db->query("SELECT DISTINCT 
                                CASE 
                                  WHEN grade BETWEEN '01' AND '07' THEN '01-07'
                                  WHEN grade BETWEEN '08' AND '09' THEN '08-09'
                                  WHEN grade BETWEEN '10' AND '11' THEN '10-11'
                                  WHEN grade BETWEEN '12' AND '19' THEN '12-19'
                                  ELSE 'Unknown'
                                END AS grade_group
                                FROM data_pertanyaan_ppk");
        return $data->result_array();
    }

    
  public function getAllTypePer() 
  {
    $data = $this->db->query("SELECT DISTINCT type_pertanyaan 
                                FROM data_pertanyaan_ppk");
    return $data->result_array();
  }

  public function getDataPertanyaanHardCom($grade, $type_pertanyaan) {
    // Memisahkan nilai grade menjadi bagian sebelum dan sesudah tanda "-"
    $gradeParts = explode('-', $grade);

    if (count($gradeParts) == 2) {
        // Jika grade dalam format rentang seperti '01-07'
        $gradeStart = $gradeParts[0];
        $gradeEnd = $gradeParts[1];

        // Menyesuaikan query untuk menggunakan rentang grade
        $query = $this->db->query("
            SELECT DISTINCT 
                
              
                CASE 
                    WHEN grade BETWEEN '01' AND '07' THEN '01-07'
                    WHEN grade BETWEEN '08' AND '09' THEN '08-09'
                    WHEN grade BETWEEN '10' AND '11' THEN '10-11'
                    WHEN grade BETWEEN '12' AND '19' THEN '12-19'
                    ELSE 'Unknown'
                END AS grade_group,
                pertanyaan,
                descr_pertanyaan,
                type_pertanyaan,
                kd_pertanyaan
            FROM data_pertanyaan_ppk
            WHERE grade BETWEEN ? AND ?
             AND type_pertanyaan = '$type_pertanyaan'
        ", array($gradeStart, $gradeEnd));

        // Mengembalikan hasil query
        return $query->result_array();
    } else {
        // Jika data grade tidak sesuai dengan format yang diharapkan
        return array();
    }
  }

  

  public function model_update_pertanyaan($data) {
    // Ambil nilai parameter
    $pertanyaan = $data['pertanyaan'];
    $descr_pertanyaan = $data['descr_pertanyaan'];
    $type_pertanyaan = $data['type_pertanyaan'];
    $grade_pertanyaan = $data['grade_pertanyaan'];
    $kd_pertanyaan = $data['kd_pertanyaan'];

    // Jika grade_pertanyaan berformat '01-07', kita ambil nilai min dan max nya
    list($grade_min, $grade_max) = explode('-', $grade_pertanyaan);

    // Membuat query untuk update data
    $this->db->set('pertanyaan', $pertanyaan);
    $this->db->set('descr_pertanyaan', $descr_pertanyaan);
    $this->db->where('type_pertanyaan', $type_pertanyaan);
    $this->db->where('kd_pertanyaan', $kd_pertanyaan);
    $this->db->where('grade >=', $grade_min);
    $this->db->where('grade <=', $grade_max);

    // Proses update
    $this->db->update('data_pertanyaan_ppk');

    // Cek apakah query berhasil
    if ($this->db->affected_rows() > 0) {
        return true;  // Update berhasil
    } else {
        return false;  // Gagal update
    }
  }

}
