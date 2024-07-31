<?php
$act = $_GET['act'];
switch ($act) {
  case "datagrid":
    $kd_daftar = $_GET['kd_daftar'];
    $qupdate = "SELECT * FROM t_daftar WHERE kd_daftar = '$kd_daftar'";
    $rupdate = mysqli_query($mysqli, $qupdate);
    $dupdate = mysqli_fetch_assoc($rupdate);
?>
    <?php
    include("leftbar.php");
    ?>


    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <i class="ace-icon fa fa-home home-icon"></i>
              <a href="?unit=dashboard">Beranda</a>
            </li>
            <li>Data Transaksi</li>
            <li>Konsultasi</li>
          </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
          <div class="page-header">
            <h1>Konsultasi<small> Nama : <?php echo $dupdate['nm_pasien']; ?></h1>

          </div>
          <h6>Silahkan Pilih Kondisi Gejala Susai Yang Dialami:</h6>
          <div class="row">
            <div class="col-xs-12">
              <!-- PAGE CONTENT BEGINS -->
              <div class="row">

                <form name="p_gejala" id="p_gejala" method="post" action="?unit=p_gejala_unit&act=proses&kd_daftar=<?php echo $dupdate['kd_daftar']; ?>" enctype="multipart/form-data">

                  <div class="widget-box widget-color-red" id="widget-box-2">
                    <div class="widget-header">
                      <h5 class="widget-title bigger lighter">
                        <i class=""></i>
                        Pilih Gejala
                      </h5>

                    </div>
                    <div class="widget-body">
                      <div class="widget-main no-padding">
                        <table class="table">
                          <tbody>
                            <?php
                            $qdatagrid = "SELECT * FROM t_gejala where pertanyaan!='' or pertanyaan != null ORDER by kode_gejala ";
                            $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                            $i = 0;
                            while ($ddatagrid = mysqli_fetch_array($rdatagrid)) {
                              $i++;
                            ?>
                              <tr>
                                <td class="lead"><?= $i ?></td>
                                <td class="lead"><?= $ddatagrid['pertanyaan'] ?></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td>
                                  <div class="form-check col-sm-2">
                                    <input class="form-check-input" type="radio" name="kondisi[<?=$ddatagrid['kode_gejala']?>]" id="inlineRadio<?=$i?>1" value="0">
                                    <label class="form-check-label" for="inlineRadio<?=$i?>1">Tidak</label>
                                  </div>
                                  <div class="form-check col-sm-2">
                                    <input class="form-check-input" type="radio" name="kondisi[<?=$ddatagrid['kode_gejala']?>]" id="inlineRadio<?=$i?>2" value="0.25">
                                    <label class="form-check-label" for="inlineRadio<?=$i?>2">Sedikit Yakin</label>
                                  </div>
                                  <div class="form-check col-sm-2">
                                    <input class="form-check-input" type="radio" name="kondisi[<?=$ddatagrid['kode_gejala']?>]" id="inlineRadio<?=$i?>3" value="0.5">
                                    <label class="form-check-label" for="inlineRadio<?=$i?>3">Cukup Yakin</label>
                                  </div>
                                  <div class="form-check col-sm-2">
                                    <input class="form-check-input" type="radio" name="kondisi[<?=$ddatagrid['kode_gejala']?>]" id="inlineRadio<?=$i?>4" value="0.75">
                                    <label class="form-check-label" for="inlineRadio<?=$i?>4">Yakin</label>
                                  </div>
                                  <div class="form-check col-sm-2">
                                    <input class="form-check-input" type="radio" name="kondisi[<?=$ddatagrid['kode_gejala']?>]" id="inlineRadio<?=$i?>5" value="1">
                                    <label class="form-check-label" for="inlineRadio<?=$i?>5">Sangat Yakin</label>
                                  </div>
                                </td>
                              </tr>
                            <?php
                            }
                            ?>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                      <button type="submit" name="submit" class="btn btn-danger">Proses Gejala</button>
                    </div>
                  </div>
                </form>


              </div><!-- /.row -->
              <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.page-content -->
      </div>
    </div><!-- /.main-content -->

    <?php
    include("footer.php");
    ?>
    <!-- DATA TABLES SCRIPT -->
    <script src="css/backend/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="css/backend/js/jquery.dataTables.bootstrap.min.js" type="text/javascript"></script>
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

  case "proses":

    if(isset($_POST['submit'])){
      $kd_daftar = $_GET['kd_daftar'];
    $qupdate = "SELECT * FROM t_daftar WHERE kd_daftar = '$kd_daftar'";
    $rupdate = mysqli_query($mysqli, $qupdate);
    $dupdate = mysqli_fetch_assoc($rupdate);
      $cek = $_POST['kondisi'];
      $pertanyaan = "SELECT * FROM t_gejala join t_diagnosa on t_diagnosa.kode_gejala = t_gejala.kode_gejala where pertanyaan!='' or pertanyaan != null ORDER by t_gejala.kode_gejala ";
      $rpertanyaan = mysqli_query($mysqli, $pertanyaan);

      $cf_start=0;
      $cf_end=0;
      $numb = 0;

      $cf_old = 0;
      
      while ($data = mysqli_fetch_assoc($rpertanyaan)) {
        $cf = ($data['cf_gejala'] * $cek[$data['kode_gejala']]);

        if($numb == 0){
          $cf_old = $cf;
        }

        if($numb > 0){
          $temp = $cf_old + $cf * (1 - $cf_old);
          $cf_old = $temp;
        }

        $numb++;
      }

      $cf_combine = $cf_old * 100;

      // $cf_combine = round(floor($cf_combine),5);
      $cf_combine = number_format($cf_combine,2);

    include("leftbar.php");
    ?>
    <div class="main-content">
      <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
          <ul class="breadcrumb">
            <li>
              <i class="ace-icon fa fa-home home-icon"></i>
              <a href="?unit=dashboard">Beranda</a>
            </li>
            <li>Data Transaksi</li>
            <li>Konsultasi</li>
          </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
          <div class="page-header">
            <h1>Konsultasi<small> Nama : <?php echo $dupdate['nm_pasien']; ?></h1>

          </div>
          <h1>Hasil Diagnosa Kemungkinan <?=$cf_combine?>&#37; Terinfeksi COVID-19</h1>
        </div><!-- /.page-content -->
      </div>
    </div><!-- /.main-content -->
    <?php
    include("footer.php");

    }

    

    break;


  case "input":
  ?>

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
            <li>Data Transaksi</li>
            <li>Konsultasi</li>
          </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
          <div class="page-header">
            <h1>Konsultasi<br><small> Untuk Memulai Konsultasi Silahkan Masukan Identitas Terlebih Dahulu</h1>


          </div>

          <div class="row">

            <div class="col-xs-12">

              <?php
              $qupdate = "SELECT max(kode_daftar) as maxKode FROM t_daftar";
              $rupdate = mysqli_query($mysqli, $qupdate);
              $dupdate = mysqli_fetch_assoc($rupdate);
              $kd_daftar = $dupdate['maxKode'];
              $no_urut = $kd_daftar + 1;
              $char = "K";
              $newID = $char . sprintf("%01s", $no_urut);

              ?>
              <form class="form-horizontal" name="tambah_subkat" id="tambah_subkat" method="post" action="?unit=p_gejala_unit&act=inputact" enctype="multipart/form-data">



                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right">Kode Daftar</label>
                  <div class="col-sm-9">
                    <input class="col-xs-10 col-sm-5" type="text" name="kd_daftar" id="kd_daftar" required="required" value="<?php echo "$newID"; ?>" readonly="" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="nm_pasien">Nama</label>
                  <div class="col-sm-9">
                    <input class="col-xs-10 col-sm-5" type="text" name="nm_pasien" id="nm_pasien" required />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="jk">Jenis Kelamin</label>
                  <div class="col-sm-9">
                    <select class="col-xs-10 col-sm-5" name="jk" id="jk" required>
                      <option selected disabled>-- Pilih Jenis Kelamin --</option>
                      <option value="laki-laki">Laki-Laki</option>
                      <option value="perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="usia">Usia</label>
                  <div class="col-sm-9">
                    <input class="col-xs-10 col-sm-5" type="text" name="usia" id="usia" required />
                  </div>
                </div>

                <div class="clearfix form-actions">
                  <div class="col-md-offset-3 col-md-9">
                    <button type="submit" name="submit" class="btn btn-success">Lanjutkan</button>
                    <button type="reset" name="reset" class="btn btn-danger">Batal</button>
                  </div>
                </div>

              </form>



            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.page-content -->
      </div>

    </div><!-- /.main-content -->
    <?php
    include("footer.php");
    ?>
    <script type="text/javascript">
      var frmvalidator = new Validator("tambah_subkat");

      frmvalidator.addValidation("kd_penyakit", "req", "Silakan Pilih kategori");
      frmvalidator.addValidation("namasubkategori", "req", "Silakan Masukkan Nama Subkategori");
      frmvalidator.addValidation("namasubkategori", "maxlen=35", "Maksimal Karakter Nama 35 digit");
      frmvalidator.addValidation("namasubkategori", "alpha_s", "Hanya Huruf Saja");
      frmvalidator.addValidation("namasubkategori", "simbol", "Hanya Huruf Saja");
    </script>
    </body>

    </html>


  <?php
    break;

  case "inputact":

    $kd_daftar = $_POST['kd_daftar'];
    $nm_pasien = $_POST['nm_pasien'];
    $jk = $_POST['jk'];
    $usia = $_POST['usia'];

    $qinput = "
          INSERT INTO t_daftar
          (kd_daftar, nm_pasien, jk, usia)
          VALUES
          ('$kd_daftar', '$nm_pasien', '$jk', '$usia')
        ";

    $cek = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM t_daftar WHERE kd_daftar = '$kd_daftar'"));

    if ($cek > 0) {
      echo "<script> alert('Kode Sudah Ada');
              document.location='?unit=p_gejala_unit&act=input';
              </script>";
    } else {
      mysqli_query($mysqli, $qinput);
      echo "<script> alert('Data Tersimpan');
              document.location='?unit=p_gejala_unit&act=datagrid&kd_daftar=$kd_daftar';
              </script>";
      exit();
    }
    break;

  case "update":
    $kd_daftar = $_GET['kd_daftar'];
    $qupdate = "SELECT 
                           t_hasil.kd_hasil, t_hasil.tanggal, t_hasil.nilai_cf, t_hasil.hasil_id,t_hasil.kd_daftar,
						   t_penyakit.kode_penyakit, t_penyakit.nm_penyakit, t_penyakit.penyebab,
						   t_penyakit.pencegahan, t_penyakit.penanganan,
						   t_daftar.kd_daftar, t_daftar.nm_pasien
                            FROM 
                                t_hasil
                                    JOIN t_penyakit ON t_hasil.hasil_id = t_penyakit.kode_penyakit
									JOIN t_daftar ON t_hasil.kd_daftar = t_daftar.kd_daftar
									WHERE t_hasil.kd_daftar ='$kd_daftar'";
    $rupdate = mysqli_query($mysqli, $qupdate);
    $dupdate = mysqli_fetch_assoc($rupdate);

    $arcolor = array('#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804', '#FFFC00', '#FDCD01', '#FD9A01', '#FB6700');
    date_default_timezone_set("Asia/Jakarta");
    $inptanggal = date('Y-m-d H:i:s');

    $arbobot = array('0', '0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1.0');
    $argejala = array();

    for ($i = 0; $i < count($_POST['kondisi']); $i++) {
      $arkondisi = explode("_", $_POST['kondisi'][$i]);
      if (strlen($_POST['kondisi'][$i]) > 1) {
        $argejala += array($arkondisi[0] => $arkondisi[1]);
      }
    }

    $sqlkondisi = (" SELECT * FROM t_kondisi ORDER by id+0");
    $rdatagridk = mysqli_query($mysqli, $sqlkondisi);
    while ($rkondisi = mysqli_fetch_array($rdatagridk)) {
      $arkondisitext[$rkondisi['id']] = $rkondisi['kondisi'];
    }
    $sqlpkt = (" SELECT * FROM t_penyakit ORDER by kode_penyakit+0");
    $rdatagridp = mysqli_query($mysqli, $sqlpkt);
    while ($rpkt = mysqli_fetch_array($rdatagridp)) {
      $arpkt[$rpkt['kode_penyakit']] = $rpkt['nm_penyakit'];
      $ardpkt[$rpkt['kode_penyakit']] = $rpkt['penyebab'];
      $arspkt[$rpkt['kode_penyakit']] = $rpkt['pencegahan'];
      $argpkt[$rpkt['kode_penyakit']] = $rpkt['penanganan'];
    }

    $kd_daftar = $_GET['kd_daftar'];
    $sqlhasil = "SELECT 
                           t_hasil.kd_hasil, t_hasil.tanggal, t_hasil.nilai_cf, t_hasil.hasil_id,t_hasil.kd_daftar,
						   t_hasil.penyakit, t_hasil.gejala,
						   t_penyakit.kode_penyakit, t_penyakit.nm_penyakit, t_penyakit.penyebab,
						   t_penyakit.pencegahan, t_penyakit.penanganan,
						   t_daftar.kd_daftar, t_daftar.nm_pasien
                            FROM 
                                t_hasil
                                    JOIN t_penyakit ON t_hasil.hasil_id = t_penyakit.kode_penyakit
									JOIN t_daftar ON t_hasil.kd_daftar = t_daftar.kd_daftar
									WHERE t_hasil.kd_daftar = '$kd_daftar'";
    $rdatagridp = mysqli_query($mysqli, $sqlhasil);
    while ($rhasil = mysqli_fetch_array($rdatagridp)) {
      $arpenyakit = unserialize($rhasil['penyakit']);
      $argejala = unserialize($rhasil['gejala']);
    }

    $np1 = 0;
    foreach ($arpenyakit as $key1 => $value1) {
      $np1++;
      $idpkt1[$np1] = $key1;
      $vlpkt1[$np1] = $value1;
    }
  ?>
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
            <li>Data Transaksi</li>
            <li>Data Hasil Konsultasi</li>
          </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
          <div class="page-header">
            <h1>Data Hasil Konsultasi</h1>
          </div>
          <h7>Berikut adalah hasil Konsultasi <?php echo $dupdate['nm_pasien']; ?>, Pada Tanggal <?php echo $dupdate['tanggal']; ?></h7>
          <div class="row">
            <div class="col-xs-12">


              <div class="widget-box widget-color-red" id="widget-box-2">
                <div class="widget-header">
                  <h5 class="widget-title bigger lighter">
                    <i class=""></i>
                    Gejala Yang Dipilih
                  </h5>

                </div>
                <div class="widget-body">
                  <div class="widget-main no-padding">
                    <table class="table table-striped table-bordered table-hover">
                      <thead class="thin-border-bottom">

                        <tr>
                          <th style="text-align: center">No.</th>
                          <th style="text-align: center">Kode Gejala</th>
                          <th style="text-align: center">Nama Gejala</th>
                          <th style="text-align: center">Nilai CF (Kondsi)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $ig = 0;
                        foreach ($argejala as $key => $value) {
                          $kondisi = $value;
                          $ig++;
                          $gejala = $key;
                          $qdatagrid = " SELECT * FROM t_gejala where kode_gejala = '$key'";
                          $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                          $ddatagrid = mysqli_fetch_array($rdatagrid);
                          echo '<tr><td>' . $ig . '</td>';
                          echo "<td> $ddatagrid[kd_gejala]</td>";
                          echo "<td> $ddatagrid[nm_gejala]</td>";
                          echo '<td><span class="kondisipilih">' . $arkondisitext[$kondisi] . "</span></td>";
                        }
                        ?>

                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="page-header"></div>
              <div class="widget-box widget-color-red" id="widget-box-2">
                <div class="widget-header">
                  <h5 class="widget-title bigger lighter">
                    <i class=""></i>
                    Hasil Konsultasi Penyakit
                  </h5>

                </div>
                <div class="widget-body">
                  <div class="widget-main no-padding">
                    <table class="table table-striped table-bordered table-hover">
                      <thead class="thin-border-bottom">
                        <tr>
                          <th style="text-align: center">No.</th>
                          <th style="text-align: center">Kode</th>
                          <th style="text-align: center">Penyakit</th>
                          <th style="text-align: center">Nilai CF</th>
                          <th style="text-align: center">Persen</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $np = 0;
                        foreach ($arpenyakit as $key => $value) {
                          $np++;
                          $idpkt[$np] = $key;
                          $nmpkt[$np] = $arpkt[$key];
                          $vlpkt[$np] = $value;

                          $qdatagrid = " SELECT * FROM t_penyakit where kode_penyakit = '$key'";
                          $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                          $ddatagrid = mysqli_fetch_array($rdatagrid);
                          for ($ipl = 1; $ipl < count($idpkt); $ipl++);
                          echo '<tr><td>' . $np . '</td>';
                          echo "<td class=opsi > $ddatagrid[kd_penyakit]</td>";
                          echo "<td class=opsi > $ddatagrid[nm_penyakit]</td>";
                          echo '<td>' . $vlpkt[$ipl] . '</td>';
                          echo "<td> " . round($vlpkt[$ipl], 2) . " %</td></tr>";
                        }

                        ?>



                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


              <div class="page-header"></div>
              <h5>DIAGNOSA</h5>
              <h6>Hasil Dari Diagnosa Penyakit Yang Paling Mungkin adalah : <?php echo $dupdate['nm_penyakit']; ?></h6>

              <div class="widget-body">
                <div class="widget-main">

                  <p class="alert alert-danger">
                    Penyebab : <?php echo $dupdate['penyebab']; ?>
                  </p>
                  <p class="alert alert-danger">
                    Penceggahan : <?php echo $dupdate['pencegahan']; ?>
                  </p>
                  <p class="alert alert-danger">
                    Penanganan : <?php echo $dupdate['penanganan']; ?>
                  </p>

                </div>
              </div>
              <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                  <a href="?unit=l_konsultasi&kd_daftar=<?php echo $kd_daftar; ?>" class='btn btn-sm btn-danger glyphicon glyphicon-print'> Print</a>
                  <a href="?unit=p_gejala_unit&act=datagrid&kd_daftar=<?php echo $kd_daftar; ?>" class='btn btn-sm btn-info glyphicon'>Kembali</a> <br><br><br>
                </div>
              </div>


            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.page-content -->
      </div>

    </div><!-- /.main-content -->
    <?php
    include("footer.php");
    ?>
    </body>

    </html>

<?php
    break;
}
