<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('cover/header'); ?>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.19.1/dist/sweetalert2.all.min.js"></script>
  <style>
    /* From Uiverse.io by andrew-demchenk0 */ 
/* before adding the photo to the div with the "card-photo" class, in the css clear the styles for .card-photo and remove .card-photo::before and .card-photo::after, then set the desired styles for .card- photo. */

.card-new {
  --font-color: #001F3F;
  --font-color-sub: #001F3F;
  --bg-color: #fff;
  --main-color: #001F3F;
  width: 200px;
  height: 280px;
  background: var(--bg-color);
  border: 2px solid var(--main-color);
  box-shadow: 4px 4px var(--main-color);
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 15px;
  box-sizing: border-box;
  position: relative;
  overflow: hidden;
}

.card-photo {
  width: 120px;
  height: 120px;
  background: url(<?= base_url('assets/img/employ.png'); ?>) center/cover no-repeat;
  background-color: #ccc;
  border-radius: 50%;
  margin-top: 10px;
  transition: transform 0.3s;
}

.card-title {
  text-align: center;
  color: var(--font-color);
  font-size: 20px;
  font-weight: 400;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.card-title span {
  font-size: 15px;
  color: var(--font-color-sub);
}

.card-socials {
  display: flex;
  height: 0;
  opacity: 0;
  margin-top: 20px;
  gap: 20px;
  transition: 0.5s;
}

.card-socials-btn {
  width: 25px;
  height: 25px;
  border: none;
  background: transparent;
  cursor: pointer;
}

.card-socials-btn svg {
  width: 100%;
  height: 100%;
  fill: var(--main-color);
}

.card-new:hover > .card-socials {
  opacity: 1;
  height: 35px;
}

.card-socials-btn:hover {
  transform: translateY(-5px);
  transition: all 0.15s;
}

.card-photo:hover {
  transition: 0.3s;
  /*transform: scale(0.4) translate(160px, 150px);*/
}
  </style>
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
                          Data Matrix Sls 
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          MENU TAMBAH DATA PENILAI SLS
                        </div>
                      </div>
                      <div class="col-auto">
                        <img style="width: 100px; height: 60px;" src="<?php echo base_url('assets/img/addMatriks.svg')?>">
                        <!-- <i class="fas fa-calendar-check fa-3x " style="color: #74C0FC;"></i> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                
                <button class="btn btn-info  mb-3" onclick="history.back()">
                  <span class="icon text-white-50">
                     <i class="fas fa-arrow-left"></i>
                  </span>Kembali</button>
                <button class="btn btn-warning mb-3" id="addPenilai" name="addPenilai">Tambah 
                  <span class="icon text-white-80">
                    <i class="far fa-plus-square"></i>
                  </span></button>
                <button class="btn btn-success mb-3" onclick="simpanSaja()">Simpan 
                  <span class="icon text-white-80">
                    <i class="fas fa-save"></i></span></button>

              <div class="card">
                <div class="card-body">
                      <div id="penilaiContainer">
        <div class="penilai-set" data-set="1">
    <div class="row">
 <!--          <button class="removePenilai btn btn-danger"> - </button> -->
<div class="col-lg-3">
<div class="card-new">
    <div class="card-photo"></div>
    <div class="card-title"><p style="color: #111; margin-bottom: 5px; margin-top: 20px; font-size: 15px;">Nama Dinilai</p>
      <select id="Dinilai_1" class="form-control select2" name="dinilai1">
         <option value="">Pilih Karyawan </option>
         <?php foreach ($nilai as $k) { ?>
         <option value="<?=$k['nip_btn'] .'|'. $k['name'] ?>"><?= $k['name']; ?></option>
         <?php } ?>
       </select> <br>
        <span id="getdeep_1"></span>
    </div>
    <div class="card-sosials">
      
    </div>
</div>
</div>
<div class="col-lg-3">
<div class="card-new">
    <div class="card-photo"></div>
    <div class="card-title"><p style="color: #111; margin-bottom: 5px; margin-top: 20px; font-size: 15px;">Nama Penilai 1 :</p>
       <select id="penilai1_1" class="form-control select2" name="p1">
         <option value="">Pilih Karyawan</option>
       </select><br>
        <span id="dept_penilai1_1"></span>
    </div>
    <div class="card-sosials">  
      
    </div>
</div>
</div>
<div class="col-lg-3">
<div class="card-new">
    <div class="card-photo"></div>
    <div class="card-title"><p style="color: #111; margin-bottom: 5px; margin-top: 20px; font-size: 15px;">Nama Penilai 2 :</p>
        <select id="penilai2_1" class="form-control select2" name="p2">
         <option value="">Pilih Karyawan</option>
       </select><br>
        <span id="dept_penilai2_1"></span>
    </div>
    <div class="card-sosials">
      
    </div>
</div>
</div>
<div class="col-lg-3">
<div class="card-new">
    <div class="card-photo"></div>
    <div class="card-title"><p style="color: #111; margin-bottom: 5px; margin-top: 20px; font-size: 15px;">Nama Penilai 3 :</p>
      <select id="penilai3_1" class="form-control select2" name="p3">
         <option value="">Pilih Karyawan</option>
       </select><br>
        <span id="dept_penilai3_1"></span>
        <div class="card-sosials">
          
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
  <script>
  $(document).ready(function() {
    $('#Dinilai_1').on('change', function() {
      var namaDinilai = $(this).val();  

      if (namaDinilai) {
        var spliData = namaDinilai.split('|'); 
        var nama = spliData[1]; 
        var nik = spliData[0]; 

        console.log('cek :', nik); 
        $.ajax({
          url: '<?= site_url("C_matrix_penilaian_sls/getDepartemen"); ?>',
          type: 'POST',
          data: { nik_dinilai: nik },
          dataType: 'json',
          success: function(data) {
            if (data.departemen.length > 0) {
              var departemen = data.departemen[0].departemen;
              $('#getdeep_1').text(departemen); 
              console.log('departemen : ', departemen); 
              // Panggil AJAX kedua untuk mendapatkan daftar karyawan
              $.ajax({
                url: '<?= site_url("C_matrix_penilaian_sls/dptKaryawan"); ?>',
                type: 'POST',
                data: { departemen: departemen }, 
                dataType: 'json',
                success: function(response) {
                  $('#penilai1_1, #penilai2_1, #penilai3_1').empty().append('<option value="">Pilih Karyawan</option>'); 

                  if (response.namaDin.length > 0) {
                    $.each(response.namaDin, function(index, item) {
                      $('#penilai1_1, #penilai2_1, #penilai3_1').append('<option value="' + item.nip_btn + '|' + item.name + '">' + item.name + '</option>');
                    });
                  }
                  $('#penilai1_1, #penilai2_1, penilai3_1').select2(); 
                }
              });

            } else {
              $('#getdeep_1').text('Departemen tidak ditemukan');
              $('#penilai1_1, #penilai2_1, #penilai3_1').empty().append('<option value="">Pilih Karyawan</option>');
            }
          }
        });
      } else {
        $('#getdeep_1').text('');
        $('#penilai1_1, #penilai2_1, #penilai3_1').empty().append('<option value="">Pilih Karyawan</option>');
      }
    });

    $('#penilai1_1, #penilai2_1, #penilai3_1').on('change', function(){
      var penilaiID = $(this).attr('id'); 
      var namaPenilai = $(this).val(); 



      if (namaPenilai) {

        var pisahData = namaPenilai.split('|');
        var nikP      = pisahData[0]; 
        var namaP     = pisahData[1];

       
        $.ajax({
          url : '<?= site_url('C_matrix_penilaian_sls/getDepartemen');  ?>', 
          type : 'POST', 
          data : {nik_dinilai : nikP}, 
          dataType : 'json', 
          success : function(data) {
            if (data.departemen.length > 0) {
              var departemen = data.departemen[0].departemen;
              $('#dept_' + penilaiID).text(departemen);
            } 
          }          
        });
      } else {
        $('#dept_' + penilaiID).text('-');
      }
        removeDuplicateOptions(); 

    });

      function removeDuplicateOptions() {
        var selectedValue = []; 

        $('#penilai1_1, #penilai2_1, #penilai3_1').each(function() {
          var val = $(this).val(); 
          if (val) selectedValue.push(val);
        });

        $('#penilai1_1, #penilai2_1, #penilai3_1').each(function() {
          var currentSelect = $(this);
          var penilaiSet  = $(this).closest('.penilai-set');
          currentSelect.find('option').each(function() {
            if (selectedValue.includes($(this).val()) && $(this).val() !== currentSelect.val()) {
              $(this).remove(); 
            }
            penilaiSet.prev('hr').remove(); 
          });
        });
        
      }
  });

$(document).ready(function () {
  var count = 1; // Nomor urut set kartu

  // Tambah Set Penilai
  $('#addPenilai').click(function () {
    count++;
    var newSet = `
    <hr class="garis">
    <div class="penilai-set" data-set="${count}">
      <button class="removePenilai btn btn-danger"><i class="fas fa-minus"></i></button><br><br>
      
        <div class="card-body">
          <div class="row">
            <div class="col-lg-3">
<div class="card-new">
    <div class="card-photo"></div>
    <div class="card-title"><p style="color: #111; margin-bottom: 5px; margin-top: 20px; font-size: 15px;">Nama Dinilai</p>
      <select id="Dinilai_${count}" class="form-control select2 dinilai" name="dinilai${count}">
         <option value="">Pilih Karyawan</option>
         <?php foreach ($nilai as $k) { ?>
         <option value="<?=$k['nip_btn'] .'|'. $k['name'] ?>"><?= $k['name']; ?></option>
         <?php } ?>
       </select> <br>
        <span id="getdeep_${count}"></span>
    </div>
    <div class="card-sosials">
      
    </div>
</div>
</div>
<div class="col-lg-3">
<div class="card-new">
    <div class="card-photo"></div>
    <div class="card-title"><p style="color: #111; margin-bottom: 5px; margin-top: 20px; font-size: 15px;">Nama Penilai 1 :</p>
       <select id="penilai1_${count}" class="form-control select2 penilai" name="p1_${count}">
         <option value="">Pilih Karyawan</option>
       </select><br>
        <span id="dept_penilai1_${count}"></span>
    </div>
    <div class="card-sosials">
      
    </div>
</div>
</div>
<div class="col-lg-3">
<div class="card-new">
    <div class="card-photo"></div>
    <div class="card-title"><p style="color: #111; margin-bottom: 5px; margin-top: 20px; font-size: 15px;">Nama Penilai 2 :</p>
        <select id="penilai2_${count}" class="form-control select2 penilai" name="p2_${count}">
         <option value="">Pilih Karyawan</option>
       </select><br>
        <span id="dept_penilai2_${count}"></span>
    </div>
    <div class="card-sosials">
      
    </div>
</div>
</div>
<div class="col-lg-3">
<div class="card-new">
    <div class="card-photo"></div>
    <div class="card-title"><p style="color: #111; margin-bottom: 5px; margin-top: 20px; font-size: 15px;">Nama Penilai 3 :</p>
      <select id="penilai3_${count}" class="form-control select2 penilai" name="p3_${count}">
         <option value="">Pilih Karyawan</option>
       </select><br>
        <span id="dept_penilai3_${count}"></span>
        <div class="card-sosials">
          
        </div>
    </div>
</div>
</div>
          </div>
        </div>
      
    </div>`;

    $('#penilaiContainer').append(newSet);
    $('.select2').select2(); // Re-inisialisasi Select2 setelah elemen baru ditambahkan
  });

  // Event Delegation: Menghapus Set Penilai
  $(document).on('click', '.removePenilai', function () {
    $(this).closest('.penilai-set').remove();
  });

  //  Event Delegation: Handle perubahan di "Nama Dinilai" untuk mencari Departemen & Karyawan
  $(document).on('change', '.dinilai', function () {
    var setId = $(this).attr('id').split('_')[1]; // Ambil nomor urut
    var selectedValue = $(this).val();

    if (selectedValue) {
      var splitData = selectedValue.split('|'); // Pisahkan NIK & Nama
      var nik = splitData[0];

      //  AJAX untuk mendapatkan Departemen
      $.ajax({
        url: '<?= site_url("C_matrix_penilaian_sls/getDepartemen"); ?>',
        type: 'POST',
        data: { nik_dinilai: nik },
        dataType: 'json',
        success: function (data) {
          if (data.departemen.length > 0) {
            $('#getdeep_' + setId).text(data.departemen[0].departemen);

            //  AJAX untuk mendapatkan Karyawan berdasarkan Departemen
            $.ajax({
              url: '<?= site_url("C_matrix_penilaian_sls/dptKaryawan"); ?>',
              type: 'POST',
              data: { departemen: data.departemen[0].departemen },
              dataType: 'json',
              success: function (response) {
                $('#penilai1_' + setId + ', #penilai2_' + setId + ', #penilai3_' + setId)
                  .empty()
                  .append('<option value="">Pilih Karyawan</option>');

                if (response.namaDin.length > 0) {
                  $.each(response.namaDin, function (index, item) {
                    $('#penilai1_' + setId + ', #penilai2_' + setId + ', #penilai3_' + setId).append(
                      '<option value="' + item.nip_btn + '|' + item.name + '">' + item.name + '</option>'
                    );
                  });
                }

                //  Re-inisialisasi Select2 setelah opsi baru ditambahkan
                $('#penilai1_' + setId + ', #penilai2_' + setId + ', #penilai3_' + setId).select2();
              }
            });
          } else {
            $('#getdeep_' + setId).text('Departemen tidak ditemukan');
          }
        }
      });
    } else {
      $('#getdeep_' + setId).text('');
    }
    });

    $(document).on('change', '.penilai', function() {
      var ableID = $(this).attr('id');
      var pilihAbsle = $(this).val();

      if (pilihAbsle) {
        var dataSplit = pilihAbsle.split('|'); 
        var nikD      = dataSplit[0]; 

        console.log('Cek NIK Penilai: ', nikD);

        $.ajax({
          url : '<?= site_url("C_matrix_penilaian_sls/getDepartemen"); ?>', 
          type : 'POST', 
          data : { nik_dinilai : nikD }, 
          dataType : 'json', 
          success : function(data) {
            if (data.departemen.length > 0 ) {
              var departemen = data.departemen[0].departemen; 
              $('#dept_' + ableID).text(departemen); //  Perbaikan ID
            } else {
              $('#dept_' + ableID).text('Departemen tidak ditemukan'); 
            }
          },
          error: function(xhr, status, error) {
            console.error("Error: " + error);
            $('#dept_' + ableID).text('Gagal mengambil departemen'); 
          }
        });
      } else {
        $('#dept_' + ableID).text(''); 
      }
    });


  });

function simpanSaja() {
  var penilaiData = [];

  // Loop semua set kartu yang ada
  $('.penilai-set').each(function () {
    var setId = $(this).attr('data-set'); // Ambil ID unik untuk setiap set kartu

console.log(setId);

    var dinilaiVal = $('#Dinilai_' + setId).val();
    var penilai1Val = $('#penilai1_' + setId).val();
    var penilai2Val = $('#penilai2_' + setId).val();
    var penilai3Val = $('#penilai3_' + setId).val();

    var dinilai = dinilaiVal ? dinilaiVal.split('|')[1] : null;
    var nik_dinilai = dinilaiVal ? dinilaiVal.split('|')[0] : null;
    var penilai1 = penilai1Val ? penilai1Val.split('|')[1] : null; 
    var nik_penilai1 = penilai1Val ? penilai1Val.split('|')[0] : null; 
    var penilai2  = penilai2Val ? penilai2Val.split('|')[1] : null; 
    var nik_penilai2 = penilai2Val ? penilai2Val.split('|')[0] : null; 
    var penilai3 = penilai3Val ? penilai3Val.split('|')[1] : null; 
    var nik_penilai3 = penilai3Val ? penilai3Val.split('|')[0] : null;

    // Hanya tambahkan data yang tidak kosong
    if (dinilai && (penilai1 || penilai2 || penilai3)) {
      penilaiData.push({
        dinilai     : dinilai,
        nik_dinilai : nik_dinilai, 
        penilai1    : penilai1,
        nik_penilai1 : nik_penilai1, 
        penilai2     : penilai2,
        nik_penilai2 : nik_penilai2, 
        penilai3     : penilai3, 
        nik_penilai3 : nik_penilai3
      });
    }
  });

  console.log(penilaiData);
  if (penilaiData.length === 0) {
    // alert('Tidak ada data yang dipilih. Mohon isi setidaknya satu penilaian.');
    Swal.fire({
      title : "Info!", 
      text  : "tidak ada data yang dipilih, Mohon isi setidaknya satu penilaian", 
      icon  : "info"
    }); 
    return;
  }

  // Kirim data ke controller dengan AJAX
  $.ajax({
    url: '<?= site_url("C_matrix_penilaian_sls/simpanSave"); ?>',
    type: 'POST',
    data: { penilaiData: JSON.stringify(penilaiData) }, // Kirim sebagai JSON
    dataType: 'json',
    success: function (response) {
      if (response.status === 'success') {
        // alert('Data berhasil disimpan!');
        Swal.fire({
          title : "Sukses!", 
          text  : "Data berhasil disimpan", 
          icon  : "success"
        }); 
        console.log("data :", penilaiData);
        //location.reload(); // Refresh halaman setelah menyimpan (opsional)
        window.location.href = "<?= site_url('C_matrix_penilaian_sls'); ?>";
      } else {
        alert('Gagal menyimpan data.');
      }
    },
    error: function () {
      alert('Terjadi kesalahan saat menyimpan data.');
    }
  });
}
</script>
<script>
$(document).ready(function(){
  $('.select2').select2()
});
</script>


</body>
<?php $this->load->view('cover/footer'); ?>
</html>
              