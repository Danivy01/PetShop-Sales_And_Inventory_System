<style type="text/css">
  #overlay {
    position: fixed;
    display: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 2;
    cursor: pointer;
  }

  #text {
    position: absolute;
    top: 50%;
    left: 50%;
    font-size: 50px;
    color: white;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
  }
</style>

<div id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pet Shop Management System</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        General
      </div>
      <!-- Tables Buttons -->
      <li class="nav-item">
        <a class="nav-link" href="?page=1">
          <i class="fas fa-fw fa-user"></i>
          <span>Customer</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="?page=2">
          <i class="fas fa-fw fa-user"></i>
          <span>Employee</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="?page=3">
          <i class="fas fa-fw fa-table"></i>
          <span>Product</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="?page=4">
          <i class="fas fa-fw fa-archive"></i>
          <span>Inventory</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="?page=5">
          <i class="fas fa-fw fa-retweet"></i>
          <span>Transaction</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="?page=6">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Supplier</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="?page=7">
          <i class="fas fa-fw fa-users"></i>
          <span>Accounts</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
    <?php include_once 'topbar.php'; ?>