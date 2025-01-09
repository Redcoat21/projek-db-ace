<!-- <?php
// include("../config/conn.php");
// if(isset($_POST["username"])){
//     $username = $_POST["username"];
//     $password = $_POST["password"];
//     $name = $_POST["name"];
//     $address = $_POST["address"];
//     $contact = $_POST["contact"];
//     $age = $_POST["age"];
//     $salary = $_POST["salary"];
//     $position = $_POST["position"];
//     $sql = "BEGIN system.insertEmployee(:username,:password,:name,:address,:contact,:age,:salary,:position); END;";
//     $stmt = oci_parse($conn, $sql);
//     oci_bind_by_name($stmt, ":username", $username);
//     oci_bind_by_name($stmt, ":password", $password);
//     oci_bind_by_name($stmt, ":name", $name);
//     oci_bind_by_name($stmt, ":address", $address);
//     oci_bind_by_name($stmt, ":contact", $contact);
//     oci_bind_by_name($stmt, ":age", $age);
//     oci_bind_by_name($stmt, ":salary", $salary);
//     oci_bind_by_name($stmt, ":position", $position);
//     oci_execute($stmt);
// }
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Employee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <style>
    body {
      display: flex;
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
      margin-left: 250px;
      padding: 20px;
      width: 100%;
    }

    .form-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: 30px auto;
    }

    .form-container h1 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #333;
      text-align: center;
    }

    .form-container input[type="text"],
    .form-container select,
    .form-container input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-container select {
      padding: 12px 10px;
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

    /* Input labels */
    label {
      font-weight: bold;
      margin-bottom: 5px;
      display: inline-block;
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
    <div class="form-container">
      <h1>Tambah Employee</h1>
      <form method="POST">
        <div class="mb-3">
          <label for="username">Username</label>
          <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="mb-3">
          <label for="password">Password</label>
          <input type="text" name="password" placeholder="Password" required>
        </div>
        <div class="mb-3">
          <label for="name">Name</label>
          <input type="text" name="name" placeholder="Name" required>
        </div>
        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" name="address" placeholder="Address" required>
        </div>
        <div class="mb-3">
          <label for="contact">Contact</label>
          <input type="text" name="contact" placeholder="Contact" required>
        </div>
        <div class="mb-3">
          <label for="age">Age</label>
          <input type="text" name="age" placeholder="Age" required>
        </div>
        <div class="mb-3">
          <label for="salary">Salary</label>
          <input type="text" name="salary" placeholder="Salary" required>
        </div>
        <div class="mb-3">
          <label for="position">Position</label>
          <select name="position" required>
            <option value="manager">Manager</option>
            <option value="staff">Staff</option>
          </select>
        </div>
        <input type="submit" value="Simpan Data">
      </form>
    </div>
  </div>
</body>

</html>