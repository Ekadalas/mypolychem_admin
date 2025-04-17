<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('cover/header'); ?>

</head>
<body class="page-top">
  <div id="wrapper">
    <?php $this->load->view('cover/sidebar'); ?>

     <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
              <?php $this->load->view('cover/topbar'); ?>
               <div class="contente">
               <div class="container-fluid">  

                <div class="col-xl-12 col-md-12 mb-5">
                <div class="card border-left-warning shadow py-3" style="min-height: auto;">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Edit 
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          LOKASI KANTOR
                        </div>
                      </div>
                      <div class="col-auto">
                        <img style="width: 100px; height: 65px;" src="<?php echo base_url('assets/img/editlokasi.svg')?>">
                      </div>
                      <!--  <div class="col-auto" style="position: relative; display: inline-block;">
                      <i class="fas fa-map fa-3x" style="color: #74C0FC;"></i>
                      <i class="fas fa-pen-nib" style="position: absolute; top: -15px; right: -10px; font-size: 2em; color: #10375C; transform: rotate(0deg);"></i>
                    </div> -->
                  </div>
                </div>
              </div><br>

   <a href="#" class="btn btn-info btn-icon-split" onclick="history.back()">
      <span class="icon text-white-50">
         <i class="fas fa-arrow-left"></i>
      </span>
      <span class="text">Kembali</span>
   </a><br><br>
  <div class="mb-2 align-items-center">
    <div class="card shadow mb-4">
        <div class="card border-left-warning shadow py-3">
            <div class="card-body">
                    <?php 
                        foreach ($editable as $k):
                          $id     = $k['id'];
                          $lang = $k['latitude_longitude'];
                          $cd_office = $k['cd_office'];
                          $nm        = $k['nm_office'];
                          $rad       = $k['radius_absen'];

                        ?>

                <form method="POST" enctype="multipart/form-data" action="<?php echo site_url('C_lokasi/menuEdit')?>">
                    <div class="row">
                        <!-- Titik Koordinat Input -->
                        <input type="text" name="id" value="<?php echo $id ?>" hidden>
                       
                        <div class="col-lg-12 mb-3">
                            <label for="koordinat" class="form-label">Titik Koordinat [Latitude & Longitude]<code>*</code></label>
                            <input type="text" class="form-control" id="koordinat" name="lang" value="<?php echo $lang; ?>" required>
                        </div>

                        <!-- Kode Kantor Input -->
                        <div class="col-lg-12 mb-3">
                            <label for="kantor" class="form-label">Kode Kantor</label>
                            <input type="number" class="form-control" id="kantor" name="kantor" value="<?php echo $cd_office; ?>" readonly>
                        </div>

                        <!-- Nama Wilayah Input -->
                        <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">Nama Wilayah</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nm ?>" readonly>
                        </div>

                         <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">Radius(meter) </label>
                            <input type="text" class="form-control" id="radius" name="radius" value="<?php echo $rad ?>">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <?php endforeach; ?>
                    <div class="d-flex justify-content-start mt-3">
                        <button type="submit" class="btn btn-info btn-fw">Submit</button>
                    </div>

                </form>
                  
                   <p><code>* Untuk melihat bagaimana mendapatkan titik koordinat suatu lokasi bisa dilihat pada tombol tanda tanya di 
                halaman depan </code></p>
            </div>
        </div>
    </div>
</div>



            </div>      
          </div>      
        </div>
      </div>          
  </div>
</body>
<?php $this->load->view('cover/footer'); ?>
</html>