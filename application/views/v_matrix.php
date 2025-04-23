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
<?php if ($this->session->flashdata('success')): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?= $this->session->flashdata('success'); ?>',
        showConfirmButton: false,
        timer: 2000
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
<form method="POST">
  <button type="submit" id="plusPlus" class="btn btn-info" formaction="<?= site_url('C_matrix_penilaian/tambah'); ?>"> Data Penilai Baru <i class="fas fa-plus"></i></button>

  <!-- <button type="submit" class="btn btn-warning"   onclick="submitNIK()">Ubah <i class="far fa-edit"></i></button> -->
  <button type="submit" class="btn btn-success" formaction="<?= site_url('C_matrix_penilaian/edit_penilai') ?>" id="klikEdit" > Ubah<i class="far fa-edit "></i> </button>
      
  <button type="submit" id="apusDelet" class="btn btn-danger" formaction="<?= site_url('C_matrix_penilaian/hapus') ?>" onclick = "return confirm('apakah anda yakin ingin menghapus data ini ?')">Hapus <i class="far fa-trash-alt"></i></button>
      <br><br>
      
  <code style="color: red">Mohon Pilih satu data yang penilainya ingin di ubah </code>
 <div class="row my-4">
  <div class="col-md-12">
    <div class="card shadow">
         <div class="card border-left-info shadow py-3" style="min-height: auto;">
      <div class="card-body">

        <div class="table-responsive">
           <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
           
           <thead class="thead-light"  style="font-size: 12px;">
              <tr>
                <th></th>
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
                                <td><input type="checkbox" class="input_nik" name="input_nik[]" value="<?= $k['nik_dinilai']; ?>"></td>
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
                        </form>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>

              </div> <!-- .card-body -->
            </div> <!-- .card -->
          </div>


					<script>
			    // Fungsi untuk mengaktifkan/menonaktifkan semua checkbox
			    function toggleCheckboxes() {
			    var checkboxes = document.getElementsByName('nik_id[]');
			    var checkAllCheckbox = document.getElementById('checkAll');

			    for (var i = 0; i < checkboxes.length; i++) {
			    checkboxes[i].checked = checkAllCheckbox.checked;
			    }
			    }
			    </script>

			    <!-- Membuat button menjadi disabled ketika checkbox belum dipilih -->
			  <!-- <script>
			  $(document).ready(function() {
			  $('#submit').prop('disabled', true); // set button to disabled by default
			  $('input[type="checkbox"]').on('change', function() {
			  var anyChecked = $('input[type="checkbox"]:checked').length > 0; // check if any checkbox is checked
			  $('#submit').prop('disabled', !anyChecked); // enable/disable button based on whether a checkbox is checked
			  });
			  });
			  </script> -->

				<script>
          
		

//   $('#klikEdit').on('click', function(e) {
//     var selectedValue = $('input[name="input_nik[]"]:checked')
//         .map(function() {
//             return this.value;
//         }).get();

//     if (selectedValue.length > 0) {
//         var actionUrl = "<?= site_url('C_matrix_penilaian/edit_penilai') ?>?input_nik=" + selectedValue.join(',');
//         $(this).attr('formaction', actionUrl);
//     } else {
//         e.preventDefault(); // Mencegah submit jika tidak ada yang dipilih
//         alert('Pilih minimal satu NIK terlebih dahulu!');
//     }

    
// });


$(document).ready(function() {
    var table = $('#dataTable').DataTable(); // Inisialisasi DataTables

    $('#klikEdit').on('click', function(e) {
        var selectedValue = [];

        // Gunakan API DataTables untuk ambil semua checkbox tercentang, termasuk dari halaman lain
        table.$('input[name="input_nik[]"]:checked').each(function() {
            selectedValue.push(this.value);
        });

        if (selectedValue.length > 0) {
            var actionUrl = "<?= site_url('C_matrix_penilaian/edit_penilai') ?>?input_nik=" + selectedValue.join(',');
            $(this).attr('formaction', actionUrl);
        } else {
            e.preventDefault(); // Mencegah submit
            alert('Pilih minimal satu NIK terlebih dahulu!');
        }
    });
});


      
				</script>


               </div>
             </div>
           </div>
        </div>
 	</div>
</body>
<?php $this->load->view('cover/footer')?>
</html>
