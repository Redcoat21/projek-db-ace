<?php
include("../config/conn.php");
$sql = "SELECT * FROM PRODUCT";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);

// Menampilkan data dalam bentuk tabel
echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<thead>";
echo "<tr>";
echo "<th>Product ID</th>";
echo "<th>Name</th>";
echo "<th>Type</th>";
echo "<th>Price</th>";
echo "<th>Stok</th>";
echo "<th>Branch_Owner</th>";
echo "<th>DBLink</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row["PRODUCT_ID"] . "</td>";
    echo "<td>" . $row["Name"] . "</td>";
    echo "<td>" . $row["Type"] . "</td>";
    echo "<td>" . $row["PRICE"] . "</td>";
    echo "<td>" . $row["STOK"] . "</td>";
    echo "<td>" . $row["BRANCH_OWNER"] . "</td>";
    echo "<td>" . $row["DBLINK"] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>