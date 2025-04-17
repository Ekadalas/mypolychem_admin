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

	<?php if($this->session->flashdata('berhasil_reset_password')): ?>
  <script>
  Swal.fire({
    title: 'Sukses',
    html: 'Berhasil melakukan reset password',
    type: 'success',
    width: '400px',
    padding: '20px',
    timer: '3000'
  });
  </script>
  <?php endif; ?>


	<?php if($this->session->flashdata('berhasil_reset_device')): ?>
	<script>
	Swal.fire({
		title: 'Sukses',
    html: 'Berhasil melakukan reset device',
		type: 'success',
		width: '400px',
		padding: '20px',
		timer: '3000'
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
                          DATA MASTER KARYAWAN
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
        <div class="table-responsive">
           <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-light"  style="font-size: 12px;">
              <tr>
                <th>NO</th>
                <th>NIK</th>
                <th>NAMA</th>
                <th>GENDER</th>
                <th>GRADE</th>
                <th>DEPARTEMEN</th>
                <th>UNIT KERJA</th>
								<?php
									$cek = $this->db->query("SELECT level FROM data_karyawan
									WHERE nip = '$nip'");
									$fetch = $cek->row_array();
									$level = $fetch['level'];

									if ($level == 'admin') {
										$hidden = '';
									}else {
										$hidden = 'hidden';
									}
								 ?>

								 <th <?php echo $hidden; ?>>KEY</th>
								 <th <?php echo $hidden; ?>>DEVICE</th>
								 <th <?php echo $hidden; ?>>RESET</th>

              </tr>
            </thead>

            <tbody style="font-size: 12px; color: black;">
                             <?php
                              $no = 1;

                              foreach ($karyawan as $k) {
                                  $nip_btn    = $k['nip_btn'];
                                  $name       = $k['name'];
                                  $sex        = $k['sex'];
																	$cd_grade   = $k['cd_grade'];
																	$departemen = $k['departemen'];
																	$unit_kerja = $k['unit_kerja'];
																	$device     = $k['device'];
																	$status_change_password     = $k['status_change_password'];
                              ?>
                              <tr>
                                <td><?php echo $no++  ?></td>
                                <td><?php echo $nip_btn ?></td>
                                <td><?php echo $name  ?></td>
                                <td><?php echo $sex  ?></td>
                                <td><?php echo $cd_grade ?></td>
                                <td><?php echo $departemen?></td>
                                <td><?php echo $unit_kerja ?></td>
																<?php
																$cek = $this->db->query("SELECT level FROM data_karyawan
																WHERE nip = '$nip'");
																$fetch = $cek->row_array();
																$level = $fetch['level'];

																if ($level == 'admin') {
																	$hidden = '';
																}else {
																	$hidden = 'hidden';
																}
																 ?>
																<td <?php echo $hidden; ?>>
																	<?php if ($status_change_password == 1) {
																		echo "<h6><span class='badge badge-danger'><i class='fas fa-lock'></i></span></h6>";
	                                    }else {
	                                      echo "";
	                                    }
	                                  ?>
																</td>
                                <td <?php echo $hidden; ?>><?php if ($device != NULL or $device != null) {
																	echo "<h6><span class='badge badge-success'><img src='https://upload.wikimedia.org/wikipedia/commons/3/3e/Android_logo_2019.png' width='16' height='16' style='margin-right:5px;'> Terverifikasi</span></h6>";
																}elseif ($status_change_password == 1 AND $device == NULL) {
																	echo "<h6><span class='badge badge-success'><img src='https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg' width='16' height='16' style='margin-right:5px;'> Terverifikasi</span></h6>";
																}else {
                                      echo "<h6><span class='badge badge-danger'>Null</span></h6>";
                                    }
                                  ?>
                                </td>
																			<td <?php echo $hidden; ?>>
																			<a class="btn btn-info btn-xs" href="<?php echo site_url('C_karyawan/password/'.$nip_btn) ?>"
																			onclick="return confirm('Apakah Anda yakin ingin mereset password?')">
																			Password
																			</a>

																			<a class="btn btn-warning btn-xs" href="<?php echo site_url('C_karyawan/device/'.$nip_btn) ?>"
																			onclick="return confirm('Apakah Anda yakin ingin mereset device?')">
																			Device
																			</a>
																			</td>

                              </tr>
                              <?php } ?>
                            </tbody>

                          </table>
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
</body>
<?php $this->load->view('cover/footer')?>
</html>
