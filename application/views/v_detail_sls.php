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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body id="page-top">

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
                          DATA PERTANYAAN SLS
                        </div>
                      </div>
                      <div class="col-auto">
                        <img style="width: 100px; height: 60px;" src="<?php echo base_url('assets/img/pertanyaan.svg')?>">
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
        <div class="card shadow border-left-info py-3">
            <div class="card-body">

                <!-- Form Utama -->
                <form action="<?= site_url('C_data_pertanyaan_sls/ambilSoal'); ?>" method="post" id="formPertanyaan">

                    <!-- Header -->
                    <div class="card-header bg-light">
    <div class="d-flex flex-column">
        <div class="card-title text-dark" style="font-size: 20px; font-weight: 500; margin-bottom: 0.5rem;">
            Pertanyaan yang dipilih: <?= strtoupper($HcSc); ?>
        </div>
        <div class="card-subtitle text-secondary" style="font-size: 16px; font-weight: 400;">
            Grade yang dipilih: <?= strtoupper($gradeTerpilih); ?>
        </div>
    </div>
</div>


                    <!-- Dropdown Pilihan -->
                    <div class="row align-items-end mb-3">
                        <div class="col-lg-6">
                            <label class="form-label">Pilih Grade</label>
                            <select class="form-control" name="getSelectGrade" id="grade-select" required>
                                <option value="">Pilih Grade</option>
                                <?php foreach ($ambilGrade as $group): ?>
                                    <option value="<?= $group['grade_group']; ?>"><?= $group['grade_group']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Pilih Tipe Pertanyaan</label>
                            <select class="form-control" name="getSelectTypePertanyaan" id="type-pertanyaan-select" required>
                                <option value="">Pilih Tipe Pertanyaan</option>
                                <?php foreach ($semuaHcSc as $type): ?>
                                    <option value="<?= $type['type_pertanyaan']; ?>"><?= $type['type_pertanyaan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="row mb-4">
                        <div class="col-lg-4">
                            <button type="submit" class="btn btn-info px-5">Submit</button>
                        </div>
                    </div>

                </form>

                <!-- Wizard Pertanyaan -->
<div id="basic-pills-wizard" class="twitter-bs-wizard">
    <!-- Navigasi Step -->
    <ul class="twitter-bs-wizard-nav nav nav-pills nav-justified" role="tablist">
        <?php foreach ($pertanyaan as $i => $item): ?>
            <li class="nav-item" role="presentation">
                <a href="#step-<?= $i + 1 ?>"
                   class="nav-link <?= $i === 0 ? 'active' : '' ?>"
                   data-bs-toggle="pill"
                   role="tab"
                   aria-controls="step-<?= $i + 1 ?>"
                   aria-selected="<?= $i === 0 ? 'true' : 'false' ?>">
                    <div class="step-icon" title="Step <?= $i + 1 ?>">
                        <h6 style="font-size: 18px; font-weight: bold; text-align: center;"><strong><?= $i + 1 ?></strong></h6>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Isi Konten Tab -->
    <div class="tab-content twitter-bs-wizard-tab-content mt-4">
        <?php foreach ($pertanyaan as $i => $item): ?>
            <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>"
                 id="step-<?= $i + 1 ?>"
                 role="tabpanel">
                <form>
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Pertanyaan -->
                            <div class="mb-3">
                                <label for="basicpill-awal-<?= $i + 1 ?>" class="form-label">Pertanyaan <?= $i + 1 ?></label>
                                <textarea class="form-control" id="basicpill-awal-<?= $i + 1 ?>" rows="4" readonly><?= $item['pertanyaan'] ?></textarea>
                            </div>
                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label for="descr-pertanyaan-<?= $i + 1 ?>" class="form-label" style="font-weight: bold; color: #6c757d;">Deskripsi Pertanyaan <?= $i + 1 ?></label>
                                <textarea class="form-control" id="descr-pertanyaan-<?= $i + 1 ?>" rows="4" readonly style="background-color: #f8f9fa; border: 1px solid #ced4da;"><?= $item['descr_pertanyaan'] ?></textarea>
                            </div>
                            <!-- Hidden Input -->
                            <input type="hidden" class="form-control" id="type-pertanyaan-<?= $i + 1 ?>" value="<?= $item['type_pertanyaan'] ?>" readonly>
                            <input type="hidden" class="form-control" id="grade-pertanyaan-<?= $i + 1 ?>" value="<?= $item['grade_group'] ?>" readonly>
                            <input type="hidden" class="form-control" id="kd-pertanyaan-<?= $i + 1 ?>" value="<?= $item['kd_pertanyaan'] ?>" readonly>
                        </div>
                    </div>
                    <!-- hidden sementara tombol edit pertanyaan  -->
                    <!-- Tombol Edit -->
                    <!-- <div class="btn-toolbar flex-column mt-3" role="toolbar">
                      <button type="button" class="button5 btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#editPertanyaanModal" onclick="setEditData(<?= $i + 1 ?>)">
                      <i class="fas fa-edit"></i> Edit Pertanyaan
                    </button>
                    </div> -->

                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Bootstrap 5 Bundle (wajib ditaruh sebelum </body>) -->

            </div> <!-- card-body -->
        </div> <!-- card -->
    </div>
</div>
<!-- Modal Edit Pertanyaan -->
    <!-- Modal Edit Pertanyaan -->
<div class="modal fade" id="editPertanyaanModal" tabindex="-1" aria-labelledby="editPertanyaanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Ukuran modal diperbesar -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPertanyaanModalLabel">Edit Pertanyaan</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                 <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url('C_pertanyaan_sls/updatepertanyaan'); ?>" method="post">
                    <div class="mb-3">
                        <label for="editPertanyaan" class="form-label">Pertanyaan</label>
                        <textarea class="form-control" id="editPertanyaan" name="editPertanyaan" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="editDeskripsiPertanyaan" class="form-label">Deskripsi Pertanyaan</label>
                        <textarea class="form-control" id="editDeskripsiPertanyaan" name="edit_descr_pertanyaan" rows="4" required></textarea>
                    </div>

                    <!-- Hidden Inputs -->
                    <input type="hidden" id="kdpertanyaan" name="kd_pertanyaan">
                    <input type="hidden" id="typepertanyaan" name="type_pertanyaan">
                    <input type="hidden" id="gradepertanyaan" name="grade_pertanyaan">

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap JS -->
    <script>
        function setEditData(pertanyaanId) {
            // Ambil data pertanyaan berdasarkan ID
            const pertanyaan = <?php echo json_encode($pertanyaan); ?>;
            const selectedPertanyaan = pertanyaan[pertanyaanId - 1]; // Karena index dimulai dari 0

            // Isi modal dengan data pertanyaan
            document.getElementById('editPertanyaan').value = selectedPertanyaan.pertanyaan;
            document.getElementById('editDeskripsiPertanyaan').value = selectedPertanyaan.descr_pertanyaan;
            document.getElementById('kdpertanyaan').value = selectedPertanyaan.kd_pertanyaan;
            document.getElementById('typepertanyaan').value = selectedPertanyaan.type_pertanyaan;
            document.getElementById('gradepertanyaan').value = selectedPertanyaan.grade_group;
        }
    </script>

</body>
<?php $this->load->view('cover/footer')?>
</html>
