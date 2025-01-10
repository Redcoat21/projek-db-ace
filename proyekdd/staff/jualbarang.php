<?php
include("../config/conn.php");
include("pengecekan.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jual Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
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
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    select,
    input {
      margin: 10px 0;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 100%;
      max-width: 400px;
    }

    input[type="button"],
    input[type="submit"] {
      width: auto;
      background-color: #343a40;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    input[type="button"]:hover,
    input[type="submit"]:hover {
      background-color: #495057;
    }

    .list-produk p {
      margin: 5px 0;
    }

    .list-produk span {
      color: blue;
      cursor: pointer;
      text-decoration: underline;
    }

    .list-produk span:hover {
      color: darkblue;
    }
  </style>
</head>

<body>
  <?php include('sidebar.php'); ?>

  <div class="content">
    <div class="card">
      <h1>Jual Barang</h1>
      <?php

        // Fetch products
        $sql = "SELECT * FROM PRODUCT";
        $produk = oci_parse($conn, $sql);
        oci_execute($produk);

        // Fetch customers
        $sql = "SELECT * FROM customer";
        $customer = oci_parse($conn, $sql);
        oci_execute($customer);

        if (isset($_POST["customer"])) {
            $employee_id = $_SESSION["employeeid"];
            $custid = $_POST["customer"];
            $sql = "BEGIN system.createTransaction(:emploid,:custid); END;";
            $stmt = oci_parse($conn, $sql);
            oci_bind_by_name($stmt, ":emploid", $employee_id);
            oci_bind_by_name($stmt, ":custid", $custid);
            oci_execute($stmt);
        }
      ?>

      <form method="POST">
        <input type="text" name="employee_id" value="<?= $_SESSION["employeeid"] ?>" hidden>

        <label for="customer">Pilih Customer:</label>
        <select name="customer" id="customer">
          <?php while ($row = oci_fetch_assoc($customer)) { ?>
            <option value="<?= $row["CUSTOMER_ID"] ?>"><?= $row["NAME"] ?></option>
          <?php } ?>
        </select>

        <label for="listprod">Pilih Produk:</label>
        <select id="listprod">
          <?php while ($row = oci_fetch_assoc($produk)) { ?>
            <option value="<?= $row["PRODUCT_ID"] ?>"><?= $row["NAME"] ?></option>
          <?php } ?>
        </select>

        <input type="number" placeholder="Quantity" id="qtyprod">
        <input type="button" onclick="tambahproduk()" value="Tambah Produk">

        <div class="list-produk mt-3" id="listproduke"></div>

        <input type="submit" value="Simpan">
      </form>
    </div>
  </div>

  <script>
    function getproduk() {
      $.get("ajax_cart.php?action=view", function (data) {
        const products = JSON.parse(data);
        let html = "";

        products.forEach(product => {
          html += `
            <p>${product.Name} 
              <span onclick="removeproduk('${product.PRODUCT_ID}')">(remove)</span>
            </p>`;
        });

        document.getElementById("listproduke").innerHTML = html;
      });
    }

    function removeproduk(id) {
      $.get(`ajax_cart.php?action=remove&product_id=${id}`, function () {
        getproduk();
      });
    }

    function tambahproduk() {
      const produkid = document.getElementById('listprod').value;
      const qtyprod = document.getElementById("qtyprod").value;

      if (!qtyprod || qtyprod <= 0) {
        alert("Harap masukkan quantity yang valid!");
        return;
      }

      $.get(`ajax_cart.php?action=add&product_id=${produkid}&qty=${qtyprod}`, function () {
        getproduk();
      });
    }

    // Load initial products
    getproduk();
  </script>
</body>

</html>
