<?php 
$this->load->helper('url'); ?>

<html lang="en">

<head>
 <?php $this->load->view('cover/headerlogin'); ?>

</head>
<body class="index-page">

<?php if ($this->session->flashdata('gagal')): ?>
<script>
  Swal.fire({
  title: 'Error!',
  text: 'NIK atau password salah',
  icon: 'error',
  timer: 3000
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('gagallagi')): ?>
<script>
  Swal.fire({
  title: 'kacau!',
  text: 'Silahkan Login terlebih dahulu! ',
  icon: 'warning',
  timer: 3000
});
</script>
<?php endif; ?>


  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename"></h1>
      </a>

      <nav id="navmenu" class="navmenu">

        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <img src="<?php echo base_url('assets/login/img/hero-bg-2.jpg'); ?>" alt="" class="hero-bg">

      <div class="container">
        <div class="row gy-4 justify-content-between">
          <div class="col-lg-4 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="<?php echo base_url('assets/login/img/face.png'); ?>" class="img-fluid animated" alt="">
          </div>

          <div class="col-lg-6  d-flex flex-column justify-content-center" data-aos="fade-in">
            <h1>Selamat Datang di MyPolychem</h1> 
              <h8 style="font-family: poppins; font-size: 14.5px;" >Silakan masukkan nik dan kata sandi </h8> 
             <hr class="border border-warning border-3 opacity-75 col-lg-10">
            <form class="row g-3 needs-validation" method="post" action="<?php echo site_url('C_login/loganLogin'); ?>">

                    <div class="col-lg-5">
                      <!-- <label for="yourUsername" class="form-label">NIK</label> -->
                      <div class="input-group has-validation">
                        <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                        <input type="number" name="nik" class="form-control" placeholder="nik" required>
                        
                      </div>
                    </div>

                    <div class="col-lg-5 position-relative">
                      <input type="password" name="password" id="pass" class="form-control" placeholder="kata sandi" required> 
                      <i class="far fa-eye position-absolute top-50 end-0 translate-middle-y me-3" id="eye-icon" style="cursor: pointer;" onclick="showHide()"></i>
                      <input type="checkbox" id="eye-checkbox" style="display: none;" >
                  </div>
                    <!-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div> -->
                    <div class="col-3">
                      <button class="btn btn-warning btn-fw" style="color: #fff; font-weight: bold; " type="submit" name="btn_login">Masuk</button>
                    </div>
                    
                  </form>
          </div>

        </div>
      </div>

      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3"></use>
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0"></use>
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9"></use>
        </g>
      </svg>

    </section><!-- /Hero Section -->

 <style type="text/css">
   .btn-warning {
    width: 70%;
    opacity: 90%;
    cursor: pointer;
    display: inline-block;
   }

   /* Menambahkan padding di kiri input untuk memberi ruang ikon */
.ps-5 {
    padding-left: 50px; /* Sesuaikan dengan lebar ikon */
}

/* Styling untuk ikon */
#eye-icon {
    font-size: 18px; /* Ukuran ikon */
    color: #6c757d; /* Warna ikon */
}


 </style>
 <script >
  function showHide() {
    var passwordField = document.getElementById('pass');
    var eyeIcon = document.getElementById('eye-icon');
    var checkbox = document.getElementById('eye-checkbox');
    
    if (passwordField.type === "password") {
        passwordField.type = "text";  // Menampilkan password
        eyeIcon.classList.remove('far', 'fa-eye');
        eyeIcon.classList.add('far', 'fa-eye-slash');  // Ganti ikon
    } else {
        passwordField.type = "password";  // Sembunyikan password
        eyeIcon.classList.remove('far', 'fa-eye-slash');
        eyeIcon.classList.add('far', 'fa-eye');  // Ganti ikon
    }
}

 </script>

  </main>

<?php $this->load->view('cover/footerlogin'); ?>
  

</body>

</html>