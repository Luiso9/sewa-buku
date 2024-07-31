<?php
include("leftbar.php");
?>

<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <i class="ace-icon fa fa-home home-icon"></i>
          <a href="#">Beranda</a>
        </li>
        <li>Tentang</li>
        <li>Penyakit</li>
      </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
      <div class="page-header">
        <h1>Tentang COVID-19
        </h1>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <?php
          $data = mysqli_query($mysqli, "SELECT * FROM t_tentangpenyakit limit 1");
          $data = mysqli_fetch_assoc($data);
          ?>
          <!-- PAGE CONTENT BEGINS -->
          <dl class="row">
            <dt class="col-sm-2">Nama Penyakit</dt>
            <dd class="col-sm-10"><?= $data['nm_tentangpenyakit'] ?></dd>

            <dt class="col-sm-2">Detail</dt>
            <dd class="col-sm-10">
              <?= $data['det_tentangpenyakit'] ?>
            </dd>

            <dt class="col-sm-2">Saran</dt>
            <dd class="col-sm-10">
              <?= $data['srn_tentangpenyakit'] ?>
            </dd>
          </dl>
          <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div>
  </div><!-- /.main-content -->
  <?php
  include("footer.php");
  ?>
  </body>

  </html>