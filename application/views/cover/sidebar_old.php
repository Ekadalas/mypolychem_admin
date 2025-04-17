 <!-- Sidebar -->
<style type="text/css">
    .logo-wrapper {
    width: 50px; /* Sesuaikan dengan ukuran background bundar */
    height: 50px;
    background-color: #fff; /* Sesuaikan dengan warna logo */
    border-radius: 50%; /* Membuat background menjadi bulat */
    display: flex;
    justify-content: center;
    align-items: center;
}

.logo {
    width: 50px;
    height: 50px;
    border-radius: 50%; /* Membuat gambar logo juga menjadi bulat */
}

.custom-sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    top: 0; 
    left: 0;
    background-color: #10375C;
    color: white;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.custom-sidebar ul {
    list-style-type: none;
    padding: 0;
}

.custom-sidebar .menu-item {
    padding: 1px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Gaya untuk menu yang aktif */
.custom-sidebar .menu-item.active {
    background-color: #1C5D88; /* Warna menu aktif */
    color: #ffffff;
    font-weight: bold;
    box-shadow: inset 1px 0 0 #FFB100; /* Highlight di sebelah kiri */
}
.custom-sidebar .menu-item span {
   
    font-weight: bold; /* Tambahan, jika ingin teks lebih tebal */
    color: inherit; /* Mengikuti warna font induk */
}


</style>

      
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <div class="custom-sidebar">
            <!-- Sidebar - Brand -->
       
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url('C_dashboard')?>">
                <div class="sidebar-brand-icon">
                    <div class="logo-wrapper">
                   <img class="logo" src="<?php echo base_url('assets/img/kecil.jpg')?>">
                    </div>
                </div>
                <div class="sidebar-brand-text mx-3">MyPolychem </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item  menu-item" id="dashboard" onclick="activateMenu(this)">
                <a class="nav-link" href="<?php echo site_url('C_dashboard')?>">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data Harian
            </div>


            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item menu-item" id="absen" onclick="activateMenu(this)">
                <a class="nav-link" href="" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo" >
                   <i class="fas fa-fw fa-user-check"></i>
                    <span>Periode Absen</span></a>
                     <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kustomisasi Data:</h6>
                        <a class="collapse-item" href="<?php echo site_url('C_absen')?>">Absensi Harian</a>
                        <!-- <a class="collapse-item" href="<?php echo site_url('C_absen/tambahAbsen')?>"> Menu Tambah Data </a> -->
                       
                    </div>
                </div>
            </li>
            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data Pendukung
            </div>

             <li class="nav-item  menu-item" id="cuti" onclick="activateMenu(this)">
                <a class="nav-link" href="<?php echo site_url('C_cuti')?>">
                    <i class="fas fa-fw fa-calendar-check"></i>
                    <span>Data Pengajuan Cuti</span></a>
            </li>


            <!-- Nav Item - Charts -->
            <li class="nav-item menu-item" id="izin" onclick="activateMenu(this)">
                <a class="nav-link" href="<?php echo site_url('C_izin')?>">
                    <i class="fas fa-fw fa-file-signature"></i>
                    <span>Data Pengajuan Izin</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item menu-item" id="matriks" onclick="activateMenu(this)">
                <a class="nav-link" href="<?php echo site_url('C_matriks')?>">
                    <i class="fas fa-fw fa-check-double"></i>
                    <span>Matriks Approval</span></a>
            </li>

             <li class="nav-item menu-item" id="lokasi" onclick="activateMenu(this)">
                <a class="nav-link" href="<?php echo site_url('C_lokasi')?>">
                    <i class="fas fa-fw fa-map-marked-alt"></i>
                    <span>Lokasi Koordinat</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

           
         </div>
        </ul>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Memeriksa menu aktif di localStorage
    const activeMenuId = localStorage.getItem("activeMenu");

    if (activeMenuId) {
        const activeMenuItem = document.getElementById(activeMenuId);
        if (activeMenuItem) {
            activeMenuItem.classList.add("active");
        }
    }
});

function activateMenu(selectedMenu) {
    // Menghapus kelas .active dari semua menu
    const menuItems = document.querySelectorAll('.custom-sidebar .menu-item');
    menuItems.forEach(item => item.classList.remove('active'));

    // Menambahkan kelas .active ke menu yang diklik
    selectedMenu.classList.add('active');

    // Menyimpan ID menu aktif ke localStorage
    localStorage.setItem("activeMenu", selectedMenu.id);
}

</script>
   
        <!-- End of Sidebar -->