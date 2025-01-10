<?php
include("../config/conn.php");
// include("pengecekan.php");
if(isset($_POST["cabangnya"])){
    $datacabang = explode("#",$_POST["cabangnya"]);
    $dblink = strtolower($datacabang[1]);
    $branch_owners = strtolower($datacabang[0]);
    $product_idd = $_POST["produk"];
    $subtotal = $_POST["qty"];
    $sql = "BEGIN system.BoughtProductFromOtherBranch(:dblink,:branch_owners,:product_idd,:subtotal); END;";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ":dblink", $dblink);
    oci_bind_by_name($stmt, ":branch_owners", $branch_owners);
    oci_bind_by_name($stmt, ":product_idd", $product_idd);
    oci_bind_by_name($stmt, ":subtotal", $subtotal);
    oci_execute($stmt);
}
$sql = "SELECT * FROM branch";
$branch2 = oci_parse($conn, $sql);
oci_execute($branch2);
$branche22 = oci_fetch_assoc($branch2);
$dblinke = strtolower($branche22["DBLINK"]);
$sql = "SELECT * FROM system.productFromAllBranch where DBLINK = :dblinke";
$produk = oci_parse($conn, $sql);
oci_bind_by_name($produk, ":dblinke", $dblinke);
oci_execute($produk);
$sql = "SELECT * FROM system.branch";
$branch = oci_parse($conn, $sql);
oci_execute($branch);
?>
<form method="POST">
    <select name="cabangnya">
        <?php
        while($row = oci_fetch_assoc($branch)){
            ?>
            <option value="<?= $row["BRANCH_NAME"] ?>#<?= $row["DBLINK"] ?>"><?= $row["Address"] ?></option>
            <?php
        }
        ?>
    </select>
    <select name="produk">
        <?php
            while($row = oci_fetch_assoc($produk)){
                ?>
                <option value="<?= $row["PRODUCT_ID"] ?>"><?= $row["Name"] ?> (<?= $row["STOK"] ?>)</option>
                <?php
            }
        ?>
    </select>
    <input type="number" name="qty" placeholder="Qty">
    <input type="submit" value="Beli">
</form>