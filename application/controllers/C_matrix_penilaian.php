<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_matrix_penilaian extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('M_matrix');
	}

	public function index() {

		$data['matrix'] = $this->M_matrix->dataMatrix();
		$this->load->view('v_matrix', $data);
	}




}
