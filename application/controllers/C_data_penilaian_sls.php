<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_data_penilaian_sls extends CI_Controller
{



public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('M_data_penilaian_sls');
	}

	public function index() {
    
    $nik_sesi = $this->session->userdata('nip_btn');
	$data['penilaian'] = $this->M_data_penilaian_sls->dataPenilaian($nik_sesi);
    $data['departemen'] = $this->M_data_penilaian_sls->pilihDepart($nik_sesi);
		
    $this->load->view('v_data_penilaian_sls', $data);
	
    }


      public function filter() {
    $nik_sesi = $this->session->userdata('nip_btn');
    $departemen = $this->input->post('departemen');

    $data['penilaian'] = $this->M_data_penilaian_sls->get_depart($nik_sesi, $departemen); // UBAH INI
    $data['departemen'] = $departemen; // kalau kamu butuh juga di view
    $this->load->view('v_data_penilaian', $data);
}





}

