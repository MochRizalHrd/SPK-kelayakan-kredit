<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<h5 class="mb-3"><?= esc($title) ?></h5>
<div class="row">
    <div class="col">
        <div class="card card-small mb-4">

            <li class="list-group-item d-flex justify-content-between align-items-center px-3">
                <div class="btn-group" role="group">
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#dataKriteriaModal">
                        <i class="fas fa-plus"></i> Add Data
                    </button>
                    <a href="<?= base_url('/ahp/bobot_ahp') ?>" class="btn btn-sm btn-primary mx-2">
                        <i class="fas fa-balance-scale"></i> Bobot Preferensi AHP
                    </a>
                </div>
            </li>

            <div class="card-body p-0 pb-3">
                <div class="table-responsive"> <!-- Tambahkan wrapper agar responsif -->
                    <table class="table mb-0 text-center">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">No</th>
                                <th scope="col" class="border-0">Kode</th>
                                <th scope="col" class="border-0">Kriteria</th>
                                <th scope="col" class="border-0">Jenis</th>
                                <th scope="col" class="border-0">Bobot</th>
                                <th scope="col" class="border-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($kriteria as $krt) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= esc($krt['id']) ?></td>
                                    <td><?= esc($krt['kriteria']) ?></td>
                                    <td><?= esc($krt['jenis']) ?></td>
                                    <td><?= esc($krt['bobot']) ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-sm btn-warning"
                                                onclick="openEditKriteriaModal(this)"
                                                data-id="<?= $krt['id'] ?>"
                                                data-kriteria="<?= esc($krt['kriteria']) ?>"
                                                data-jenis="<?= esc($krt['jenis']) ?>"
                                                data-bobot="<?= esc($krt['bobot']) ?>">
                                                Edit
                                            </button>

                                            <a href="javascript:void(0);"
                                                class="btn btn-danger"
                                                onclick="deleteKriteria(<?= $krt['id'] ?>)">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item ">
                    <a class="page-link" href="#" aria-current="page">2</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Modal include -->
<?= $this->include('modals/kriteria_modal') ?>

<!-- sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '<?= session()->getFlashdata('success') ?>',
            timer: 2500,
            showConfirmButton: false
        });
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            html: '<?= session()->getFlashdata('error') ?>',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>

<script>
    function deleteKriteria(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data kriteria yang dihapus tidak bisa dikembalikan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke route delete
                window.location.href = "<?= base_url('deleteKriteria') ?>/" + id;
            }
        });
    }
</script>

<?= $this->endSection() ?>