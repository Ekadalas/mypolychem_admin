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
                          LOKASI KOORDINAT
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          PT. POLYCHEM INDONESIA. Tbk
                        </div>
                      </div>
                      <div class="col-auto">
                        <img style="width: 100px; height: 60px;" src="<?php echo base_url('assets/img/loc.svg')?>">
                      </div>
                      <!--  <div class="col-auto" style="position: relative; display: inline-block;">
                        <i class="fas fa-vial" style="position: absolute; top: -15px; left: -10px; font-size: 1.55em; color: #74C0FC; transform: rotate(0deg);"></i>
                      <i class="fas fa-flask fa-3x" style="color: #74C0FC;"></i>
                     
                    </div> -->
                    </div>
                  </div>
                </div>
              </div>


                
               <div class="mb-2 align-items-center">
                <form method="POST">
                  <button type="submit" formaction="<?php echo site_url('C_lokasi/plus')?>" class="btn btn-primary btn-circle"><i class="fas fa-fw fa-plus"></i></button>
                 <button type="submit" name="submitEdit" id="submitEdit" formaction="<?php echo site_url('C_lokasi/edit')?>" class="btn btn-warning btn-circle" disabled><i class="fas fa-fw fa-edit"></i></button>
                
                <!-- <i class="fas fa-fw fa-question"></i></a> -->
                 

  <div class="modal fade" id="TanyaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selamat Datang !</h5>
                    <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"> Ini adalah akses menu untuk mendapatkan informasi mengenai cara mendapatkan
                titik koordinat latitude dan longitude. Silakan klik tombol Modul dibawah ini </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo base_url('pdf/koordinat.pdf')?>" target="_blank" >Modul</a>
                </div>
            </div>
        </div>
    </div>
                  
                  
                <div class="card shadow mb-4">
                   <div class="card border-left-info shadow py-3" style="min-height: auto;">

                  <div class="card-body">
                  
                    <!-- <hr class="border border-info border-3 opacity-75"> -->
                     <div class="row">

                                <?php 

                                foreach ($lokasi as $k) {
                                    $lati = $k['latitude_longitude'];
                                    $id        = $k['id'];
                                    $cd_office = $k['cd_office'];
                                    $nm_office = $k['nm_office'];
                                    $radius    = $k['radius_absen'];
 
                                
                                ?>
                               
                                <!-- Wisma BNI 46 -->
                                <div class="col-lg-3">
                                    <div class="card-body">
                                        
                                        <label class="form-label"><input type="radio" name="input_HO" value="<?php echo $id?>"  ><?php echo substr($nm_office, 28,15) ?></label>

                                        <!-- <input type="text" class="form-control" style="font-size: 12px;" value="<?php echo $lati; ?>" readonly> --><textarea class="form-control" style="font-size: 14px;" readonly><?php echo $lati; ?> | Radius: <?php echo $radius; ?> m </textarea>
                                    </div>
                                </div>
                             
                               <?php } ?>  
                            </div>
                     </form>    
                  </div> <!-- .card-body -->
                </div> <!-- .card -->
              </div>
              </div>
             </div> 
            
  
<script>
  $(document).ready(function() {
    $('#submitEdit').prop('disabled', true); // Set button to disabled by default
    
    $('input[name="input_HO"]').on('change', function() {
      var anyChecked = $('input[name="input_HO"]:checked').length > 0; // Check if any radio is checked
      $('#submitEdit').prop('disabled', !anyChecked); // Enable/disable button based on whether a radio is checked
    });
  });
</script>

    </div>

   </div>
    <a href=""  data-toggle="modal" data-target="#TanyaModal" >
   <img  class="bottom-right-image" src="<?php echo base_url('assets/img/question.svg')?>">
    </a>
  
  
  </div>              
  </div>
</body>
<?php $this->load->view('cover/footer'); ?>
</html>