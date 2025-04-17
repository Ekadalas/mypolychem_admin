<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_matriks extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('M_matriks');
	}

	public function index() {

		$data_matriks['data'] = $this->M_matriks->dataMatriks();
		$data_matriks['departemen'] = $this->M_matriks->pilihDepart();
		$this->load->view('v_matriks', $data_matriks);
	}

	public function filter() {

		$departemen = $this->input->post('departemen');

		$data_matriks['depart'] = $this->M_matriks->get_depart($departemen);

		$this->load->view('v_matriks',$data_matriks);
	}

	
}