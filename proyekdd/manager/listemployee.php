<?php
include("../config/conn.php");
$sql = "SELECT * FROM employee";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);
if(isset($_POST["action"])){
    $username = $_POST["username"];
    if($_POST["action"] == "delete"){
        $sql = "BEGIN system.deleteEmployee(:username); END;";
    }else{
        $sql = "BEGIN system.restoreEmployee(:username); END;";
    }
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ":username", $username);
    oci_execute($stmt);
}
// Menampilkan data dalam bentuk tabel
echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<thead>";
echo "<tr>";
echo "<th>Employee ID</th>";
echo "<th>Username</th>";
echo "<th>Name</th>";
echo "<th>Address</th>";
echo "<th>Contact</th>";
echo "<th>Age</th>";
echo "<th>Salary</th>";
echo "<th>Position</th>";
echo "<th>Action</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row["EMPLOYEE_ID"] . "</td>";
    echo "<td>" . $row["USERNAME"] . "</td>";
    echo "<td>" . $row["Name"] . "</td>";
    echo "<td>" . $row["Address"] . "</td>";
    echo "<td>" . $row["Contact"] . "</td>";
    echo "<td>" . $row["AGE"] . "</td>";
    echo "<td>" . $row["SALARY"] . "</td>";
    echo "<td>" . $row["POSITION"] . "</td>";
    if($row["IS_DELETED"]){
        echo "<td>
        <form method='post'>
        <input type='text' name='username' value='".$row["USERNAME"]."' hidden>
        <input type='text' name='action' value='restore' hidden>
        <input type='submit' value='Restore'>
        </form>
        </td>";
    }else{
        echo "<td>
        <form method='post'>
        <input type='text' name='username' value='".$row["USERNAME"]."' hidden>
        <input type='text' name='action' value='delete' hidden>
        <input type='submit' value='Delete'>
        </form>
        </td>";
    }
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>