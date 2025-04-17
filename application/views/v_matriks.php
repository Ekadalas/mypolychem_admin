<?php $this->load->helper('url') ?>

<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('cover/header'); ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                          MATRIX APPROVAL
                        </div>
                      </div>

                      <div class="col-auto">
                        <img style="width: 100px; height: 60px;" src="<?php echo base_url('assets/img/matrix.svg')?>">
                      </div>
                      <!--  <div class="col-auto" style="position: relative; display: inline-block;">

                      <i class="far fa-file-alt fa-3x" style="color: #10375C;"></i>
                     <i class="fas fa-check-double" style="position: absolute; top: -15px; left: -10px; font-size: 1.55em; color: #74C0FC; transform: rotate(0deg);"></i>
                    </div> -->
                    </div>
                  </div>
                </div>
              </div>

               		 <div class="mb-2 align-items-center">
            <div class="card shadow mb-4">
              <div class="card-body">
									<div class="dropdown mb-4">
									<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="departemen"> Pilih Departemen </button>

									<div class="dropdown-menu animated--fade-in"
									aria-labelledby="dropdownMenuButton">
									<?php foreach ($departemen as $k) { ?>

									<a class="dropdown-item" href="#" data-value = "<?php echo $k['departemen'] ?>" ><?php echo $k['departemen']; ?></a>

									<?php }?>
									</div>
									</div>
                   <!--  <form method="POST" class="">
                    <label class="form-label">Pilih Departemen</label>
                    <select class="form-select">
                      <option value="ALL">ALL</option>
                      <option value="ALL">ALL</option>
                    </select>
                  </form> -->
 <div class="row my-4">
  <div class="col-md-12">
    <div class="card shadow">
         <div class="card border-left-info shadow py-3" style="min-height: auto;">
      <div class="card-body">
        <div class="table-responsive" id="filteredTable">
           <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-light"  style="font-size: 12px;">
              <tr>
                <th>NO</th>
                <th>NIK</th>
                <th>NAMA</th>
                <th>DEPARTEMEN</th>
                <th>GRADE</th>
                <th>KANTOR</th>
                <th>ORGANISASI</th>
                <th>NIK ATASAN</th>
                <th>NAMA ATASAN</th>
                <!-- <th>ORGANISASI ATASAN</th> -->
              </tr>
            </thead>

          <?php if (!empty($data)): ?>

            <tbody style="font-size: 12px; color: black;">
                             <?php
                              $no = 1;

                              foreach ($data as $k) {
                                  $nip_btn    = $k['nik_dinilai'];
                                  $name       = $k['nama_dinilai'];
                                  $departemen = $k['departemen'];
                                  $cd_office     = $k['office'];
                                  $grade      = $k['cd_grade'];
                                  $org        = $k['organisasi_ppk'];
                                  $nik_atasan = $k['nik_atasan'];
                                  $nama_atasan = $k['nama_atasan'];

                              ?>
                              <tr>
                                <td><?php echo $no++  ?></td>
                                <td><?php echo $nip_btn ?></td>
                                <td><?php echo $name  ?></td>
                                <td><?php echo $departemen  ?></td>
                                <td><?php echo $grade; ?></td>
                                <td><?php echo $cd_office ?></td>
                                <td><?php echo $org ?></td>
                                <td><?php echo $nik_atasan ?></td>
                                <td><?php echo $nama_atasan ?></td>
                                <!-- <td></td> -->

                              </tr>
                              <?php } ?>
                              <?php elseif (isset($depart)): ?>
                              <?php
                              $no = 1;

                              foreach ($depart as $k) {
                                  $nip_btn    = $k['nik_dinilai'];
                                  $name       = $k['nama_dinilai'];
                                  $departemen = $k['departemen'];
                                  $cd_office     = $k['office'];
                                  $grade      = $k['cd_grade'];
                                  $org        = $k['organisasi_ppk'];
                                  $nik_atasan = $k['nik_atasan'];
                                  $nama_atasan = $k['nama_atasan'];

                              ?>
                               <tr>
                                <td><?php echo $no++  ?></td>
                                <td><?php echo $nip_btn ?></td>
                                <td><?php echo $name  ?></td>
                                <td><?php echo $departemen  ?></td>
                                <td><?php echo $grade; ?></td>
                                <td><?php echo $cd_office ?></td>
                                <td><?php echo $org ?></td>
                                <td><?php echo $nik_atasan ?></td>
                                <td><?php echo $nama_atasan ?></td>
                                <!-- <td></td> -->

                              </tr>
                            <?php } ?>
                            <?php else: ?>
                              <tr>
                                  <td colspan="10">Data tidak ditemukan.</td>
                              </tr>
                            <?php endif; ?>
                            </tbody>

                          </table>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        var dataTable = $('#dataTable').DataTable(); // Inisialisasi awal DataTables

        $('.dropdown-item').on('click', function(e){
            e.preventDefault();
            var departemen = $(this).data('value');

            $.ajax({
                url: "<?php echo site_url('C_matriks/filter'); ?>",
                method: "POST",
                data: {departemen: departemen},
                success: function(response){
                    // Replace tabel dengan data baru
                    $('#filteredTable').html($(response).find('#filteredTable').html());

                    // Re-inisialisasi DataTables
                    dataTable.destroy();
                    dataTable = $('#dataTable').DataTable();

                    // Terapkan ulang style khusus setelah refresh
                    $('#dataTable thead').addClass('thead-light').css('font-size', '12px');
                    $('#dataTable tbody').css({
                        'font-size': '12px',
                        'color': 'black'
                    });
                },
                error: function(xhr, status, error) {
                    console.log("AJAX request failed: " + status + " - " + error);
                }
            });
        });
    });
</script>



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
