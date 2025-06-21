<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<h5 class="mb-3"><?= esc($title) ?></h5>
<div class="row">
    <div class="col">
        <div class="card card-small mb-4">
            <li class="list-group-item d-flex justify-content-between align-items-center px-3">
                <!-- <span class="font-weight-bold">Data Kriteria</span> -->
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#dataKriteriaModal">
                    <i class="fas fa-plus"></i> Add Data

                </button>
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
                            
                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-sm btn-warning"
                                                onclick="openEditKriteriaModal(this)"
                                                >
                                                Edit
                                            </button>

                                            <a href="javascript:void(0);"
                                                class="btn btn-danger"
                                                onclick="deleteKriteria()">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<h3 class="mb-3 text-center"><?= esc($title) ?></h3>

<div class="table-responsive">
    <table class="table table-bordered text-center">
        <thead class="table-warning">
            <tr>
                <th>Kriteria</th>
                <?php foreach ($kriteria as $k): ?>
                    <th><?= $k ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($matrix as $i => $row): ?>
                <tr>
                    <td><?= $kriteria[$i] ?></td>
                    <?php foreach ($row as $val): ?>
                        <td><?= round($val, 4) ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
            <tr class="table-active">
                <td>Total</td>
                <?php foreach ($totalKolom as $total): ?>
                    <td><?= round($total, 4) ?></td>
                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
</div>

<h5 class="mt-4">Normalisasi Matriks & Bobot Prioritas</h5>
<div class="table-responsive">
    <table class="table table-bordered text-center">
        <thead class="table-light">
            <tr>
                <th>Kriteria</th>
                <?php foreach ($kriteria as $k): ?>
                    <th><?= $k ?></th>
                <?php endforeach; ?>
                <th>Bobot</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($normalisasi as $i => $row): ?>
                <tr>
                    <td><?= $kriteria[$i] ?></td>
                    <?php foreach ($row as $val): ?>
                        <td><?= round($val, 4) ?></td>
                    <?php endforeach; ?>
                    <td><strong><?= round($bobotPrioritas[$i], 4) ?></strong></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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