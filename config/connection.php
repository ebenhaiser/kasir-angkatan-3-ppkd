<?php

$connection_host = 'localhost';
$connection_username = 'root';
$connection_password = '';
$connection_database = 'angkatan3_cashier';

$connection = mysqli_connect($connection_host, $connection_username, $connection_password, $connection_database);

if(!$connection){
    die("Koneksi Gagal: " . mysqli_connect_error());
}