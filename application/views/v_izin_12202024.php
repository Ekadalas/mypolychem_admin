<?php $this->load->helper('url') ?>

<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('cover/header'); ?>


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
                          Data Pendukung
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          DATA PENGAJUAN IZIN
                        </div>
                      </div>
                      <div class="col-auto">
                        <img style="width: 100px; height: 60px;" src="<?php echo base_url('assets/img/dataizin.svg')?>">
                        <!-- <i class="fas fa-file-signature fa-3x " style="color: #74C0FC;"></i> -->
                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>

               		 <div class="mb-2 align-items-center">
            <div class="card shadow mb-4">
              <div class="card-body">
          
                

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
                <th>DEPARTEMEN</th>
                <th>KANTOR</th>
                <th>TANGGAL</th>
                <th>LAMA IZIN / HARI</th>
                <th>KETERANGAN</th>
                <th>STATUS IZIN</th>
                <th>STATUS HRMS</th>
              </tr>
            </thead>
            <?php if (!empty($data)): ?>
            <tbody style="font-size: 12px;">
                             <?php
                              $no = 1; 
                              $bagde = "";
                              foreach ($data as $k) {
                                  $nip_btn    = $k['nip_btn'];
                                  $name       = $k['name'];
                                  $departemen = $k['departemen'];
                                  $cd_office     = $k['cd_office'];
                                  $tgl_mulai        = $k['date_start'];
                                  $tgl_akhir    = $k['date_end'];
                                  $cuti       = $k['lama_cuti'];
                                  $ket        = $k['remark'];
                                  $status     = $k['status'];

                                
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
                                <td><?php echo $tgl_mulai?></td>                              
                                <td><?php echo $cuti; ?></td>
                                <td><?php echo $ket;?></td>
                                <td><h6><span class="badge badge-success">APPROVE</span></h6></td>
                                <td><?php if ($status == '0') {
                                      echo "<h6><span class='badge badge-danger'>NO HRMS</span></h6>";
                                    } elseif ($status == '1') {
                                      echo "<h6><span class='badge badge-success'>HRMS</span></h6>";
                                    } 
                                ?>
                                  

                                </td>
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