<?php
include("../config/conn.php");
if(isset($_POST["name"])){
    $name = $_POST["name"];
    $type = $_POST["type"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $sql = "BEGIN system.INSERTTOPRODUCTUSINGSCHEDULER(:name, :type, :price, :stock); END;";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ":name", $name);
    oci_bind_by_name($stmt, ":type", $type);
    oci_bind_by_name($stmt, ":price", $price);
    oci_bind_by_name($stmt, ":stock", $stock);
    oci_execute($stmt);
}
?>
<form method="POST">
    <input type="text" name="name" placeholder="Nama Produk">
    <input type="text" name="type" placeholder="Type Produk">
    <input type="text" name="price" placeholder="Harga Produk">
    <input type="text" name="stock" placeholder="Stok Produk">
    <input type="submit" value="Save">
</form>