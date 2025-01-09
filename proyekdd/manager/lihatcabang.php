<?php
include("../config/conn.php");
include("pengecekan.php");
$sql = "SELECT * FROM branch";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);

// Menampilkan data dalam bentuk tabel
echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<thead>";
echo "<tr>";
echo "<th>Branch Name</th>";
echo "<th>DBLink</th>";
echo "<th>Address</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row["BRANCH_NAME"] . "</td>";
    echo "<td>" . $row["DBLINK"] . "</td>";
    echo "<td>" . $row["Address"] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>