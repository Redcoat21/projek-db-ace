<?php
include("../config/conn.php");
$sql = "SELECT * FROM INTERBRANCHTRANSACTION it, product p where p.PRODUCT_ID = it.product_id";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);

// Menampilkan data dalam bentuk tabel
echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<thead>";
echo "<tr>";
echo "<th>IBT_ID</th>";
echo "<th>BRANCH_BUYER</th>";
echo "<th>PRODUCT</th>";
echo "<th>QUANTITY</th>";
echo "<th>TOTAL</th>";
echo "<th>DATES</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row["IBT_ID"] . "</td>";
    echo "<td>" . $row["BRANCH_BUYER"] . "</td>";
    echo "<td>" . $row["Name"] . "</td>";
    echo "<td>" . $row["QUANTITY"] . "</td>";
    echo "<td>" . $row["TOTAL"] . "</td>";
    echo "<td>" . $row["DATES"] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>