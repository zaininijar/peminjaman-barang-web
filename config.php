<?php


$USERNAME = "root";
$PASSWORD = "";
$HOSTNAME = "localhost";
$DBNAME = "db_peminjaman_barang";

$db = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DBNAME);

if (!$db) {
    echo "Database Error - Please try again";
    die;
}