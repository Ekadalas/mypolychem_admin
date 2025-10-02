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


  .fc {
    border-color: #81BFDA;
    border-width: 3px;
  }
  .select-karyawan {
  width: 180px !important; /* atau sesuai kebutuhan, bisa 200px, 300px */
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
                          Ruang Edit Penilai Rekan Kerja
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          EDIT PENILAI REKAN KERJA
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
<form action="<?= site_url('C_matrix_sls_rekan_kerja/update_multiple_rekan_kerja') ?>" method="post">
    <button type="button" class="btn btn-warning mb-3" onclick="history.back()">
        <i class="fas fa-arrow-left"></i> Kembali
    </button>
    <button type="submit" class="btn btn-success mb-3" id="klikSimpan">
        Simpan <i class="fas fa-save"></i>
    </button>

    <div class="container mt-4">
        <!-- Tombol Tambah di Atas Kiri -->
        <div class="mb-3">
            <button type="button" class="btn btn-primary btn-add">
                <i class="fas fa-plus"></i> Tambah Pasangan
            </button>
        </div>

        <div id="wrapper-pasangan">
            <!-- pasangan default -->
            <div class="row pasangan mb-3">
                <!-- Card Org Dinilai -->
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card-new h-100">
                        <div class="card-title">
                            <p style="color:#111;margin-bottom:5px;margin-top:10px;font-size:15px;">
                                Code Org Dinilai
                            </p>
                            <select class="form-select select-karyawan select2" name="dinilai[]">
                                <option value="">Pilih Code Org Dinilai</option>
                                <?php foreach ($list_org_dinilai as $row): ?>
                                    <option value="<?= $row['code_org'] ?>">
                                        <?= $row['code_org'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Card Org Penilai -->
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card-new h-100">
                        <div class="card-title">
                            <p style="color:#111;margin-bottom:5px;margin-top:10px;font-size:15px;">
                                Code Org Penilai
                            </p>
                            <select class="form-select select-karyawan select2" name="penilai[]">
                                <option value="">Pilih Code Org Penilai</option>
                                <?php foreach ($list_org_penilai as $row): ?>
                                    <option value="<?= $row['code_org'] ?>">
                                        <?= $row['code_org'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tombol Hapus di dalam row -->
                <div class="col-lg-2 col-md-6 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-remove">Hapus</button>
                </div>
            </div>
        </div>
    </div>



</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    // Inisialisasi awal untuk select2
    $(".select2").select2();

    // Tambah pasangan baru
    $(document).on("click", ".btn-add", function(){
        let clone = $(".pasangan").first().clone();
        clone.find("select").val(""); // reset pilihan
        clone.find(".select2").removeClass("select2-hidden-accessible").next(".select2").remove(); // hapus select2 lama
        $("#wrapper-pasangan").append(clone);

        // re-init select2 untuk select baru
        clone.find("select").select2();
    });

    // Hapus pasangan
    $(document).on("click", ".btn-remove", function(){
        if ($(".pasangan").length > 1) {
            $(this).closest(".pasangan").remove();
        } else {
            alert("Minimal 1 pasangan harus ada");
        }
    });
});

</script>


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
  

</script>
</body>
<?php $this->load->view('cover/footer')?>
</html>





