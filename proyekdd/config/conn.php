<?php
session_start();
if(!isset($_SESSION["employeeid"]) || $_SESSION["employeeid"] == ""){
    $_SESSION["username"] = "system";
    $_SESSION["password"] = "viery";
    $_SESSION["employeeid"] = "";
    $_SESSION["jabatan"] = "";
}
$conn = oci_connect($_SESSION["username"],$_SESSION["password"],"//localhost/LEONKENNEDY");
if(!$conn){
    echo "Tidak bisa konek database!!";
}
?>