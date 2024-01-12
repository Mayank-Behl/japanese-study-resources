<?php

$servername = "";
$dBUsername = "";
$dBPassword = "";
$dBName = "";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, "$dBName");


if(!$conn) {
    die("Connection failed :".mysqli_connect_error());
}
?>