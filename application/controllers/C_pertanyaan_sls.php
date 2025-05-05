<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_pertanyaan_sls extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('M_data_pertanyaan_sls');
	}

	public function index() {

		// Mendapatkan data dari metode getDataSelectGrade
		$data['pilihData'] = $this->M_data_pertanyaan_sls->pilihGrade();
		// Mendapatkan data dari metode getAllTypePer
		$data['ambilSemua'] = $this->M_data_pertanyaan_sls->hardSoft();
		

        $this->load->view('v_pertanyaan_sls', $data);

	}

	public function ambilSoal() {

		// Mengambil nilai dari form
		$grade = $this->input->post('grade');
		$type_pertanyaan = $this->input->post('TypeHcSc');

		// var_dump($grade, $type_pertanyaan);
	
		// Validasi input
		if (empty($grade) || empty($type_pertanyaan)) {
			// Jika input kosong, kembalikan ke halaman sebelumnya dengan pesan error
			$this->session->set_flashdata('error', 'Grade dan Type Pertanyaan harus diisi!');
			redirect('C_pertanyaan_sls'); 
			// Ganti dengan URL tujuan
		}
	
		// Ambil data grade untuk dropdown (opsional)
		$data['ambilGrare'] = $this->M_data_pertanyaan_sls->pilihGrade();
		$data['semuaHcSc'] = $this->M_data_pertanyaan_sls->hardSoft();
		// Memanggil fungsi model untuk mendapatkan pertanyaan
		$dataPertanyaan = $this->M_data_pertanyaan_sls->getDataPertanyaanHardCom($grade, $type_pertanyaan);	
		// Menyertakan parameter yang dipilih dalam data untuk ditampilkan di view
		$data['gradeTerpilih'] = $grade;
		$data['HcSc'] = $type_pertanyaan;
		// Tampilkan data ke view
		$data['pertanyaan'] = $dataPertanyaan;

		
		$this->load->view('v_detail_sls', $data); 
		// Ganti 'v_hard_com' dengan nama file view Anda
		
	}

	public function updatepertanyaan() {
        // Pastikan data yang dikirim melalui POST
        $type_pertanyaan = $this->input->post('type_pertanyaan');
        $pertanyaan = $this->input->post('editPertanyaan');
        $descr_pertanyaan = $this->input->post('edit_descr_pertanyaan');
		$kd_pertanyaan = $this->input->post('kd_pertanyaan');
		$type_pertanyaan = $this->input->post('type_pertanyaan');
		$grade_pertanyaan = $this->input->post('grade_pertanyaan');

		$updateData = array(
			'pertanyaan' => $pertanyaan,
			'descr_pertanyaan' => $descr_pertanyaan,
			'type_pertanyaan' => $type_pertanyaan,
			'kd_pertanyaan' => $kd_pertanyaan,
			'grade_pertanyaan' => $grade_pertanyaan
		);

// echo '</pre>';
// var_dump($updateData);
// echo '</pre><br><br>';

		// Kirim ke model untuk proses update
		$updateResult = $this->M_data_pertanyaan_sls->update_pertanyaan($updateData);
	
		// Cek hasil update dan beri feedback
		if ($updateResult) {
			$this->session->set_flashdata('success', 'Pertanyaan berhasil diperbarui!');
			redirect('C_pertanyaan_sls');  // Ganti dengan URL yang sesuai
		} else {
			$this->session->set_flashdata('error', 'Gagal memperbarui pertanyaan.');
			redirect('C_pertanyaan_sls');  // Ganti dengan URL yang sesuai
		}	
    }	




}
