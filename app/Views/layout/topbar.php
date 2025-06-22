<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="container-fluid">
        <!-- Judul Dashboard -->
        <h5 class="m-0">Dashboard SPK</h5>

        <!-- Tombol Logout di kanan atas -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="btn btn-danger btn-sm" href="<?= base_url('/logout') ?>" onclick="return confirm('Yakin ingin logout?')">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
