<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_izin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('M_izin');
	}

	public function index() {

		$data_izin['data'] = $this->M_izin->dataIzin();
		$data_izin['ta'] = $this->M_izin->Ambiltahun();
		$this->load->view('v_izin', $data_izin);
	}

	public function tampil_izin() {

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$nik_sesi = $this->session->userdata('nip_btn');

		$map_bulan = [
	    'Januari' => '1',
	    'Februari' => '2',
	    'Maret' => '3',
	    'April' => '4',
	    'Mei' => '5',
	    'Juni' => '6',
	    'Juli' => '7',
	    'Agustus' => '8',
	    'September' => '9',
	    'Oktober' => '10',
	    'November' => '11',
	    'Desember' => '12'
	    ];

		$nobulan = isset($map_bulan[$bulan]) ? $map_bulan[$bulan] : null;
		if (!$nobulan) {
		    show_error("Bulan tidak valid: $bulan");
		}


		//var_dump($nobulan, $tahun, $nik_sesi);



		$data_izin['data'] = $this->M_izin->proses_data_izin($nobulan, $tahun ,$nik_sesi);
		$data_izin['ta'] = $this->M_izin->Ambiltahun();
		$this->load->view('v_izin', $data_izin);
	}



	public function izin_belum_disetujui() {
		$data_izin['data'] = $this->M_izin->dataIzinBelumDisetujui();
		$data_izin['ta'] = $this->M_izin->Ambiltahun();
		$this->load->view('v_izin_belum_disetujui', $data_izin);
	}


	public function setujui_admin($nip_btn,$id){
		$this->M_izin->update_status($nip_btn,$id);
		$this->session->set_flashdata('berhasil_approve', '');
		redirect('C_izin/izin_belum_disetujui');
	}

}
