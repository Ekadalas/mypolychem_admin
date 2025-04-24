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

        /* From Uiverse.io by abrahamcalsin */ 
.card-client {
  background: #3E3F5B;
  width: 13rem;
  padding-top: 15px;
  padding-bottom: 15px;
  padding-left: 10px;
  padding-right: 10px;
  border: 4px solid #7cdacc;
  box-shadow: 0 6px 10px rgba(207, 212, 222, 1);
  border-radius: 10px;
  text-align: center;
  color: #fff;
  font-family: "Poppins", sans-serif;
  transition: all 0.3s ease;
  /*margin: 10px;*/
}

.card-client:hover {
  transform: translateY(-10px);
}

.user-picture {
  overflow: hidden;
  object-fit: cover;
  width: 5rem;
  height: 5rem;
  border: 4px solid #7cdacc;
  border-radius: 999px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: auto;
}

.user-picture svg {
  width: 2.5rem;
  fill: currentColor;
}

.name-client {
  margin: 0;
  margin-top: 20px;
  font-weight: 600;
  font-size: 18px;
}

.name-client span {
  display: block;
  font-weight: 200;
  font-size: 16px;
}
	</style>
</head>
<body id="page-top">

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
                          Edit Penilai
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">

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
  .select-karyawan {
  width: 180px !important; /* atau sesuai kebutuhan, bisa 200px, 300px */
}

</style>
<!-- AWAL BODY DETAIL EDIT PENILAI -->
<form action="<?= site_url('C_matrix_penilaian/update_multiple') ?>" method="post">    

    <!-- <input type="submit" class="btn btn-info" value="Simpan" style="margin-left: 20px;">
   -->
    <button type="submit" class="btn btn-info" style="margin-left: 20px;">Simpan <i class="far fa-edit"></i></button>
    
  <?php foreach ($get_data_penilai as $index => $p): ?>    
  
    <div class="card-body mb-3">
    <div class="row">  
      <div class="col-lg-3">
        <div class="card-client">
          <div class="user-picture">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
              <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
            </svg>
          </div>
          <label class="form-label">Nama Dinilai:</label>
          <p class="name-client">
          <select id="dinilai_<?= $index ?>" class="form-select select2 select-karyawan" name="dinilai1[]" disabled>
              <option value="">Pilih Karyawan</option>
              <option value="<?= $p['id']; ?>" selected><?= $p['nama_dinilai']; ?></option>
          </select> 
            <span id="getdeep_dinilai_<?= $index ?>"></span>
            <input type="hidden" name="dinilai1[]" value="<?= $p['id']; ?>">

          </p>
        </div>
      </div>
       <div class="col-lg-3">
        <div class="card-client">
          <div class="user-picture">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
              <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
            </svg>
          </div>

          <label class="form-label">Nama Penilai 1 :</label>
          <p class="name-client">
          <select id="dinilai_<?= $index ?>" class="form-select select2 select-karyawan" name="penilai1[]">
              <option value="">Pilih Karyawan</option>
              <?php foreach ($get_data_karyawan as $karyawan): ?>
          <option value="<?= $karyawan['nip_btn'] ?>" 
            <?= $karyawan['name'] == $p['nama_p1'] ? 'selected' : '' ?>>
            <?= $karyawan['name'] ?>
          </option>
          <?php endforeach; ?>
          </select> 
            <span id="getdeep_dinilai_<?= $index ?>"></span>
            
          </p>
        </div>
      </div>
       <div class="col-lg-3">
        <div class="card-client">
          <div class="user-picture">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
              <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
            </svg>
          </div>
          <label class="form-label">Nama Penilai 2 :</label>
          <p class="name-client">
          
            <select id="penilai_<?= $index ?>" class="form-select select2 select-karyawan" name="penilai2[]">
            <option value="">Pilih Karyawan</option>
            <?php foreach ($get_data_karyawan as $karyawan): ?>
                <option value="<?= $karyawan['nip_btn'] ?>" 
                    <?= $karyawan['name'] == $p['nama_p2'] ? 'selected' : '' ?>>
                    <?= $karyawan['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
            <span id="getdeep_penilai_<?= $index ?>"></span>
          </p>
        </div>
      </div>
       <div class="col-lg-3">
        <div class="card-client">
          <div class="user-picture">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
              <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
            </svg>
          </div>
          <label class="form-label">Nama Penilai 3 :</label>
          <p class="name-client">
          
            <select id="penilai_<?= $index ?>" class="form-select select2 select-karyawan" name="penilai3[]">
            <option value="">Pilih Karyawan</option>
            <?php foreach ($get_data_karyawan as $karyawan): ?>
                <option value="<?= $karyawan['nip_btn'] ?>" 
                    <?= $karyawan['name'] == $p['nama_p3'] ? 'selected' : '' ?>>
                    <?= $karyawan['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
            <span id="getdeep_penilai_<?= $index ?>"></span>
          </p>
        </div>
        
      </div>
      
      <hr class="garis">
      <hr class="garis">
      <?php endforeach; ?>
     </div>
     </form>
    <!-- AKHIR BODY DETAIL EDIT PENILAI -->
        </div>
      </div>
    </div>
    </div>
  </div>
<script>
  <script>
  $(document).ready(function() {
    $('.select-karyawan').select2({
      placeholder: "Pilih Karyawan",
      allowClear: true,
      width: '100%' // pastikan select2 full width sesuai container
    });
  });
</script>

</script>
</body>
<?php $this->load->view('cover/footer')?>
</html>





