<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class C_login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('M_login');
	}

	public function index() {

		$this->load->view('v_login');

	}

	public function loganLogin() {
    $nik = $this->input->post('nik');
    $password = $this->input->post('password');

    // Query untuk cek login
    $query = $this->M_login->cek_log($nik, md5($password));

    if ($query->num_rows() == 1) {
        $x        = $query->row_array();
        $nip_btn  = $x['nip_btn'];
        $pass     = $x['password'];
        $lvl      = $x['level'];
        $cd       = $x['cd_office'];

        $dataLogin = [
            'nip_btn' => $nip_btn,
            'password' => $pass,
            'level'    => $lvl,
            'Loggin'   => TRUE
        ];

        $this->session->set_userdata($dataLogin);

        // Cek apakah NIK dan password cocok
        if ($lvl == 'admin') {
            // Redirect ke dashboard
            redirect('C_dashboard');
        }elseif ($lvl == 'admin_ppk') {
					// Redirect ke dashboard
					redirect('C_dashboard');
        } else {
            // Set flashdata error jika gagal
            $this->session->set_flashdata('gagallagi', 'maaf login dulu');
            redirect('C_login');
        }
    } else {
        // Set flashdata error jika NIK atau password salah
        $this->session->set_flashdata('gagal', 'NIK atau password salah!');
        redirect('C_login');
    }
}


	public function outlog() {

		$this->session->sess_destroy();
		redirect('C_login');
	}


}
