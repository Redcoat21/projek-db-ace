<?php
include("../config/conn.php");
include("pengecekan.php");
if(isset($_POST["name"])){
    $name = $_POST["name"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $sql = "BEGIN system.CHECKANDINSERTCUSTOMER(:name, :contact, :address); END;";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ":name", $name);
    oci_bind_by_name($stmt, ":contact", $contact);
    oci_bind_by_name($stmt, ":address", $address);
    oci_execute($stmt);
}
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
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .form-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
    }

    .form-container h1 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      text-align: center;
      color: #343a40;
    }

    .form-container label {
      font-weight: bold;
      margin-bottom: 5px;
      display: block;
      color: #343a40;
    }

    .form-container input[type="text"],
    .form-container input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }

    .form-container input[type="submit"] {
      background-color: #343a40;
      color: #fff;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .form-container input[type="submit"]:hover {
      background-color: #495057;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 200px;
      }

      .content {
        margin-left: 200px;
        padding: 20px;
      }
    }
  </style>
</head>

<body>
<?php include('sidebar.php'); ?>

  <div class="content">
    <div class="form-container">
      <h1>Tambah Customer</h1>
      <form method="POST">
        <div class="mb-3">
          <label for="name">Nama</label>
          <input type="text" id="name" name="name" placeholder="Nama" required>
        </div>
        <div class="mb-3">
          <label for="contact">Kontak</label>
          <input type="text" id="contact" name="contact" placeholder="Kontak" required>
        </div>
        <div class="mb-3">
          <label for="address">Alamat</label>
          <input type="text" id="address" name="address" placeholder="Alamat" required>
        </div>
        <input type="submit" value="Tambah Customer">
      </form>
    </div>
  </div>
</body>

</html>

