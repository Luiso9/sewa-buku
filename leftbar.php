<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
  <div id="sidebar" class="bg-gray-800 text-white w-64 h-screen p-4 fixed">
    <ul class="space-y-2">
      <?php if ($_SESSION['status'] == "admin") { ?>
        <li class="<?= $page == 'dashboard' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="adminmainapp.php?unit=dashboard" class="flex items-center p-2">
            <i class="fa fa-home mr-3"></i>
            <span>Beranda</span>
          </a>
        </li>

        <li class="<?= in_array($page, ['penyakit_unit', 'gejala_unit', 'tentangpenyakit_unit']) ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="#" class="flex items-center p-2 justify-between" onclick="toggleMenu('dataMasterMenu')">
            <span>
              <i class="fa fa-table mr-3"></i> Data Master
            </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul id="dataMasterMenu" class="pl-4 hidden">
            <li class="<?= $page == 'gejala_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=gejala_unit&act=datagrid" class="flex items-center p-2">
                <i class="fa fa-caret-right mr-3"></i> Data Gejala
              </a>
            </li>
            <li class="<?= $page == 'tentangpenyakit_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-black rounded">
              <a href="adminmainapp.php?unit=tentangpenyakit_unit&act=datagrid" class="flex items-center p-2">
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
              <a href="adminmainapp.php?unit=dbp_unit&act=datagrid" class="flex items-center p-2">
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
              <a href="adminmainapp.php?unit=pengguna_unit&act=datagrid" class="flex items-center p-2">
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
              <a href="adminmainapp.php?unit=admin_unit&act=datagrid" class="flex items-center p-2">
                <i class="fa fa-caret-right mr-3"></i> Data Admin
              </a>
            </li>
          </ul>
        </li>

      <?php } else { ?>

        <li class="<?= $page == 'p_dashboard' ? 'bg-black' : '' ?> hover:bg-black rounded">
          <a href="adminmainapp.php?unit=p_dashboard" class="flex items-center p-2">
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
              <a href="adminmainapp.php?unit=p_gejala_unit&act=input" class="flex items-center p-2">
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
              <a href="adminmainapp.php?unit=p_penyakit_unit&act=datagrid" class="flex items-center p-2">
                <i class="fa fa-caret-right mr-3"></i> Virus COVID-19
              </a>
            </li>
            <li class="<?= $page == 'p_cf_unit' && $act1 == 'datagrid' ? 'bg-black' : '' ?> hover:bg-gray-700 rounded">
              <a href="adminmainapp.php?unit=p_cf_unit&act=datagrid" class="flex items-center p-2">
                <i class="fa fa-caret-right mr-3"></i> Tentang Aplikasi
              </a>
            </li>
          </ul>
        </li>

      <?php } ?>

      <li class="hover:bg-black rounded">
        <a href="logout.php" class="flex items-center p-2">
          <i class="fa fa-power-off mr-3"></i>
          <span>Keluar</span>
        </a>
      </li>
    </ul>
  </div>

  <script>
    function toggleMenu(menuId) {
      const menu = document.getElementById(menuId);
      menu.classList.toggle('hidden');
    }
  </script>
</body>

</html>
