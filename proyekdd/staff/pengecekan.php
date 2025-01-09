<?php
if(!isset($_SESSION["employeeid"]) || $_SESSION["employeeid"] == "" || $_SESSION["jabatan"] != "staff"){
    header("location:../login.php");
}
?>