<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_cuti extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('M_cuti');
	}

	public function index() {

		$data['cuti'] = $this->M_cuti->dataCuti();
		$data['ta']   = $this->M_cuti->tahun();
		$this->load->view('v_cuti', $data);
	}

	public function bulanCuti() {

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$nik_sesi = $this->session->userdata('nip_btn');

		$mapping = [
		'Januari'  => '1',
	    'Februari' => '2',
	    'Maret'    => '3',
	    'April'    => '4',
	    'Mei'      => '5',
	    'Juni'     => '6',
	    'Juli'     => '7',
	    'Agustus'  => '8',
	    'September' => '9',
	    'Oktober'  => '10',
	    'November' => '11',
	    'Desember' => '12'
		];

		$nobulan = isset($mapping[$bulan]) ? $mapping[$bulan] : null;
		if (!$nobulan) {
			show_error("bulan tidak ada");
		}

		$data_c['cuti'] = $this->M_cuti->proses_cuti($nik_sesi, $nobulan, $tahun);
		$data_c['ta']   = $this->M_cuti->tahun();
		$this->load->view('v_cuti', $data_c);
	}

	public function cuti_belum_disetujui($nip){
		$data['data_cuti_belum_disetujui'] = $this->M_cuti->dataCutiBelumDisetujui($nip);
		$data['ta']   = $this->M_cuti->tahun();
		$this->load->view('v_cuti_belum_disetujui', $data);
	}


	public function setujui_admin($nip,$nip_btn,$id){
		$this->M_cuti->update_status($nip,$nip_btn,$id);
		$this->session->set_flashdata('berhasil_approve', '');
		redirect('C_cuti/cuti_belum_disetujui/'.$nip);
	}

}
