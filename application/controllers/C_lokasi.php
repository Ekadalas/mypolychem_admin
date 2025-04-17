<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**S
 * 
 */
class C_lokasi extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_lokasi');
	}

	public function index() {

		$data['lokasi'] = $this->M_lokasi->ambilKordinat();
		$this->load->view('v_lokasi',$data);
	}

	public function plus() {
    
    $this->load->view('v_plus_loc');
   }

   public function plusTambah() {
   	$koordinat = $this->input->post('latitude_longitude');
    $kantor = $this->input->post('cd_office');
    $nama = $this->input->post('nm_office');
    $rad = $this->input->post('radius');
    
    if (!empty($koordinat) && !empty($kantor) && !empty($nama && !empty($rad))) {
        // Proses simpan data jika semua field terisi
        $loc = [
        	'latitude_longitude' => $koordinat,
            'cd_office' => $kantor,
            'nm_office' => $nama,
            'radius_absen'    => $rad ];

        $this->M_lokasi->insertPlus($loc);
        redirect('C_lokasi');
    } else {
        // Redirect atau tampilkan pesan error jika field kosong
        $this->load->view('v_plus_loc');
    }
   }


	public function minus() {

		$this->load->view('v_minus_loc');
	}

	public function edit() {

		$id = $this->input->post('input_HO');

		//var_dump($id);
		$hasil['editable'] = $this->M_lokasi->editing($id);
		$this->load->view('v_edit_loc', $hasil);
	}

	public function menuEdit() {

		$id =  $this->input->post('id');
		$lang  =  $this->input->post('lang');
		$kantor  =  $this->input->post('kantor');
		$nama     = $this->input->post('nama');
		$rad      = $this->input->post('radius');

		$dataEdit = [
			'id'  => $id,
			'latitude_longitude' => $lang,
			'cd_office'  => $kantor,
			'nm_office'  => $nama,
			'radius_absen' => $rad
		];

		$this->M_lokasi->edit_lagi($dataEdit);
		redirect('C_lokasi');


	}

	// public function question() {

	// 	$conPdf = 'pdf/koordinat.pdf'; // Path file PDF

	// 	header('Content-Type: application/pdf');
	// 	header('Content-Disposition: inline; filename="koordinat.pdf"');
	// 	header('Content-Transfer-Encoding: binary');
	// 	header('Accept-Ranges: none');
	// 	header('Content-Length: ' . filesize($conPdf));

	// 	ob_clean();
	// 	flush();
	// 	@readfile($conPdf);
	// 	exit();

	// 	}

}