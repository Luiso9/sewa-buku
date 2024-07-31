<?php
session_start();
require_once '../lib/koneksi.php';

$act = $_GET['act'];
switch ($act) {
  case "datagrid":
?>
    <?php
    include("../admin/leftbar.php");
    ?>
    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <i class="ace-icon fa fa-home home-icon"></i>
              <a href="adminmainapp.php?unit=dashboard">Dashboard</a>
            </li>
            <li>Data Master</li>
            <li>Data Penyakit</li>
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
                  $data = mysqli_query($mysqli,"SELECT * FROM t_tentangpenyakit limit 1");
                  $data = mysqli_fetch_assoc($data); 
              ?>
              <!-- PAGE CONTENT BEGINS -->
              <dl class="row">
                <dt class="col-sm-2">Nama Penyakit</dt>
                <dd class="col-sm-10"><?=$data['nm_tentangpenyakit']?></dd>

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
          <a href="?unit=tentangpenyakit_unit&act=update&kd_tentangpenyakit=<?=$data['kd_tentangpenyakit']?>" class='btn btn-sm btn-warning' >
          <i class="glyphicon glyphicon-pencil"></i> Edit
        </a> 
          
        </div><!-- /.page-content -->
      </div>
    </div><!-- /.main-content -->
    <?php
    include("../admin/footer.php");
    ?>
    <!-- DATA TABLES SCRIPT -->
    <script src="../css/backend/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../css/backend/js/jquery.dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      function confirmDialog() {
        return confirm('Apakah anda yakin?')
      }
      $('#datatable').dataTable({
        "lengthMenu": [
          [10, 25, 50, 100, 500, 1000, -1],
          [10, 25, 50, 100, 500, 1000, "Semua"]
        ]
      });
    </script>
    </body>

    </html>
  <?php

    break;
  case "update":
    $kd_tentangpenyakit = $_GET['kd_tentangpenyakit'];
    $qupdate = "SELECT * FROM t_tentangpenyakit WHERE kd_tentangpenyakit = '$kd_tentangpenyakit'";
    $rupdate = mysqli_query($mysqli, $qupdate);
    $dupdate = mysqli_fetch_assoc($rupdate);
  ?>

    <?php
    include("../admin/leftbar.php");
    ?>

    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <i class="ace-icon fa fa-home home-icon"></i>
              <a href="#">Beranda</a>
            </li>
            <li>Data Master</li>
            <li>Edit Data Penyakit</li>
          </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
          <div class="page-header">
            <h1>Edit Data Penyakit</h1>
          </div>
          <div class="row">
            <div class="col-xs-12">



              <form class="form-horizontal" id="tambah_kat" name="tambah_kat" method="post" action="adminmainapp.php?unit=tentangpenyakit_unit&act=updateact">
                  <input class="col-xs-10 col-sm-5" type="hidden" name="kd_tentangpenyakit" id="kd_tentangpenyakit" required="required" value="<?php echo $dupdate['kd_tentangpenyakit'] ?>" readonly="readonly" />
                <div class="form-group">
                  <label>Nama Penyakit :</label>
                  <div>
                    <input class="col-xs-10 col-sm-5" type="text" name="nm_tentangpenyakit" id="nm_tentangpenyakit" required="required" value="<?php echo $dupdate['nm_tentangpenyakit'] ?>" autofocus="autofocus" />
                  </div>
                </div>

                <div class="form-group">
                  <label>Detail Tentang Penyakit :</label>
                  <div>
                    <textarea class="form-control limited" name="det_tentangpenyakit" id="det_tentangpenyakit"><?php echo $dupdate['det_tentangpenyakit'] ?> </textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="srn_tentangpenyakit">Saran Tentang Penyakit :</label>
                  <div>
                    <textarea class="form-control limited" name="srn_tentangpenyakit" id="srn_tentangpenyakit"><?php echo $dupdate['srn_tentangpenyakit'] ?> </textarea>
                  </div>
                </div>




                <div class="clearfix form-actions">
                  <div class="col-md-offset-3 col-md-9">
                    <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                    <button type="reset" name="reset" class="btn btn-danger">Batal</button>
                    <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=tentangpenyakit_unit&act=datagrid'">kembali</button>
                  </div>
                </div>



              </form>


            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.page-content -->
      </div>

    </div><!-- /.main-content -->
    <?php
    include("../admin/footer.php");
    ?>

    <script type="text/javascript">

      tinymce.init({
        selector: "textarea",

        // ===========================================
        // INCLUDE THE PLUGIN
        // ===========================================

        plugins: [
          "advlist autolink lists link image charmap print preview anchor",
          "searchreplace visualblocks code fullscreen",
          "insertdatetime media table contextmenu paste jbimages"
        ],

        // ===========================================
        // PUT PLUGIN'S BUTTON on the toolbar
        // ===========================================

        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",

        // ===========================================
        // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
        // ===========================================

        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,

      });
    </script>
    </body>

    </html>
<?php
    break;

  case "updateact":
    $kd_tentangpenyakit = $_POST['kd_tentangpenyakit'];
    $nm_tentangpenyakit = $_POST['nm_tentangpenyakit'];
    $det_tentangpenyakit = $_POST['det_tentangpenyakit'];
    $srn_tentangpenyakit = $_POST['srn_tentangpenyakit'];
    // menyimpan nama file di variabel
      $qupdate =
        "
                UPDATE t_tentangpenyakit SET
				nm_tentangpenyakit = '$nm_tentangpenyakit',
				det_tentangpenyakit = '$det_tentangpenyakit',
				srn_tentangpenyakit = '$srn_tentangpenyakit'
                WHERE
                kd_tentangpenyakit = '$kd_tentangpenyakit'
                ";

    $rupdate = mysqli_query($mysqli, $qupdate) or die(mysqli_error($mysqli));
    header("location:?unit=tentangpenyakit_unit&act=datagrid");
    break;

  case "delete":
    $kd_tentangpenyakit = $_GET['kd_tentangpenyakit'];
    $qdelete = "
          DELETE  FROM t_tentangpenyakit
       
          WHERE
            kd_tentangpenyakit = '$kd_tentangpenyakit'
        ";

    $rdelete = mysqli_query($mysqli, $qdelete);
    header("location:?unit=tentangpenyakit_unit&act=datagrid");
    break;
}
