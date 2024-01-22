<?php require_once 'layouts/header.php'; ?>

<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo '<meta http-equiv="refresh" content="0; url=index.php?page=barang">';
}

require_once 'config.php';

$id = $_GET['id'];
$sql_get = "SELECT * FROM barang WHERE id='" . $id . "'";
$result_get = $db->query($sql_get)->fetch_assoc();

if (isset($_POST['update-barang'])) {

    $filename = $result_get['gambar'];
    $dir_barang = "storage/barang";
    $has_upload_file = false;

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] <= 0) {

        $filename = $dir_barang . "/" . $_FILES['gambar']['name'];

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $filename)) {
            $has_upload_file = true;
        }

        if (!$has_upload_file) {
            echo "<script>alert('gagal upload gambar')</script>";
            die;
        }
    }


    $newID = $_POST['id'];
    if ($newID !== $id) {
        updateBarangIdOnPeminjaman($id);
    }

    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $filename;
    $stok = $_POST['stok'];

    $sql = "UPDATE barang SET id='$newID', nama='$nama', deskripsi='$deskripsi', gambar='$gambar', stok='$stok', stok_awal_barang='$stok' WHERE id='$id'";

    $db->query($sql);

    if ($newID !== $id) {
        $sqlUpdatedPeminjamanIDs = "UPDATE peminjaman SET barang_id='$newID' WHERE barang_id IS NULL";
        $db->query($sqlUpdatedPeminjamanIDs);
    }

    echo '<meta http-equiv="refresh" content="0; url=index.php?page=barang&message=<strong>Berhasil!</strong> merubah data barang">';

}

function updateBarangIdOnPeminjaman($oldId)
{
    global $db;
    $sqlUpdateBarangIdOnPeminjaman = "UPDATE peminjaman SET barang_id = null WHERE barang_id = '$oldId'";
    $db->query($sqlUpdateBarangIdOnPeminjaman);
}

?>


<section style="min-height: 85vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold">Edit Barang</h5>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="id-barang" class="form-label">ID Barang</label>
                        <input type="text" class="form-control" value="<?= $result_get['id'] ?>" id="id-barang"
                            name="id" aria-describedby="id-barang-help">
                        <div onclick="generateRFIDFromDate(event)" data-id="id-barang"
                            class="btn btn-primary btn-sm my-3">
                            Generate ID
                        </div>
                        <div id="deskripsi-help" class="form-text">
                            Pastikan tidak ada kode barang yang bernilai sama
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nama-barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" value="<?= $result_get['nama'] ?>" id="nama-barang"
                            name="nama" aria-describedby="nama-barang-help">
                        <div id="nama-barang-help" class="form-text">
                            Isi nama barang yang mau anda tambahkan
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" aria-describedby="deskripsi-help" name="deskripsi"
                            id="deskripsi" cols="30" rows="10"><?= $result_get['deskripsi'] ?></textarea>
                        <div id="deskripsi-help" class="form-text">
                            Isi deskripsi yang menjelaskan tentang barang yang mau anda tambahkan
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok Barang</label>
                        <input type="number" value="<?= $result_get['stok'] ?>" class="form-control" id="stok"
                            name="stok" aria-describedby="stok-help">
                        <div id="stok-help" class="form-text">
                            Isi stok awal barang
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Barang</label>
                        <input type="file" class="form-control" id="gambar" name="gambar"
                            aria-describedby="gambar-help">
                        <div id="gambar-help" class="form-text">
                            Upload gambar barang
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="card" style="width: 16rem;">
                            <img class="card-img-top rounded" width="100" src="<?= $result_get['gambar'] ?>" alt="">
                        </div>
                    </div>
                    <a href="index.php?page=barang" class="btn btn-outline-dark me-2">Kembali</a>
                    <button type="submit" name="update-barang" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
function generateRFIDFromDate(e) {

    let IDBarang = e.currentTarget.dataset.id
    const IDBarangEl = document.getElementById(IDBarang)

    var currentDate = new Date();

    var year = currentDate.getFullYear();
    var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
    var day = currentDate.getDate().toString().padStart(2, '0');
    var hours = currentDate.getHours().toString().padStart(2, '0');
    var minutes = currentDate.getMinutes().toString().padStart(2, '0');
    var seconds = currentDate.getSeconds().toString().padStart(2, '0');
    var milliseconds = currentDate.getMilliseconds().toString().padStart(3, '0');

    var rfidCode = year + month + day + hours + minutes + seconds + milliseconds;
    IDBarangEl.value = rfidCode

}
</script>

<?php require_once 'layouts/footer.php'; ?>