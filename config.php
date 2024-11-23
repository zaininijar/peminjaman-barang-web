<?php


$USERNAME = "root";
$PASSWORD = "";
$HOSTNAME = "localhost";
$DBNAME = "skripsi";

$db = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DBNAME);

if (!$db) {
    echo "Database Error - Please try again";
    die;
}