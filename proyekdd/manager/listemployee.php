<?php
include("../config/conn.php");
include("pengecekan.php");
$sql = "SELECT * FROM system.employee";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);
if(isset($_POST["action"])){
    $username = $_POST["username"];
    if($_POST["action"] == "delete"){
        $sql = "BEGIN system.deleteEmployee(:username); END;";
    }else{
        $sql = "BEGIN system.restoreEmployee(:username); END;";
    }
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ":username", $username);
    oci_execute($stmt);
}
?>

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
      font-family: Arial, sans-serif;
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
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    td form {
      display: inline-block;
      margin: 0;
    }

    input[type="submit"] {
      background-color: #0e1c36;
      color: #fff;
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #1a2b4c;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 200px;
      }

      .content {
        margin-left: 200px;
      }

      .table-container {
        padding: 15px;
      }
    }
  </style>
</head>

<body>

<?php include('sidebar.php'); ?>

  <div class="content">
    <div class="table-container">
      <h1>Employee Data</h1>
      <table>
        <thead>
          <tr>
            <th>Employee ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Age</th>
            <th>Salary</th>
            <th>Position</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php

            while ($row = oci_fetch_assoc($stmt)) {
              echo "<tr>";
              echo "<td>" . $row["EMPLOYEE_ID"] . "</td>";
              echo "<td>" . $row["USERNAME"] . "</td>";
              echo "<td>" . $row["Name"] . "</td>";
              echo "<td>" . $row["Address"] . "</td>";
              echo "<td>" . $row["Contact"] . "</td>";
              echo "<td>" . $row["AGE"] . "</td>";
              echo "<td>" . $row["SALARY"] . "</td>";
              echo "<td>" . $row["POSITION"] . "</td>";
              if($row["IS_DELETED"]){
                  echo "<td>
                  <form method='post'>
                  <input type='text' name='username' value='".$row["USERNAME"]."' hidden>
                  <input type='text' name='action' value='restore' hidden>
                  <input type='submit' value='Restore'>
                  </form>
                  </td>";
              }else{
                  echo "<td>
                  <form method='post'>
                  <input type='text' name='username' value='".$row["USERNAME"]."' hidden>
                  <input type='text' name='action' value='delete' hidden>
                  <input type='submit' value='Delete'>
                  </form>
                  </td>";
              }
              echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</body>

</html>

