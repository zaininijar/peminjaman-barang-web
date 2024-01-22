<?php require_once 'layouts/header.php'; ?>
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
<div class="row w-100 text-center align-items-start" style="min-height: 85vh;">
    <div class="brand-logo d-flex align-items-center justify-content-between mb-4">
        <a href="/index.php?page=dashboard" class="text-nowrap logo-img" style="border-left: 2px solid #5D87FF;">
            <h6 class="mt-5 ms-n3 text-dark mb-n1" style="color: #aaaaaa !important;">Peminjaman</h6>
            <h1 class="ms-3 text-primary" style="font-weight: bolder;">Barang</h1>
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
        </div>
        <h4 class="mt-auto text-primary"><span style="color: #aaaaaa !important;">Welcome, </span>
            <?= $_SESSION['username'] ?></h4>
    </div>
</div>

<?php require_once 'layouts/footer.php'; ?>