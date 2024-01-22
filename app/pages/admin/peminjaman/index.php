<?php require_once 'layouts/header.php'; ?>

<?php

require_once 'config.php';

// Barang
$sqlBarang = "SELECT * FROM barang";

$resultBarang = $db->query($sqlBarang);

$dataBarang = [];

while ($rowBarang = $resultBarang->fetch_assoc()) {
    $dataBarang[] = $rowBarang;
}

// Peminjaman
$sqlPeminjaman = "SELECT peminjaman.*, barang.nama as nama_barang FROM peminjaman INNER JOIN barang ON peminjaman.barang_id = barang.id";

$resultPeminjaman = $db->query($sqlPeminjaman);

$dataPeminjaman = [];

while ($rowPeminjaman = $resultPeminjaman->fetch_assoc()) {
    $dataPeminjaman[] = $rowPeminjaman;
}

if (isset($_POST['pinjam'])) {

    $nama = $_POST['nama'];
    $barangId = $_POST['barang_id'];
    $jumlahPinjam = $_POST['jumlah'];
    $alamat = $_POST['alamat'];
    $noHandphone = $_POST['no_hp'];
    $deskripsi = $_POST['deskripsi'];

    if (getStokBarang($barangId, $jumlahPinjam) < 0) {
        echo '<meta http-equiv="refresh" content="0; url=index.php?page=peminjaman&error=<strong>Gagal!,  </strong>Stok barang tidak mencukupi">';
        return false;
    }

    $sqlPinjam = "INSERT INTO peminjaman (barang_id, nama, jumlah, jumlah_awal, alamat, no_hp, deskripsi) VALUES ('$barangId', '$nama', '$jumlahPinjam', '$jumlahPinjam', '$alamat', '$noHandphone', '$deskripsi')";
    $db->query($sqlPinjam);

    if ($db->affected_rows > 0) {
        echo '<meta http-equiv="refresh" content="0; url=index.php?page=peminjaman&success=<strong>Berhasil!,  </strong>meminjam barang">';
        return false;

    }

    echo '<meta http-equiv="refresh" content="0; url=index.php?page=peminjaman&error=<strong>Gagal!,  </strong>meminjam barang">';


}

function getStokBarang($idGetStok, $stokDec)
{

    global $db;

    $sqlGetStok = "SELECT * FROM barang WHERE id = $idGetStok";
    $resultGetStok = $db->query($sqlGetStok)->fetch_assoc()['stok'];

    $stokDec = $resultGetStok - $stokDec;

    if ($stokDec >= 0) {
        $sqlDecStock = "UPDATE barang SET stok = $stokDec WHERE id = $idGetStok";
        $db->query($sqlDecStock);
    }

    return $stokDec;
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


    <h5 class="card-title fw-semibold mb-4">Peminjaman</h5>
    <div class="row mb-5">
        <div class="col-lg-4">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Input Peminjaman</h5>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Peminjam</label>
                            <input type="text" name="nama" class="form-control" id="nama">
                        </div>
                        <div class="mb-3">
                            <label for="barang_id" class="form-label">Nama Barang</label>
                            <select class="form-control" name="barang_id" id="id-barang">
                                <?php foreach($dataBarang as $barang) : ?>
                                <option value="<?= $barang['id'] ?>"><?= $barang['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Pinjam</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no-hp" class="form-label">No Handphone</label>
                            <input type="text" name="no_hp" class="form-control" id="no-hp">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30"
                                rows="3"></textarea>
                        </div>
                        <button type="submit" name="pinjam" class="btn btn-primary me-2">Pinjam</button>
                        <button type="reset" class="btn btn-outline-primary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Data Peminjaman</h5>
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
                                        <h6 class="fw-semibold mb-0">Jumlah Pinjam</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Alamat</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Desc</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($dataPeminjaman as $key => $peminjaman): ?>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0"><?= $key + 1 ?></h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1"><?= $peminjaman['nama'] ?></h6>
                                        <p class="mb-0" style="font-size: 10px;"><?= $peminjaman['no_hp'] ?></p>
                                        <span class="fw-normal"><?= $peminjaman['nama_barang'] ?></span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="badge mb-n2 bg-primary rounded-circle fw-semibold d-flex flex-column align-items-center justify-content-center"
                                                style="width: 24px; height: 24px; font-size: 10px;">
                                                <?= $peminjaman['jumlah_awal'] ?>
                                            </div><br>
                                            <?php if ($peminjaman['jumlah'] > 0) : ?>
                                            <span class="mt-n1 text-white bg-warning px-2 py-1 rounded-2"
                                                style="font-size: 10px;"><?= $peminjaman['jumlah'] ?> -
                                                Masih dipinjam</span>
                                            <?php else : ?>
                                            <span class="mt-n1 text-white bg-success px-2 py-1 rounded-2"
                                                style="font-size: 10px;">Sudah
                                                di
                                                kembalikan
                                            </span>
                                            <?php endif; ?>

                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal text-wrap"><?= $peminjaman['alamat'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal text-wrap"><?= $peminjaman['deskripsi'] ?></p>
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