<?php
session_start();
if (!isset($_SESSION['nm_pengguna'])) {
  header("location:dashboard.php");
}
require_once '../lib/koneksi.php';
$qupdate = "SELECT * FROM t_login WHERE nm_pengguna = '" . $_SESSION['nm_pengguna'] . "'";
$rupdate = mysqli_query($mysqli, $qupdate);
$dupdate = mysqli_fetch_assoc($rupdate);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" rel="stylesheet">
  <style>
    #sidebar {
      z-index: 1000;
      display: none; /* Hide sidebar by default */
    }

    .dropdown-menu {
      display: none; /* Hide dropdowns by default */
    }

    .dropdown-menu.show {
      display: block; /* Show dropdowns when they have the 'show' class */
    }
  </style>
</head>

<body class="bg-gray-100">
  <div id="navbar" class="navbar navbar-default navbar-fixed bg-green-900 shadow-xl">
    <div class="navbar-container ace-save-state" id="navbar-container">
      <button id="burgerButton" class="navbar-toggler text-white float-left mt-5 w-6">☰</button>
      <div class="navbar-header pull-left">
        <a href="adminmainapp.php?unit=dashboard" class="navbar-brand">
          <small><i class="fa fa-desktop"></i> Perpustakaan SMKN 3 Yogyakarta</small>
        </a>
      </div>
      <div class="navbar-buttons navbar-header pull-right white" role="navigation">
        <ul class="nav ace-nav">
          <span class="user-info">
            <i data-tooltip-target="tooltip-default" data-tooltip-placement="bottom" class="fa fa-user mt-4 w-10 fa-lg lg:hidden"
              aria-hidden="true"></i>
            <div id="tooltip-bottom" role="tooltip"
              class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
              Tooltip on bottom
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
          </span>
        </ul>
      </div>
    </div>
  </div>

  <!-- Sidebar -->
  <div id="sidebar"
    class="bg-green-900 text-white w-64 h-screen p-4 fixed z-100 transition-transform ease-in-out duration-300 transform lg:translate-x-0">
    <ul class="space-y-2">
      <?php if ($_SESSION['status'] == "admin") { ?>
        <li class="<?= $page == 'dashboard' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="adminmainapp.php?unit=dashboard" class="flex items-center p-2">
            <i class="fa fa-home mr-3"></i>
            <span>Beranda</span>
          </a>
        </li>

        <li
          class="<?= in_array($page, ['penyakit_unit', 'gejala_unit', 'tentangpenyakit_unit']) ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" data-collapse-toggle="dataMasterMenu">
            <span>
              <i class="fa fa-table mr-3"></i> Data Master
            </span>
            <i class="fa fa-angle-down"></i>
          </a>

          <ul id="dataMasterMenu" class="pl-4 hidden dropdown-menu">
            <li class="<?= $page == 'gejala_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=gejala_unit&act=datagrid" class="flex items-center p-2">
                <i class="fa fa-caret-right mr-3"></i> Data Gejala
              </a>
            </li>
            <li
              class="<?= $page == 'tentangpenyakit_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=tentangpenyakit_unit&act=datagrid" class="flex items-center p-2">
                <i class="fa fa-caret-right mr-3"></i> Data Tentang COVID-19
              </a>
            </li>
          </ul>
        </li>

        <li class="<?= in_array($page, ['dbp_unit', 'konsultasi_unit']) ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" data-collapse-toggle="dataTransaksiMenu">
            <span>
              <i class="fa fa-book mr-3"></i> Data Transaksi
            </span>
            <i class="fa fa-angle-down"></i>
          </a>

          <ul id="dataTransaksiMenu" class="pl-4 hidden dropdown-menu">
            <li class="<?= $page == 'dbp_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=dbp_unit&act=datagrid" class="flex items-center p-2">
                <i class="fa fa-caret-right mr-3"></i> Data Basis Pengetahuan
              </a>
            </li>
          </ul>
        </li>

        <li class="<?= $page == 'pengguna_unit' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" data-collapse-toggle="penggunaMenu">
            <span>
              <i class="fa fa-users mr-3"></i> Pengguna
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="penggunaMenu" class="pl-4 hidden dropdown-menu">
            <li class="<?= $page == 'pengguna_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=pengguna_unit&act=datagrid" class="flex items-center p-2">
                <i class="fa fa-caret-right mr-3"></i> Data Pengguna
              </a>
            </li>
          </ul>
        </li>

        <li class="<?= $page == 'admin_unit' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" data-collapse-toggle="adminMenu">
            <span>
              <i class="fa fa-user mr-3"></i> Admin
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="adminMenu" class="pl-4 hidden dropdown-menu">
            <li class="<?= $page == 'admin_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=admin_unit&act=datagrid" class="flex items-center p-2">
                <i class="fa fa-caret-right mr-3"></i> Data Admin
              </a>
            </li>
          </ul>
        </li>

      <?php } else { ?>

        <li class="<?= $page == 'p_dashboard' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="adminmainapp.php?unit=p_dashboard" class="flex items-center p-2 sidebar-link">
            <i class="fa fa-home mr-3"></i>
            <span>Beranda</span>
          </a>
        </li>

        <li class="<?= $page == 'p_gejala_unit' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" data-collapse-toggle="konsultasiMenu">
            <span>
              <i class="fa fa-search-plus mr-3"></i> Konsultasi
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="konsultasiMenu" class="pl-4 hidden dropdown-menu">
            <li class="<?= $page == 'p_gejala_unit' && $act1 == 'input' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=p_gejala_unit&act=input" class="flex items-center p-2">
                <i class="fa fa-caret-right mr-3"></i> Input Data Gejala
              </a>
            </li>
            <li class="<?= $page == 'p_gejala_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=p_gejala_unit&act=datagrid" class="flex items-center p-2">
                <i class="fa fa-caret-right mr-3"></i> Lihat Data Gejala
              </a>
            </li>
          </ul>
        </li>

        <li class="<?= $page == 'p_penyakit_unit' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" data-collapse-toggle="dataMenu">
            <span>
              <i class="fa fa-table mr-3"></i> Data
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="dataMenu" class="pl-4 hidden dropdown-menu">
            <li class="<?= $page == 'p_penyakit_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=p_penyakit_unit&act=datagrid" class="flex items-center p-2">
                <i class="fa fa-caret-right mr-3"></i> Penyakit
              </a>
            </li>
            <li class="<?= $page == 'p_cf_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=p_cf_unit&act=datagrid" class="flex items-center p-2">
                <i class="fa fa-caret-right mr-3"></i> Certainty Factor
              </a>
            </li>
          </ul>
        </li>

      <?php } ?>
    </ul>
  </div>

  <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Toggle dropdowns
      document.querySelectorAll('[data-collapse-toggle]').forEach(function (toggle) {
        toggle.addEventListener('click', function () {
          const targetMenu = document.getElementById(toggle.getAttribute('data-collapse-toggle'));
          targetMenu.classList.toggle('show');
        });
      });

      // Toggle sidebar
      const sidebarToggle = document.getElementById('burgerButton');
      const sidebar = document.getElementById('sidebar');

      sidebarToggle.addEventListener('click', function () {
        sidebar.classList.toggle('hidden');
      });
    });
  </script>
</body>

</html>
