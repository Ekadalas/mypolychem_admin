<?php $this->load->helper('url') ?>

<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('cover/header'); ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style>
	    .btn-xs {
	        font-size: 13px; /* Ukuran teks lebih kecil */
	        padding: 2px 5px; /* Padding lebih kecil */
	    }
	</style>
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
                          Data Harian
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          DATA PENILAIAN PPK
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

                <div class="dropdown mb-4">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="departemen"> Pilih Departemen </button>

                <div class="dropdown-menu animated--fade-in"
                aria-labelledby="dropdownMenuButton">
                <?php foreach ($departemen as $k) { ?>

                <a class="dropdown-item" href="#" data-value = "<?php echo $k['departemen'] ?>" ><?php echo $k['departemen']; ?></a>

                <?php }?>
                </div>
                </div>

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
        <div class="table-responsive" id="filteredTable">
           <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-light"  style="font-size: 12px;">
              <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">NIK</th>
                <th rowspan="2">NAMA</th>
                <th rowspan="2">DEPARTEMEN</th>
                <th colspan="3" style="text-align: center;">SC 1</th>
                <th colspan="3" style="text-align: center;">SC 2</th>
                <th colspan="3" style="text-align: center;">SC 3</th>
                <th colspan="3" style="text-align: center;">SC 4</th>
                <th colspan="3" style="text-align: center;">SC 5</th>
                <th colspan="3" style="text-align: center;">HC 1</th>
                <th colspan="3" style="text-align: center;">HC 2</th>
                <th colspan="3" style="text-align: center;">HC 3</th>
                <th colspan="3" style="text-align: center;">HC 4</th>
                <th colspan="3" style="text-align: center;">HC 5</th>
              </tr>
              <tr>
                <!-- SC1 -->
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                <!-- END SC1 -->
                <!-- SC2 -->
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                <!-- END SC2 -->
                <!-- SC3 -->
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                <!-- END SC3 -->
                <!-- SC4 -->
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                <!-- END SC4 -->
                <!-- SC5 -->
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                <!-- END SC5 -->
                <!-- HC1 -->
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                <!-- END HC1 -->
                <!-- HC2 -->
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                <!-- END HC2 -->
                <!-- HC3 -->
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                <!-- END HC3 -->
                <!-- HC4 -->
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                <!-- END HC4 -->
                <!-- HC5 -->
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                <!-- END HC5 -->
              </tr>


            </thead>

                            <?php if (!empty($penilaian)): ?>
                            <tbody style="font-size: 11px; color: black;">
                            <?php
                            $no = 1;

                            foreach ($penilaian as $k) {
                            $nik_dinilai  = $k['nik_dinilai'];
                            $name         = $k['name'];
                            $departemen   = $k['departemen'];
                            $kd_1         = $k['kd_1'];
                            $kd_2         = $k['kd_2'];
                            $kd_3         = $k['kd_3'];
                            $kd_4         = $k['kd_4'];
                            $kd_5         = $k['kd_5'];
                            $kd_6         = $k['kd_6'];
                            $kd_7         = $k['kd_7'];
                            $kd_8         = $k['kd_8'];
                            $kd_9         = $k['kd_9'];
                            $kd_10        = $k['kd_10'];
                            $kd_11        = $k['kd_11'];
                            $kd_12        = $k['kd_12'];
                            $kd_13        = $k['kd_13'];
                            $kd_14        = $k['kd_14'];
                            $kd_15        = $k['kd_15'];
                            $kd_16        = $k['kd_16'];
                            $kd_17        = $k['kd_17'];
                            $kd_18        = $k['kd_18'];
                            $kd_19        = $k['kd_19'];
                            $kd_20        = $k['kd_20'];
                            $kd_21        = $k['kd_21'];
                            $kd_22        = $k['kd_22'];
                            $kd_23        = $k['kd_23'];
                            $kd_24        = $k['kd_24'];
                            $kd_25        = $k['kd_25'];
                            $kd_26        = $k['kd_26'];
                            $kd_27        = $k['kd_27'];
                            $kd_28        = $k['kd_28'];
                            $kd_29        = $k['kd_29'];
                            $kd_30        = $k['kd_30'];
                            ?>
                            <tr>
                            <td><?php echo $no++  ?></td>
                            <td><?php echo $nik_dinilai ?></td>
                            <td><?php echo $name  ?></td>
                            <td><?php echo $departemen  ?></td>
                            <td><?php echo $kd_1  ?></td>
                            <td><?php echo $kd_2  ?></td>
                            <td><?php echo $kd_3  ?></td>
                            <td><?php echo $kd_4  ?></td>
                            <td><?php echo $kd_5  ?></td>
                            <td><?php echo $kd_6  ?></td>
                            <td><?php echo $kd_7  ?></td>
                            <td><?php echo $kd_8  ?></td>
                            <td><?php echo $kd_9  ?></td>
                            <td><?php echo $kd_10  ?></td>
                            <td><?php echo $kd_11  ?></td>
                            <td><?php echo $kd_12  ?></td>
                            <td><?php echo $kd_13  ?></td>
                            <td><?php echo $kd_14  ?></td>
                            <td><?php echo $kd_15  ?></td>
                            <td><?php echo $kd_16  ?></td>
                            <td><?php echo $kd_17  ?></td>
                            <td><?php echo $kd_18  ?></td>
                            <td><?php echo $kd_19  ?></td>
                            <td><?php echo $kd_20  ?></td>
                            <td><?php echo $kd_21  ?></td>
                            <td><?php echo $kd_22  ?></td>
                            <td><?php echo $kd_23  ?></td>
                            <td><?php echo $kd_24  ?></td>
                            <td><?php echo $kd_25  ?></td>
                            <td><?php echo $kd_26  ?></td>
                            <td><?php echo $kd_27  ?></td>
                            <td><?php echo $kd_28  ?></td>
                            <td><?php echo $kd_29  ?></td>
                            <td><?php echo $kd_30  ?></td>
                            </tr>
                            <?php } ?>
                            <?php else: ?>
                            <p style="color:red;">Tidak ada data penilaian.</p>
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
                url: "<?php echo site_url('C_data_penilaian/filter'); ?>",
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
