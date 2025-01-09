<!-- <?php
// include("../config/conn.php");
// $sql = "SELECT * FROM CUSTOMER";
// $stmt = oci_parse($conn, $sql);
// oci_execute($stmt);

// // Menampilkan data dalam bentuk tabel
// echo "<table border='1' cellpadding='10' cellspacing='0'>";
// echo "<thead>";
// echo "<tr>";
// echo "<th>Customer ID</th>";
// echo "<th>Name</th>";
// echo "<th>Contact</th>";
// echo "<th>Address</th>";
// echo "</tr>";
// echo "</thead>";
// echo "<tbody>";
// while ($row = oci_fetch_assoc($stmt)) {
//     echo "<tr>";
//     echo "<td>" . $row["CUSTOMER_ID"] . "</td>";
//     echo "<td>" . $row["Name"] . "</td>";
//     echo "<td>" . $row["CONTACT"] . "</td>";
//     echo "<td>" . $row["Address"] . "</td>";
//     echo "</tr>";
// }
// echo "</tbody>";
// echo "</table>";
?> -->

<!DOCTYPE html>
<html lang="en">

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
    <div class="sidebar">
        <h3>Staff Panel</h3>
        <a href="lihatproduk.php">Lihat Produk</a>
        <a href="jualbarang.php">Jual Barang</a>
        <a href="lihatcustomer.php">Lihat Customer</a>
        <a href="tambahcustomer.php">Tambah Customer</a>
        <a href="login.html">Logout</a>
    </div>

    <div class="content">
        <div class="table-container">
            <h1>Customer Data</h1>
            <table>
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("../config/conn.php");
                        $sql = "SELECT * FROM CUSTOMER";
                        $stmt = oci_parse($conn, $sql);
                        oci_execute($stmt);

                        while ($row = oci_fetch_assoc($stmt)) {
                            echo "<tr>";
                            echo "<td>" . $row["CUSTOMER_ID"] . "</td>";
                            echo "<td>" . $row["Name"] . "</td>";
                            echo "<td>" . $row["CONTACT"] . "</td>";
                            echo "<td>" . $row["Address"] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                    <!-- Data Dummy -->
                    <!-- <tr>
                        <td>CUST001</td>
                        <td>John Doe</td>
                        <td>+62 812 3456 7890</td>
                        <td>Jl. Merdeka No.1, Jakarta</td>
                    </tr>
                    <tr>
                        <td>CUST002</td>
                        <td>Jane Smith</td>
                        <td>+62 811 9876 5432</td>
                        <td>Jl. Sudirman No.10, Bandung</td>
                    </tr>
                    <tr>
                        <td>CUST003</td>
                        <td>Michael Johnson</td>
                        <td>+62 813 5678 1234</td>
                        <td>Jl. Thamrin No.20, Surabaya</td>
                    </tr>
                    <tr>
                        <td>CUST004</td>
                        <td>Emily Davis</td>
                        <td>+62 812 3456 6543</td>
                        <td>Jl. Diponegoro No.15, Yogyakarta</td>
                    </tr>
                    <tr>
                        <td>CUST005</td>
                        <td>Robert Brown</td>
                        <td>+62 814 1234 5678</td>
                        <td>Jl. Gatot Subroto No.5, Bali</td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
  
</body>

</html>