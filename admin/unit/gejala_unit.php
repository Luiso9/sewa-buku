<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gejala</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <?php
    include "../admin/leftbar.php";
    $act = $_GET['act'];

    switch ($act) {
        case "datagrid":
            ?>
            <div class="p-6">
            <?php
            include "../admin/component/breadcrumb.php";
            ?>

            <div class="my-4 bg-white rounded">
                <div class="mx-auto px-6 py-4 w-full flex justify-between items-center border-b mb-4 shadow-md rounded-l border-black mx-6">
                    <h2 class="xl:text-xl text-mdd font-semibold">Data Penyewaan Buku</h2>
                    <a href="?unit=gejala_unit&act=input" class="bg-green-500 text-white px-4 py-2 rounded">Tambah Data</a>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-xl md:text-md text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class=" bg-green-900">
                            <tr class="w-full text-white bg-green-900 text-left border-b border-gray-200">
                                <th class="px-4 py-2">No.</th>
                                <th class="px-4 py-2">Kode Buku</th>
                                <th class="px-4 py-2">Nama Buku</th>
                                <th class="px-4 py-2">Dipinjam</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qdatagrid = "SELECT * FROM t_gejala";
                            $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                            $i = 1;
                            while ($ddatagrid = mysqli_fetch_array($rdatagrid)) {
                                ?>
                                <tr class="hover:bg-gray-100 border-b border-gray-200">
                                    <td class="px-4 py-2"><?php echo $i++ ?></td>
                                    <td class="px-4 py-2"><?php echo $ddatagrid['kd_gejala'] ?></td>
                                    <td class="px-4 py-2"><?php echo $ddatagrid['nm_gejala'] ?></td>
                                    <td class="px-4 py-2"><?php echo $ddatagrid['pertanyaan'] ?></td>
                                    <td class="px-4 py-2 flex space-x-2">
                                        <a href="?unit=gejala_unit&act=update&kd_gejala=<?php echo $ddatagrid[0] ?>"
                                            class="bg-yellow-400 text-white px-4 py-2 rounded">Edit</a>
                                        <a href="?unit=gejala_unit&act=delete&kd_gejala=<?php echo $ddatagrid[0] ?>"
                                            onclick="return confirm('Apakah anda yakin akan menghapusnya?')"
                                            class="bg-red-500 text-white px-4 py-2 rounded">Delete</a>
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
            </div>
            <?php
            break;

        // Case Input Form Element
        case "input":
            ?>
            <div class="p-6">
                <div class="bg-white shadow-md rounded my-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold">Tambah Gejala</h2>
                    </div>
                    <div class="p-4">
                        <form class="space-y-4" method="post" action="?unit=gejala_unit&act=inputact">
                            <div>
                                <label for="kd_gejala" class="block text-gray-700">Kode Gejala</label>
                                <input type="text" name="kd_gejala" id="kd_gejala" class="w-full px-4 py-2 border rounded"
                                    required>
                            </div>
                            <div>
                                <label for="nm_gejala" class="block text-gray-700">Nama Gejala</label>
                                <input type="text" name="nm_gejala" id="nm_gejala" class="w-full px-4 py-2 border rounded"
                                    required>
                            </div>
                            <div>
                                <label for="pertanyaan" class="block text-gray-700">Pertanyaan</label>
                                <input type="text" name="pertanyaan" id="pertanyaan" class="w-full px-4 py-2 border rounded"
                                    required>
                            </div>
                            <div class="flex space-x-4">
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                                <button type="reset" class="bg-red-500 text-white px-4 py-2 rounded">Batal</button>
                                <button type="button" onclick="window.location='?unit=gejala_unit&act=datagrid'"
                                    class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            break;

        // Case Update button
        case "update":
            $kd_gejala = $_GET['kd_gejala'];
            $qupdate = "SELECT * FROM t_gejala WHERE kd_gejala = '$kd_gejala'";
            $rupdate = mysqli_query($mysqli, $qupdate);
            $dupdate = mysqli_fetch_array($rupdate);
            ?>
            <div class="p-6">
                <div class="bg-white shadow-md rounded my-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold">Update Gejala</h2>
                    </div>
                    <div class="p-4">
                        <form class="space-y-4" method="post" action="?unit=gejala_unit&act=updateact">
                            <div>
                                <label for="kd_gejala" class="block text-gray-700">Kode Gejala</label>
                                <input type="text" name="kd_gejala" id="kd_gejala" class="w-full px-4 py-2 border rounded"
                                    value="<?php echo $dupdate['kd_gejala'] ?>" readonly>
                            </div>
                            <div>
                                <label for="nm_gejala" class="block text-gray-700">Nama Gejala</label>
                                <input type="text" name="nm_gejala" id="nm_gejala" class="w-full px-4 py-2 border rounded"
                                    value="<?php echo $dupdate['nm_gejala'] ?>" required>
                            </div>
                            <div>
                                <label for="pertanyaan" class="block text-gray-700">Pertanyaan</label>
                                <input type="text" name="pertanyaan" id="pertanyaan" class="w-full px-4 py-2 border rounded"
                                    value="<?php echo $dupdate['pertanyaan'] ?>" required>
                            </div>
                            <div class="flex space-x-4">
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                                <button type="reset" class="bg-red-500 text-white px-4 py-2 rounded">Batal</button>
                                <button type="button" onclick="window.location='?unit=gejala_unit&act=datagrid'"
                                    class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            break;

        // Update action buttons
        case "updateact":
            $kd_gejala = $_POST['kd_gejala'];
            $nm_gejala = $_POST['nm_gejala'];
            $pertanyaan = $_POST['pertanyaan'];
            $qupdate = "
              UPDATE t_gejala SET
                nm_gejala = '$nm_gejala',
                pertanyaan = '$pertanyaan'
              WHERE
                kd_gejala = '$kd_gejala'
            ";
            $rupdate = mysqli_query($mysqli, $qupdate) or die(mysqli_error($mysqli));
            header("location:?unit=gejala_unit&act=datagrid");
            break;

        // Case Delete from
        case "delete":
            $kd_gejala = $_GET['kd_gejala'];
            $qdelete = "
              DELETE FROM t_gejala
              WHERE kd_gejala = '$kd_gejala'
            ";

            $rdelete = mysqli_query($mysqli, $qdelete);
            header("location:?unit=gejala_unit&act=datagrid");
            break;
    }
    ?>
</body>

</html>