<?php require_once 'layouts/header.php'; ?>

<?php

if (isset($_POST['tambah-barang'])) {
    require_once 'config.php';

    $filename = "";
    $dir_barang = "storage/barang";
    $has_upload_file = false;

    if (isset($_FILES['gambar'])) {

        $filename = $dir_barang . "/" . $_FILES['gambar']['name'];

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $filename)) {
            $has_upload_file = true;
        }

    }

    if (!$has_upload_file) {
        echo "<script>alert('gagal upload gambar')</script>";
        die;
    }


    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $filename;
    $stok = $_POST['stok'];

    $sql = "INSERT INTO barang (id, nama, deskripsi, gambar, stok, stok_awal_barang) VALUES ('$id', '$nama','$deskripsi', '$gambar','$stok','$stok')";

    $db->query($sql);
    echo '<meta http-equiv="refresh" content="0; url=index.php?page=barang&message=<strong>Berhasil!</strong> menambah data barang">';
}

?>

<section style="min-height: 85vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold">Tambah Barang</h5>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="id-barang" class="form-label">ID Barang</label>
                        <input type="text" class="form-control" id="id-barang" name="id"
                            aria-describedby="id-barang-help">
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
                        <input type="text" class="form-control" id="nama-barang" name="nama"
                            aria-describedby="nama-barang-help">
                        <div id="nama-barang-help" class="form-text">
                            Isi nama barang yang mau anda tambahkan
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" aria-describedby="deskripsi-help" name="deskripsi"
                            id="deskripsi" cols="30" rows="10"></textarea>
                        <div id="deskripsi-help" class="form-text">
                            Isi deskripsi yang menjelaskan tentang barang yang mau anda tambahkan
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok Barang</label>
                        <input type="number" class="form-control" id="stok" name="stok" aria-describedby="stok-help">
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
                    <button type="submit" name="tambah-barang" class="btn btn-primary">Simpan</button>
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