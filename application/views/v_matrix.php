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
                          Data Harian
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          DATA MATRIX PENILAIAN
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
                <th>PERIODE</th>
                <th>NIK</th>
                <th>NAMA</th>
                <th>DEPARTEMEN</th>
                <th>ORGANISASI</th>
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
              </tr>
            </thead>

            <tbody style="font-size: 12px; color: black;">
                             <?php
                              $no = 1;
                              foreach ($matrix as $k) {
                                  $periode      = $k['periode_ppk'];
                                  $nik_dinilai  = $k['nik_dinilai'];
                                  $nama_dinilai = $k['nama_dinilai'];
                                  $departemen   = $k['departemen'];
																	$organisasi   = $k['organisasi_ppk'];
																	$p1           = $k['nama_p1'];
																	$p2           = $k['nama_p2'];
																	$p3           = $k['nama_p3'];
                              ?>
                              <tr style="font-size:11px">
                                <td><?php echo $no++  ?></td>
                                <td><?php echo $periode ?></td>
                                <td><?php echo $nik_dinilai  ?></td>
                                <td><?php echo $nama_dinilai  ?></td>
                                <td><?php echo $departemen ?></td>
                                <td><?php echo $organisasi?></td>
                                <td><?php echo $p1 ?></td>
                                <td><?php echo $p2 ?></td>
                                <td><?php echo $p3 ?></td>
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
