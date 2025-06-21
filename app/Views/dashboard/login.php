<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Rekomendasi UMKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
            border-top: 5px solid #003366;
        }

        .form-control:focus {
            border-color: #003366;
            box-shadow: 0 0 0 0.15rem rgba(0, 51, 102, 0.25);
        }

        .btn-primary {
            background-color: #003366;
            border: none;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #002244;
        }

        .login-title {
            color: #003366;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .small-text {
            font-size: 0.9rem;
            color: #666;
        }

        .logo-text {
            font-weight: 600;
            color: #003366;
            font-size: 1.2rem;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="col-md-5">
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card login-card">
            <div class="logo-text">Sistem Rekomendasi Pemberian Pinjaman</div>
            <h4 class="login-title text-center">Login Pengguna</h4>

            <form action="<?= base_url('/login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Email</label>
                    <input type="text" class="form-control" id="username" name="username" required placeholder="Masukkan username Anda">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan kata sandi Anda">
                </div>

                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>

            <div class="mt-3 text-center small-text">
                Belum punya akun? <a href="#" class="text-decoration-none">Register</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
