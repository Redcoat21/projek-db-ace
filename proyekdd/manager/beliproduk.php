<?php
include("../config/conn.php");
// include("pengecekan.php");
if(isset($_POST["cabangnya"])){
    $datacabang = explode("#",$_POST["cabangnya"]);
    $dblink = strtolower($datacabang[1]);
    $branch_owners = strtolower($datacabang[0]);
    $product_idd = $_POST["produk"];
    $subtotal = $_POST["qty"];
    $sql = "BEGIN system.BoughtProductFromOtherBranch(:dblink,:branch_owners,:product_idd,:subtotal); END;";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ":dblink", $dblink);
    oci_bind_by_name($stmt, ":branch_owners", $branch_owners);
    oci_bind_by_name($stmt, ":product_idd", $product_idd);
    oci_bind_by_name($stmt, ":subtotal", $subtotal);
    oci_execute($stmt);
}
$sql = "SELECT * FROM branch";
$branch2 = oci_parse($conn, $sql);
oci_execute($branch2);
$branche22 = oci_fetch_assoc($branch2);
$dblinke = strtolower($branche22["DBLINK"]);
$sql = "SELECT * FROM system.productFromAllBranch where DBLINK = :dblinke";
$produk = oci_parse($conn, $sql);
oci_bind_by_name($produk, ":dblinke", $dblinke);
oci_execute($produk);
$sql = "SELECT * FROM system.branch";
$branch = oci_parse($conn, $sql);
oci_execute($branch);
?>
<form method="POST">
    <select name="cabangnya">
        <?php
        while($row = oci_fetch_assoc($branch)){
            ?>
            <option value="<?= $row["BRANCH_NAME"] ?>#<?= $row["DBLINK"] ?>"><?= $row["Address"] ?></option>
            <?php
        }
        ?>
    </select>
    <select name="produk">
        <?php
            while($row = oci_fetch_assoc($produk)){
                ?>
                <option value="<?= $row["PRODUCT_ID"] ?>"><?= $row["Name"] ?> (<?= $row["STOK"] ?>)</option>
                <?php
            }
        ?>
    </select>
    <input type="number" name="qty" placeholder="Qty">
    <input type="submit" value="Beli">
</form>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      display: flex;
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
    }

    .sidebar {
      width: 250px;
      background-color: #0e1c36;
      color: white;
      height: 100vh;
      position: fixed;
      padding: 20px;
    }

    .sidebar h3 {
      text-align: center;
      margin-bottom: 20px;
    }

    .sidebar a {
      display: block;
      color: white;
      text-decoration: none;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 10px;
      transition: background-color 0.3s;
    }

    .sidebar a:hover {
      background-color: #1a2b4c;
    }

    .content {
      margin-left: 260px;
      padding: 40px;
      width: 100%;
    }

    .form-container {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: 0 auto;
    }

    .form-container h1 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #333;
      text-align: center;
    }

    .form-container select,
    .form-container input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-container input[type="submit"] {
      background-color: #0e1c36;
      color: white;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .form-container input[type="submit"]:hover {
      background-color: #1a2b4c;
    }

    label {
      font-weight: bold;
      margin-bottom: 5px;
      display: inline-block;
    }
  </style>
</head>

<body>
  <?php include('sidebar.php'); ?>

  <div class="content">
    <div class="form-container">
      <h1>Tambah Produk</h1>
      <form method="POST">
        <label for="cabangnya">Pilih Cabang:</label>
        <select name="cabangnya" id="cabangnya" required>
          <?php 
            while ($row = oci_fetch_assoc($branch)) { 
                ?>
                <option value="<?= $row["BRANCH_NAME"] ?>#<?= $row["DBLINK"] ?>">
                <?= $row["Address"] ?>
                </option>
          <?php } ?>
        </select>

        <label for="produk">Pilih Produk:</label>
        <select name="produk" id="produk" required>
          <?php while ($row = oci_fetch_assoc($produk)) { ?>
            <option value="<?= $row["PRODUCT_ID"] ?>">
              <?= $row["Name"] ?> (Stok: <?= $row["STOK"] ?>)
            </option>
          <?php } ?>
        </select>

        <label for="qty">Jumlah:</label>
        <input type="number" name="qty" id="qty" placeholder="Qty" required min="1">

        <input type="submit" value="Beli">
      </form>
    </div>
  </div>
</body>

</html>