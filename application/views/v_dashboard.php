<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="en">

<head>

<?php $this->load->view('cover/header'); ?>
 <style >
    .fs-responsive {
                                        
        font-size: 14px; /* Default size for desktop */
    }

    @media (max-width: 1024px) {
        /* Tablet */
        .fs-responsive {
            font-size: 14px;
        }
    }

    @media (max-width: 768px) {
        /* Small tablets and large phones */
        .fs-responsive {
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        /* Mobile phones */
        .fs-responsive {
            font-size: 10px;
        }
    }
                                    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<?php $this->load->view('cover/sidebar'); ?>
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

<?php $this->load->view('cover/topbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                        <!-- Page Heading -->
                <div class="col-xl-12 col-md-12 mb-5">
                <div class="card border-left-info shadow py-3" style="min-height: auto; background-color: #10375C">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase">
                          <div class="marquee-container">
                          <div class="marquee ">
                          <span>Selamat Datang!</span>
                          </div>
                        </div>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white">
                          DASHBOARD MYPOLYCHEM
                        </div>
                      </div>
                      <div class="col-auto">
                        <img style="width: 100px; height: 50px;" src="<?php echo base_url('assets/img/dash.svg')?>" >
                        <!-- <i class="fas fa-tv fa-2x " style="color: #74C0FC;"></i> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
<!--
                 
 <?php 
             
// Mendapatkan nama bulan saat ini dalam bahasa Indonesia
$bulanIndonesia = [
    1 => 'JANUARI',
    2 => 'FEBRUARI',
    3 => 'MARET',
    4 => 'APRIL',
    5 => 'MEI',
    6 => 'JUNI',
    7 => 'JULI',
    8 => 'AGUSTUS',
    9 => 'SEPTEMBER',
    10 => 'OKTOBER',
    11 => 'NOVEMBER',
    12 => 'DESEMBER'
];

$mo = $bulanIndonesia[date('n')]; // 'n' untuk mendapatkan angka bulan tanpa leading zero
$to = date('Y'); // 'Y' untuk mendapatkan tahun 4 digit
?>


                    <div class="row">

                        
                        <div class="col-xl-8 col-lg-7">

                          <div class="d-flex flex-column" style="height: 90%;  margin: auto; padding: 1px;" >                                
                         <div class="card border-left-dark py-1 d-flex flex-column align-items-start" style="min-height: 15%; border-bottom: 2px solid #ddd;">
                           <div class="card-body d-flex flex-column justify-content-between">
                             <p style=" color: #10375C;" class=" font-weight-bold fs-responsive">PENGAJUAN CUTI PER-<strong><?php echo $mo; ?> <?php echo $to; ?></strong></p>
                            
                          </div>
                        </div>

                            <div class="card shadow mb-4 d-flex flex-column" style="flex: 1; margin-top: 10px;">
                              
                                <div class="card-body d-flex flex-column">


                                    <div class="chart-area" >
                                        <canvas id="myBarbarchart" width="400" height="200"></canvas>
<?php 
        
        // Mendeklarasikan variabel untuk menyimpan total data masing-masing status
        $total_approve = 0;
        $total_register = 0;
        $total_in_hrms = 0;
        $total_no_hrms = 0;

        // Memproses hasil query
        foreach ($data as $k) {
            if ($k['status_group'] == 'Approve') {
                $total_approve = $k['total_status'];
            } else {
                $total_register = $k['total_status'];
            }
            
            if ($k['hrms_group'] == 'IN HRMS') {
                $total_in_hrms = $k['total_hrms'];
            } else {
                $total_no_hrms = $k['total_hrms'];
            }
        }
?>
                                       
     <script>
    // Mendapatkan elemen canvas dengan id 'myChart'
   const xtx = document.getElementById('myBarbarchart').getContext('2d');
const cuti = [
    <?php echo $total_approve ?? 0; ?>,
    <?php echo $total_register ?? 0; ?>,
    <?php echo $total_in_hrms ?? 0; ?>
];

// Jika semua nilai dalam array `cuti` adalah 0
if (cuti.every(value => value === 0)) {
    // Tampilkan teks 'Maaf data tidak ada'
    xtx.clearRect(0, 0, xtx.canvas.width, xtx.canvas.height); // Bersihkan canvas
    xtx.font = '16px Arial';
    xtx.textAlign = 'center';
    xtx.fillStyle = '#000'; // Warna teks
    xtx.fillText('Maaf data tidak ada', xtx.canvas.width / 2, xtx.canvas.height / 2);
} else {
    // Membuat Grafik dengan Chart.js
    const myBarbarchart = new Chart(xtx, {
        type: 'bar', // Tipe 'bar'
        data: {
            labels: ['Sudah Approve', 'Belum Approve', 'Integrasi HRMS'],
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: cuti,
                backgroundColor: 'rgba(61, 64, 91, 0.2)',
                borderColor: 'rgba(61, 64, 91, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive : true,
            maintainAspectRatio : false,
            indexAxis: 'y', // Membuat grafik horizontal
            scales: {
                x: {
                    beginAtZero: true // Mulai grafik dari 0
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var value = tooltipItem.raw; // Data nilai
                            return value === 0 ? 'Tidak ada data' : value;
                        }
                    }
                }
            }
        }
    });
}

  </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
 
                      

                       
                        <div class="col-xl-4 col-lg-5">
                           <div class="d-flex flex-column" style="height: 90%;  margin: auto; padding: 2px;" >
                           <div class="card border-left-dark py-1 d-flex flex-column align-items-start" style="min-height: 15%; border-bottom: 2px solid #ddd;">
                           <div class="card-body d-flex flex-column justify-content-between">
                               
                                    <p style=" color: #10375C;" class="m-0 font-weight-bold fs-responsive">GRAFIK DATA KEHADIRAN PER-<strong><?php echo $mo;?> <?php echo $to; ?></strong> </p>
                                   
                                </div>
                                </div>
                            <div class="card shadow mb-4 d-flex flex-column" style="flex: 1; margin-top: 10px;">
                             
                                <div class="card-body  d-flex flex-column">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPiepiechart"></canvas>

                                        <?php 

                                        $cuti = 0;
                                        $masuk = 0;
                                        $izin = 0;
                                        $alfa = 0;

                                        foreach ($hadir as $k) {
                                          if ($k['kategori'] == 'Kehadiran' ) {
                                              $masuk = $k['jumlah'];
                                          } elseif ($k['kategori'] == 'Cuti') {
                                              $cuti  = $k['jumlah'];
                                          } elseif ($k['kategori'] == 'Izin') {
                                              $izin  = $k['jumlah'];
                                          } elseif ($k['kategori'] == 'Alfa') {
                                              $alfa  = $k['jumlah'];
                                          } else {
                                              echo "kosong";
                                          }

                                        }
                                        ?>
                                        <script>
                                          
                                      var ctx = document.getElementById("myPiepiechart").getContext('2d');
                                      var dataPHP = [
                                          <?php echo $masuk ?? 0; ?>, 
                                          <?php echo $izin ?? 0; ?>, 
                                          <?php echo $cuti ?? 0; ?>, 
                                          <?php echo $alfa ?? 0; ?>
                                      ];

                                      if (dataPHP.every(value => value === 0)) {
                                          // Data kosong, tampilkan pesan
                                          ctx.font = '16px Arial';
                                          ctx.textAlign = 'center';
                                          ctx.fillText('Tidak ada data untuk ditampilkan', ctx.canvas.width / 2, ctx.canvas.height / 2);
                                      } else {
                                          // Data tersedia, buat chart
                                          var myPieChart = new Chart(ctx, {
                                              type: 'doughnut',
                                              data: {
                                                  labels: ["Masuk", "Izin", "Cuti", "Alfa"],
                                                  datasets: [{
                                                      data: dataPHP,
                                                      backgroundColor: ['#4e73df', '#1cc88a', '#10375C', '#36b9cc'],
                                                      hoverBackgroundColor: ['#2e59d9', '#17a673', '#fff', '#2c9faf'],
                                                      hoverBorderColor: "rgba(234, 236, 244, 1)",
                                                  }],
                                              },
                                              options: {
                                                  maintainAspectRatio: false,
                                                  responsive: true,
                                                  tooltips: {
                                                      callbacks: {
                                                          label: function(tooltipItem, data) {
                                                              var value = data.datasets[0].data[tooltipItem.index];
                                                              return value === 0 ? 'Tidak ada data' : value;
                                                          }
                                                      }
                                                  },
                                                  legend: {
                                                      display: false
                                                  },
                                                  cutoutPercentage: 80,
                                              },
                                               scales: {
                                                     x: {
                                                          beginAtZero: true // Mulai grafik dari 0
                                                        }
                                                      }
                                              });
                                            }
                                        </script>

                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Masuk : <?php echo $masuk; ?>
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Izin : <?php echo $izin; ?>
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-dark"></i> Cuti : <?php echo $cuti; ?>
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Alfa : <?php echo $alfa; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div> 

                
                   <div class="row">

                        <div class="col-lg-12 mb-4">

                             <div class="d-flex flex-column" style="height: 90%;  margin: auto; padding: 2px;" >
                           <div class="card border-left-dark py-1 d-flex flex-column align-items-start" style="min-height: 15%; border-bottom: 2px solid #ddd;">
                           <div class="card-body d-flex flex-column justify-content-between">
                             <p style=" color: #10375C;" class="m-0 font-weight-bold fs-responsive">PENGAJUAN IZIN PER-<strong><?php echo $mo; ?> <?php echo $to; ?></strong></p>
                            
                          </div>
                        </div>
                            <div class="card shadow mb-4 d-flex flex-column" style="flex: 1; margin-top: 10px;">
                         
                         
                                     
                                   
                                    
                                   <div class="row">
                                    <div class="col-lg-8">
                                    
                                        <div class="card-body ">
                                            <div class="chart-area">
                                                <canvas id="izinChart" width="400" height="200" ></canvas>

                                                <?php 

                                                $inHrms = 0;
                                                $noHrms = 0;

                                                foreach ($perizinan as $k) {
                                                    if ($k['hrms_group'] == 'IN HRMS') {
                                                        $inHrms = $k['total_hrms'];
                                                    } elseif ($k['hrms_group'] == 'NO HRMS') {
                                                        $noHrms = $k['jumlah_hrms'];
                                                    } 

                                                    $jmlh_izin = $k['data'];
                                                }

                                                ?>

                                                <script>
                                            // Mendapatkan elemen canvas dengan id 'myChart'
                                            const ftx = document.getElementById('izinChart').getContext('2d');
                                            const izin = [
                                            <?php echo $jmlh_izin ?? 0; ?>,
                                            <?php echo $inHrms ?? 0; ?>,
                                            <?php echo $noHrms ?? 0;?>
                                            ];

                                            if (izin.every(value => value === 0)) {
                                              ftx.font = '16px Arial';
                                              ftx.textAlign = 'center';
                                              ftx.fillText('Maaf data tidak tersedia', ftx.canvas.width / 2, ftx.canvas.height / 2);
                                            } else {
                                            // Membuat Grafik dengan Chart.js
                                            const izinChart = new Chart(ftx, {
                                              type: 'bar', // Masih menggunakan tipe 'bar'
                                              data: {
                                                labels: ['DATA','INTEGERASI HRMS', 'NO HRMS'],
                                                datasets: [{
                                                  label: 'Jumlah Pengajuan',
                                                  data: izin,
                                                  backgroundColor: 'rgba(61, 64, 91, 0.2)',
                                                  borderColor: 'rgba(61, 64, 91, 1)',
                                                  borderWidth: 1
                                                }]
                                              },
                                              options: {
                                                responsive : true, 
                                                maintainAspectRatio : false,
                                                indexAxis: 'y', // Menjadikan grafik horizontal
                                                scales: {
                                                  x: {
                                                    beginAtZero: true
                                                  }
                                                },
                                                tooltips : {
                                                  callbacks : {
                                                    label: function(tooltipItem, data) {
                                                        var value = data.datasets[0].data[tooltipItem.index];
                                                        return value === 0 ? 'Tidak ada data' : value;
                                                    }
                                                  }
                                                }
                                              }
                                            });
                                          }
                                          </script>


                                            </div>
                                        </div>
                                       
                                    </div>

                                    <div class="col-lg-4 " style="margin-top: auto; margin-bottom: 0%; height: 100%;">
                                      <div class="card-body d-flex flex-column justify-content-end">
                                         <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="<?php echo base_url('assets/img/izin_3.svg')?>" alt="...">
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
                <!-/.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; MYPOLYCHEM 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin keluar ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"> Pilih Logout untuk meninggalkan laman ini, atau pilih cancel untuk tetap disini.</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo site_url('C_login/outlog') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

   
   <?php $this->load->view('cover/footer'); ?>

</body>

</html>