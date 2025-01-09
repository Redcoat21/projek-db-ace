<?php
include("../config/conn.php");
if(isset($_POST["username"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];
    $age = $_POST["age"];
    $salary = $_POST["salary"];
    $position = $_POST["position"];
    $sql = "BEGIN system.insertEmployee(:username,:password,:name,:address,:contact,:age,:salary,:position); END;";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ":username", $username);
    oci_bind_by_name($stmt, ":password", $password);
    oci_bind_by_name($stmt, ":name", $name);
    oci_bind_by_name($stmt, ":address", $address);
    oci_bind_by_name($stmt, ":contact", $contact);
    oci_bind_by_name($stmt, ":age", $age);
    oci_bind_by_name($stmt, ":salary", $salary);
    oci_bind_by_name($stmt, ":position", $position);
    oci_execute($stmt);
}
?>
<form method="post">
    <input type="text" name="username" placeholder="Username">
    <br>
    <input type="text" name="password" placeholder="Password">
    <br>
    <input type="text" name="name" placeholder="Name">
    <br>
    <input type="text" name="address" placeholder="Address">
    <br>
    <input type="number" name="contact" placeholder="Contact">
    <br>
    <input type="number" name="age" placeholder="Age">
    <br>
    <input type="number" name="salary" placeholder="Salary">
    <br>
    <select name="position">
        <option value="manager">Manager</option>
        <option value="staff">Staff</option>
    </select>
    <br>
    <input type="submit" value="Simpan Data">
</form>