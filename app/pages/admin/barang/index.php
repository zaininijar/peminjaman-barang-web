<?php require_once 'layouts/header.php'; ?>

<?php

require_once 'config.php';
$sql = "SELECT * FROM barang";

$result = $db->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

?>


<section style="min-height: 85vh;">
    <?php if (isset($_GET['message'])) : ?>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <?= $_GET['message']; ?>
    </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <?= $_GET['error']; ?>
    </div>
    <?php endif; ?>


    <h5 class="card-title fw-semibold mb-4">List Barang</h5>
    <div class="grid w-100 mb-5">
        <?php foreach($data as $barang) : ?>
        <div class="grid-item" style="width: 22%;">
            <div class="card overflow-hidden rounded-2">
                <div class="position-relative">
                    <img src="<?= $barang['gambar'] ?>" class="card-img-top rounded-0" alt="...">
                    <a href="index.php?page=delete-barang&id=<?= $barang['id'] ?>&action=delete"
                        class="bg-danger rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                        <i class="ti ti-trash fs-4"></i>
                    </a>
                    <a href="index.php?page=edit-barang&id=<?= $barang['id'] ?>"
                        class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3"
                        style="margin-right: 3.5rem;" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="Edit">
                        <i class="ti ti-pencil fs-4"></i>
                    </a>
                </div>
                <div class="card-body pt-3 p-4">
                    <h6 class="fw-semibold fs-4"><?= $barang['nama'] ?></h6>

                    <p><?= substr($barang['deskripsi'], 0, 250) ?></p>

                    <div class="mb-3">
                        <?php if ($barang['stok'] !== $barang['stok_awal_barang']) : ?>
                        <span class="mt-n1 text-white bg-warning px-2 py-1 rounded-2"
                            style="font-size: 10px;"><?= $barang['stok_awal_barang'] - $barang['stok'] ?> -
                            Sedang dipinjam</span>
                        <?php else : ?>
                        <span class="mt-n1 text-white bg-success px-2 py-1 rounded-2" style="font-size: 10px;">
                            Tidak ada yang sedang di pinjam
                        </span>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="fw-semibold fs-4 mb-0">
                            <span class="ms-2 fw-normal text-muted fs-3">Stok : </span><?= $barang['stok'] ?>
                        </h6>
                    </div>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once 'layouts/footer.php'; ?>