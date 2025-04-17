<?php $this->load->helper('url') ?>

<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('cover/header'); ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- <script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
  #custom-control {
    border-color: black;
  }

</style>

 
</head>
<body id="page-top">
 	<div id="wrapper">
 		<?php $this->load->view('cover/sidebar') ?>
 		 <!-- Content Wrapper -->

   <?php if ($this->session->flashdata('kosong')): ?>
     <script>
Swal.fire({
  title: 'Error!',
  text: 'Maaf data tidak ada',
  icon: 'warning',
  timer: 3000
});
     </script>
   <?php endif; ?>  
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
               		
          <div class="mb-2 align-items-center">
            <div class="card shadow mb-4">
                <div class="card border-left-info shadow py-3" style="min-height: auto;">
                    <div class="card-body">
               
                <!-- <hr class="border border-info border-3 opacity-75"> -->
                
  <form method="post" id="formAbsen" action="<?php echo site_url('C_absen/trackData') ?>">
    <div class="row align-items-center">
        <div class="col-lg-3">
            <div class="card-body">
                <label class="form-label">Tanggal Mulai :</label>
                <input type="date" class="form-control" name="mulai" id="mulai" required>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card-body">
                <label class="form-label">Tanggal Akhir :</label>
                <input type="date" class="form-control" name="selesai" id="selesai" required>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="card-body">
                <label class="form-label">Office :</label>
                <select class="form-control" name="Office" id="OfficeDropdown" required>
                    <option value="">--pilih--</option>
                    <option value="HO">Head Office</option>
                    <option value="TGR">Plant Tangerang</option>
                    <option value="MRK">Plant Merak</option>
                    <option value="KRW">Plant Karawang</option>
                </select>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card-body">
                <label class="form-label">Departemen :</label>
                <select class="form-control select2" name="departemen" id="departDropdown" required>
                    <option value="ALL">ALL</option>
                </select>
            </div>
        </div>

    <div class="col-lg-5">
        <div class="card-body">
            <button type="submit" class="btn btn-info mt-4">Submit</button>
        </div>
    </div>
  </div>
</form>

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            width: '100%' // Set to 100% to match Bootstrap form-control width
           // border-color: 'black';
        });

        // Event handler for Office selection
        $('#OfficeDropdown').on('change', function() {
            var office = $(this).val();
            $('#departDropdown').html('<option value="">Pilih Departemen</option>');

            if (office) {
                $.ajax({
                    url: '<?php echo site_url("C_absen/getDepartments"); ?>',
                    type: 'POST',
                    data: {office: office},
                    dataType: 'json',
                    success: function(data) {
                        $('#departDropdown').empty().append('<option value="ALL">ALL</option>');
                        $.each(data, function(index, item) {
                            $('#departDropdown').append('<option value="' + item.departemen + '">' + item.departemen + '</option>');
                        });
                    }
                });
            } else {
                $('#departDropdown').html('<option value="ALL">ALL</option>');
            }
        });
    });
</script>


              </div> <!-- .card-body -->
            </div>
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