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
<style>

</style>

 <?php if (!empty($absensi)): ?>
 <div class="row my-4" >
  <div class="col-md-12">
    <div class="card shadow">
         
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
                <th>TANGGAL MASUK</th>
                <th>TANGGAL KELUAR</th>
                <th>JAM DATANG</th>
                <th>JAM PULANG</th>
                <th>FOTO REGISTRASI</th>
                <th>FOTO MASUK</th>
                <th>FOTO KELUAR</th>
                <th>STATUS</th> 
              </tr>
            </thead>
           
            <tbody style="font-size: 12px; color: black;">
                             <?php
                              $no = 1; 
                              //$status = ""; 
                              foreach ($absensi->result_array() as $k) {
                                  $nip_btn    = $k['nip_btn'];
                                  $name       = $k['name'];
                                  $departemen = $k['departemen'];
                                  $kantor     = $k['kantor'];
                                  $tgl        = $k['tgl_masuk'];
                                  $tgl_plng   = $k['tgl_pulang'];
                                  $jam_msk    = $k['jam_masuk'];
                                  $jam_klr    = $k['jam_pulang'];
                                  $regis      = $k['foto_registrasi'];
                                  $f_masuk    = $k['foto_masuk'];
                                  $f_keluar   = $k['foto_keluar'];
                                  $status     = $k['status_hrms'];
                              ?>
                              <tr>
                              
                                <td><?php echo $no++  ?></td>
                                <td><?php echo $nip_btn ?></td>
                                <td><?php echo $name  ?></td>
                                <td><?php echo $departemen  ?></td>
                                <td><?php echo $kantor ?></td>
                                <td><?php echo $tgl ?></td>
                                <td><?php echo $tgl_plng ?></td>
                                <td><?php echo $jam_msk ?></td>
                                <td><?php echo $jam_klr ?></td>
                                 <td><?php if ($status == NULL) {
                                    echo "<h6><span class='badge badge-danger'>REGISTRASI</span></h6>";
                                   } elseif ($status == '1') {
                                    echo "<h6><span class='badge badge-warning'>IN HRMS</span></h6>";
                                   } elseif ($status == '2') {
                                    echo "<h6><span class='badge badge-success'>HRMS OUT</span></h6>";
                                   }
                                ?></td>
                                <td align="center">
                                  <img class="zoom regis-photo"  id="regis-photo" src="<?= base_url('assets/img/' .$regis) ?>" >
                                </td>
                                <td align="center">
                                  <img class="zoom checkin-photo" id="checkin-photo" src="<?= base_url('assets/img/' .$f_masuk) ?>">
                                </td>
                                <td align="center">
                                  <img class="zoom checkout-photo"  id="checkout-photo" src="<?= base_url('assets/img/' .$f_keluar) ?>">
                                </td>
                               
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
<!-- Initialize face-api.js -->

<script>

  const baseUrl = '<?php echo base_url() ?>';

    async function loadModels() {
        await faceapi.nets.ssdMobilenetv1.loadFromUri(baseUrl + '/assets/models');
        await faceapi.nets.faceLandmark68Net.loadFromUri(baseUrl + '/assets/models');
        await faceapi.nets.faceRecognitionNet.loadFromUri(baseUrl + '/assets/models');
    }

    async function getFaceDescriptorFromUrl(imageUrl) {
        const img = await faceapi.fetchImage(imageUrl);
        const fullFaceDescription = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
        return fullFaceDescription ? fullFaceDescription.descriptor : null;
    }

   async function compareFaceDescriptors() {
    console.log("Memulai proses pencocokan...");
    await loadModels();

    document.querySelectorAll('tr').forEach(async row => {
        const regisPhoto = row.querySelector('.regis-photo');
        const checkinPhoto = row.querySelector('.checkin-photo');
        const statusCol = row.querySelector('.status-col');

        if (regisPhoto && checkinPhoto) {
            console.log("Mendeteksi wajah pada foto_registrasi dan foto_masuk...");

            // Dapatkan face descriptor untuk foto_registrasi
            const regisDescriptor = await getFaceDescriptorFromUrl(regisPhoto.src);
            if (!regisDescriptor) {
                console.log("Wajah tidak terdeteksi pada foto_registrasi.");
                statusCol.textContent = 'Face not detected';
                return;
            }

            // Dapatkan face descriptor untuk foto_masuk
            const checkinDescriptor = await getFaceDescriptorFromUrl(checkinPhoto.src);
            if (!checkinDescriptor) {
                console.log("Wajah tidak terdeteksi pada foto_masuk.");
                statusCol.textContent = 'Face not detected';
                return;
            }

            // Bandingkan deskriptor wajah
            const distance = faceapi.euclideanDistance(regisDescriptor, checkinDescriptor);
            console.log(`Jarak Euclidean: ${distance}`);

            // Perbarui kolom status


            statusCol.textContent = distance < 0.6 ? 'Match' : 'No Match';
        } else {
            console.log("Tidak ditemukan elemen gambar untuk foto_registrasi atau foto_masuk.");
        }
    });
 }


    $(document).ready(async () => {
      await loadModels();
        compareFaceDescriptors();
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