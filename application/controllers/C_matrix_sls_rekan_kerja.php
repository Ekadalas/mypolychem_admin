<?php
defined('BASEPATH') or exit('No direct script access allowed');
class C_matrix_sls_rekan_kerja extends CI_Controller
{

    // ini data matrix ppk
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('M_data_rekan_kerja');
    }

    public function index()
    {


        $data['matrix_rekan_kerja'] = $this->M_data_rekan_kerja->get_data_rekan_kerja();
        $this->load->view('v_matrix_rekan_kerja', $data);
    }


    public function edit_rekan_kerja()
    {

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

        // Ambil list code org dinilai
        $data['list_org_dinilai'] = $this->db
            ->select('code_org')
            ->distinct()
            ->from('tb_person_code_organisasi_sls')
            ->where('office', $office)   // <--- filter sesuai office

            ->get()
            ->result_array();

        // Ambil list code org penilai
        $data['list_org_penilai'] = $this->db
            ->select('code_org')
            ->distinct()
            ->from('tb_person_code_organisasi_sls')
            ->where('office', $office)   // <--- filter sesuai office

            ->get()
            ->result_array();

        // Kirim ke view
        $this->load->view('v_edit_rekan_kerja', $data);
    }




    public function get_detail_org($code_org = null)
    {


        if ($code_org) {
            $result = $this->db->distinct()
                ->select('nama_dinilai, nik_dinilai')
                ->from('data_matrix_sls_rekan_kerja')
                ->where('code_org_dinilai', $code_org)
                ->get()
                ->result();

            echo json_encode($result);
        }
    }


    public function get_detail_penilai($code_org = null)
    {
        if ($code_org) {
            $result = $this->db->distinct()
                ->select('nama_penilai, nik_penilai')
                ->from('data_matrix_sls_rekan_kerja')
                ->where('code_org_penilai', $code_org)
                ->get()
                ->result();

            echo json_encode($result);
        }
    }




    // ini update tanpa hapus yang sudah ada
    // public function update_multiple_rekan_kerja()
    // {
    //     $dinilai = $this->input->post('dinilai');   // array kode org dinilai
    //     $penilai = $this->input->post('penilai');   // array kode org penilai

    //     $resultDinilai = [];
    //     $resultPenilai = [];

    //     // Ambil detail dinilai
    //     foreach ($dinilai as $kode) {
    //         $query = $this->db->query("
    //             SELECT DISTINCT periode_sls, kode_organisasi, nik_dinilai, nama_dinilai 
    //             FROM data_matrix_sls 
    //             WHERE kode_organisasi = ?", [$kode]);
    //         $resultDinilai = array_merge($resultDinilai, $query->result_array());
    //     }

    //     // Ambil detail penilai
    //     foreach ($penilai as $kode) {
    //         $query = $this->db->query("
    //             SELECT DISTINCT periode_sls, kode_organisasi, nik_dinilai, nama_dinilai 
    //             FROM data_matrix_sls 
    //             WHERE kode_organisasi = ?", [$kode]);
    //         $resultPenilai = array_merge($resultPenilai, $query->result_array());
    //     }

    //     // Buat pasangan dinilai × penilai
    //     $insertData = [];
    //     foreach ($resultDinilai as $d) {
    //         foreach ($resultPenilai as $p) {
    //             $insertData[] = [
    //                 'periode_sls'      => $d['periode_sls'],
    //                 'code_org_dinilai' => $d['kode_organisasi'],
    //                 'nik_dinilai'      => $d['nik_dinilai'],
    //                 'nama_dinilai'     => $d['nama_dinilai'],
    //                 'code_org_penilai' => $p['kode_organisasi'],
    //                 'nik_penilai'      => $p['nik_dinilai'],
    //                 'nama_penilai'     => $p['nama_dinilai']
    //             ];
    //         }
    //     }

    //     // Insert batch
    //     if (!empty($insertData)) {
    //         $this->db->insert_batch('data_matrix_sls_rekan_kerja', $insertData);
    //     }
    // }


    // ini update hapus data yang sudah ada baik dinilai atau penilai
    // public function update_multiple_rekan_kerja()
    // {
    //     $dinilai = $this->input->post('dinilai');
    //     $penilai = $this->input->post('penilai');

    //     // Pastikan array
    //     if (!is_array($dinilai)) $dinilai = [$dinilai];
    //     if (!is_array($penilai)) $penilai = [$penilai];

    //     $resultDinilai = [];
    //     $resultPenilai = [];

    //     // Ambil detail dinilai
    //     foreach ($dinilai as $kode) {
    //         $query = $this->db->query("
    //             SELECT DISTINCT periode_sls, kode_organisasi, nik_dinilai, nama_dinilai 
    //             FROM data_matrix_sls 
    //             WHERE kode_organisasi = ?", [$kode]);
    //         $resultDinilai = array_merge($resultDinilai, $query->result_array());
    //     }

    //     // Ambil detail penilai
    //     foreach ($penilai as $kode) {
    //         $query = $this->db->query("
    //             SELECT DISTINCT periode_sls, kode_organisasi, nik_dinilai, nama_dinilai 
    //             FROM data_matrix_sls 
    //             WHERE kode_organisasi = ?", [$kode]);
    //         $resultPenilai = array_merge($resultPenilai, $query->result_array());
    //     }

    //     // --- STEP 1: HAPUS DATA LAMA ---
    //     foreach ($resultDinilai as $d) {
    //         $this->db->where('code_org_dinilai', $d['kode_organisasi']);
    //         $this->db->delete('data_matrix_sls_rekan_kerja');
    //     }

    //     foreach ($resultPenilai as $p) {
    //         $this->db->where('code_org_penilai', $p['kode_organisasi']);
    //         $this->db->delete('data_matrix_sls_rekan_kerja');
    //     }

    //     // --- STEP 2: BUAT PASANGAN BARU ---
    //     $insertData = [];
    //     foreach ($resultDinilai as $d) {
    //         foreach ($resultPenilai as $p) {
    //             $insertData[] = [
    //                 'periode_sls'      => $d['periode_sls'],
    //                 'code_org_dinilai' => $d['kode_organisasi'],
    //                 'nik_dinilai'      => $d['nik_dinilai'],
    //                 'nama_dinilai'     => $d['nama_dinilai'],
    //                 'code_org_penilai' => $p['kode_organisasi'],
    //                 'nik_penilai'      => $p['nik_dinilai'],
    //                 'nama_penilai'     => $p['nama_dinilai']
    //             ];
    //         }
    //     }

    //     // --- STEP 3: INSERT ULANG ---
    //     if (!empty($insertData)) {
    //         $this->db->insert_batch('data_matrix_sls_rekan_kerja', $insertData);
    //     }
    // }


    // ini untuk update multiple
    public function update_multiple_rekan_kerja()
    {
        $dinilai = $this->input->post('dinilai');
        $penilai = $this->input->post('penilai');

        if (!is_array($dinilai) || !is_array($penilai)) return;

        $insertData = [];
        $this->db->trans_start();

        for ($i = 0; $i < count($dinilai); $i++) {
            if (empty($dinilai[$i]) || empty($penilai[$i])) continue;

            // Ambil semua record utk org dinilai
            $queryDinilai = $this->db->query("
            SELECT code_org AS code_org_dinilai, nik AS nik_dinilai, name AS nama_dinilai
            FROM tb_person_code_organisasi_sls
            WHERE code_org = ?
        ", [$dinilai[$i]]);
            $dinilaiList = $queryDinilai->result_array();

            // Ambil semua record utk org penilai
            $queryPenilai = $this->db->query("
            SELECT code_org AS code_org_penilai, nik AS nik_penilai, name AS nama_penilai
            FROM tb_person_code_organisasi_sls
            WHERE code_org = ?
        ", [$penilai[$i]]);
            $penilaiList = $queryPenilai->result_array();

            // Loop kombinasi dinilai × penilai
            foreach ($dinilaiList as $d) {
                foreach ($penilaiList as $p) {
                    // Hapus pasangan lama kalau duplikat di salah satu sisi
                    $this->db->group_start();
                    $this->db->where('code_org_dinilai', $d['code_org_dinilai']);
                    $this->db->or_where('code_org_penilai', $p['code_org_penilai']);
                    $this->db->group_end();
                    $this->db->delete('data_matrix_sls_rekan_kerja');

                    // Insert data baru
                    $insertData[] = [
                        'code_org_dinilai' => $d['code_org_dinilai'],
                        'nik_dinilai'      => $d['nik_dinilai'],
                        'nama_dinilai'     => $d['nama_dinilai'],
                        'code_org_penilai' => $p['code_org_penilai'],
                        'nik_penilai'      => $p['nik_penilai'],
                        'nama_penilai'     => $p['nama_penilai'],
                        'periode_sls' => date("Y"),

                    ];
                }
            }
        }

        if (!empty($insertData)) {
            $this->db->insert_batch('data_matrix_sls_rekan_kerja', $insertData);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            show_error('Gagal menyimpan data.');
        } else {
            redirect('C_matrix_sls_rekan_kerja');
        }
    }



    // METHOD CONTROLLER UNTUK HAPUS MULTIPLE
    public function delete_multiple()
    {
        $ids = $this->input->post('input_id'); // dapat array dari AJAX

        if (!is_array($ids) || empty($ids)) {
            echo json_encode([
                "status" => "error",
                "message" => "Tidak ada data yang dipilih!"
            ]);
            return;
        }

        // hapus berdasarkan field tertentu (misal code_org_dinilai)
        $this->db->where_in('code_org_dinilai', $ids);
        $this->db->delete('data_matrix_sls_rekan_kerja'); // sesuaikan nama tabel

        if ($this->db->affected_rows() > 0) {
            echo json_encode([
                "status" => "success",
                "message" => "Data berhasil dihapus!"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Data gagal dihapus!"
            ]);
        }
    }

    public function edit_multiple_rekan_kerja()
    {
        $ids = $this->input->post('input_id');

        if (empty($ids) || !is_array($ids)) {
            echo "Tidak ada data terpilih";
            return;
        }

        // Ambil data lama tanpa duplikat
        $this->db->select('*');
        $this->db->where_in('code_org_dinilai', $ids);
        $this->db->group_by('code_org_dinilai'); // <-- hanya 1 record per code_org_dinilai
        $data_terpilih = $this->db->get('data_matrix_sls_rekan_kerja')->result_array();

        // Ambil semua pilihan dropdown
        $list_org = $this->db->select('code_org')->get('tb_person_code_organisasi_sls')->result_array();

        $data = [
            'data_terpilih' => $data_terpilih,
            'list_org'      => $list_org
        ];

        $this->load->view('v_edit_rekan_kerja_form', $data);
    }

    public function editb_multiple_rekan_kerja()
    {
        $dinilaiBaru  = (array) $this->input->post('dinilai');
        $penilaiBaru  = (array) $this->input->post('penilai');
        $dinilaiLama  = (array) $this->input->post('dinilai_lama');
        $penilaiLama  = (array) $this->input->post('penilai_lama');

        $this->db->trans_begin();

        try {
            $insertData = [];

            foreach ($dinilaiBaru as $key => $codeOrgDinilaiBaru) {
                $codeOrgPenilaiBaru = $penilaiBaru[$key] ?? null;
                $codeOrgDinilaiLama = $dinilaiLama[$key] ?? null;
                $codeOrgPenilaiLama = $penilaiLama[$key] ?? null;

                // skip kalau kosong
                if (empty($codeOrgDinilaiBaru) || empty($codeOrgPenilaiBaru)) {
                    continue;
                }

                // --- Hapus pasangan lama (jika ada)
                if (!empty($codeOrgDinilaiLama) && !empty($codeOrgPenilaiLama)) {
                    $this->db->where('code_org_dinilai', $codeOrgDinilaiLama);
                    $this->db->where('code_org_penilai', $codeOrgPenilaiLama);
                    $this->db->delete('data_matrix_sls_rekan_kerja');
                }

                // --- Ambil semua record utk dinilai
                $dinilaiList = $this->db
                    ->get_where('tb_person_code_organisasi_sls', ['code_org' => $codeOrgDinilaiBaru])
                    ->result_array();

                // --- Ambil semua record utk penilai
                $penilaiList = $this->db
                    ->get_where('tb_person_code_organisasi_sls', ['code_org' => $codeOrgPenilaiBaru])
                    ->result_array();

                // --- Loop kombinasi dinilai × penilai
                foreach ($dinilaiList as $d) {
                    foreach ($penilaiList as $p) {
                        $insertData[] = [
                            'code_org_dinilai' => $d['code_org'],
                            'nik_dinilai'      => $d['nik'],
                            'nama_dinilai'     => $d['name'],
                            'code_org_penilai' => $p['code_org'],
                            'nik_penilai'      => $p['nik'],
                            'nama_penilai'     => $p['name'],
                            'periode_sls' => date("Y"),
                        ];
                    }
                }
            }

            // --- Insert batch (lebih efisien, semua row masuk)
            if (!empty($insertData)) {
                $this->db->insert_batch('data_matrix_sls_rekan_kerja', $insertData);

                // log untuk debug
                log_message('debug', 'Insert batch: ' . json_encode($insertData));
            }

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                $this->session->set_flashdata('success', 'Data berhasil diupdate.');
            } else {
                throw new Exception('Transaksi gagal.');
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Gagal update: ' . $e->getMessage());
        }

        redirect('C_matrix_sls_rekan_kerja');
    }
}
