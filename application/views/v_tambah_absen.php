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
                <div class="card border-left-info shadow py-3" style="min-height: auto;">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                         Periode Absen
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          TAMBAH DATA
                        </div>
                      </div>
                      <div class="col-auto">
                        <img style="width: 100px; height: 60px;" src="<?php echo base_url('assets/img/addUser.svg')?>">
                        <!-- <i class="fas fa-user-plus fa-2x " style="color: #74C0FC;"></i> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row my-4 justify-content-center" >
                <div class="col-md-12">
                <div class="card border-left-info shadow py-3" style="min-height: auto;">
                    <div class="card-body">
                   <!--    <h5>Test Tambah data absen</h5> -->
                     <!--  <hr class="border border-info border-3 opacity-75"> -->
                   <form method="POST" enctype="multipart/form-data" action="<?php echo site_url('C_absen/upload') ?>">
                     <div class="row">

                     
                        <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">NIP_BTN</label>
                            <input type="text" class="form-control" id="nik" name="nik"  required>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip"  required>
                        </div>

                         <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">tgl_masuk</label>
                            <input type="date" class="form-control" id="tgl" name="masuk"  required>
                        </div>

                         <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">tgl_masuk_formated</label>
                            <input type="text" class="form-control" id="formad" name="formad"  required>
                        </div>

                         <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">tgl_pulang</label>
                            <input type="date" class="form-control" id="pulang" name="pulang"  required>
                        </div>

                         <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">tgl_pulang_formad</label>
                            <input type="text" class="form-control" id="pulang_formad" name="pulang_formad"  required>
                        </div>

                         <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">Jam_msk</label>
                            <input type="text" class="form-control" id="jam_msk" name="jam_msk"  required>
                        </div>

                         <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">jam_pulang</label>
                            <input type="text" class="form-control" id="jam_plng" name="jam_plng"  required>
                        </div>

                         <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">cd_office</label>
                            <input type="number" class="form-control" id="cd_office" name="cd_office"  required>
                        </div>

                         <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">location</label>
                            <input type="text" class="form-control" id="location" name="location"  required>
                        </div>

                         <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">location_out</label>
                            <input type="text" class="form-control" id="loc_ot" name="loc_ot"  required>
                        </div>

                         <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">work_location</label>
                            <input type="text" class="form-control" id="work_loc" name="work_loc"  required>
                        </div>

                         <div class="col-lg-12 mb-3">
                            <label for="nama" class="form-label">keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan"  required>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label for="koordinat" class="form-label">Foto Masuk</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>

                     
                        <div class="col-lg-12 mb-3">
                            <label for="kantor" class="form-label">Foto Keluar</label>
                            <input type="file" class="form-control" id="img" name="img" required>
                        </div>


                    </div>

                    <div class="d-flex justify-content-start mt-3">
                        <button type="submit" class="btn btn-info btn-fw">Submit</button>
                    </div>

                </form>
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