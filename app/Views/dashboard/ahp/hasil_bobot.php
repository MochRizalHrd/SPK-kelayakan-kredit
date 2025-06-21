<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3 class="mb-4">Hasil Perhitungan Bobot Kriteria (AHP)</h3>

    <!-- Matriks Perbandingan -->
    <h5>Matriks Perbandingan Kriteria</h5>
    <div class="table-responsive mb-4">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>Kriteria</th>
                    <?php foreach ($kriteria as $col): ?>
                        <th><?= esc($col['kriteria']) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($matriks as $i => $baris): ?>
                    <tr>
                        <th><?= esc($kriteria[$i - 1]['kriteria']) ?></th>
                        <?php foreach ($baris as $val): ?>
                            <td><?= number_format($val, 5) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Matriks Normalisasi -->
    <h5>Matriks Normalisasi</h5>
    <div class="table-responsive mb-4">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>Kriteria</th>
                    <?php foreach ($kriteria as $col): ?>
                        <th><?= esc($col['kriteria']) ?></th>
                    <?php endforeach; ?>
                    <th><strong>Total Baris</strong></th>
                    <th><strong>Eigen</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($normal as $i => $baris): ?>
                    <?php $total = array_sum($baris); ?>
                    <tr>
                        <th><?= esc($kriteria[$i - 1]['kriteria']) ?></th>
                        <?php foreach ($baris as $val): ?>
                            <td><?= number_format($val, 5) ?></td>
                        <?php endforeach; ?>
                        <td><?= number_format($total, 5) ?></td>
                        <td><?= number_format($bobot[$i], 5) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bobot Eigen -->
    <h5>Bobot Prioritas (Eigen Vector)</h5>
    <table class="table table-bordered text-center mb-4">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Kriteria</th>
                <th>Bobot Prioritas</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($kriteria as $k): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($k['kriteria']) ?></td>
                    <td><?= number_format($bobot[$k['id']], 5) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Konsistensi -->
    <h5>Nilai Konsistensi</h5>
    <ul>
        <li><strong>λ Max</strong> = <?= number_format($lambdaMax, 5) ?></li>
        <li><strong>CI (Consistency Index)</strong> = <?= number_format($ci, 5) ?></li>
        <li><strong>CR (Consistency Ratio)</strong> = <?= number_format($cr, 5) ?></li>
    </ul>

    <?php if ($cr <= 0.1): ?>
        <div class="alert alert-success">
            ✓ <strong>Konsistensi DITERIMA</strong> (CR ≤ 0.1)
        </div>
    <?php else: ?>
        <div class="alert alert-danger">
            ✗ <strong>Konsistensi TIDAK DITERIMA</strong> (CR > 0.1)
        </div>
    <?php endif; ?>

    <a href="<?= base_url('wp/form') ?>" class="btn btn-primary mt-3">
        Lanjut ke Penilaian Alternatif (WP)
    </a>
</div>

<?= $this->endSection() ?>
