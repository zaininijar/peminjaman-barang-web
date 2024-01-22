<?php require_once 'layouts/header.php'; ?>

<?php

require_once 'config.php';

// Barang Hilang
$sqlBarangHilang = "SELECT *, barang.nama as nama_barang, barang_hilang.nama as nama_tanggung_jawab FROM barang_hilang INNER JOIN barang ON barang_hilang.barang_id = barang.id";

$resultBarangHilang = $db->query($sqlBarangHilang);

$dataBarangHilang = [];

while ($rowBarangHilang = $resultBarangHilang->fetch_assoc()) {
    $dataBarangHilang[] = $rowBarangHilang;
}

// Barang
$sqlBarang = "SELECT * FROM barang";

$resultBarang = $db->query($sqlBarang);

$dataBarang = [];

while ($rowBarang = $resultBarang->fetch_assoc()) {
    $dataBarang[] = $rowBarang;
}

// Peminjaman
$sqlPeminjaman = "SELECT peminjaman.*, barang.nama AS barang_nama FROM peminjaman INNER JOIN barang ON peminjaman.barang_id = barang.id WHERE peminjaman.jumlah > 0";

$resultPeminjaman = $db->query($sqlPeminjaman);

$dataPeminjaman = [];

while ($rowPeminjaman = $resultPeminjaman->fetch_assoc()) {
    $dataPeminjaman[] = $rowPeminjaman;
}

if (isset($_POST['barang_hilang'])) {

    $barangId = $_POST['barang_id'];
    $jumlah = $_POST['jumlah'];
    $nama = "0";
    $alamat = "0";
    $no_hp = "0";


    updateStokBarang($barangId, $jumlah);

    $sqlBarangHilang = "INSERT INTO barang_hilang (barang_id, jumlah, nama, alamat, no_hp) VALUES ('$barangId', $jumlah, '$nama', '$alamat', '$no_hp')";
    $db->query($sqlBarangHilang);

    if ($db->affected_rows > 0) {
        echo '<meta http-equiv="refresh" content="0; url=index.php?page=barang-hilang&success=<strong>Berhasil!,  </strong>menambahkan barang hilang">';
        die;
    }

    echo '<meta http-equiv="refresh" content="0; url=index.php?page=barang-hilang&error=<strong>Gagal!,  </strong>menambahkan barang hilang">';


}

function updateStokBarang($barangId, $stokDec)
{

    global $db;

    $sqlGetBarang = "SELECT stok FROM barang WHERE id = '$barangId'";
    $resultGetBarang = $db->query($sqlGetBarang)->fetch_assoc();
    $stok = $resultGetBarang['stok'];

    if (($stok - $stokDec) < 0) {
        echo '<meta http-equiv="refresh" content="0; url=index.php?page=pengembalian&error=<strong>Gagal!,  </strong>jumlah hilang tidak sesuai">';
        die;
    }

    $sqlDecStock = "UPDATE barang SET stok = stok - $stokDec, stok_awal_barang = stok_awal_barang - $stokDec WHERE id = $barangId";
    $db->query($sqlDecStock);

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


    <h5 class="card-title fw-semibold mb-4">Barang Hilang</h5>
    <div class="row mb-5">
        <div class="col-lg-4">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Input Barang Hilang</h5>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="barang_id" class="form-label">Barang</label>
                            <select class="form-control" name="barang_id" id="barang_id">
                                <?php foreach($dataBarang as $barang) : ?>
                                <option value="<?= $barang['id'] ?>">
                                    <?= $barang['nama'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Hilang</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah">
                        </div>
                        <br>
                        <!-- <div>
                            <i class="form-label mt-5 text-warning" style="font-weight: 300; font-size: 12px;">Yang
                                Bertanggung Jawab</i>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no-hp" class="form-label">No Handphone</label>
                            <input type="text" name="no_hp" class="form-control" id="no-hp">
                        </div> -->
                        <button type="submit" name="barang_hilang" class="btn btn-primary me-2">Simpan</button>
                        <button type="reset" class="btn btn-outline-primary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-6">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Input Barang Hilang Saat Dipinjam</h5>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="peminjaman_id" class="form-label">Barang</label>
                            <select class="form-control" name="peminjaman_id" id="peminjaman_id">
                                <option>-- Pilih --</option>
                                <?php foreach($dataPeminjaman as $peminjaman) : ?>
                                <option value="<?= $peminjaman['id'] ?>">
                                    <?= $peminjaman['nama'] . ' - ' . $peminjaman['barang_nama'] . ' - ' . $peminjaman['jumlah'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Hilang</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah">
                        </div>
                        <br>
                        <div>
                            <i class="form-label mt-5 text-warning" style="font-weight: 300; font-size: 12px;">Yang
                                Bertanggung Jawab</i>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no-hp" class="form-label">No Handphone</label>
                            <input type="text" name="no_hp" class="form-control" id="no-hp">
                        </div>
                        <button type="submit" name="barang_hilang_pinjam" class="btn btn-primary me-2">Simpan</button>
                        <button type="reset" class="btn btn-outline-primary">Reset</button>
                    </form>
                </div>
            </div>
        </div> -->
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Data Barang Hilang</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Barang</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Jumlah Hilang</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Nama Penanggung Jawab</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Alamat Penanggung Jawab</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No Hp. Penanggung Jawab</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($dataBarangHilang as $key => $barang_hilang): ?>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0"><?= $key + 1 ?></h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1"><?= $barang_hilang['nama_barang'] ?></h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <span
                                                class="badge bg-primary rounded-3 fw-semibold"><?= $barang_hilang['jumlah'] ?></span>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal text-wrap"><?= $barang_hilang['nama'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal text-wrap"><?= $barang_hilang['alamat'] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal text-wrap"><?= $barang_hilang['no_hp'] ?></p>
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