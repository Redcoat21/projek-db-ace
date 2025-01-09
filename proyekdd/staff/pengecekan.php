<?php
if($_SESSION["employeeid"] == "" || $_SESSION["jabatan"] != "staff"){
    header("location:../index.php");
}
?>