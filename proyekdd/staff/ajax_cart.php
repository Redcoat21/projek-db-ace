<?php
include("../config/conn.php");
if(isset($_GET['action'])){
    $employee_id = $_SESSION["employeeid"];
    if($_GET["action"] == "add"){
        $id = $_GET['product_id'];
        $qty = $_GET['qty'];
        $sql = "SELECT * FROM ProductTransaction WHERE Employee_id = :emploid AND Product_id = :prodid";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ":emploid", $employee_id);
        oci_bind_by_name($stmt, ":prodid", $id);
        oci_execute($stmt);
        $datae = oci_fetch_assoc($stmt);
        if($datae == null){
            $sql = "INSERT INTO ProductTransaction VALUES(:prodid,:qty,:emploid)";
            $stmt = oci_parse($conn, $sql);
            oci_bind_by_name($stmt, ":prodid", $id);
            oci_bind_by_name($stmt, ":qty", $qty);
            oci_bind_by_name($stmt, ":emploid", $employee_id);
            oci_execute($stmt);
        }else{
            $qtybaru = $qty+$datae["QUANTITY"];
            $sql = "UPDATE ProductTransaction SET QUANTITY = :qty WHERE Employee_id = :emploid AND Product_id = :prodid";
            $stmt = oci_parse($conn, $sql);
            oci_bind_by_name($stmt, ":prodid", $id);
            oci_bind_by_name($stmt, ":qty", $qtybaru);
            oci_bind_by_name($stmt, ":emploid", $employee_id);
            oci_execute($stmt);
        }
        echo "sukses";
    }else if($_GET["action"] == "remove"){
        $id = $_GET['product_id'];
        $sql = "DELETE FROM ProductTransaction WHERE Product_id = :prodid AND Employee_id = :emploid ";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ":prodid", $id);
        oci_bind_by_name($stmt, ":emploid", $employee_id);
        oci_execute($stmt);
        echo "sukses";
    }else{
        $sql = "SELECT * FROM ProductTransaction pt, product p WHERE p.PRODUCT_ID = pt.PRODUCT_ID AND Employee_id = :emploid ";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ":emploid", $employee_id);
        oci_execute($stmt);
        $data = array();
        while($row = oci_fetch_assoc($stmt)){
            array_push($data,$row);
        }
        $data = json_encode($data);
        echo $data;
    }
}
?>