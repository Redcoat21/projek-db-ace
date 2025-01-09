<?php
include("config/conn.php");
$_SESSION["username"] = "system";
$_SESSION["password"] = "viery";
$_SESSION["employeeid"] = "";
$_SESSION["jabatan"] = "";
header("location:index.php")
?>