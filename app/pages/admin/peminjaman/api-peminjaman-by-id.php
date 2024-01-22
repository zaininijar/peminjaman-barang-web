<?php

require_once 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM peminjaman WHERE id = $id";

$result = $db->query($sql);
$data = $result->fetch_assoc();

header('Content-Type: application/json');

echo json_encode([
    "success" => true,
    "data" => $data
]);
