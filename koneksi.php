<?php 
$host  = "localhost";
$user  = "root";
$pass  = "";
$db    = "sultan";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi){
    die (" tidak konek");
}