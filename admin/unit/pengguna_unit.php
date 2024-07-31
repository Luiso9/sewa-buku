<?php
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
              <a href="adminmainapp.php?unit=dashboard">Beranda</a>
            </li>
            <li>Pengguna</li>
            <li>Data Pengguna</li>
          </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
          <div class="page-header">
            <h1>Data Pengguna
            </h1>
          </div>
          <h1>
		  
           <!-- <a href="?unit=pengguna_unit&act=input">
              <button class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Data</button>
            </a> -->
			
          </h1>
          <div class="row">
            <div class="col-xs-12">
              <!-- PAGE CONTENT BEGINS -->
              <div class="row">
                <div class="box box-primary">
                  <div class="box-body table-responsive padding">

                    <table id="datatable" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="text-align: center">No</th>
                          <th style="text-align: center">Kode Daftar</th>
                          <th style="text-align: center">Nama Pasien</th>
                          <th style="text-align: center">Jenis Kelamin</th>
                          <th style="text-align: center">Usia</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                        $qdatagrid = " SELECT * FROM t_daftar";
                        $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                        while ($row = mysqli_fetch_assoc($rdatagrid)) {
                        ?>
                          <tr>

                            <td><?= $no ?></td>
                            <td><?= $row["kd_daftar"] ?></td>
                            <td><?= $row["nm_pasien"] ?></td>
                            <td><?= $row["jk"] ?></td>
                            <td><?= $row["usia"] ?></td>
                          </tr>
                        <?php
                          $no++;
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div><!-- /.row -->
              <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
          </div><!-- /.row -->
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

  case "diagnosa":
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
            <li>Pengguna</li>
            <li>Detail</li>
          </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
          <div class="page-header">
            <h1>Hasil DIagnosa Pengguna</h1>
          </div>
          <div class="row">
            <div class="col-xs-12">







            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.page-content -->
      </div>

    </div><!-- /.main-content -->
    <?php
    include("../admin/footer.php");
    ?>
    <script src="../css/backend/js/jquery.validate.min.js"></script>
    </body>

    </html>
  <?php
    break;

  case "inputact":
    $nm_pengguna = $_POST['nm_pengguna'];
    $nama = $_POST['nama'];
    $katasandi = md5($_POST['katasandi']);
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $qinput = "
          INSERT INTO t_login
          (
            nm_pengguna,
            nama,
            katasandi,
            jk,
            alamat,
            email,
            status
          )
          VALUES
          (
            '$nm_pengguna',
            '$nama',
            '$katasandi',
            '$jk',
            '$alamat',
            '$email',
            '$status'
          )
        ";

    $cek = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM t_login WHERE nm_pengguna = '$nm_pengguna'"));

    if (!preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $_POST['email'])) {
      echo "<script> alert('Perbaiki Email Anda');
              document.location='adminmainapp.php?unit=pengguna_unit&act=input';
              </script>";
    } else {
      $save =  mysqli_query($mysqli, $qinput) or die(mysqli_error($mysqli));
      echo "<script> alert('Data Tersimpan');
              document.location='adminmainapp.php?unit=pengguna_unit&act=datagrid';
              </script>";
      exit();
    }
    break;

  case "update":
    $kd_login = $_GET['kd_login'];
    $qupdate = "SELECT * FROM  t_login WHERE kd_login = '$kd_login'";
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
            <li>Pengguna</li>
            <li>Edit Data Pengguna</li>
          </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
          <div class="page-header">
            <h1>Edit Data Pengguna</h1>
          </div>
          <div class="row">
            <div class="col-xs-12">

              <form class="form-horizontal" method="post" action="?unit=pengguna_unit&act=updateact" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="kd_login">Kode Pengguna</label>
                  <div class="col-sm-9">
                    <input class="col-xs-10 col-sm-5" type="text" name="kd_login" id="kd_login" readonly="readonly" value="<?php echo $dupdate['kd_login'] ?>" required />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="nama">Nama</label>
                  <div class="col-sm-9">
                    <input class="col-xs-10 col-sm-5" type="text" name="nama" id="nama" value="<?php echo $dupdate['nama'] ?>" required />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="nm_pengguna">Nama Pengguna</label>
                  <div class="col-sm-9">
                    <input class="col-xs-10 col-sm-5" type="text" name="nm_pengguna" id="nm_pengguna" value="<?php echo $dupdate['nm_pengguna'] ?>" required />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="katasandi">Kata Sandi</label>
                  <div class="col-sm-9">
                    <input class="col-xs-10 col-sm-5" type="text" name="katasandi" id="katasandi" value="<?php echo $dupdate['katasandi'] ?>" required />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="jk">Jenis Kelamin</label>
                  <div class="col-sm-9">
                    <select class="col-xs-10 col-sm-5" name="jk" id="jk" required>
                      <option value=""></option>
                      <option value="laki-laki" <?= $dupdate['jk'] == 'laki-laki' ? 'selected' : '' ?>>Laki-Laki</option>
                      <option value="Perempuan" <?= $dupdate['jk'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="nm_pengguna">Alamat</label>
                  <div class="col-sm-9">
                    <input class="col-xs-10 col-sm-5" type="text" name="alamat" id="nm_pengguna" value="<?php echo $dupdate['alamat'] ?>" required />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="email">Email</label>
                  <div class="col-sm-9">
                    <input class="col-xs-10 col-sm-5" type="text" name="email" id="email" value="<?php echo $dupdate['email'] ?>" required />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="status">Status</label>
                  <div class="col-sm-9">
                    <input class="col-xs-10 col-sm-5" type="text" name="status" id="status" value="<?php echo $dupdate['status'] ?>" readonly="readonly" required />
                  </div>
                </div>

                <div class="clearfix form-actions">
                  <div class="col-md-offset-3 col-md-9">
                    <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                    <button type="reset" name="reset" class="btn btn-danger">Batal</button>
                    <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=pengguna_unit&act=datagrid'">kembali</button>
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
    </body>

    </html>

<?php
    break;

  case "updateact":
    $kd_login = $_POST['kd_login'];
    $nm_pengguna = $_POST['nm_pengguna'];
    $nama = $_POST['nama'];
    $katasandi = md5($_POST['katasandi']);
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    $qupdate = "";
    if ($katasandi == "") {
      $qupdate = "
              UPDATE t_login SET
                nm_pengguna = '$nm_pengguna',
                nama = '$nama', 
                jk = '$jk',
                alamat = '$alamat',
                email = '$email',    
                status = '$status'        
              WHERE
                kd_login = '$kd_login'
            ";
    } else {
      $katasandi = md5($katasandi);
      $qupdate = "
              UPDATE t_login SET
                nm_pengguna = '$nm_pengguna',
                 nama = '$nama',
                katasandi = '$katasandi',    
                 jk = '$jk',
                alamat = '$alamat',
                email = '$email',    
                status = '$status'        
              WHERE
                kd_login = '$kd_login'
            ";
    }

    $rupdate = mysqli_query($mysqli, $qupdate) or die(mysqli_error($mysqli));
    //echo $qupdate . '<br />';
    header("location:?unit=pengguna_unit&act=datagrid");
    break;

  case "delete":
    $kd_login = $_GET['kd_login'];
    $qdelete = "
          DELETE  FROM t_login 
       
          WHERE
            kd_login = '$kd_login'
        ";
    $rdelete = mysqli_query($mysqli, $qdelete);
    header("location:?unit=pengguna_unit&act=datagrid");
    break;

  case "aktif":
    $kd_login = $_GET['kd_login'];
    $blokir = $_POST['blokir'];
    $qupdate = "
          UPDATE t_login SET
            blokir = 'N',
            bataslogin = '0' 
     
          WHERE
            kd_login = '$kd_login' 
        ";
    $rupdate = mysqli_query($mysqli, $qupdate);
    header("location:?unit=pengguna_unit&act=datagrid");


    break;
  case "blokir":
    $kd_login = $_GET['kd_login'];
    $blokir = $_POST['blokir'];
    $qupdate = "
          UPDATE t_login SET
            blokir = 'Y' 
     
          WHERE
            kd_login = '$kd_login' 
        ";
    $rupdate = mysqli_query($mysqli, $qupdate);
    header("location:?unit=pengguna_unit&act=datagrid");


    break;
}
