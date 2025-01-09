<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <style>
    body {
      display: flex;
    }

    .sidebar {
      width: 250px;
      background-color: #0e1c36;
      color: #fff;
      height: 100vh;
      position: fixed;
    }

    .sidebar a {
      color: #fff;
      text-decoration: none;
      display: block;
      padding: 15px;
    }

    .sidebar a:hover {
      background-color: #1a2b4c;
    }

    .content {
      margin-left: 250px;
      padding: 20px;
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <h3 class="text-center py-3">Manager Panel</h3>
    <a href="listproduk.php">List Produk</a>
    <a href="tambahproduk.php">Tambah Produk</a>
    <a href="listemployee.php">List Employee</a>
    <a href="tambahemployee.php">Tambah Employee</a>
    <a href="login.html">Logout</a>
  </div>

  <div class="content">
    <h1>Welcome, Manager</h1>
    <p>Selamat datang di halaman manager. Silakan gunakan menu di sidebar untuk navigasi.</p>
  </div>

</body>

</html>
