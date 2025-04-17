<?php $nip = $this->session->userdata('nip_btn'); ?>
  <!-- Sidebar -->
        <ul class="navbar-nav bg-custom-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url('C_dashboard') ?>">
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

        <li class="nav-item menu-item <?= ($this->uri->segment(1) == 'C_dashboard') ? 'active' : '' ?>" id="menu-dashboard">
            <a class="nav-link" href="<?php echo site_url('C_dashboard') ?>">
                <i class="fas fa-fw fa-chalkboard-teacher"></i>
                <span>Dashboard</span>
            </a>
        </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->


          <?php
          // Ambil semua menu
          $sidebar = $this->db->query("SELECT * FROM menu_admin
          WHERE FIND_IN_SET('$nip', akses) > 0
          ORDER BY id ASC")->result_array();

          // Kelompokkan menu berdasarkan grup
          $menu_groups = [];
          foreach ($sidebar as $item) {
          $menu_groups[$item['grup']][] = $item;
          }

          // Daftar grup yang akan ditampilkan
          $allowed_groups = [
          'data_harian' => 'DATA HARIAN',
          'data_pendukung' => 'DATA PENDUKUNG'
          ];

          // Tampilkan menu per grup
          foreach ($allowed_groups as $group_key => $group_label):
          if (isset($menu_groups[$group_key])):
          echo '<div class="sidebar-heading">'.strtoupper($group_label).'</div>';
          foreach ($menu_groups[$group_key] as $menu):
          $active     = ($this->uri->segment(1) == $menu['controller']) ? 'active' : '';
          $controller = $menu['controller'];
          $icon       = $menu['icon'];
          $class      = $menu['class'];
          $label      = $menu['menu'];

          echo '<li class="nav-item menu-item '.$active.'" id="'.$class.'">
          <a class="nav-link" href="'.site_url($controller).'">
          <i class="'.$icon.'"></i>
          <span>'.$label.'</span>
          </a>
          </li>';
          endforeach;
          echo '<hr class="sidebar-divider">';
          endif;
          endforeach;
          ?>




        </ul>
