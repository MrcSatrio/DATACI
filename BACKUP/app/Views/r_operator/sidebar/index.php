<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>admin/dashboard">
  <div class="sidebar-brand-icon mt-3">
  <img src="<?= base_url() ?>assets/img/png.png" style="width: 150px; height: 150px;">
  </div>
</a>


    <!-- Divider -->
    <hr class="sidebar-divider my-0 mt-2">
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url(); ?>admin/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>operator/riwayat">
            <i class="fas fa-clock"></i>
            <span>Riwayat</span></a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>operator/modul">
            <i class="fas fa-book"></i>
            <span>Panduan Pengguna</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>