<?php

session_start();

function middlewareAuth()
{
    if (!isset($_SESSION['username'])) {
        echo '<meta http-equiv="refresh" content="0; url=index.php?page=login&error=<strong>Unauthenticated, </strong>you must log in first">';
        die;
    }

}

if (isset($_GET['page'])) {
    $page = $_GET['page'];

    switch ($page) {
        case 'dashboard':
            middlewareAuth();
            include 'app/pages/admin/dashboard.php';
            break;

            //? Auth
        case 'login':
            include 'app/pages/auth/login.php';
            break;

        case 'logout':
            middlewareAuth();
            include 'app/pages/auth/logout.php';
            break;


            //? Barang
        case 'barang':
            middlewareAuth();
            include 'app/pages/admin/barang/index.php';
            break;

        case 'tambah-barang':
            middlewareAuth();
            include 'app/pages/admin/barang/create.php';
            break;

        case 'edit-barang':
            middlewareAuth();
            include 'app/pages/admin/barang/edit.php';
            break;

        case 'delete-barang':
            middlewareAuth();
            include 'app/pages/admin/barang/delete.php';
            break;

            //? Peminjaman

        case 'peminjaman':
            middlewareAuth();
            include 'app/pages/admin/peminjaman/index.php';
            break;

            //? APi Peminjaman By ID

        case 'api-peminjaman-by-id':
            middlewareAuth();
            include 'app/pages/admin/peminjaman/api-peminjaman-by-id.php';
            break;

            //? Peminjaman

        case 'pengembalian':
            middlewareAuth();
            include 'app/pages/admin/pengembalian/index.php';
            break;

            //? Barang Hilang

        case 'barang-hilang':
            middlewareAuth();
            include 'app/pages/admin/barang-hilang/index.php';
            break;

        default:
            echo "Page not found";
            break;
    }
} else {
    echo '<meta http-equiv="refresh" content="0; url=index.php?page=login">';
}
