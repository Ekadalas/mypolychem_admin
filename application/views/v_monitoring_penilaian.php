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
            DATA PENILAIAN
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

              <!-- <div class="dropdown mb-4">
              <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="departemen"> Pilih Departemen </button>

              <div class="dropdown-menu animated--fade-in"
              aria-labelledby="dropdownMenuButton">
              <?php foreach ($departemen as $k) { ?>

              <a class="dropdown-item" href="#" data-value = "<?php echo $k['departemen'] ?>" ><?php echo $k['departemen']; ?></a>

              <?php }?>
              </div>
              </div> -->

            <form class="form-inline" method="post" action="<?php echo site_url('C_monitoring_penilaian/filter'); ?>">
            <div class="form-group mx-sm-3 mb-2">
            <label class="sr-only">Departemen</label>
            <select class="form-control form-control-sm" name="departemen">
              <?php
              foreach ($departemen as $k) {
              ?>
              <option value="<?php echo $k['departemen'] ?>"><?php echo $k['departemen'] ?></option>
              <?php
              }
              ?>
            </select>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Filter</button>
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
        <div class="table-responsive" id="filteredTable">
          <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-light"  style="font-size: 12px;">
          <tr>
          <th>NO</th>
          <th>PERIODE PPK</th>
          <th>NIK</th>
          <th>NAMA</th>
          <th>DEPARTEMEN</th>
          <th>PROSES</th>
          <th>STATUS</th>
          <th>AKSI</th>
          </tr>



          </thead>

          <?php if (!empty($monitoring)): ?>
          <tbody style="font-size: 11px; color: black;">
          <?php
          $no = 1;

          foreach ($monitoring as $k) {
          $periode_ppk          = $k['periode_ppk'];
          $nik_dinilai          = $k['nik_dinilai'];
          $nama_dinilai         = $k['nama_dinilai'];
          $departemen           = $k['departemen'];
          $progress_penilaian   = $k['progress_penilaian'];
          $jumlah_penilai       = $k['jumlah_penilai'];
          ?>
          <tr>
          <td><?php echo $no++  ?></td>
          <td><?php echo $periode_ppk ?></td>
          <td><?php echo $nik_dinilai  ?></td>
          <td><?php echo $nama_dinilai  ?></td>
          <td><?php echo $departemen  ?></td>
          <td><?php echo $progress_penilaian  ?>/<?php echo $jumlah_penilai  ?></td>
          <td>
          <?php
          if ($progress_penilaian == $jumlah_penilai) {
          echo "
          <button type='button' class='btn btn-success btn-xs'>
          LENGKAP
          </button>";
          }else{
            echo "
            <button type='button' class='btn btn-danger btn-xs'>
            BELUM LENGKAP
            </button>";
          }
          ?>
          </td>
          <td>

          <button type="button" class="btn btn-info btn-xs"
          data-nik_dinilai="<?= $nik_dinilai;?>"
          data-toggle="modal"
          data-target="#tabelDetail">
          CEK DATA
          </button>


          </td>
          </tr>
          <?php } ?>
          <?php else: ?>
          <p style="color:red;">Tidak ada data monitoring penilaian.</p>
          <?php endif; ?>
          </tbody>

          </table>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>


          <!-- Modal -->
          <div class="modal fade" id="tabelDetail" tabindex="-1" aria-labelledby="tabelDetailLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="tabelDetailLabel">
            PENILAI PPK
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
          <table class="table table-bordered table-sm">
          <thead class="table-light">
          <tr style="font-size: 12px;">
          <th>NIK PENILAI</th>
          <th>NAMA PENILAI</th>
          <th>KODE PENILAI</th>
          <th>STATUS</th>
          </tr>
          </thead>
          <tbody id="detailBody" style="font-size: 11px;">
          <!-- Data akan diisi dari JS -->
          </tbody>
          </table>
          </div>
          </div>
          </div>
          </div>


              <script>
              $(document).ready(function () {
              $('#dataTable').on('click', '.btn-info', function () {
              var nik = $(this).data('nik_dinilai'); // Ambil NIK yang dikirimkan melalui data-atribut

              // Lakukan AJAX untuk mengambil data berdasarkan NIK
              $.ajax({
              url: '<?= site_url("C_monitoring_penilaian/getDetailPenilaian") ?>', // URL yang dipanggil untuk mendapatkan data
              type: 'POST',
              data: { nik_dinilai: nik }, // Mengirim data NIK ke server
              dataType: 'json',
              success: function (response) {
              var html = '';

              // Mengecek apakah data ada
              if (response.length > 0) {
              $.each(response, function (i, data) {
                // Menentukan warna berdasarkan status
              var statusColor = (data.status === 'Belum Menilai') ? 'style="color:red;"' : 'style="color:green;"';
              // Menambah data ke dalam tabel
              html += '<tr>' +
              '<td>' + data.nik_penilai + '</td>' +
              '<td>' + data.nama_penilai + '</td>' +
              '<td>' + data.kode_penilai + '</td>' +
              '<td ' + statusColor + '>' + data.status + '</td>' +
              '</tr>';
              });
              } else {
              // Menampilkan pesan jika data kosong
              html = '<tr><td colspan="3" class="text-center">Tidak ada data penilaian.</td></tr>';
              }

              // Memasukkan data ke dalam body modal atau tabel
              $('#detailBody').html(html);
              },
              error: function (xhr, status, error) {
              // Jika terjadi error saat AJAX
              $('#detailBody').html('<tr><td colspan="3" class="text-center text-danger">Gagal mengambil data.</td></tr>');
              }
              });
              });
              });
              </script>





                <!-- <script>
                $(document).ready(function(){
                var dataTable = $('#dataTable').DataTable(); // Inisialisasi awal DataTables

                $('.dropdown-item').on('click', function(e){
                e.preventDefault();
                var departemen = $(this).data('value');

                $.ajax({
                url: "<?php echo site_url('C_monitoring_penilaian/filter'); ?>",
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
                </script> -->

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
