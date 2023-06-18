<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url($user['nama_role']); ?>/dashboard">
  <div class="sidebar-brand-icon mt-3">
  <img src="<?= base_url() ?>assets/img/png.png" style="width: 150px; height: 150px;">
  </div>
</a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0 mt-2">
  <li class="nav-item active">
    <a class="nav-link" href="<?= base_url($user['nama_role']); ?>/dashboard">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">Menu</div>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>user/topup">
      <i class="bi bi-cash-stack"></i>
      <span>Top up Saldo</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>user/kartuhilang">
      <i class="bi bi-credit-card-2-front"></i>
      <span>Kartu Hilang</span>
    </a>
  </li>

  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link" href="pengumuman">
      <i class="fas fa-bullhorn"></i>
      <span>Pengumuman</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>user/riwayatTransaksi">
      <i class="fas fa-clock"></i>
      <span>Riwayat Transaksi</span>
    </a>
  </li>
  <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>user/modul">
            <i class="fas fa-book"></i>
            <span>Panduan Pengguna</span></a>
    </li>


  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
