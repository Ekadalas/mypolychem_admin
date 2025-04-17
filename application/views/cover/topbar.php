 <?php $nik_sesi = $this->session->userdata('nip_btn'); ?>

   <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                     <h5 style="color: black; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); margin-left: 10px;">
                        <?php
                        if ($nik_sesi == '000') {
                            echo "Head Office";
                        } elseif ($nik_sesi == '001') {
                            echo "Plant Merak";
                        } elseif ($nik_sesi == '002') {
                            echo "Plant Tangerang";
                        } elseif ($nik_sesi == '003') {
                            echo "Plant Karawang";
                        } else {
                            echo "UNKNOW";
                        }
                        ?>
                    </h5>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                      

                    

        
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                 <?php
                            if ($nik_sesi == '000') {
                               // echo "<span class='mr-2 d-none d-lg-inline text-gray-600 small'>Head Office</span>";
                                echo "<img  src='" . base_url('assets/img/adminHO.png') . "' alt='Admin Head Office' width='45' height='45'> ";
                            } elseif ($nik_sesi == '001') {
                              //  echo " <span class='mr-2 d-none d-lg-inline text-gray-600 small'>Plant Merak</span>";
                                echo "<img  src='" . base_url('assets/img/adminMRK.png') . "' alt='Admin Plant Merak' width='45' height='45'> ";
                            } elseif ($nik_sesi == '003') {
                                echo " <span class='mr-2 d-none d-lg-inline text-gray-600 small'>Plant Karawang</span>";
                            } elseif ($nik_sesi == '002') {
                                echo " <span class='mr-2 d-none d-lg-inline text-gray-600 small'>Plant Tangerang</span>";
                            } else {
                                echo "UNKNOW";
                                echo "<i class='fas fa-2x fa-layer-group' style='color: #004080;'>";
                            }

                            ?>

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                            
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
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

                        </li>

                    </ul>

                </nav>