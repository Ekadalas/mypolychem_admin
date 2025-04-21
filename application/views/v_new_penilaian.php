<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('cover/header'); ?>
  <style>
    
 /* From Uiverse.io by abrahamcalsin */ 
.card-client {
  background: #3E3F5B;
  width: 13rem;
  padding-top: 15px;
  padding-bottom: 15px;
  padding-left: 10px;
  padding-right: 10px;
  border: 4px solid #7cdacc;
  box-shadow: 0 6px 10px rgba(207, 212, 222, 1);
  border-radius: 10px;
  text-align: center;
  color: #fff;
  font-family: "Poppins", sans-serif;
  transition: all 0.3s ease;
  /*margin: 10px;*/
}

.card-client:hover {
  transform: translateY(-10px);
}

.user-picture {
  overflow: hidden;
  object-fit: cover;
  width: 5rem;
  height: 5rem;
  border: 4px solid #7cdacc;
  border-radius: 999px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: auto;
}

.user-picture svg {
  width: 2.5rem;
  fill: currentColor;
}

.name-client {
  margin: 0;
  margin-top: 20px;
  font-weight: 600;
  font-size: 18px;
}

.name-client span {
  display: block;
  font-weight: 200;
  font-size: 16px;
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
                          Data Matrix Penilaian ppk 
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          MENU TAMBAH DATA PENILAI 
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
               	
                <button class="btn btn-info mb-3" onclick="history.back()"><- Kembali</button>
                <button class="btn btn-warning mb-3" id="addPenilai" name="addPenilai">Tambah <i class="far fa-plus-square"></i></button>
                <button class="btn btn-success mb-3" onclick="simpanSaja()">Simpan <i class="fas fa-save"></i></button>

              <div class="card">
                <div class="card-body">
                      <div id="penilaiContainer">
        <div class="penilai-set" data-set="1">
    <div class="row">
 <!--          <button class="removePenilai btn btn-danger"> - </button> -->
      <div class="col-lg-3">
        <div class="card-client">
          <div class="user-picture">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
              <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
            </svg>
          </div>
          <label>Nama Dinilai :</label>
          <p class="name-client">
       <select id="Dinilai_1" class="form-control select2" name="dinilai1">
         <option value="">Pilih Karyawan</option>
         <?php foreach ($nilai as $k) { ?>
         <option value="<?=$k['nip_btn'] .'|'. $k['name'] ?>"><?= $k['name']; ?></option>
         <?php } ?>
       </select>
            <span id="getdeep_1"></span>
          </p>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card-client">
          <div class="user-picture">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
              <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
            </svg>
          </div>
          <label>Nama Penilai 1 :</label>
          <p class="name-client">
        <select id="penilai1_1" class="form-control select2" name="p1">
         <option value="">Pilih Karyawan</option>
         
       </select>
            <span id="dept_penilai1_1"></span>
          </p>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card-client">
          <div class="user-picture">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
              <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
            </svg>
          </div>
          <label>Nama Penilai 2 :</label>
          <p class="name-client">
       <select id="penilai2_1" class="form-control select2" name="p2">
         <option value="">Pilih Karyawan</option>
         
       </select>
            <span id="dept_penilai2_1"></span>
          </p>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card-client">
          <div class="user-picture">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
              <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
            </svg>
          </div>
          <label>Nama Penilai 3 :</label>
          <p class="name-client">
        <select id="penilai3_1" class="form-control select2" name="p3">
         <option value="">Pilih Karyawan</option>
         
       </select>
            <span id="dept_penilai3_1"></span>
          </p>
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

      //  console.log('cek :', nama); 
        $.ajax({
          url: '<?= site_url("C_matrix_penilaian/getDepartemen"); ?>',
          type: 'POST',
          data: { nik_dinilai: nik },
          dataType: 'json',
          success: function(data) {
            if (data.departemen.length > 0) {
              var departemen = data.departemen[0].departemen;
              $('#getdeep_1').text(departemen); 

              // Panggil AJAX kedua untuk mendapatkan daftar karyawan
              $.ajax({
                url: '<?= site_url("C_matrix_penilaian/dptKaryawan"); ?>',
                type: 'POST',
                data: { departemen: departemen }, 
                dataType: 'json',
                success: function(response) {
                  $('#penilai1_1, #penilai2_1, #penilai3_1').empty().append('<option value="">Pilih Karyawan</option>'); 

                  if (response.namaDin.length > 0) {
                    $.each(response.namaDin, function(index, item) {
                      $('#penilai1_1, #penilai2_1, #penilai3_1').append('<option value="' + item.nik_dinilai + '|' + item.nama_dinilai + '">' + item.nama_dinilai + '</option>');
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
          url : '<?= site_url('C_matrix_penilaian/getDepartemen');  ?>', 
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
      <button class="removePenilai btn btn-danger"><i class="fas fa-minus"></i> </button>
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-3">
              <div class="card-client">
              <div class="user-picture">
               <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
                </svg>
                </div>
                <label>Nama Dinilai:</label>
                <p class="name-client">
                  <select id="Dinilai_${count}" class="form-control select2 dinilai" name="dinilai${count}">
                    <option value="">Pilih Karyawan</option>
                    <?php foreach ($nilai as $k) { ?>
                      <option value="<?= $k['nip_btn'] . '|' . $k['name'] ?>"><?= $k['name'] ?></option>
                    <?php } ?>
                  </select>
                  <span id="getdeep_${count}"></span>
                </p>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card-client">
              <div class="user-picture">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
              <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
              </svg>
               </div>
                <label>Nama Penilai 1:</label>
                <p class="name-client">
                  <select id="penilai1_${count}" class="form-control select2 penilai" name="p1_${count}">
                    <option value="">Pilih Karyawan</option>
                  </select>
                  <span id="dept_penilai1_${count}"></span>
                </p>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card-client">
              <div class="user-picture">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
              <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
              </svg>
                </div>
                <label>Nama Penilai 2:</label>
                <p class="name-client">
                  <select id="penilai2_${count}" class="form-control select2 penilai" name="p2_${count}">
                    <option value="">Pilih Karyawan</option>
                  </select>
                  <span id="dept_penilai2_${count}"></span>
                </p>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="card-client">
              <div class="user-picture">
            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
              <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"></path>
               </svg>
               </div>
                <label>Nama Penilai 3:</label>
                <p class="name-client">
                  <select id="penilai3_${count}" class="form-control select2 penilai" name="p3_${count}">
                    <option value="">Pilih Karyawan</option>
                  </select>
                  <span id="dept_penilai3_${count}"></span>
                </p>
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
        url: '<?= site_url("C_matrix_penilaian/getDepartemen"); ?>',
        type: 'POST',
        data: { nik_dinilai: nik },
        dataType: 'json',
        success: function (data) {
          if (data.departemen.length > 0) {
            $('#getdeep_' + setId).text(data.departemen[0].departemen);

            //  AJAX untuk mendapatkan Karyawan berdasarkan Departemen
            $.ajax({
              url: '<?= site_url("C_matrix_penilaian/dptKaryawan"); ?>',
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
                      '<option value="' + item.nik_dinilai + '|' + item.nama_dinilai + '">' + item.nama_dinilai + '</option>'
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
          url : '<?= site_url("C_matrix_penilaian/getDepartemen"); ?>', 
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
    alert('Tidak ada data yang dipilih. Mohon isi setidaknya satu penilaian.');
    return;
  }

  // Kirim data ke controller dengan AJAX
  $.ajax({
    url: '<?= site_url("C_matrix_penilaian/simpanSave"); ?>',
    type: 'POST',
    data: { penilaiData: JSON.stringify(penilaiData) }, // Kirim sebagai JSON
    dataType: 'json',
    success: function (response) {
      if (response.status === 'success') {
        alert('Data berhasil disimpan!');
        console.log("data :", penilaiData);
        //location.reload(); // Refresh halaman setelah menyimpan (opsional)
        window.location.href = "<?= site_url('C_matrix_penilaian'); ?>";
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
              