<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/index.php?page=dashboard" class="text-nowrap logo-img" style="border-left: 2px solid #5D87FF;">
                <h6 class="mt-5 ms-3 text-dark mb-n1" style="color: #aaaaaa !important;">Peminjaman</h6>
                <h1 class="ms-3 text-primary" style="font-weight: bolder;">Barang</h1>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" data-currentPage="dashboard" href="/index.php?page=dashboard"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Barang</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" data-currentPage="barang" href="/index.php?page=barang"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Semua Barang</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" data-currentPage="tambah-barang" href="/index.php?page=tambah-barang"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-plus"></i>
                        </span>
                        <span class="hide-menu">Tambah Barang</span>
                    </a>
                </li>
                <?php if ($page == 'edit-barang') : ?>
                <li class="sidebar-item">
                    <a class="sidebar-link" data-currentPage="edit-barang" href="javascript:void();"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-pencil"></i>
                        </span>
                        <span class="hide-menu">Edit Barang</span>
                    </a>
                </li>
                <?php endif; ?>
                <li class="sidebar-item">
                    <a class="sidebar-link" data-currentPage="peminjaman" href="/index.php?page=peminjaman"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-arrow-left"></i>
                        </span>
                        <span class="hide-menu">Peminjaman</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" data-currentPage="pengembalian" href="/index.php?page=pengembalian"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-arrow-right"></i>
                        </span>
                        <span class="hide-menu">Pengembalian</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" data-currentPage="barang-hilang" href="/index.php?page=barang-hilang"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-trash"></i>
                        </span>
                        <span class="hide-menu">Barang Hilang</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>