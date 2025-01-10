<?php
include("../config/conn.php");
include("pengecekan.php");
if(isset($_POST["nama_produk"])){
    $id_produk = $_POST["id_produk"];
    $nama_produk = $_POST["nama_produk"];
    $tipe_produk = $_POST["tipe_produk"];
    $harga_produk = $_POST["harga_produk"];
    $stok_produk = $_POST["stok_produk"];
    $sql = 'update product set "Name" = :nama_produk, PRICE = :harga_produk, STOK = :stok_produk where product_id = :id_produk';
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ":nama_produk", $nama_produk);
    oci_bind_by_name($stmt, ":harga_produk", $harga_produk);
    oci_bind_by_name($stmt, ":stok_produk", $stok_produk);
    oci_bind_by_name($stmt, ":id_produk", $id_produk);
    oci_execute($stmt);
}
if(isset($_GET["id"])){
    $id_produk = $_GET["id"];
    $sql = "SELECT * FROM PRODUCT WHERE product_id = '".$id_produk."'";
    $stmt = oci_parse($conn, $sql);
    oci_execute($stmt);
    $row = oci_fetch_assoc($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    .sidebar {
      width: 250px;
      background-color: #0e1c36;
      color: #fff;
      height: 100vh;
      position: fixed;
      padding: 20px;
    }

    .sidebar h3 {
      text-align: center;
      color: #fff;
    }

    .sidebar a {
      color: #fff;
      text-decoration: none;
      display: block;
      padding: 15px;
      margin-bottom: 10px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .sidebar a:hover {
      background-color: #1a2b4c;
    }

    .content {
      margin-left: 170px;
      padding: 20px;
      width: 100%;
    }

    .form-container {
      background-color: #fff;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: 0 auto;
    }

    .form-container h1 {
      font-size: 28px;
      margin-bottom: 30px;
      color: #333;
      text-align: center;
    }

    .form-container input[type="text"],
    .form-container input[type="number"],
    .form-container input[type="submit"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-container input[type="submit"] {
      background-color: #0e1c36;
      color: #fff;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .form-container input[type="submit"]:hover {
      background-color: #1a2b4c;
    }

    label {
      font-weight: bold;
      margin-bottom: 8px;
      display: block;
    }

    .form-container input[type="text"]:focus,
    .form-container input[type="number"]:focus {
      border-color: #0e1c36;
      outline: none;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 200px;
      }

      .content {
        margin-left: 200px;
      }
    }
  </style>
</head>

<body>

<?php include('sidebar.php'); ?>

  <div class="content">
    <div class="form-container">
        <h1>Edit Produk</h1>
        <form method="POST">
            <input type="text" name="id_produk" value="<?= $_GET["id"] ?>" hidden>
            <label for="nama_produk">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" value="<?= htmlspecialchars($row["Name"]) ?>" required>
            
            <label for="tipe_produk">Tipe Produk</label>
            <input type="text" id="tipe_produk" name="tipe_produk" value="<?= htmlspecialchars($row["Type"]) ?>" required>
            
            <label for="harga_produk">Harga Produk</label>
            <input type="number" id="harga_produk" name="harga_produk" value="<?= htmlspecialchars($row["PRICE"]) ?>" required>
            
            <label for="stok_produk">Stok Produk</label>
            <input type="number" id="stok_produk" name="stok_produk" value="<?= htmlspecialchars($row["STOK"]) ?>" required>

            <input type="submit" value="Simpan">
        </form>
    </div>
  </div>

</body>

</html>
