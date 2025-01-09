<?php
if(!isset($_SESSION["employeeid"]) || $_SESSION["employeeid"] == "" || $_SESSION["jabatan"] != "manager"){
    header("location:../login.php");
}
?>