<?php
include("../config/conn.php");
include("pengecekan.php");
$sql = "SELECT * FROM PRODUCT";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Table</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
    }

    .table-container {
      max-width: 900px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      text-align: left;
      padding: 10px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #0e1c36;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #e0e0e0;
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
      margin-left: 250px;
      padding: 20px;
    }
  </style>
</head>

<body>
<?php include('sidebar.php'); ?>

    <div class="content">
        <div class="table-container">
            <h1>Lihat Produk</h1>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Stok</th>
                        <th>Branch_Owner</th>
                        <th>DBLink</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        while ($row = oci_fetch_assoc($stmt)) {
                            echo "<tr>";
                            echo "<td>" . $row["PRODUCT_ID"] . "</td>";
                            echo "<td>" . $row["Name"] . "</td>";
                            echo "<td>" . $row["Type"] . "</td>";
                            echo "<td>" . $row["PRICE"] . "</td>";
                            echo "<td>" . $row["STOK"] . "</td>";
                            echo "<td>" . $row["BRANCH_OWNER"] . "</td>";
                            echo "<td>" . $row["DBLINK"] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
  
</body>

</html>