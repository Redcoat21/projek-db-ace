<?php
$conn = oci_connect("system","viery","//localhost/LEONKENNEDY");
if(!$conn){
    echo "error";
}else{
    echo "jos";
}
?>