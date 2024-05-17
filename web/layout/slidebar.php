<?php
include("web/menu/menu.php");
// include "web/menu/menu.php";
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="./home" class="brand-link">
    <img src="/pong-framework/web/favicon/logoweb.png" style="width: 45px;" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8;">
    <span class="brand-text font-weight-light">Pong Framework</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
      </div>
      <div class="info">
        <a href="/personal_data" class="d-block">Pong Framework</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2 ">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the ." " .nav-icon class
               with font-awesome or any other icon font library -->

        <?php
        for ($i = 0; $i < count($menu); $i++) {  ?>
          <li class="nav-item ">
            <!-- menu-open -->
            <!-- หัวข้อเมนูหลัก -->
            <a href="#" class="nav-link  active">
              <i class="<?= $menu[$i]['icon'] ?>"></i>
              <p>
                <?= $menu[$i]['title_main'] ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- menu ย่อย -->
              <?php for ($x = 0; $x < count($menu[$i]['list_more']); $x++) {
                $menu_in = $menu[$i]['list_more'][$x];
              ?>
                <li class="nav-item " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?= $menu_in['tooltip'] ?>">
                  <a href="<?= $menu_in['link'] ?>" class="nav-link  " id="nav-link<?= $menu_in['menu_number'] ?>">
                    <i class="<?= $menu_in['icon'] ?> nav-icon"></i>
                    <p><?= $menu_in['name'] ?>
                    </p>
                  </a>
                </li>
              <?php
              } ?>
            </ul>
          </li>
        <?php  } ?>


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>