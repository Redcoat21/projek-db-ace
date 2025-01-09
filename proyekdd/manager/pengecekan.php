<?php
if($_SESSION["employeeid"] == "" || $_SESSION["jabatan"] != "manager"){
    header("location:../index.php");
}
?>