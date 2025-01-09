<?php
include("../config/conn.php");
if(isset($_POST["nama_produk"])){
    $id_produk = $_POST["id_produk"];
    $nama_produk = $_POST["nama_produk"];
    $tipe_produk = $_POST["tipe_produk"];
    $harga_produk = $_POST["harga_produk"];
    $stok_produk = $_POST["stok_produk"];
    $sql = 'update product set "Name" = :nama_produk, PRICE = :harga_produk, STOK = :stok_produk where product_id = :id_produk';
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ":nama_produk", $nama_produk);
    oci_bind_by_name($stmt, ":harga_produk", $harga_produk);
    oci_bind_by_name($stmt, ":stok_produk", $stok_produk);
    oci_bind_by_name($stmt, ":id_produk", $id_produk);
    oci_execute($stmt);
}
if(isset($_GET["id"])){
    $id_produk = $_GET["id"];
    $sql = "SELECT * FROM PRODUCT WHERE product_id = '".$id_produk."'";
    $stmt = oci_parse($conn, $sql);
    oci_execute($stmt);
    $row = oci_fetch_assoc($stmt);
}
?>
<form method="POST">
    <input type="text" name="id_produk" value="<?= $_GET["id"] ?>" hidden>
    <input type="text" name="nama_produk" placeholder="Nama Produk" value="<?= $row["Name"] ?>">
    <br>
    <input type="text" name="tipe_produk" placeholder="Tipe Produk" value="<?= $row["Name"] ?>">
    <br>
    <input type="number" name="harga_produk" placeholder="Harga Produk" value="<?= $row["PRICE"] ?>">
    <br>
    <input type="number" name="stok_produk" placeholder="Stok Produk" value="<?= $row["STOK"] ?>">
    <br>
    <input type="submit" value="Simpan">
</form>