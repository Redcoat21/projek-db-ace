<?php
include("../config/conn.php");
include("pengecekan.php");
$sql = 'SELECT ht.HTRANS_ID as hid, ht.TRANSACTION_DATE as datee, e."Name" as emplonama, c."Name" as custnama, ht.TOTAL as totale FROM HTRANS ht, employee e, customer c where ht.employee_id = e.employee_id and c.customer_id = c.customer_id';
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);

// Menampilkan data dalam bentuk tabel
echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<thead>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Date</th>";
echo "<th>Employe</th>";
echo "<th>Customer</th>";
echo "<th>List Produk</th>";
echo "<th>Total</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
while ($row = oci_fetch_assoc($stmt)) {
    $lproduk = "";
    $sqle = 'SELECT * FROM DTRANS dt, product p where dt.product_id = p.product_id and dt.htrans_id = :htid';
    $stmte = oci_parse($conn, $sqle);
    oci_bind_by_name($stmte, ":htid", $row["HID"]);
    oci_execute($stmte);
    while($roww = oci_fetch_assoc($stmte)){
        $lproduk.='<li>'.$roww["Name"].' (x'.$roww["QUANTITY"].')</li>';
    }
    echo "<tr>";
    echo "<td>" . $row["HID"] . "</td>";
    echo "<td>" . $row["DATEE"] . "</td>";
    echo "<td>" . $row["EMPLONAMA"] . "</td>";
    echo "<td>" . $row["CUSTNAMA"] . "</td>";
    echo "<td><ul>" . $lproduk . "</ul></td>";
    echo "<td>" . $row["TOTALE"] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>