<?php require_once 'app/pages/auth/layouts/header.php'; ?>

<?php

require_once 'config.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo '<meta http-equiv="refresh" content="0; url=index.php?page=dashboard&success=Login successful! Welcome, <strong>' . $username . '</strong>">';
    die;
}

if (isset($_POST['login'])) {

    $username = isset($_POST['username']) ? $db->real_escape_string($_POST['username']) : '';
    $password = isset($_POST['password']) ? $db->real_escape_string($_POST['password']) : '';

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $db->query($query);

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        $_SESSION['username'] = $user['name'];

        echo '<meta http-equiv="refresh" content="0; url=index.php?page=dashboard&success=Login successful! Welcome, <strong>' . $_SESSION['username'] . '</strong>">';
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?page=dashboard&error=<strong>Login failed.  </strong> Please check your username and password.">';
    }

    $db->close();
}

?>


<div class="row justify-content-center w-100">
    <div class="col-md-8 col-lg-6 col-xxl-3">
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
        <div class="card mb-0">
            <form class="card-body" action="" method="post">
                <div class="brand-logo d-flex align-items-center justify-content-between mb-4">
                    <a href="/index.php?page=dashboard" class="text-nowrap logo-img"
                        style="border-left: 2px solid #5D87FF;">
                        <h6 class="mt-5 ms-3 text-dark mb-n1" style="color: #aaaaaa !important;">Peminjaman</h6>
                        <h1 class="ms-3 text-primary" style="font-weight: bolder;">Barang</h1>
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <form>
                    <div class="mb-3">
                        <label for="exampleInputusername1" class="form-label">Username</label>
                        <input type="username" name="username" class="form-control" id="exampleInputusername1"
                            aria-describedby="usernameHelp">
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                        Sign In
                    </button>
                    <div class="d-flex align-items-center justify-content-center">
                        <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Create an account</a>
                    </div>
                </form>
            </form>
        </div>
    </div>
</div>
<?php require_once 'app/pages/auth/layouts/footer.php'; ?>