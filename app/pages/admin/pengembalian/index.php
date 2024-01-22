<?php require_once 'layouts/header.php'; ?>

<?php

require_once 'config.php';

// Pengembalian
$sqlPengembalian = "SELECT *, barang.nama as nama_barang, peminjaman.nama as nama_peminjam, pengembalian.jumlah as jumlah_pengembalian, peminjaman.jumlah as jumlah_peminjaman FROM pengembalian INNER JOIN peminjaman ON pengembalian.peminjaman_id = peminjaman.id INNER JOIN barang ON barang.id = peminjaman.barang_id";

$resultPengembalian = $db->query($sqlPengembalian);

$dataPengembalian = [];

while ($rowPengembalian = $resultPengembalian->fetch_assoc()) {
    $dataPengembalian[] = $rowPengembalian;
}

// Peminjaman
$sqlPeminjaman = "SELECT peminjaman.*, barang.nama AS barang_nama FROM peminjaman INNER JOIN barang ON peminjaman.barang_id = barang.id WHERE peminjaman.jumlah > 0";

$resultPeminjaman = $db->query($sqlPeminjaman);

$dataPeminjaman = [];

while ($rowPeminjaman = $resultPeminjaman->fetch_assoc()) {
    $dataPeminjaman[] = $rowPeminjaman;
}

if (isset($_POST['kembalikan'])) {

    $peminjamanId = $_POST['peminjaman_id'];
    $jumlah = $_POST['jumlah'];

    updateStokBarang($peminjamanId, $jumlah);
    updateJumlahPeminjaman($peminjamanId, $jumlah);

    $sqlKembali = "INSERT INTO pengembalian (peminjaman_id, jumlah) VALUES ('$peminjamanId', '$jumlah')";
    $db->query($sqlKembali);

    if ($db->affected_rows > 0) {
        echo '<meta http-equiv="refresh" content="0; url=index.php?page=pengembalian&success=<strong>Berhasil!,  </strong>mengembalikan barang">';
        die;
    }

    echo '<meta http-equiv="refresh" content="0; url=index.php?page=pengembalian&error=<strong>Gagal!,  </strong>mengembalikan barang">';


}

function updateStokBarang($peminjamanId, $stokInc)
{

    global $db;

    $sqlGetBarang = "SELECT barang_id, jumlah FROM peminjaman WHERE id = '$peminjamanId'";
    $resultGetBarang = $db->query($sqlGetBarang)->fetch_assoc();
    $idBarang = $resultGetBarang['barang_id'];
    $jumlah = $resultGetBarang['jumlah'];

    if (($jumlah - $stokInc) < 0) {
        echo '<meta http-equiv="refresh" content="0; url=index.php?page=pengembalian&error=<strong>Gagal!,  </strong>jumlah pengembalian tidak sesuai">';
        die;
    }

    $sqlIncStock = "UPDATE barang SET stok = stok + $stokInc WHERE id = $idBarang";
    $db->query($sqlIncStock);

}


function updateJumlahPeminjaman($peminjamanId, $stokInc)
{

    global $db;

    $sqlIncStock = "UPDATE peminjaman SET jumlah = jumlah - $stokInc WHERE id = $peminjamanId";
    $db->query($sqlIncStock);

}

?>

<section style="min-height: 85vh;">
    <?php if (isset($_GET['success'])) : ?>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <?= $_GET['success']; ?>
    </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <?= $_GET['error']; ?>
    </div>
    <?php endif; ?>


    <h5 class="card-title fw-semibold mb-4">Pengembalian</h5>
    <div class="row mb-5">
        <div class="col-lg-4">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Input Pengembalian</h5>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="peminjaman_id" class="form-label">Nama Barang</label>
                            <select class="form-control" name="peminjaman_id" id="peminjaman_id">
                                <?php foreach($dataPeminjaman as $peminjaman) : ?>
                                <option value="<?= $peminjaman['id'] ?>">
                                    <?= $peminjaman['nama'] . ' - ' . $peminjaman['barang_nama'] . ' - ' . $peminjaman['jumlah'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Kembali</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah">
                        </div>
                        <button type="submit" name="kembalikan" class="btn btn-primary me-2">Kembalikan</button>
                        <button type="reset" class="btn btn-outline-primary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Data Pengembalian</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Peminjam</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Jumlah Kembali</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Alamat</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($dataPengembalian as $key => $pengembalian): ?>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0"><?= $key + 1 ?></h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1"><?= $pengembalian['nama_peminjam'] ?></h6>
                                        <p class="mb-0"><?= $pengembalian['no_hp'] ?></p>
                                        <span class="fw-normal"><?= $pengembalian['nama_barang'] ?></span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <span
                                                class="badge bg-primary rounded-3 fw-semibold"><?= $pengembalian['jumlah_pengembalian'] ?></span>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal text-wrap"><?= $pengembalian['alamat'] ?></p>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'layouts/footer.php'; ?>