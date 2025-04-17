
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_absen extends CI_Controller
{ 
	
	public function __construct()
	{ 
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session','upload');
        $this->load->model('M_absen');
       // header('Content-Type: Application/json');
		
	}

	public function index() {

		//$data['absensi'] = $this->M_absen->ambilAbsen();
        $data['present'] = $this->M_absen->ambilDepart();
		$this->load->view('v_absen', $data);
	}


   public function getDepartments() {
    $kantor = $this->input->post('office');
    log_message('debug', 'Kantor yang diterima: ' . $kantor); // Debugging

    if ($kantor == 'HO') {
        $cd_office = '000';
    } elseif ($kantor == 'TGR') {
        $cd_office = '002';
    } elseif ($kantor == 'MRK') {
        $cd_office = '001';
    } elseif ($kantor == 'KRW') {
        $cd_office = '003';
    } 

    $departement = $this->M_absen->get_departemen($cd_office);
    echo json_encode($departement);
}


	public function trackData() {
    $mulai   = $this->input->post('mulai');
    $selesai = $this->input->post('selesai');
    $office  = $this->input->post('Office');
    $departemen = $this->input->post('departemen');

    // var_dump($mulai, $selesai, $office, $departemen);
   // Map kode kantor berdasarkan pilihan kantor
    switch ($office) {
        case 'HO':
            $cd_office = '000';
            break;
        case 'TGR':
            $cd_office = '002';
            break;
        case 'MRK':
            $cd_office = '001';
            break;
        case 'KRW':
            $cd_office = '003';
            break;
        default:
            $this->session->set_flashdata('error', 'Office tidak dikenal');
            redirect('C_absen'); // Redirect ke halaman awal jika error
            return;
    }

    // Panggil data dari model
    $data['absensi'] = $this->M_absen->Data_tracking($mulai, $selesai, $cd_office, $departemen);
    if ( $data['absensi']->num_rows() == 0) {
        $this->session->set_flashdata('kosong', 'data telah berhasil diubah');
        redirect('C_absen');
    }
    $data['present'] = $this->M_absen->ambilDepart();
    $this->load->view('v_absen_harian', $data);
}

   
    

   public function upload() {
    // Ambil data dari input post
    $nik  = $this->input->post('nik');
    $nip  = $this->input->post('nip');
    $masuk = $this->input->post('masuk');
    $fomad  = $this->input->post('fomad');
    $pulang = $this->input->post('pulang');
    $pulang_formad = $this->input->post('pulang_formad');
    $jam_msk = $this->input->post('jam_msk');
    $jam_plng = $this->input->post('jam_plng');
    $cd_office = $this->input->post('cd_office');
    $location  = $this->input->post('location');
    $loc_ot    = $this->input->post('loc_ot');
    $work_loc  = $this->input->post('work_loc');
    $keterangan = $this->input->post('keterangan');

    

    // Konfigurasi upload file
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = 2000; // Naikkan batas menjadi 2MB
    $config['max_width'] = 2048;
    $config['max_height'] = 2048;

    $this->load->library('upload', $config);

    // Proses upload file
    if ($this->upload->do_upload('image')) {
        $upload_data = $this->upload->data();
        $data['foto_masuk'] = $upload_data['file_name'];
    } else {
        $error = array('error' => $this->upload->display_errors());
        $this->load->view('v_absen', $error);
        return;
    }

    if ($this->upload->do_upload('img')) {
        $upload_data = $this->upload->data();
        $data['foto_keluar'] = $upload_data['file_name'];
    } else {
        $error = array('error' => $this->upload->display_errors());
        $this->load->view('v_absen', $error);
        return;
    }

    $data = array(
        'nip_btn' => $nik,
        'nip' => $nip,
        'tgl_masuk' => $masuk,
        'tgl_masuk_formated' => $fomad,
        'tgl_pulang' => $pulang,
        'tgl_pulang_formated' => $pulang_formad,
        'jam_masuk' => $jam_msk,
        'jam_pulang' => $jam_plng,
        'cd_office' => $cd_office,
        'location' => $location,
        'location_out' => $loc_ot,
        'work_location' => $work_loc,
        'keterangan' => $keterangan,
        'foto_masuk' => $upload_data['file_name'],
        'foto_keluar' => $upload_data['file_name']
    );

    // Kirim semua data ke model untuk diinsert ke database
    if($this->M_absen->uploader($data)){
        // Jika berhasil
        echo "Data berhasil dikirim";
    } else {
        // Jika gagal
        echo "Data gagal dikirim";
    }
}

    public function tambahAbsen() {

        $this->load->view('v_tambah_absen');
    }



       
        
    

	
}