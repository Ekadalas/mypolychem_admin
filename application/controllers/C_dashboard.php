<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class C_dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		// $this->load->model('M_dashboard');
	}

	public function index() {

		// $x['data'] = $this->M_dashboard->ambilBar();
		// $x['perizinan'] = $this->M_dashboard->izinBar();
		// $x['hadir'] = $this->M_dashboard->grafikKehadiran();
		// $this->load->view('v_dashboard',$x);
		$this->load->view('v_dashboard');
	}
}
