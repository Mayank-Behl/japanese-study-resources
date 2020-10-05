<?php

$servername = "sql206.epizy.com";
$dBUsername = "epiz_26067994";
$dBPassword = "XZHOtI8IR357R";
$dBName = "epiz_26067994_emailsubmit";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, "$dBName");


if(!$conn) {
    die("Connection failed :".mysqli_connect_error());
}
?>