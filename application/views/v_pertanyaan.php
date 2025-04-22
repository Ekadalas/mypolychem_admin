<?php $this->load->helper('url') ?>

<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('cover/header'); ?>
	<style>
	    .btn-xs {
	        font-size: 13px; /* Ukuran teks lebih kecil */
	        padding: 2px 5px; /* Padding lebih kecil */
	    }
	</style>
</head>
<body id="page-top">
  <!-- Bagian Pilih Grade -->
                <!-- awal alert validasi -->
                <?php if ($this->session->flashdata('success')): ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '<?php echo $this->session->flashdata('success'); ?>',
                            timer: 3000, // Menunggu 10 detik (10000 ms)
                            timerProgressBar: true, // Menampilkan progres waktu
                            willClose: () => {
                                // Optional: Menambahkan tindakan saat SweetAlert ditutup
                            }
                        });
                    </script>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: '<?php echo $this->session->flashdata('error'); ?>',
                            timer: 3000, // Menunggu 10 detik (10000 ms)
                            timerProgressBar: true, // Menampilkan progres waktu
                            willClose: () => {

                            }
                        });
                    </script>
                <?php endif; ?>




  <?php $nip = $this->session->userdata('nip_btn'); ?>
 	<div id="wrapper">
 		<?php $this->load->view('cover/sidebar') ?>
 		 <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            	<?php $this->load->view('cover/topbar'); ?>
               <div class="contente">
               <div class="container-fluid">

                <div class="col-xl-12 col-md-12 mb-5">
                <div class="card border-left-info shadow py-3" style="min-height: auto;">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Data Pendukung
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          DATA PERTANYAAN PPK
                        </div>
                      </div>
                      <div class="col-auto">
                        <img style="width: 100px; height: 60px;" src="<?php echo base_url('assets/img/cuti.svg')?>">
                        <!-- <i class="fas fa-calendar-check fa-3x " style="color: #74C0FC;"></i> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>

         <div class="mb-2 align-items-center">
            <div class="card shadow mb-4">
              <div class="card-body">


<style>
  .fc {
    border-color: #81BFDA;
    border-width: 3px;
  }
</style>

 <div class="row my-4">
  <div class="col-md-12">
    <div class="card shadow">
         <div class="card border-left-info shadow py-3" style="min-height: auto;">
      <div class="card-body">
<form action="<?php echo site_url('C_data_pertanyaan/getPertanyaanByGradeHardCom'); ?>" method="post" id="formPertanyaan">
    <div class="card-body">
        <div class="row align-items-end mb-3">
            <!-- Office Dropdown -->
            <div class="col-lg-6">
                <label class="form-label">Pilih Grade</label>
                <select class="form-control" name="getSelectGrade" id="grade-select" required>
                <option value="">Pilih Grade</option>
                  <?php foreach ($get_select as $group): ?>
                  <option value="<?php echo $group['grade_group']; ?>">
                  <?php echo $group['grade_group']; ?>
                  </option>
                  <?php endforeach; ?>
                </select>
            </div>

            <!-- Contoh Tambahan Input -->
            <div class="col-lg-6">
            <label class="form-label">Pilih Tipe Pertanyaan</label>
                <select class="form-control" id="type-pertanyaan-select" name="getSelectTypePertanyaan" required>
                <option value="">Pilih Tipe Pertanyaan</option>
                 <?php foreach ($get_select_all_pertanyaan as $type): ?>
                  <option value="<?php echo $type['type_pertanyaan']; ?>">
                  <?php echo $type['type_pertanyaan']; ?>
                  </option>
                  <?php endforeach; ?>
                </select>
            </div>

        </div>

        <!-- Tombol Submit -->
        <div class="row">
            <div class="col-lg-4">
                <button type="submit" onclick="submitTanya()" class="btn btn-primary px-5">Submit</button>
            </div>
        </div>
    </div>
</form>



<!-- <p class="col-lg-4 text-center fw-bold">
    Grade dan Pertanyaan yang dipilih: <span id="selected-grade">Belum ada</span>
</p> -->

<!-- <div id="susunomor">
    <div id="basic-pills-wizard" class="twitter-bs-wizard">
        <ul class="twitter-bs-wizard-nav nav nav-pills nav-justified">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                <li class="nav-item">
                    <a href="#step-<?= $i ?>" class="nav-link <?= $i === 1 ? 'active' : '' ?>" data-bs-toggle="tab">
                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Step <?= $i ?>">
                            <h6 style="font-size: 14px; font-weight: bold; text-align: center;"><?= $i ?></h6>
                        </div>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
        <div class="tab-content twitter-bs-wizard-tab-content mt-4">
            <div class="row">
            </div>
            <!-- Bagian Tab Content -->
            <div class="tab-content">
                <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <div class="tab-pane <?= $i === 1 ? 'active' : '' ?>" id="step-<?= $i ?>">
                        <form>
                            <div class="row">
                                <!-- Input Soal -->
                                <!-- <div class="col-lg-7">
                                    <div class="mb-3">
                                        <label for="basicpill-awal-<?= $i ?>" class="form-label">Pertanyaan <?= $i ?></label>
                                        <textarea class="form-control" id="basicpill-awal-<?= $i ?>" rows="4" placeholder="Tulis soal di sini..."></textarea>
                                    </div>
                                </div> -->

                                <!-- Input Jawaban -->
                                <!-- <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input-<?= $i ?>" class="form-label">Jawaban</label>
                                        <input type="text" class="form-control" id="basicpill-firstname-input-<?= $i ?>" placeholder="Masukkan jawaban">
                                    </div>
                                </div> -->
                            </div>

                            <!-- Navigasi Button -->
                            <div class="d-flex justify-content-between mt-3">
                                <?php if ($i > 1) : ?>
                                    <a href="javascript:void(0);" class="btn btn-secondary" onclick="previousTab(<?= $i - 1 ?>)">
                                        <i class="bx bx-chevron-left me-1"></i> Back
                                    </a>
                                <?php else : ?>
                                    <div></div>
                                <?php endif; ?>

                                <?php if ($i < 5) : ?>
                                    <!-- <a href="javascript:void(0);" class="btn btn-primary" onclick="nextTab(<?= $i - 1 ?>)">
                                        Next <i class="bx bx-chevron-right ms-1"></i>
                                    </a> -->
                                <?php else : ?>
                                    <a href="javascript:void(0);" class="btn btn-success" onclick="submitForm()">
                                        Kirim <i class="bx bx-check-circle ms-1"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                <?php endfor; ?>
            </div>


            </div>
         </div>
       </div>
    </div>
</div>

      </div>
    </div>
    </div>
  </div>
</div>



              </div> <!-- .card-body -->
            </div> <!-- .card -->
          </div>
               </div>
             </div>
           </div>
        </div>
 	</div>

<script>

   document.getElementById("formPertanyaan").addEventListener("submit", function(event) {

       document.getElementById("susunomor").style.display = "none";
   });

   function submitTanya() {

       document.getElementById("susunomor").style.display = "none";

       // alert('Berikut nomor Soalnya');

       document.getElementById("formPertanyaan").submit();
   }

   function nextTab(currentIndex) {
       // AWAL VALIDASI FORM
       // const soalInput = document.getElementById('basicpill-awal-' + currentIndex);
       // const jawabanInput = document.getElementById('basicpill-firstname-input-' + currentIndex);
       // const gradeSelect = document.getElementById('grade-select-' + currentIndex);

       // if (!soalInput.value || !jawabanInput.value || !gradeSelect.value) {
       //     alert('Harap isi semua field sebelum melanjutkan!');
       //     return;
       // }
       // AKHIR VALIDASI FORM

       const tabs = document.querySelectorAll('.twitter-bs-wizard-nav .nav-link');
       if (currentIndex < tabs.length - 1) {
           tabs[currentIndex + 1].click();
       }
   }
   function previousTab(currentIndex) {
       const tabs = document.querySelectorAll('.twitter-bs-wizard-nav .nav-link');
       if (currentIndex > 0) {
           tabs[currentIndex - 1].click();
       }
   }
   function submitForm() {
       alert('Pertanyaan berhasil dikirim!');
       // Tambahkan logika pengiriman formulir sesuai kebutuhan
   }



</script>
</body>
<?php $this->load->view('cover/footer')?>
</html>
