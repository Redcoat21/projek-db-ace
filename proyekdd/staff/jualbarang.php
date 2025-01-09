<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<?php
include("../config/conn.php");
$sql = "SELECT * FROM PRODUCT";
$produk = oci_parse($conn, $sql);
oci_execute($produk);
$sql = "SELECT * FROM customer";
$customer = oci_parse($conn, $sql);
oci_execute($customer);
if(isset($_POST["customer"])){
    $employee_id = $_SESSION["employeeid"];
    $custid = $_POST["customer"];
    $sql = "BEGIN system.createTransaction(:emploid,:custid); END;";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ":emploid", $employee_id);
    oci_bind_by_name($stmt, ":custid", $custid);
    oci_execute($stmt);
}
?>
<form method="POST">
    <input type="text" name="employee_id" value="<?= $_SESSION["employeeid"] ?>" hidden>
    <select name="customer">
        <?php
        while($row = oci_fetch_assoc($customer)){
            ?>
                <option value="<?= $row["CUSTOMER_ID"] ?>"><?= $row["Name"] ?></option>
            <?php
        }
        ?>
    </select>
    <div id="listproduke">
        
    </div>
    <select id="listprod">
        <?php
        while($row = oci_fetch_assoc($produk)){
            ?>
                <option value="<?= $row["PRODUCT_ID"] ?>"><?= $row["Name"] ?></option>
            <?php
        }
        ?>
    </select>
    <input type="number" placeholder="Qty" id="qtyprod">
    <input type="button" onclick="tambahproduk()" value="+">
    <br>
    <input type="submit" value="Simpan">
</form>
<script>
    getproduk()
    function getproduk(){
        $.get("ajax_cart.php?action=view",function(data){
            data = JSON.parse(data)
            datahtml = ""
            for (const iterator of data) {
                datahtml += '<p>'+iterator.Name+' <span onclick="removeproduk(\''+iterator.PRODUCT_ID+'\')" style="cursor:pointer;color:blue;text-decoration:underline">(remove)</span></p>'
            }
            document.getElementById("listproduke").innerHTML = datahtml
        })
    }
    function removeproduk(id){
        $.get("ajax_cart.php?action=remove&product_id="+id,function(data){
            getproduk()
        })
    }
    function tambahproduk(){
        var selectElement = document.getElementById('listprod');
        var produkid = selectElement.value;
        var qtyprod = document.getElementById("qtyprod").value
        if(!qtyprod || qtyprod == 0){
            alert("Harap Masukkan Quantity")
        }else{
            $.get("ajax_cart.php?action=add&product_id="+produkid+"&qty="+qtyprod,function(data){
                getproduk()
            })
        }
    }
</script>