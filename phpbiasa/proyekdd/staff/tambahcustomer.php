<?php
include("../config/conn.php");
if(isset($_POST["name"])){
    $name = $_POST["name"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $sql = "BEGIN CHECKANDINSERTCUSTOMER(:name, :contact, :address); END;";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ":name", $name);
    oci_bind_by_name($stmt, ":contact", $contact);
    oci_bind_by_name($stmt, ":address", $address);
    oci_execute($stmt);
}
?>
<form method="POST">
    <input type="text" name="name">
    <input type="text" name="contact">
    <input type="text" name="address">
    <input type="submit" value="submit">
</form>