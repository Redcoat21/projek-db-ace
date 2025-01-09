<?php
session_start();
if(!isset($_SESSION["employeeid"]) || $_SESSION["employeeid"] == ""){
    $_SESSION["username"] = "system";
    $_SESSION["password"] = "viery";
    $_SESSION["employeeid"] = "";
}
$conn = oci_connect("system","viery","//localhost/LEONKENNEDY");
if(!$conn){
    echo "Tidak bisa konek database!!";
}
?>