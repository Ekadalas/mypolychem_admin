<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_karyawan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('M_karyawan');
	}

	public function index() {

		$data['karyawan'] = $this->M_karyawan->dataKaryawan();
		$this->load->view('v_karyawan', $data);
	}

	public function password($nip_btn){
		$this->M_karyawan->reset_password($nip_btn);
		$this->session->set_flashdata('berhasil_reset_password', 'Data berhasil diubah');
		redirect('c_karyawan');
	}

	public function device($nip_btn){
		$this->M_karyawan->reset_device($nip_btn);
		$this->session->set_flashdata('berhasil_reset_device', 'Data berhasil diubah');
		redirect('c_karyawan');
	}



}
