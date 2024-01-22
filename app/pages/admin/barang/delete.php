<?php


if (!isset($_GET['action']) && $_GET['action'] !== 'delete') {
    echo '<meta http-equiv="refresh" content="0; url=index.php?page=barang">';
}

require_once 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM barang WHERE id=$id";

$result = $db->query($sql);

if ($result) {
    echo '<meta http-equiv="refresh" content="0; url=index.php?page=barang&message=<strong>Berhasil</strong> menghapus barang">';
} else {
    echo '<meta http-equiv="refresh" content="0; url=index.php?page=barang&error=<strong>Gagal</strong> menghapus barang">';
}