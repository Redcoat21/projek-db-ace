<?php
session_start();
$_SESSION["employeeid"] = "EMP003";
if(!isset($_SESSION["employeeid"]) || $_SESSION["employeeid"] == ""){
    $_SESSION["username"] = "system";
    $_SESSION["password"] = "viery";
}
$conn = oci_connect("system","viery","//localhost/LEONKENNEDY");
if(!$conn){
    echo "Tidak bisa konek database!!";
}
?>