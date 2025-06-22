<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<h3>Hasil Perhitungan Nilai V dan Ranking</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Peringkat</th>
            <th>Alternatif</th>
            <th>Nilai V</th>
            <th>Keputusan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($rangking as $r): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $r['nama'] ?></td>
                <td><?= number_format($r['nilai'], 6) ?></td>
                <td><?= $r['nilai'] >= 0.2400 ? 'Layak' : 'Tidak Layak' ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="<?= base_url('/perhitungan') ?>" class="btn btn-secondary">← Kembali ke Perhitungan</a>


<?= $this->endSection() ?>
