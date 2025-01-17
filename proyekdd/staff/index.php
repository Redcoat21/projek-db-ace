<?php
include("../config/conn.php");
include("pengecekan.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Staff</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
    }

    .sidebar {
      width: 260px;
      background-color: #343a40;
      color: #fff;
      height: 100vh;
      position: fixed;
      padding: 20px 0;
      display: flex;
      flex-direction: column;
    }

    .sidebar h3 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
    }

    .sidebar a {
      color: #ddd;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 5px;
      margin: 5px 0;
      transition: all 0.3s;
    }

    .sidebar a:hover {
      background-color: #495057;
      color: #fff;
    }

    .content {
      margin-left: 260px;
      padding: 40px;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    .welcome-title {
      color: #495057;
      font-weight: bold;
    }

    .action-buttons a {
      text-decoration: none;
      margin-right: 10px;
    }

    .btn-custom {
      background-color: #343a40;
      color: #fff;
      border: none;
    }

    .btn-custom:hover {
      background-color: #495057;
    }
  </style>
</head>

<body>
<?php include('sidebar.php'); ?>

  <div class="content">
    <div class="card">
      <h1 class="welcome-title">Welcome, Staff</h1>
      <p class="text-muted">Selamat datang di halaman Staff. Silakan gunakan menu di sidebar untuk navigasi.</p>
      <div class="action-buttons mt-4">
        <a href="jualbarang.php" class="btn btn-custom">Jual Barang</a>
        <a href="lihatcustomer.php" class="btn btn-custom">Lihat Customer</a>
        <a href="tambahcustomer.php" class="btn btn-custom">Tambah Customer</a>
      </div>
    </div>
  </div>
</body>

</html>
