<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_dashboard extends CI_Model
{
	public function ambilBar() {

    $nik_sesi = $this->session->userdata('nip_btn');

		 $hasilCuti = $this->db->query("
            SELECT 
            CASE 
                WHEN a.status = '2' THEN 'Approve' 
                ELSE 'Register' 
            END AS status_group,
            
            SUM(CASE WHEN a.status = '2' THEN 1 ELSE 0 END) AS total_status,
            
            CASE 
                WHEN a.status_hrms = '1' THEN 'IN HRMS' 
                ELSE 'NO HRMS' 
            END AS hrms_group,
            
            SUM(CASE WHEN a.status_hrms = '1' THEN 1 ELSE 0 END) AS total_hrms
        FROM 
            data_cuti a
        LEFT JOIN 
            data_karyawan b 
        ON 
            a.nip_btn = b.nip_btn 
        WHERE 
            b.cd_office = '$nik_sesi'
            AND a.date_start BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') 
                              AND LAST_DAY(CURDATE())
        GROUP BY 
            status_group, hrms_group;

        ");

        return $hasilCuti->result_array();
	}
  public function izinBar() {

$nik_sesi = $this->session->userdata('nip_btn');

		$dataIzin = $this->db->query(" SELECT 
                CASE 
                    WHEN status = '1' THEN 'IN HRMS' 
                   	WHEN status = '0' THEN 'NO HRMS'
                    ELSE 'UNKNOW' 
                END AS hrms_group,
                
                SUM(CASE WHEN status = '1' THEN 1 ELSE 0 END) AS total_hrms,
                SUM(CASE WHEN status = '0' THEN 1 ELSE 0 END) AS jumlah_hrms,
                COUNT(id) AS data
            FROM 
                data_izin a
            LEFT JOIN
                data_karyawan b
            ON a.nip_btn = b.nip_btn 
            WHERE 
                b.cd_office = '$nik_sesi'
                AND a.date_start BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01')
                                    AND LAST_DAY(CURDATE())
            GROUP BY 
                hrms_group;");

		return $dataIzin->result_array();

	}

 public function grafikKehadiran() {

$nik_sesi = $this->session->userdata('nip_btn');

 $data = $this->db->query("SELECT kategori, COUNT(nip_btn) AS jumlah
FROM (
    -- Karyawan dengan kehadiran
    SELECT 
        a.nip_btn, 
        'Kehadiran' AS kategori
    FROM 
        data_karyawan a
    LEFT JOIN 
        data_absen b 
        ON a.nip_btn = b.nip_btn AND a.nip = b.nip
           AND b.tgl_pulang IS NOT NULL 
           AND b.jam_pulang IS NOT NULL 
          -- AND b.tgl_masuk BETWEEN '2024-11-28' AND '2024-11-28'
           AND b.tgl_masuk BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01')
                           AND LAST_DAY(CURDATE())
    WHERE 
        a.level = 'user' 
        AND a.cd_office = '$nik_sesi'
        AND b.nip_btn IS NOT NULL

    UNION ALL

    -- Karyawan dengan cuti
    SELECT 
        a.nip_btn, 
        'Cuti' AS kategori
    FROM 
        data_karyawan a
    LEFT JOIN 
        data_cuti c 
        ON a.nip_btn = c.nip_btn AND a.nip = c.nip
          -- AND c.date_start BETWEEN '2024-11-28' AND '2024-11-28'
           AND c.date_start BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01')
                                AND LAST_DAY(CURDATE())
           AND c.status = '2' -- Hanya cuti valid
    WHERE 
        a.level = 'user' 
        AND a.cd_office = '$nik_sesi'
        AND c.nip_btn IS NOT NULL

    UNION ALL

    -- Karyawan dengan izin
    SELECT 
        a.nip_btn, 
        'Izin' AS kategori
    FROM 
        data_karyawan a
    LEFT JOIN 
        data_izin d 
        ON a.nip_btn = d.nip_btn AND a.nip = d.nip
          -- AND d.date_start BETWEEN '2024-11-28' AND '2024-11-28'
           AND d.date_start BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01')
                               AND LAST_DAY(CURDATE())
           AND d.status = '2' -- Hanya izin valid
    WHERE 
        a.level = 'user' 
        AND a.cd_office = '$nik_sesi'
        AND d.nip_btn IS NOT NULL

    UNION ALL

    -- Karyawan alfa (tidak ada catatan kehadiran, cuti, maupun izin)
    SELECT 
        a.nip_btn, 
        'Alfa' AS kategori
    FROM 
        data_karyawan a
    LEFT JOIN (
        -- Gabungan data absensi, cuti, dan izin yang valid
        SELECT nip_btn FROM data_absen
        WHERE tgl_pulang IS NOT NULL 
          AND jam_pulang IS NOT NULL 
          AND tgl_masuk BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01')
                          AND LAST_DAY(CURDATE())
       --   AND tgl_masuk BETWEEN '2024-11-28' AND '2024-11-28'
        UNION
        SELECT nip_btn FROM data_cuti
        WHERE 
        -- date_start BETWEEN '2024-11-28' AND '2024-11-28' 
         date_start BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01')
                        AND LAST_DAY(CURDATE())
        AND status = '2'
        UNION
        SELECT nip_btn FROM data_izin
        WHERE 
        -- date_start BETWEEN '2024-11-28' AND '2024-11-28' 
         date_start BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01')
                         AND LAST_DAY(CURDATE())
        AND status = '2'
    ) valid_data
    ON a.nip_btn = valid_data.nip_btn
    WHERE 
        a.level = 'user' 
        AND a.cd_office = '$nik_sesi'
        AND valid_data.nip_btn IS NULL -- Tidak ada catatan valid
) AS kategori_total
GROUP BY kategori;");

//     $data = $this->db->query("SELECT kategori, COUNT(nip_btn) AS jumlah
// FROM (
//     -- Karyawan dengan kehadiran
//     SELECT 
//         a.nip_btn, 
//         'Kehadiran' AS kategori
//     FROM 
//         data_karyawan a
//     LEFT JOIN 
//         data_absen b 
//         ON a.nip_btn = b.nip_btn AND a.nip = b.nip
//           AND b.tgl_pulang IS NOT NULL 
//           AND b.jam_pulang IS NOT NULL 
//            AND b.tgl_masuk BETWEEN '2024-11-28' AND '2024-11-28'
//         -- AND b.tgl_masuk BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01')
//   --                     AND LAST_DAY(CURDATE())
//     WHERE 
//         a.level = 'user' 
//         AND a.cd_office = '000'
//         AND b.nip_btn IS NOT NULL

//     UNION ALL

//     -- Karyawan dengan cuti
//     SELECT 
//         a.nip_btn, 
//         'Cuti' AS kategori
//     FROM 
//         data_karyawan a
//     LEFT JOIN 
//         data_cuti c 
//         ON a.nip_btn = c.nip_btn AND a.nip = c.nip
//            AND c.date_start BETWEEN '2024-11-28' AND '2024-11-28'
//            -- AND c.date_start BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01')
//   --                      AND LAST_DAY(CURDATE())
//     WHERE 
//         a.level = 'user' 
//         AND a.cd_office = '000'
//         AND c.nip_btn IS NOT NULL
//         AND c.status = '2'

//     UNION ALL

//     -- Karyawan dengan izin
//     SELECT 
//         a.nip_btn, 
//         'Izin' AS kategori
//     FROM 
//         data_karyawan a
//     LEFT JOIN 
//         data_izin d 
//         ON a.nip_btn = d.nip_btn AND a.nip = d.nip
//            AND d.date_start BETWEEN '2024-11-28' AND '2024-11-28'
//        --  AND d.date_start BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01')
//     --                   AND LAST_DAY(CURDATE())
//     WHERE 
//         a.level = 'user' 
//         AND a.cd_office = '000'
//         AND d.nip_btn IS NOT NULL
//         AND d.status = '2'

//     UNION ALL

//  -- Karyawan alfa (tidak ada catatan kehadiran, cuti, maupun izin)
// SELECT 
//     a.nip_btn, 
//     'Alfa' AS kategori
// FROM 
//     data_karyawan a
// LEFT JOIN 
//     data_absen b 
//     ON a.nip_btn = b.nip_btn
//        AND (b.tgl_masuk IS NULL AND b.tgl_pulang IS NULL)
//        AND (b.jam_masuk IS NULL AND b.jam_pulang IS NULL)
//        AND b.tgl_masuk BETWEEN '2024-11-28' AND '2024-11-28'
//     -- AND b.tgl_masuk BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01')
//   --                     AND LAST_DAY(CURDATE())
// LEFT JOIN 
//     data_cuti c 
//     ON a.nip_btn = c.nip_btn
//        AND c.date_start BETWEEN '2024-11-28' AND '2024-11-28'
//     -- AND c.date_start BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01')
//   --                      AND LAST_DAY(CURDATE())
// LEFT JOIN 
//     data_izin d 
//     ON a.nip_btn = d.nip_btn
//        AND d.date_start BETWEEN '2024-11-28' AND '2024-11-28'
//    --  AND d.date_start BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01')
//     --                   AND LAST_DAY(CURDATE())
// WHERE 
//     a.level = 'user' 
//     AND a.cd_office = '000'
//     AND b.nip_btn IS NULL 
//     AND c.nip_btn IS NULL 
//     AND d.nip_btn IS NULL

// ) AS kategori_total
// GROUP BY kategori;");

    return $data->result_array();
 }
}