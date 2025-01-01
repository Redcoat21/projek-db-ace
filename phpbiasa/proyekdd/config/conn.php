<?php
$conn = oci_connect("system","viery","//localhost/LEONKENNEDY");
if(!$conn){
    echo "Tidak bisa konek database!!";
}
?>