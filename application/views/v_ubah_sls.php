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

      .card-new {
  --font-color: #001F3F;
  --font-color-sub: #001F3F;
  --bg-color: #fff;
  --main-color: #001F3F;
  width: 200px;
  height: 280px;
  background: var(--bg-color);
  border: 2px solid var(--main-color);
  box-shadow: 4px 4px var(--main-color);
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 15px;
  box-sizing: border-box;
  position: relative;
  overflow: hidden;
}

.card-photo {
  width: 120px;
  height: 120px;
  background: url(<?= base_url('assets/img/employ.png'); ?>) center/cover no-repeat;
  background-color: #ccc;
  border-radius: 50%;
  margin-top: 10px;
  transition: transform 0.3s;
}

.card-title {
  text-align: center;
  color: var(--font-color);
  font-size: 20px;
  font-weight: 400;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.card-title span {
  font-size: 15px;
  color: var(--font-color-sub);
}

.card-socials {
  display: flex;
  height: 0;
  opacity: 0;
  margin-top: 20px;
  gap: 20px;
  transition: 0.5s;
}

.card-socials-btn {
  width: 25px;
  height: 25px;
  border: none;
  background: transparent;
  cursor: pointer;
}

.card-socials-btn svg {
  width: 100%;
  height: 100%;
  fill: var(--main-color);
}

.card-new:hover > .card-socials {
  opacity: 1;
  height: 35px;
}

.card-socials-btn:hover {
  transform: translateY(-5px);
  transition: all 0.15s;
}

.card-photo:hover {
  transition: 0.3s;
  /*transform: scale(0.4) translate(160px, 150px);*/
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
                          Ruang ubah penilai
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          UBAH PENILAI SLS
                        </div>
                      </div>
                      <div class="col-auto">
                        <img style="width: 100px; height: 60px;" src="<?php echo base_url('assets/img/ubah.svg')?>">
                        <!-- <i class="fas fa-calendar-check fa-3x " style="color: #74C0FC;"></i> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>

<form action="<?= site_url('C_matrix_penilaian_sls/update_multiple') ?>" method="post">    

    <button type="button" class="btn btn-warning mb-3" onclick="history.back()"><span class="icon text-white-50">
     <i class="fas fa-arrow-left"></i></span>Kembali</button>
    <button type="submit" class="btn btn-success mb-3" id="klikSimpan" disabled>Simpan <i class="fas fa-save"></i></button>

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

    <!-- <input type="submit" class="btn btn-info" value="Simpan" style="margin-left: 20px;">
   -->    
  <?php foreach ($get_data_penilai as $index => $p): ?>    
  
    <div class="card-body">
    <div class="row">  
      <div class="col-lg-3">
    <div class="card-new">
    <div class="card-photo"></div>
    <div class="card-title"><p style="color: #111; margin-bottom: 5px; margin-top: 20px; font-size: 15px;">Nama Dinilai</p>
      <select id="dinilai_<?= $index ?>" class="form-select select-karyawan" name="dinilai1[]" disabled>
              <option value="">Pilih Karyawan</option>
              <option value="<?= $p['id']; ?>" selected><?= $p['nama_dinilai']; ?></option>
          </select> 
            <span id="getdeep_dinilai_<?= $index ?>"></span>
            <input type="hidden" name="dinilai1[]" value="<?= $p['id']; ?>">
    </div>
    <div class="card-sosials">
      
    </div>
    </div>
      </div>
       <div class="col-lg-3">
    <div class="card-new">
    <div class="card-photo"></div>
    <div class="card-title"><p style="color: #111; margin-bottom: 5px; margin-top: 20px; font-size: 15px;">Nama Penilai 1</p>
       <select id="dinilai_<?= $index ?>_p1" class="form-select select-karyawan" name="penilai1[]">
              <option value="">Pilih Karyawan</option>
              <?php foreach ($get_data_karyawan as $karyawan): ?>
          <option value="<?= $karyawan['nip_btn'] ?>" 
            <?= $karyawan['name'] == $p['nama_p1'] ? 'selected' : '' ?>>
            <?= $karyawan['name'] ?>
          </option>
          <?php endforeach; ?>
          </select> 
            <span id="getdeep_dinilai_<?= $index ?>"></span>
    </div>
    <div class="card-sosials">
      
    </div>
</div>
      </div>
       <div class="col-lg-3">
       <div class="card-new">
    <div class="card-photo"></div>
    <div class="card-title"><p style="color: #111; margin-bottom: 5px; margin-top: 20px; font-size: 15px;">Nama Penilai 2</p>
           <select id="penilai_<?= $index ?>_p2" class="form-select select-karyawan" name="penilai2[]">
            <option value="">Pilih Karyawan</option>
            <?php foreach ($get_data_karyawan as $karyawan): ?>
                <option value="<?= $karyawan['nip_btn'] ?>" 
                    <?= $karyawan['name'] == $p['nama_p2'] ? 'selected' : '' ?>>
                    <?= $karyawan['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
            <span id="getdeep_penilai_<?= $index ?>"></span>
    </div>
    <div class="card-sosials">
      
    </div>
</div>
      </div>
       <div class="col-lg-3">
       <div class="card-new">
    <div class="card-photo"></div>
    <div class="card-title"><p style="color: #111; margin-bottom: 5px; margin-top: 20px; font-size: 15px;">Nama Penilai 3</p>
         <select id="penilai_<?= $index ?>_p3" class="form-select select-karyawan" name="penilai3[]">
            <option value="">Pilih Karyawan</option>
            <?php foreach ($get_data_karyawan as $karyawan): ?>
                <option value="<?= $karyawan['nip_btn'] ?>" 
                    <?= $karyawan['name'] == $p['nama_p3'] ? 'selected' : '' ?>>
                    <?= $karyawan['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
            <span id="getdeep_penilai_<?= $index ?>"></span>
    </div>
    <div class="card-sosials">
      
    </div>
</div>
      </div>
      
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
 $(document).ready(function(){
  $('.select-karyawan').select2();
});
</script>
<script>
  $(document).ready(function() {
    // Pastikan tombol disable dari awal
    $('#klikSimpan').prop('disabled', true);

    // Tangkap perubahan pada semua select yang punya class 'select-karyawan'
    $('.select-karyawan').on('change', function() {
        // Kalau ada yang berubah, tombol di-enable
        $('#klikSimpan').prop('disabled', false);
    });
});

</script>
</body>
<?php $this->load->view('cover/footer')?>
</html>





