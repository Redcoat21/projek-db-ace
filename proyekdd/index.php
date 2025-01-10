<?php
include("config/conn.php");
if($_SESSION["employeeid"] != ""){
  header("location:".$_SESSION["jabatan"]."/index.php");
}
if(isset($_POST["username"])){
  $username = $_POST["username"];
  $password = $_POST["password"];
  $sql = "SELECT * FROM employee where username = :username and passwordd = :passwordd";
  $stmt = oci_parse($conn, $sql);
  oci_bind_by_name($stmt, ":username", $username);
  oci_bind_by_name($stmt, ":passwordd", $password);
  oci_execute($stmt);
  $ada = false;
  while($row = oci_fetch_assoc($stmt)){
    $ada = true;
    $_SESSION["employeeid"] = $row["EMPLOYEE_ID"];
    $_SESSION["jabatan"] = $row["POSITION"];
    // $_SESSION["username"] = $username;
    // $_SESSION["password"] = $password;
    $_SESSION["username"] = "system";
    $_SESSION["password"] = "proyekdd";
  }
  if($ada){
    header("location:".$_SESSION["jabatan"]."/index.php");
  }else{
    echo "Username / Password Salah";
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ACE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <style>
    .btn-color {
      background-color: #0e1c36;
      color: #fff;

    }

    .profile-image-pic {
      height: 200px;
      width: 200px;
      object-fit: cover;
    }



    .cardbody-color {
      background-color: #ebf2fa;
    }

    a {
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Login Form</h2>
        <div class="card my-5">

          <form class="card-body cardbody-color p-lg-5" method="POST">
            <div class="text-center">
              <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
            </div>

            <div class="mb-3">
              <input type="text" class="form-control" name="username" id="Username" aria-describedby="emailHelp"
                placeholder="User Name">
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" name="password" id="password" placeholder="password">
            </div>
            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>