<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penyakit</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 z-0">
    <?php
    session_start();
    require_once '../lib/koneksi.php';
    include ("../admin/leftbar.php");

    $act = $_GET['act'];
    switch ($act) {
        case "datagrid":
            ?>
            <div class="p-6">
            <?php
                include "../admin/component/breadcrumb.php";
                ?>

                <!-- Header -->
                <div class="bg-white shadow-md rounded my-6">
                    <div class="px-6 py-4 flex justify-between items-center border-b border-gray-200">
                        <h2 class="text-xl font-semibold mx-4">Data Penyakit</h2>
                    </div>
                    <div class="p-4">
                        <!-- <?php
                        $data = mysqli_query($mysqli, "SELECT * FROM t_tentangpenyakit LIMIT 1");
                        $data = mysqli_fetch_assoc($data);
                        ?> -->
                        <div action="" class="grid grid-cols-2 grid-rows-1 gap-1 mx-6">
                            <a class="text-xl font-bold">Nama Penyakit</a>
                            <p class="text-md"><?= $data['nm_tentangpenyakit'] ?></p>
                            <p class="text-xl font-bold">Detail</p>
                            <a class="text-md"><?= $data['det_tentangpenyakit'] ?></a>
                            <p class="text-xl font-bold">Saran</p>
                            <a class="text-md"><?= $data['srn_tentangpenyakit'] ?></a>
                        </div>
                        <a href="?unit=tentangpenyakit_unit&act=update&kd_tentangpenyakit=<?= $data['kd_tentangpenyakit'] ?>"
                            class="bg-yellow-400 text-white px-4 py-2 rounded-md mt-4 inline-block shadow-md">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
            <?php
            break;

        case "update":
            $kd_tentangpenyakit = $_GET['kd_tentangpenyakit'];
            $qupdate = "SELECT * FROM t_tentangpenyakit WHERE kd_tentangpenyakit = '$kd_tentangpenyakit'";
            $rupdate = mysqli_query($mysqli, $qupdate);
            $dupdate = mysqli_fetch_assoc($rupdate);
            ?>
            <div class="p-6">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="px-6 py-4 border-b">
                        <h2 class="text-xl font-semibold">Edit Data Penyakit</h2>
                    </div>
                    <div class="p-4">
                        <form class="space-y-4" method="post" action="adminmainapp.php?unit=tentangpenyakit_unit&act=updateact">
                            <input type="hidden" name="kd_tentangpenyakit" id="kd_tentangpenyakit"
                                value="<?= $dupdate['kd_tentangpenyakit'] ?>" readonly />
                            <div>
                                <label for="nm_tentangpenyakit" class="block text-gray-700">Nama Penyakit</label>
                                <input type="text" name="nm_tentangpenyakit" id="nm_tentangpenyakit" required
                                    value="<?= $dupdate['nm_tentangpenyakit'] ?>"
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-300" />
                            </div>
                            <div>
                                <label for="det_tentangpenyakit" class="block text-gray-700">Detail Tentang Penyakit</label>
                                <textarea name="det_tentangpenyakit" id="det_tentangpenyakit"
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-300"><?= $dupdate['det_tentangpenyakit'] ?></textarea>
                            </div>
                            <div>
                                <label for="srn_tentangpenyakit" class="block text-gray-700">Saran Tentang Penyakit</label>
                                <textarea name="srn_tentangpenyakit" id="srn_tentangpenyakit"
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-300"><?= $dupdate['srn_tentangpenyakit'] ?></textarea>
                            </div>
                            <div class="flex space-x-4">
                                <button type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Simpan</button>
                                <button type="reset"
                                    class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Batal</button>
                                <button type="button"
                                    onclick="window.location='adminmainapp.php?unit=tentangpenyakit_unit&act=datagrid'"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Kembali</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            break;

        case "updateact":
            $kd_tentangpenyakit = $_POST['kd_tentangpenyakit'];
            $nm_tentangpenyakit = $_POST['nm_tentangpenyakit'];
            $det_tentangpenyakit = $_POST['det_tentangpenyakit'];
            $srn_tentangpenyakit = $_POST['srn_tentangpenyakit'];
            $qupdate = "
                UPDATE t_tentangpenyakit SET
                    nm_tentangpenyakit = '$nm_tentangpenyakit',
                    det_tentangpenyakit = '$det_tentangpenyakit',
                    srn_tentangpenyakit = '$srn_tentangpenyakit'
                WHERE kd_tentangpenyakit = '$kd_tentangpenyakit'
            ";
            $rupdate = mysqli_query($mysqli, $qupdate) or die(mysqli_error($mysqli));
            header("location:adminmainapp.php?unit=tentangpenyakit_unit&act=datagrid");
            break;
    }
    ?>


</body>

</html>