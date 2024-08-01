<?php
session_start();
require_once '/lib/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .hidden {
      display: none;
    }
  </style>
</head>

<body class="bg-gray-100 no-skin z-10">
  <div id="navbar" class="navbar navbar-default bg-green-900 ace-save-state shadow-xl">
    <div class="navbar-container ace-save-state" id="navbar-container">
      <button id="burgerButton" class="navbar-toggler text-white  float-left mt-5  w-6">
        ☰
      </button>
      <div class="navbar-header pull-left">
        <a href="adminmainapp.php?unit=dashboard" class="navbar-brand">
          <small><i class="fa fa-desktop"></i> Perpustakaan SMKN 3 Yogyakarta </small>
        </a>
      </div>

      <div class="navbar-buttons navbar-header pull-right white" role="navigation">
        <ul class="nav ace-nav">
          <span class="user-info">
            <i data-tooltip-target="tooltip-default" data-tooltip-placement="bottom" class="fa fa-user mt-4 w-10 fa-lg"
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

  <div id="sidebar" class="bg-green-900 text-white w-64 h-screen p-4 fixed z-100 hidden">
    <ul class="space-y-2">
      <?php if ($_SESSION['status'] == "admin") { ?>
        <li class="<?= $page == 'dashboard' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="adminmainapp.php?unit=dashboard" class="flex items-center p-2 sidebar-link">
            <i class="fa fa-home mr-3"></i>
            <span>Beranda</span>
          </a>
        </li>

        <li
          class="<?= in_array($page, ['penyakit_unit', 'gejala_unit', 'tentangpenyakit_unit']) ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" onclick="toggleMenu('dataMasterMenu')">
            <span>
              <i class="fa fa-table mr-3"></i> Data Master
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="dataMasterMenu" class="pl-4 hidden">
            <li class="<?= $page == 'gejala_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=gejala_unit&act=datagrid" class="flex items-center p-2 sidebar-link">
                <i class="fa fa-caret-right mr-3"></i> Data Gejala
              </a>
            </li>
            <li
              class="<?= $page == 'tentangpenyakit_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=tentangpenyakit_unit&act=datagrid"
                class="flex items-center p-2 sidebar-link">
                <i class="fa fa-caret-right mr-3"></i> Data Tentang COVID-19
              </a>
            </li>
          </ul>
        </li>

        <li class="<?= in_array($page, ['dbp_unit', 'konsultasi_unit']) ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" onclick="toggleMenu('dataTransaksiMenu')">
            <span>
              <i class="fa fa-book mr-3"></i> Data Transaksi
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="dataTransaksiMenu" class="pl-4 hidden">
            <li class="<?= $page == 'dbp_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=dbp_unit&act=datagrid" class="flex items-center p-2 sidebar-link">
                <i class="fa fa-caret-right mr-3"></i> Data Basis Pengetahuan
              </a>
            </li>
          </ul>
        </li>

        <li class="<?= $page == 'pengguna_unit' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" onclick="toggleMenu('penggunaMenu')">
            <span>
              <i class="fa fa-users mr-3"></i> Pengguna
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="penggunaMenu" class="pl-4 hidden">
            <li class="<?= $page == 'pengguna_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=pengguna_unit&act=datagrid" class="flex items-center p-2 sidebar-link">
                <i class="fa fa-caret-right mr-3"></i> Data Pengguna
              </a>
            </li>
          </ul>
        </li>

        <li class="<?= $page == 'admin_unit' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" onclick="toggleMenu('adminMenu')">
            <span>
              <i class="fa fa-user mr-3"></i> Admin
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="adminMenu" class="pl-4 hidden">
            <li class="<?= $page == 'admin_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=admin_unit&act=datagrid" class="flex items-center p-2 sidebar-link">
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
          <a href="#" class="flex items-center p-2 justify-between" onclick="toggleMenu('konsultasiMenu')">
            <span>
              <i class="fa fa-search-plus mr-3"></i> Konsultasi
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="konsultasiMenu" class="pl-4 hidden">
            <li class="<?= $page == 'p_gejala_unit' && $act1 == 'input' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=p_gejala_unit&act=input" class="flex items-center p-2 sidebar-link">
                <i class="fa fa-caret-right mr-3"></i> Konsultasi
              </a>
            </li>
          </ul>
        </li>

        <li class="<?= in_array($page, ['p_penyakit_unit', 'p_cf_unit']) ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" onclick="toggleMenu('tentangMenu')">
            <span>
              <i class="fa fa-info mr-3"></i> Tentang
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="tentangMenu" class="pl-4 hidden">
            <li class="<?= $page == 'p_penyakit_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=p_penyakit_unit&act=datagrid" class="flex items-center p-2 sidebar-link">
                <i class="fa fa-caret-right mr-3"></i> Tentang COVID-19
              </a>
            </li>
          </ul>
        </li>
      <?php } ?>
      <li class="hover:bg-black rounded">
        <a href="adminmainapp.php?unit=logout" class="flex items-center p-2">
          <i class="fa fa-sign-out mr-3"></i>
          <span>Logout</span>
        </a>
      </li>
    </ul>
  </div>
  <!-- Sidebar -->
  <div id="sidebar" class="z-100 bg-green-900 text-white w-64 h-screen p-4 fixed x hidden">
    <ul class="space-y-2">
      <?php if ($_SESSION['status'] == "admin") { ?>
        <li class="<?= $page == 'dashboard' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="adminmainapp.php?unit=dashboard" class="flex items-center p-2 sidebar-link">
            <i class="fa fa-home mr-3"></i>
            <span>Beranda</span>
          </a>
        </li>

        <li
          class="<?= in_array($page, ['penyakit_unit', 'gejala_unit', 'tentangpenyakit_unit']) ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" onclick="toggleMenu('dataMasterMenu')">
            <span>
              <i class="fa fa-table mr-3"></i> Data Master
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="dataMasterMenu" class="pl-4 hidden">
            <li class="<?= $page == 'gejala_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=gejala_unit&act=datagrid" class="flex items-center p-2 sidebar-link">
                <i class="fa fa-caret-right mr-3"></i> Data Gejala
              </a>
            </li>
            <li
              class="<?= $page == 'tentangpenyakit_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=tentangpenyakit_unit&act=datagrid"
                class="flex items-center p-2 sidebar-link">
                <i class="fa fa-caret-right mr-3"></i> Data Tentang COVID-19
              </a>
            </li>
          </ul>
        </li>

        <li class="<?= in_array($page, ['dbp_unit', 'konsultasi_unit']) ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" onclick="toggleMenu('dataTransaksiMenu')">
            <span>
              <i class="fa fa-book mr-3"></i> Data Transaksi
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="dataTransaksiMenu" class="pl-4 hidden">
            <li class="<?= $page == 'dbp_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=dbp_unit&act=datagrid" class="flex items-center p-2 sidebar-link">
                <i class="fa fa-caret-right mr-3"></i> Data Basis Pengetahuan
              </a>
            </li>
          </ul>
        </li>

        <li class="<?= $page == 'pengguna_unit' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" onclick="toggleMenu('penggunaMenu')">
            <span>
              <i class="fa fa-users mr-3"></i> Pengguna
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="penggunaMenu" class="pl-4 hidden">
            <li class="<?= $page == 'pengguna_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=pengguna_unit&act=datagrid" class="flex items-center p-2 sidebar-link">
                <i class="fa fa-caret-right mr-3"></i> Data Pengguna
              </a>
            </li>
          </ul>
        </li>

        <li class="<?= $page == 'admin_unit' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" onclick="toggleMenu('adminMenu')">
            <span>
              <i class="fa fa-user mr-3"></i> Admin
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="adminMenu" class="pl-4 hidden">
            <li class="<?= $page == 'admin_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=admin_unit&act=datagrid" class="flex items-center p-2 sidebar-link">
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
          <a href="#" class="flex items-center p-2 justify-between" onclick="toggleMenu('konsultasiMenu')">
            <span>
              <i class="fa fa-search-plus mr-3"></i> Konsultasi
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="konsultasiMenu" class="pl-4 hidden">
            <li class="<?= $page == 'p_gejala_unit' && $act1 == 'input' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=p_gejala_unit&act=input" class="flex items-center p-2 sidebar-link">
                <i class="fa fa-caret-right mr-3"></i> Konsultasi
              </a>
            </li>
          </ul>
        </li>

        <li class="<?= in_array($page, ['p_penyakit_unit', 'p_cf_unit']) ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" onclick="toggleMenu('tentangMenu')">
            <span>
              <i class="fa fa-info mr-3"></i> Tentang
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="tentangMenu" class="pl-4 hidden">
            <li class="<?= $page == 'p_penyakit_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=p_penyakit_unit&act=datagrid" class="flex items-center p-2 sidebar-link">
                <i class="fa fa-caret-right mr-3"></i> Virus COVID-19
              </a>
            </li>
            <li class="<?= $page == 'p_cf_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-gray-700 rounded">
              <a href="adminmainapp.php?unit=p_cf_unit&act=datagrid" class="flex items-center p-2 sidebar-link">
                <i class="fa fa-caret-right mr-3"></i> Tentang Aplikasi
              </a>
            </li>
          </ul>
        </li>

      <?php } ?>

      <li class="hover:bg-black rounded">
        <a href="logout.php" class="flex items-center p-2">
          <i class="fa fa-sign-out mr-3"></i>
          <span>Logout</span>
        </a>
      </li>
    </ul>

    <script>
      function toggleMenu(menuId) {
        const menu = document.getElementById(menuId);
        menu.classList.toggle('hidden');
      }

      document.querySelectorAll('.sidebar-link').forEach(link => {
        link.addEventListener('click', () => {
          document.getElementById('sidebar').classList.add('hidden');
        });
      });

      document.getElementById('burgerButton').addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('hidden');
      });
    </script>
  </div>
  </div>

  <script>
    function toggleMenu(menuId) {
      const menu = document.getElementById(menuId);
      menu.classList.toggle('hidden');
    }

    document.querySelectorAll('.sidebar-link').forEach(link => {
      link.addEventListener('click', () => {
        document.getElementById('sidebar').classList.add('hidden');
      });
    });

    document.getElementById('burgerButton').addEventListener('click', () => {
      document.getElementById('sidebar').classList.toggle('hidden');
    });
  </script>
</body>

</html>