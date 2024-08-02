<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Login User</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script>
    function validasi(form) {
      if (form.nm_pengguna.value == "" && form.password.value == "") {
        alert("Silakan Masukan Nama Pengguna Dan Password Anda");
        form.nm_pengguna.focus();
        return false;
      }
      if (form.nm_pengguna.value == "") {
        alert("Silakan Masukan Nama Pengguna Anda");
        form.nm_pengguna.focus();
        return false;
      }
      if (form.password.value == "") {
        alert("Silakan Masukan Password Anda");
        form.password.focus();
        return false;
      }
      return true;
    }
  </script>
</head>

<body class="bg-blue-100 flex items-center justify-center h-screen">
  <div class="w-full max-w-md">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="loginnaction.php"
      onsubmit="return validasi(this)">
      <h2 class="mb-4 text-2xl font-bold text-center">Cina dilarang login!</h2>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="nm_pengguna">
          Nama Pengguna
        </label>
        <input
          class="text-sm custom-input w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm transition duration-300 ease-in-out transform focus:-translate-y-1 focus:outline-none hover:shadow-lg hover:border-blue-300 bg-gray-100" id="nm_pengguna" type="text" name="nm_pengguna"
          placeholder="Nama Pengguna" autofocus>
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
          Password
        </label>
        <input
          class="text-sm custom-input w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm transition duration-300 ease-in-out transform focus:-translate-y-1 focus:outline-blue-200 hover:shadow-lg hover:border-blue-300 bg-gray-100"
          id="password" type="password" name="password" placeholder="Kata Sandi">
      </div>
      <div class="flex items-center justify-between">
        <button
          class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in"
          type="submit">
          Log in
        </button>
        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
          Forgot password?
        </a>
      </div>
      <div class="mt-4 text-center">
        <a class="inline-block align-baseline font-bold text-sm text-blue-500 transition duration-300 ease-in-out  hover:text-red-500 " href="#">
          Keluar?
        </a>
      </div>
    </form>
    <p class="text-center text-gray-500 text-xs">
      &copy;2024 Bambang Inc. All rights reserved.
    </p>
  </div>
</body>

</html>