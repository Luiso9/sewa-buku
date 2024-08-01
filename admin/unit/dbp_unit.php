<?php
$act = $_GET['act'];
switch ($act) {
    // Datagrid
    case "datagrid":
        ?>
        <?php include "../admin/leftbar.php"; ?>
        <div class="p-6 z-0">
            <?php
            include "../admin/component/breadcrumb.php";
            ?>

            <!-- Form Content -->
            <div class="container mx-auto">
                <div class="relative overflow-x-auto my-10">
                    <table id="datatable" class="w-full text-xl text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">No.</th>
                                <th scope="col" class="px-6 py-3">Gejala</th>
                                <th scope="col" class="px-6 py-3">CF(Pakar)</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $qdatagrid = "SELECT t_diagnosa.kd_diagnosa, t_diagnosa.cf_gejala, t_penyakit.kode_penyakit, t_penyakit.nm_penyakit, t_gejala.kode_gejala, t_gejala.nm_gejala FROM t_diagnosa JOIN t_penyakit ON t_diagnosa.kode_penyakit = t_penyakit.kode_penyakit JOIN t_gejala ON t_diagnosa.kode_gejala = t_gejala.kode_gejala";
                            $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                            while ($ddatagrid = mysqli_fetch_assoc($rdatagrid)) {
                                echo "
                        <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>
                            <td scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>$no</td>
                            <td class='px-6 py-4'>$ddatagrid[nm_gejala]</td>
                            <td class='px-6 py-4'>$ddatagrid[cf_gejala]</td>
                            <td class='px-6 py-4'>
                                <a href='?unit=dbp_unit&act=update&kd_diagnosa=$ddatagrid[kd_diagnosa]' class='text-sm btn font-medium text-blue-600 dark:text-blue-500 hover:underline mr-4'>✏</a>
                                <a href='?unit=dbp_unit&act=delete&kd_diagnosa=$ddatagrid[kd_diagnosa]' class='text-sm btn font-medium text-red-600 dark:text-red-500 hover:underline' onclick='return confirm(\"Yakin Akan Menghapus Data?\")'>🗑</a>
                            </td>
                        </tr>
                        ";
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="flex justify-between items-center mt-4">
                        <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-l">
                            Prev
                        </button>
                        <span class="text-gray-700 dark:text-gray-300">Page 1 of 10</span>
                        <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-r">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- PAGE CONTENT BEGINS -->

        <?php include "../admin/footer.php"; ?>
        <!-- DATA TABLES SCRIPT -->

        <script type="text/javascript">
            function confirmDialog() {
                return confirm('Apakah anda yakin?')
            }
            $(document).ready(function () {
                $('#datatable').DataTable({
                    "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Semua"]],
                    "pagingType": "full_numbers"
                });
            });
        </script>
        <?php break;

    // Input
    case "input":
        ?>
        <?php include "../admin/leftbar.php"; ?>
        <div class="main-content">
            <div class="main-content-inner">
                <?php
                include "../admin/component/breadcrumb.php";
                ?>
                <div class="page-content">
                    <div class="page-header">
                        <h1>Tambah Data Basis Pengetahuan</h1>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <form class="form-horizontal" name="tambah_subkat" id="tambah_subkat" method="post"
                                action="?unit=dbp_unit&act=inputact" enctype="multipart/form-data">
                                <?php
                                $qcombo = "SELECT * FROM t_penyakit limit 1";
                                $rcombo = mysqli_query($mysqli, $qcombo);
                                $dpenyakit = mysqli_fetch_assoc($rcombo);
                                ?>
                                <input type="hidden" name="kode_penyakit" value="<?= $dpenyakit['kode_penyakit'] ?>">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="kode_gejala">Gejala</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="kode_gejala" id="kode_gejala" required>
                                            <option selected="selected">-Pilih Gejala-</option>
                                            <?php
                                            $qcombo = "SELECT * FROM t_gejala";
                                            $rcombo = mysqli_query($mysqli, $qcombo);
                                            while ($dcombo = mysqli_fetch_assoc($rcombo)) {
                                                echo "<option value=$dcombo[kode_gejala]>$dcombo[nm_gejala]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="cf">CF</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="cf" id="cf" required />
                                    </div>
                                </div>

                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                                        <button type="reset" name="reset" class="btn btn-danger">Batal</button>
                                        <button type="button" name="kembali" class="btn btn-info"
                                            onclick="window.location='adminmainapp.php?unit=dbp_unit&act=datagrid'">Kembali</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../admin/footer.php"; ?>
        <?php break;

    // Input
    case "inputact":
        $kode_penyakit = $_POST['kode_penyakit'];
        $kode_gejala = $_POST['kode_gejala'];
        $cf = $_POST['cf'];
        $qinput = "INSERT INTO t_diagnosa (kode_penyakit, kode_gejala, cf_gejala) VALUES ('$kode_penyakit', '$kode_gejala', '$cf')";
        $cek = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM t_diagnosa WHERE kode_penyakit = '$kode_penyakit' and kode_gejala = '$kode_gejala'"));
        if ($cek > 0) {
            echo "<script>alert('Penyakit dengan gejala tersebut sudah ada'); document.location='adminmainapp.php?unit=dbp_unit&act=input';</script>";
        } else {
            mysqli_query($mysqli, $qinput) or die(mysqli_error($mysqli));
            echo "<script>alert('Data Tersimpan'); document.location='adminmainapp.php?unit=dbp_unit&act=datagrid';</script>";
            exit();
        }
        break;
    // Update
    case "update":
        $kd_diagnosa = $_GET['kd_diagnosa'];
        $qupdate = "SELECT * FROM t_diagnosa WHERE kd_diagnosa = '$kd_diagnosa'";
        $rupdate = mysqli_query($mysqli, $qupdate);
        $dupdate = mysqli_fetch_assoc($rupdate);
        ?>
        <?php include "../admin/leftbar.php"; ?>
        <div class="main-content">
            <div class="main-content-inner">
                <?php
                include "../admin/component/breadcrumb.php";
                ?>

                <div class="page-content">
                    <div class="page-header">
                        <h1>Edit Data Basis Pengetahuan</h1>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <form class="form-horizontal" name="tambah_subkat" id="tambah_subkat" method="post"
                                action="?unit=dbp_unit&act=updateact" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right">Kode Data Basis Pengetahuan</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="kd_diagnosa" id="kd_diagnosa"
                                            required="required" value="<?php echo $dupdate['kd_diagnosa'] ?>" readonly="" />
                                    </div>
                                </div>
                                <?php
                                $qcombo = "SELECT * FROM t_penyakit limit 1";
                                $rcombo = mysqli_query($mysqli, $qcombo);
                                $dpenyakit = mysqli_fetch_assoc($rcombo);
                                ?>
                                <input type="hidden" name="kode_penyakit" value="<?= $dpenyakit['kode_penyakit'] ?>">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="kode_gejala">Gejala</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="kode_gejala" id="kode_gejala" required>
                                            <?php
                                            $qcombo = "SELECT * FROM t_gejala";
                                            $rcombo = mysqli_query($mysqli, $qcombo);
                                            while ($dcombo = mysqli_fetch_assoc($rcombo)) {
                                                if ($dcombo['kode_gejala'] == $dupdate['kode_gejala']) {
                                                    echo "<option value=$dcombo[kode_gejala] selected=selected>$dcombo[nm_gejala]</option>";
                                                } else {
                                                    echo "<option value=$dcombo[kode_gejala]>$dcombo[nm_gejala]</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="cf">CF</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="cf" id="cf"
                                            value="<?php echo $dupdate['cf_gejala'] ?>" required />
                                    </div>
                                </div>

                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                                        <button type="reset" name="reset" class="btn btn-danger">Batal</button>
                                        <button type="button" name="kembali" class="btn btn-info"
                                            onclick="window.location='adminmainapp.php?unit=dbp_unit&act=datagrid'">Kembali</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../admin/footer.php"; ?>
        </body>

        </html>
        <?php break;
    // Update
    case "updateact":
        $kd_diagnosa = $_POST['kd_diagnosa'];
        $kode_penyakit = $_POST['kode_penyakit'];
        $kode_gejala = $_POST['kode_gejala'];
        $cf = $_POST['cf'];
        $qinput = "UPDATE t_diagnosa SET kode_penyakit= '$kode_penyakit', kode_gejala = '$kode_gejala', cf_gejala = '$cf' WHERE kd_diagnosa = '$kd_diagnosa'";
        $rinput = mysqli_query($mysqli, $qinput) or die(mysqli_error($mysqli));
        header("location:?unit=dbp_unit&act=datagrid");
        break;

    // Delete
    case "delete":
        $kd_diagnosa = $_GET['kd_diagnosa'];
        $qdelete = "DELETE FROM t_diagnosa WHERE kd_diagnosa = '$kd_diagnosa'";
        $rdelete = mysqli_query($mysqli, $qdelete);
        header("location:?unit=dbp_unit&act=datagrid");
        break;
}
?>