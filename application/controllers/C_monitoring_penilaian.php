<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_monitoring_penilaian extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('M_monitoring_penilaian');
	}

	public function index() {
    $nik_sesi = $this->session->userdata('nip_btn');
		$data['monitoring'] = $this->M_monitoring_penilaian->dataMonitoringPenilaian($nik_sesi);
    $data['departemen'] = $this->M_monitoring_penilaian->pilihDepart($nik_sesi);
		$this->load->view('v_monitoring_penilaian', $data);
	}

  public function filter() {
    $nik_sesi = $this->session->userdata('nip_btn');
    $departemen = $this->input->post('departemen');

    $data['monitoring'] = $this->M_monitoring_penilaian->get_depart($nik_sesi, $departemen); // UBAH INI
    $data['departemen'] = $this->M_monitoring_penilaian->pilihDepart($nik_sesi);
    $this->load->view('v_monitoring_penilaian', $data);
  }


  public function getDetailPenilaian()
{
    $nik_dinilai = $this->input->post('nik_dinilai');
    // Pastikan data nik_dinilai tidak kosong dan sesuai
    if (empty($nik_dinilai)) {
        echo json_encode(['error' => 'nik_dinilai tidak ditemukan']);
        return;
    }

    $data = $this->M_monitoring_penilaian->detail_penilai($nik_dinilai);
    echo json_encode($data); // Kirim data dalam format JSON
}










}
