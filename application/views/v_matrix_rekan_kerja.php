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
                          DATA SLS REKAN KERJA
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

<form method="post">


  
  <button type="submit" formaction="<?= site_url('C_matrix_sls_rekan_kerja/edit_rekan_kerja') ?>" class="btn btn-info">
    Tambah Penilai Rekan Kerja <i class="fas fa-plus"></i>
  </button>

<!--   
  <button type="submit" formaction="<?= site_url('C_matrix_sls_rekan_kerja/delete_multiple') ?>" 
  class="btn btn-danger">
  Hapus<i class="fas fa-trash"></i>
  </button> -->

  <!-- tombol hapus -->
<button type="button" id="btn-delete" class="btn btn-danger">
  Hapus <i class="fas fa-trash"></i>
</button>

<!-- tombol Edit -->
<button type="button" id="btn-edit" class="btn btn-info">
  Edit <i class="fas fa-trash"></i>
</button>

 <div class="row my-4">
  <div class="col-md-12">
    <div class="card shadow">
         <div class="card border-left-info shadow py-3" style="min-height: auto;">
      <div class="card-body">

  <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
           
           <thead class="thead-light"  style="font-size: 12px;">
              <tr>
                <th></th>
                <th>NO</th>
                <th>PERIODE</th>
                <th>CODE ORG DINILAI</th>
                <th>CODE ORG PENILAI</th>

            </thead>
<tbody style="font-size: 12px; color: black;">
                             <?php
                              $no = 1;
                              foreach ($matrix_rekan_kerja as $rk) {
                                  // $id_rekan_kerja       = $rk['id'];
                                  $periode      = $rk['periode_sls'];
                                  $code_org_dinilai  = $rk['code_org_dinilai'];
      
                                  $code_org_penilai  = $rk['code_org_penilai'];
                              
                              ?>
                              <tr style="font-size:11px">

                                <!-- <td>
  <input type="checkbox" class="data-checkbox" name="input_id[]" value="<?= $code_org_dinilai; ?>">
    </td> -->
    <td><input type="checkbox" class="data-checkbox" value="<?= $code_org_dinilai; ?>"></td>

                                <td><?php echo $no++  ?></td>
                                <td><?php echo $periode ?></td>
                              
                                 <td>
                                <a href="javascript:void(0)" 
                                  class="detailOrg" 
                                  data-code="<?= $code_org_dinilai ?>">
                                  <?= $code_org_dinilai ?>
                                </a>
                                </td>

                            
                                <td>
                                <a href="javascript:void(0)" 
                                  class="detailPenilai" 
                                  data-code="<?= $code_org_penilai ?>">
                                  <?= $code_org_penilai ?>
                                </a>
                               </td>

                              </tr>
                              <?php } ?>
                            </tbody>


                          </table>




            </div>
            </form>
            <!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Nama Dinilai</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table table-striped" id="tableDetail">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- Modal Penilai -->
<div class="modal fade" id="modalPenilai" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Nama Penilai</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table table-striped" id="tablePenilai">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>



            </div>
         </div>
       </div>
    </div>
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

<script>
$(document).ready(function(){
    $(".detailOrg").on("click", function(){
        var code_org = $(this).data("code");

        $.ajax({
            url: "<?= site_url('C_matrix_sls_rekan_kerja/get_detail_org/') ?>" + code_org,
            type: "GET",
            dataType: "json",
            success: function(data){
                var rows = "";
                $.each(data, function(i, val){
                    rows += "<tr><td>"+val.nik_dinilai+"</td><td>"+val.nama_dinilai+"</td></tr>";
                });
                $("#tableDetail tbody").html(rows);
                $("#modalDetail").modal("show");
            }
        });
    });
});



// DETAIL PENILAI

// Detail Penilai
$(".detailPenilai").on("click", function(){
    var code_org = $(this).data("code");

    $.ajax({
        url: "<?= site_url('C_matrix_sls_rekan_kerja/get_detail_penilai/') ?>" + code_org,
        type: "GET",
        dataType: "json",
        success: function(data){
            var rows = "";
            $.each(data, function(i, val){
                rows += "<tr><td>"+val.nik_penilai+"</td><td>"+val.nama_penilai+"</td></tr>";
            });
            $("#tablePenilai tbody").html(rows);
            $("#modalPenilai").modal("show");
        }
    });
});





//hapus
$(document).ready(function() {
    $("#btn-delete").on("click", function() {
        let ids = [];
        $(".data-checkbox:checked").each(function() {
            ids.push($(this).val());
        });

        if (ids.length === 0) {
            alert("Pilih data yang mau dihapus!");
            return;
        }

        if (!confirm("Yakin hapus data terpilih?")) return;

        $.ajax({
            url: "<?= site_url('C_matrix_sls_rekan_kerja/delete_multiple') ?>",
            type: "POST",
            data: { input_id: ids },
            success: function(response) {
                try {
                    let res = JSON.parse(response);
                    alert(res.message);
                } catch(e) {
                    alert("Data terhapus!");
                }
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Terjadi error: " + error);
            }
        });
    });
});

$(document).ready(function () {
    $("#btn-edit").on("click", function () {
        let ids = [];
        $(".data-checkbox:checked").each(function () {
            ids.push($(this).val());
        });

        if (ids.length === 0) {
            alert("Pilih data yang mau diedit!");
            return;
        }

        // Buat form dinamis
        let form = $('<form>', {
            action: "<?= site_url('C_matrix_sls_rekan_kerja/edit_multiple_rekan_kerja') ?>",
            method: 'POST'
        });

        // Tambahkan input hidden satu-satu
        ids.forEach(function (id) {
            form.append($('<input>', {
                type: 'hidden',
                name: 'input_id[]', // array
                value: id
            }));
        });

        $('body').append(form);
        form.submit();
    });
});

</script>
</body>
<?php $this->load->view('cover/footer')?>
</html>
