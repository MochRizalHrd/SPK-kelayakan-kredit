<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<!-- STEP 1: Matriks Nilai Alternatif -->
<h4>1. Matriks Nilai Alternatif terhadap Kriteria</h4>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Alternatif</th>
            <?php foreach ($kriteria as $k): ?>
                <th><?= esc($k['kriteria']) ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($detail as $id => $alt): ?>
            <tr>
                <td><?= esc($alt['nama']) ?></td>
                <?php foreach ($kriteria as $k): ?>
                    <td><?= esc($alt['nilai'][$k['id']] ?? '-') ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- STEP 2: Tabel Bobot Kriteria -->
<h4 class="mt-5">2. Bobot dan Bobot Relatif Kriteria</h4>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Kriteria</th>
            <th>Jenis</th>
            <th>Bobot (Asli)</th>
            <th>Bobot Relatif (w)</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $totalBobot = array_sum(array_column($kriteria, 'bobot'));
        ?>
        <?php foreach ($kriteria as $k): ?>
            <tr>
                <td><?= esc($k['kriteria']) ?></td>
                <td><?= esc($k['jenis']) ?></td>
                <td><?= number_format($k['bobot'], 4) ?></td>
                <td><?= number_format($k['bobot'] / $totalBobot, 6) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- STEP 3: Pangkat WP -->
<h4 class="mt-5">3. Hasil Pangkat WP (x<sup>w</sup>)</h4>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Alternatif</th>
            <?php foreach ($kriteria as $k): ?>
                <th><?= esc($k['kriteria']) ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pangkat as $idAlt => $kritVals): ?>
            <tr>
                <td><?= esc($detail[$idAlt]['nama']) ?></td>
                <?php foreach ($kriteria as $k): ?>
                    <td><?= number_format($kritVals[$k['id']] ?? 1, 6) ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- STEP 4: Nilai S -->
<h4 class="mt-5">4. Nilai Vektor S (Perkalian Pangkat Tiap Kriteria)</h4>
<table class="table table-bordered">
    <thead class="table-success">
        <tr>
            <th>Alternatif</th>
            <th>Nilai S</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($nilai_s as $id => $s): ?>
            <tr>
                <td><?= esc($detail[$id]['nama']) ?></td>
                <td><?= number_format($s, 6) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="<?= base_url('/hasilakhir') ?>" class="btn btn-success mt-4">Lanjut ke Hasil Ranking</a>

<?= $this->endSection() ?>
