    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php 
    
    if (!$this->session->userdata('nip_btn')) {
          
          redirect('C_login');
      } else {

        $nik_sesi = $this->session->userdata('nip_btn');
      }
        
    
    ?>
    <title>::MyPolychem::</title>

    <link rel="icon" href="<?php echo base_url('assets/img/kecil.jpg')?>">
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

     <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css')?>" rel="stylesheet">
     <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/select2/dist/css/select2.min.css') ?>"> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="<?php echo base_url('assets/vendor/face-api.js/dist/face-api.js')?>"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
      <!-- <script src="<?php echo base_url('assets/vendor/package/dist/chart.js')?>"></script>     -->

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
     <style type="text/css">
    .zoom {
            transition: transform 0.5s ease-in-out;
            width: 70px;
            height: 80px;
        }

    .zoom:hover {
            transform: scale(3.5);
            cursor: pointer;
        }
    .form-label {
      color: black;
    }

    .contente {
    margin-left: 55px; /* Memberi jarak pada konten utama agar tidak menutupi sidebar */
    padding: 0px;
    
    }

    .form-control {
      border-color: black;
    }

    .border-left-dark {
  border-left: .25rem solid #10375C !important;
}

   
 /* Posisi gambar di pojok kanan bawah dengan animasi mengapung */
.bottom-right-image {
    position: fixed;
    bottom: 10px;
    right: 10px;
    width: 100px;
    height: 75px;
    z-index: 9999;
   
    
    /* Membuat gelembung di sekitar gambar */
    background-color: #ffffff;
    border-radius: 40%; /* Membuat gelembung bulat */
    padding: 10px; /* Ruang antara gambar dan pinggiran gelembung */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0), 0 0 20px rgba(0, 183, 255, 0.2); /* Efek gelembung */

    /* Animasi mengapung */
    animation: float 3s ease-in-out infinite;
}

/* Animasi mengapung */
@keyframes float {
    0%, 100% {
        transform: translateY(0); /* Posisi awal */
    }
    50% {
        transform: translateY(-10px); /* Naik sedikit */
    }
}

/* Responsif: Ukuran lebih kecil pada layar kecil */
@media (max-width: 576px) {
    .bottom-right-image {
        width: 70px;
        height: 50px;
        padding: 10px;
        bottom: 5px;
        right: 5px;
        box-shadow: 0 0 10px rgba(0, 183, 255, 0.4), 0 0 20px rgba(0, 183, 255, 0.2);
    }
}

 /* CSS khusus untuk border Select2 agar berwarna hitam */
.select2-container .select2-selection--single {
    border: 1px solid #000 !important; /* Warna hitam */
    height: calc(1.5em + .75rem + 2px) !important;
    padding: .375rem .75rem !important;
    border-radius: .25rem !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #495057; /* Warna teks, sesuai dengan Bootstrap 4 */
    line-height: 1.5 !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    border-color: #000 !important; /* Warna hitam untuk panah dropdown */
    height: calc(1.5em + .75rem + 2px) !important;
    top: 50% !important;
    transform: translateY(-50%);
}

/* Mengatur warna border saat dropdown aktif (focus state) */
.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #000 !important; /* Warna hitam saat focus */
    box-shadow: 0 0 0 .2rem rgba(0, 0, 0, .25); /* Efek shadow */
}

 .marquee-container {
    width: auto; /* Sesuaikan lebar sesuai teks */
    overflow: hidden; /* Sembunyikan bagian teks yang keluar */
    white-space: nowrap; /* Cegah teks turun ke baris baru */
    box-sizing: border-box;
    /*border: 1px solid #ddd;  Opsional: untuk batas tampilan */
    /*padding: 3px;  Opsional: tambahkan ruang di sekitar teks */
    display: inline-block; /* Pastikan elemen sesuai konten */
  }

  .marquee {
    display: inline-block; /* Pastikan teks tidak meluas ke luar kontainer */
    animation: marquee-move 7s linear infinite; /* Atur animasi bergerak */
  }

  @keyframes marquee-move {
    from {
      transform: translateX(-100%); /* Mulai dari dalam kontainer */
    }
    to {
      transform: translateX(100%); /* Bergerak keluar di sisi kanan */
    }
  }

  .marquee span {
    font-size: 12px; /* Ukuran teks */
    font-weight: thin; /* Tebal teks 
    color: #17a2b8; /* Warna teks */
    text-transform: uppercase; /* Kapitalisasi teks */
   }

</style>

