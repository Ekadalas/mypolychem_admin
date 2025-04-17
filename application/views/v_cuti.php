<?php $this->load->helper('url') ?>

<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('cover/header'); ?>

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
                          DATA PENGAJUAN CUTI
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

<form method="POST" action="<?php echo site_url('C_cuti/bulanCuti'); ?>">
  <div class="row">
  <div class="col-lg-2">
  <select class="form-control fc" name="bulan" required>
    <option value="" disabled selected>Pilih Bulan</option>
    <option value="Januari">Januari</option>
    <option value="Februari">Februari</option>
    <option value="Maret">Maret</option>
    <option value="April">April</option>
    <option value="Mei">Mei</option>
    <option value="Juni">Juni</option>
    <option value="Juli">Juli</option>
    <option value="Agustus">Agustus</option>
    <option value="September">September</option>
    <option value="Oktober">Oktober</option>
    <option value="November">November</option>
    <option value="Desember">Desember</option>
  </select>
</div>
<div class="col-lg-2">
  <select class="form-control fc" name="tahun" required>
    <option value="" disabled selected>Pilih Tahun</option>
    <?php

    foreach ($ta as $k) :

    ?>
    <option value="<?php echo $k['tahun'] ?>"><?php echo $k['tahun']; ?></option>
  <?php endforeach; ?>
  </select>
</div>
<div class="col-lg-3">
  <button type="submit" class="btn btn-info">Submit</button>
</div>
</div>
</form>
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
				<a href="<?= site_url('C_cuti/cuti_belum_disetujui/'.$nip); ?>">
				*Klik tautan berikut untuk melihat data cuti yang belum disetujui atasan
				</a>

           <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-light"  style="font-size: 12px;">
              <tr>
                <th>NO</th>
                <th>NIK</th>
                <th>NAMA</th>
                <th>DEPARTEMEN</th>
                <th>KANTOR</th>
								<th>TGL.INPUT</th>
                <th>TGL.MULAI</th>
                <th>TGL.SELESAI</th>
                <th>CUTI/HARI</th>
                <th>CUTI</th>
                <th>TGL.PERSETUJUAN</th>
                <!-- <th>NIK ATASAN</th> -->
                <th>ATASAN</th>
                <th>STATUS APPROVE</th>
                <th>STATUS HRMS</th>
              </tr>
            </thead>

            <tbody style="font-size: 12px; color: black;">
                             <?php
                              $no = 1;

                              foreach ($cuti as $k) {
                                  $nip_btn    = $k['nip_btn'];
                                  $name       = $k['name'];
                                  $departemen = $k['departemen'];
                                  $cd_office     = $k['cd_office'];
																	$tgl_input = date('Y-m-d', strtotime($k['date_input_cuti']));
																	$tgl_mulai = date('Y-m-d', strtotime($k['date_start']));
																	$tgl_akhir = date('Y-m-d', strtotime($k['date_end']));
                                  $cuti       = $k['lama_cuti'];
                                  $ket        = $k['remark'];
                                  $status     = $k['status'];
                                  $vacation   = $k['cd_vacation'];
                                  $status_hrms = $k['status_hrms'];
                                  $tgl_setuju = $k['date_approval'];
                                  $nik_setuju = $k['Nik_penyetuju'];
                                  $nama_setuju = $k['nama_penyetuju'];



                                  if ($cd_office == '000') {
                                     $kantor = 'HO';
                                  } elseif ($cd_office == '001') {
                                     $kantor = 'MRK';
                                  } elseif ($cd_office == '002') {
                                     $kantor = 'TGR';
                                  } elseif ($cd_office == '003') {
                                     $kantor = 'KRW';
                                  } else {
                                     $kantor = 'UNKNOW';
                                  }
                              ?>
                              <tr>
                                <td><?php echo $no++  ?></td>
                                <td><?php echo $nip_btn ?></td>
                                <td><?php echo $name  ?></td>
                                <td><?php echo $departemen  ?></td>
                                <td><?php echo $kantor ?></td>
																<td><?php echo $tgl_input?></td>
                                <td><?php echo $tgl_mulai?></td>
                                <td><?php echo $tgl_akhir ?></td>
                                <td><?php echo $cuti ?></td>
                                <td><?php echo $vacation; ?></td>
                                <td>
																	<?php
																	if ($tgl_setuju == NULL AND $status == '2') {
																	echo "<span class='text-success fw-bold'>Otomatis Disetujui</span>";
																	} else {
																	echo "$tgl_setuju";
																	}
																	?>
																</td>
                                <!-- <td><?php echo $nik_setuju; ?></td> -->
                                <td><?php echo $nama_setuju; ?></td>
                                <td><?php if ($status == '0') {
                                      echo "<h6><span class='badge badge-danger'>PENGAJUAN</span></h6>";
                                    } elseif ($status == '2') {
                                      echo "<h6><span class='badge badge-success'>DISETUJUI</span></h6>";
                                    }
                                  ?>
                                </td>
                                <td><?php if ($status_hrms == '0') {
                                      echo "<h6><span class='badge badge-danger'>MENUNGGU</span></h6>";
                                    } elseif ($status_hrms == '1') {
                                      echo "<h6><span class='badge badge-success'>SUKSES</span></h6>";
                                    }
                                ?></td>



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
