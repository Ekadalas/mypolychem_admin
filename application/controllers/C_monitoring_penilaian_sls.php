<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_monitoring_penilaian_sls extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('M_monitoring_sls');
	}

	public function index() {
    $nik_sesi = $this->session->userdata('nip_btn');
		$data['monitor_sls'] = $this->M_monitoring_sls->dataMonitoring($nik_sesi);
    $data['depart'] = $this->M_monitoring_sls->pilihDepart($nik_sesi);
		$this->load->view('v_monitoring_sls', $data);
	}

  public function filter() {
    $nik_sesi = $this->session->userdata('nip_btn');
    $departemen = $this->input->post('departemen');

    $data['monitor_sls'] = $this->M_monitoring_sls->get_monitor($nik_sesi, $departemen); // UBAH INI
    $data['depart'] = $this->M_monitoring_sls->pilihDepart($nik_sesi);
    $this->load->view('v_monitoring_sls', $data);
  }


  public function getDetailPenilaian()
{
    $nik_dinilai = $this->input->post('nik_dinilai');
    // Pastikan data nik_dinilai tidak kosong dan sesuai
    if (empty($nik_dinilai)) {
        echo json_encode(['error' => 'nik_dinilai tidak ditemukan']);
        return;
    }

    $data = $this->M_monitoring_sls->detail_penilai($nik_dinilai);
    echo json_encode($data); // Kirim data dalam format JSON
}










}
