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
                         ABSENSI HARIAN
                        </div>
                      </div>
                      <div class="col-auto">
                        <img style="width: 100px; height: 60px;" src="<?php echo base_url('assets/img/absensi.svg')?>">
                        <!-- <i class="fas fa-user-clock fa-2x " style="color: #74C0FC;"></i> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>

               <a href="#" class="btn btn-dark btn-icon-split" onclick="history.back()">
                <span class="icon text-white-50">
                   <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
               </a>
              <!--  <a href="<?php echo site_url('C_absen/')?>" class="btn btn-primary btn-icon-split" >
                <span class="icon text-white-30">
                   <i class="fas fa-print"></i>
                </span>
                <span class="text">Cetak</span>
               </a> -->

<?php if (!empty($absensi)): ?>
 <div class="row my-4" >
  <div class="col-md-12">
    <div class="card shadow">
     <div class="card border-left-info shadow py-3" style="min-height: auto;">
      <div class="card-body">
        <div class="table-responsive">
           <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-light"  style="font-size: 12px;">
              <tr>

                <th>NO</th>
								<th>NIP</th>
                <th>NIK</th>
                <th>NAMA</th>
                <th>DEPARTEMEN</th>
                <th>KANTOR</th>
                <th>TGL.MASUK</th>
                <th>MASUK</th>
                <th>TGL.PULANG</th>
                <th>PULANG</th>
                <th>STATUS</th>
                <!-- <th>FOTO REGISTRASI</th>
                <th>FOTO MASUK</th>
                <th>FOTO KELUAR</th> -->

              </tr>
            </thead>

            <tbody style="font-size: 12px; color: black;">
                             <?php
                              $no = 1;
                              //$status = "";
                              foreach ($absensi->result_array() as $k) {
																  $nip        = $k['nip'];
																	$nip_btn    = $k['nip_btn'];
                                  $name       = $k['name'];
                                  $departemen = $k['departemen'];
                                  $kantor     = $k['kantor'];
																	$tgl = ($k['tgl_masuk'] == NULL || $k['tgl_masuk'] == '') ? '' : date('Y-m-d', strtotime($k['tgl_masuk']));
																	$tgl_plng = ($k['tgl_pulang'] == NULL || $k['tgl_pulang'] == '') ? '' : date('Y-m-d', strtotime($k['tgl_pulang']));
                                  $jam_msk    = $k['jam_masuk'];
                                  $jam_klr    = $k['jam_pulang'];
                                  $regis      = $k['foto_registrasi'];
                                  $f_masuk    = $k['foto_masuk'];
                                  $f_keluar   = $k['foto_keluar'];
                                  $status     = $k['status_hrms'];
                              ?>
                              <tr>

                                <td><?php echo $no++  ?></td>
																<td><?php echo $nip ?></td>
                                <td><?php echo $nip_btn ?></td>
                                <td><?php echo $name  ?></td>
                                <td><?php echo $departemen  ?></td>
                                <td><?php echo $kantor ?></td>
                                <td><?php echo $tgl ?></td>
                                <td><?php echo $jam_msk ?></td>
                                <td><?php echo $tgl_plng ?></td>
                                <td><?php echo $jam_klr ?></td>
                                 <td><?php if ($status == NULL) {
                                    echo "<h6><span class='badge badge-danger'>REGISTRASI</span></h6>";
                                   } elseif ($status == '1') {
                                    echo "<h6><span class='badge badge-warning'>CHECK IN</span></h6>";
                                   } elseif ($status == '2') {
                                    echo "<h6><span class='badge badge-success'>CHECK OUT</span></h6>";
                                   }
                                ?></td>
                                <!-- <td align="center">
																	<img class="zoom regis-photo" id="regis-photo"
     															src="">
                                </td>
                                <td align="center">
                                  <img class="zoom checkin-photo" id="checkin-photo"
																	src="">
                                </td>
                                <td align="center">
                                  <img class="zoom checkout-photo"  id="checkout-photo"
																	src="">
                                </td> -->

                                <!-- <td class="status-col"> Processing... </td> -->
                              </tr>
                              <?php } ?>
                            </tbody>
                          <?php endif; ?>
                          </table>
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
</body>
<?php $this->load->view('cover/footer'); ?>
</html>
