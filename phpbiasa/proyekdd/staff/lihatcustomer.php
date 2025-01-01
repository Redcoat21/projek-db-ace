<?php
include("../config/conn.php");
$sql = "SELECT * FROM CUSTOMER";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);

// Menampilkan data dalam bentuk tabel
echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<thead>";
echo "<tr>";
echo "<th>Customer ID</th>";
echo "<th>Name</th>";
echo "<th>Contact</th>";
echo "<th>Address</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row["CUSTOMER_ID"] . "</td>";
    echo "<td>" . $row["Name"] . "</td>";
    echo "<td>" . $row["CONTACT"] . "</td>";
    echo "<td>" . $row["Address"] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>