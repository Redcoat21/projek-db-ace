<?php
session_start();
if(!isset($_SESSION["employeeid"]) || $_SESSION["employeeid"] == ""){
    $_SESSION["username"] = "system";
    $_SESSION["password"] = "proyekdd";
    $_SESSION["employeeid"] = "";
    $_SESSION["jabatan"] = "";
}
$conn = oci_connect($_SESSION["username"],$_SESSION["password"],"//localhost/ACEHARD");
if(!$conn){
    echo "Tidak bisa konek database!!";
}
?>