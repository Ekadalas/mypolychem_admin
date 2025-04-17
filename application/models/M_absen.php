<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class M_absen extends CI_Model
{

	public function ambilAbsen()
	{
       // $nik_sesi = $this->session->userdata('nip_btn');

		$data = $this->db->query("SELECT
	    a.nip,a.nip_btn,
	    b.name,
	    c.departemen,
	    CASE
	        WHEN b.cd_office = '000' THEN 'HO'
	        WHEN b.cd_office = '001' THEN 'MRK'
	        WHEN b.cd_office = '002' THEN 'TGR'
	        WHEN b.cd_office = '003' THEN 'KRW'
	        ELSE 'Lainnya' -- Berikan nilai default jika tidak ada yang cocok
	    END AS kantor,
	    a.tgl_masuk,
	    a.jam_masuk,
	    a.tgl_pulang,
	    a.jam_pulang,
	    b.foto_registrasi,
	    a.foto_masuk,
	    a.foto_keluar
		FROM data_absen a
		LEFT JOIN data_karyawan b
	    ON a.nip_btn = b.nip_btn
	    LEFT JOIN data_matrix_approve_cuti c
        ON a.nip_btn = c.nik_dinilai
       -- WHERE b.cd_office = '$nik_sesi'
        GROUP BY c.departemen");
		return $data->result_array();
	}

	public function ambilDepart() {

		$query = $this->db->query("SELECT departemen FROM data_karyawan GROUP BY departemen");
		return $query->result_array();
	}


   public function get_departemen($cd_office) {

    $hasil = $this->db->query("SELECT departemen FROM data_karyawan WHERE cd_office = '$cd_office' GROUP BY departemen");
    return $hasil->result_array();


    // $this->db->select('b.departemen');
    // $this->db->from('data_karyawan a');
    // $this->db->join('data_matrix_approve_cuti b', 'a.nip_btn = b.nik_dinilai', 'left');
    // $this->db->where('a.cd_office', $cd_office);
    // $this->db->group_by('b.departemen');
    // return $this->db->get()->result_array();
   }

   public function uploader($data) {
    $sql = "INSERT INTO data_absen (id, nip, nip_btn, tgl_masuk, tgl_masuk_formated, jam_masuk, tgl_pulang, tgl_pulang_formated, jam_pulang, cd_office, location, location_out, work_location, keterangan, foto_masuk, foto_keluar)
            VALUES ('', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $bind_data = array(
        $data['nip'],
        $data['nip_btn'],
        $data['tgl_masuk'],
        $data['tgl_masuk_formated'],
        $data['jam_masuk'],
        $data['tgl_pulang'],
        $data['tgl_pulang_formated'],
        $data['jam_pulang'],
        $data['cd_office'],
        $data['location'],
        $data['location_out'],
        $data['work_location'],
        $data['keterangan'],
        $data['foto_masuk'],
        $data['foto_keluar']
    );

    return $this->db->query($sql, $bind_data);
}



	public function Data_tracking($mulai, $selesai, $cd_office, $departemen) {
 //   Gunakan Query Builder CodeIgniter untuk mengambil data
    // $this->db->select('
    //     a.nip_btn,
    //     b.name,
    //     c.departemen,
    //     CASE
    //         WHEN b.cd_office = "000" THEN "HO"
    //         WHEN b.cd_office = "001" THEN "MRK"
    //         WHEN b.cd_office = "002" THEN "TGR"
    //         WHEN b.cd_office = "003" THEN "KRW"
    //         ELSE "Lainnya"
    //     END AS kantor,
    //     a.tgl_masuk,
    //     a.jam_masuk,
    //     a.tgl_pulang,
    //     a.jam_pulang,
    //     b.foto_registrasi,
    //     a.foto_masuk,
    //     a.foto_keluar,
    //     a.status_hrms
    // ', false); // 'false' untuk menghindari escape karakter

    //        $this->db->from('data_absen a');
    //     $this->db->join('data_karyawan b', 'a.nip_btn = b.nip_btn', 'left');
    //     $this->db->join('data_matrix_approve_cuti c', 'a.nip_btn = c.nik_dinilai', 'left');
    //     $this->db->group_start();
    //     $this->db->where('a.tgl_masuk >=', $mulai);
    //     $this->db->where('a.tgl_masuk <=', $selesai);
    //     $this->db->group_end();
    //     $this->db->or_group_start();
    //     $this->db->where('a.tgl_pulang >=', $mulai);
    //     $this->db->where('a.tgl_pulang <=', $selesai);
    //     $this->db->group_end();


    //  if ($departemen !== 'ALL') {
    //    $this->db->where('b.departemen', $departemen);
    // }

    // $query = $this->db->get();
    // return $query;

    // query dibawah ini dapat digunakan untuk tracking langsung ke database
    if ($departemen !== 'ALL') {
    	$depart = "AND b.departemen = '$departemen'";
    } else {
      $depart = "";
    }

   $query = $this->db->query("SELECT DISTINCT
		 		 a.nip,
				 a.nip_btn,
         b.name,
         c.departemen,
         CASE
             WHEN b.cd_office = '000' THEN 'HO'
             WHEN b.cd_office = '001' THEN 'MRK'
             WHEN b.cd_office = '002' THEN 'TGR'
             WHEN b.cd_office = '003' THEN 'KRW'
             ELSE 'Lainnya' -- Berikan nilai default jika tidak ada yang cocok
         END AS kantor,
         a.tgl_masuk,
         a.jam_masuk,
         a.tgl_pulang,
         a.jam_pulang,
         b.foto_registrasi,
         a.foto_masuk,
         a.foto_keluar,
         a.status_hrms
         FROM data_absen a
         LEFT JOIN data_karyawan b
         ON a.nip_btn = b.nip_btn
         LEFT JOIN data_matrix_approve_cuti c
         ON a.nip_btn = c.nik_dinilai
         WHERE ((a.tgl_masuk BETWEEN '$mulai' AND '$selesai')
         OR (a.tgl_pulang BETWEEN '$mulai' AND '$selesai'))
         $depart
         AND a.cd_office = '$cd_office'

         ORDER BY a.tgl_pulang, a.tgl_masuk, b.name ASC;  ");


      return $query;  // Mengembalikan hasil query dalam bentuk array objek
}


}
