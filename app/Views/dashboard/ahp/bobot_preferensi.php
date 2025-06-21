<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>




<div class="container shadow mt-4">
    <h3 class="mb-4 pt-4"><i class="fas fa-balance-scale"></i> Form Perbandingan Berpasangan Kriteria (AHP)</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('ahp/simpan') ?>" method="post">
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 30%">Kriteria 1</th>
                        <th style="width: 40%">Skala Perbandingan</th>
                        <th style="width: 30%">Kriteria 2</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kriteria as $i): ?>
                        <?php foreach ($kriteria as $j): ?>
                            <?php if ($i['id'] < $j['id']): ?>
                                <tr>
                                    <td>(C<?= $i['id'] ?>) <?= esc($i['kriteria']) ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1 flex-nowrap overflow-auto">
                                            <?php for ($n = 9; $n >= 2; $n--): ?>
                                                <input type="radio"
                                                    name="nilai_<?= $i['id'] ?>_<?= $j['id'] ?>"
                                                    value="<?= $n ?>"
                                                    id="left_<?= $i['id'] ?>_<?= $j['id'] ?>_<?= $n ?>"
                                                    style="display: none;"
                                                    required>
                                                <label for="left_<?= $i['id'] ?>_<?= $j['id'] ?>_<?= $n ?>"
                                                    style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; cursor: pointer; min-width: 32px; text-align: center;"
                                                    onclick="toggleActive(this)">
                                                    <?= $n ?>
                                                </label>
                                            <?php endfor; ?>

                                            <input type="radio"
                                                name="nilai_<?= $i['id'] ?>_<?= $j['id'] ?>"
                                                value="1"
                                                id="center_<?= $i['id'] ?>_<?= $j['id'] ?>_1"
                                                style="display: none;"
                                                required>
                                            <label for="center_<?= $i['id'] ?>_<?= $j['id'] ?>_1"
                                                style="padding: 6px 10px; border: 1px solid #0dcaf0; border-radius: 4px; cursor: pointer; min-width: 32px; text-align: center;"
                                                onclick="toggleActive(this)">
                                                1
                                            </label>

                                            <?php for ($n = 2; $n <= 9; $n++): ?>
                                                <?php
                                                $val = 1 / $n;
                                                // Atasi floating point dengan konversi ke string presisi tetap
                                                $val = number_format($val, 5, '.', '');
                                                ?>
                                                <input type="radio"
                                                    name="nilai_<?= $i['id'] ?>_<?= $j['id'] ?>"
                                                    value="<?= $val ?>"
                                                    id="right_<?= $i['id'] ?>_<?= $j['id'] ?>_<?= str_replace('.', '_', $val) ?>"
                                                    style="display: none;">
                                                <label for="right_<?= $i['id'] ?>_<?= $j['id'] ?>_<?= str_replace('.', '_', $val) ?>"
                                                    style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; cursor: pointer; min-width: 32px; text-align: center;"
                                                    onclick="toggleActive(this)">
                                                    <?= $n ?>
                                                </label>
                                            <?php endfor; ?>

                                        </div>
                                    </td>
                                    <td>(C<?= $j['id'] ?>) <?= esc($j['kriteria']) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4 pb-4">
            <button type="submit" class="btn btn-primary mr-2" onsubmit="<?= base_url('/ahp/simpan') ?>">
                <i class="fas fa-save me-1"></i> Simpan
            </button>
            <a href="<?= base_url('/ahp/cekkonsistensi') ?>" class="btn btn-success">
                <i class="fas fa-check-circle me-1"></i> Cek Konsistensi
            </a>
            <a href="<?= base_url('/ahp/reset') ?>" class="btn btn-danger d-flex align-items-center gap-1 ml-2">
                <i class="fas fa-undo-alt"></i>
                <span>Reset</span>
            </a>
        </div>
    </form>
</div>

<div class="container shadow mt-4 py-2">
    <h5 class="mt-4 mb-3">Matriks Perbandingan Kriteria</h5>
    <table class="table table-bordered text-center table-sm">
        <thead class="table-warning">
            <tr>
                <th></th>
                <?php foreach ($kriteria as $col): ?>
                    <th><?= esc($col['kriteria']) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($nilai)): ?>
                <?php
                $matriks = [];
                $totalKolom = [];

                foreach ($kriteria as $i) {
                    foreach ($kriteria as $j) {
                        if ($i['id'] == $j['id']) {
                            $matriks[$i['id']][$j['id']] = 1;
                        } elseif ($i['id'] < $j['id']) {
                            $key = 'nilai_' . $i['id'] . '_' . $j['id'];
                            $val = isset($nilai[$key]) ? floatval($nilai[$key]) : 1;

                            // ✨ Tambahan pembulatan
                            $val = abs($val - round($val)) < 0.001 ? round($val) : round($val, 5);
                            $inv = 1 / $val;
                            $inv = abs($inv - round($inv)) < 0.001 ? round($inv) : round($inv, 5);

                            $matriks[$i['id']][$j['id']] = $val;
                            $matriks[$j['id']][$i['id']] = $inv;
                        }
                    }
                }


                // Hitung total tiap kolom
                foreach ($kriteria as $col) {
                    $total = 0;
                    foreach ($kriteria as $row) {
                        $total += $matriks[$row['id']][$col['id']] ?? 1;
                    }
                    $totalKolom[$col['id']] = $total;
                }
                ?>

                <?php foreach ($kriteria as $row): ?>
                    <tr>
                        <th><?= esc($row['kriteria']) ?></th>
                        <?php foreach ($kriteria as $col): ?>
                            <td><?= isset($matriks[$row['id']][$col['id']]) ? round($matriks[$row['id']][$col['id']], 5) : 1 ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>

                <!-- Baris Total -->
                <tr class="fw-bold table-secondary">
                    <td>Total</td>
                    <?php foreach ($kriteria as $col): ?>
                        <td><?= round($totalKolom[$col['id']], 5) ?></td>
                    <?php endforeach; ?>
                </tr>

            <?php else: ?>
                <tr>
                    <td colspan="<?= count($kriteria) + 1 ?>">Belum ada data perbandingan yang dimasukkan.</td>
                </tr>
            <?php endif; ?>
        </tbody>


    </table>
</div>

<?php
$hasil = session()->get('ahp_hasil_konsistensi');
$kriteria = $hasil['kriteria'] ?? [];
$matriks = $hasil['matriks'] ?? [];
$normalisasi = $hasil['normalisasi'] ?? [];
$prioritas = $hasil['prioritas'] ?? [];
$engine_vector = $hasil['engine_vector'] ?? [];
$total_engine_vector = $hasil['total_engine_vector'] ?? [];
$lambda_max = $hasil['lambda_max'] ?? 0;
$ci = $hasil['ci'] ?? 0;
$cr = $hasil['cr'] ?? 0;
$rasio_konsistensi = $hasil['rasio_konsistensi'] ?? [];
$total_prioritas = $hasil['total_prioritas'] ?? 0;
$total_jumlah = $hasil['total_jumlah'] ?? 0;
$total_hasil = $hasil['total_hasil'] ?? 0;
?>

<div class="container shadow mt-4 py-2">
<?php if (!empty($hasil) && !empty($prioritas)): ?>

    <!-- Normalisasi Matriks -->
    <h4 class="mb-3">Normalisasi Matriks & Bobot Prioritas</h4>
    <table class="table table-bordered text-center table-sm">
        <thead class="table-dark">
            <tr>
                <th>Kriteria</th>
                <?php foreach ($kriteria as $k): ?>
                    <th><?= esc($k['kriteria']) ?></th>
                <?php endforeach; ?>
                <th class="bg-primary text-white">Jumlah</th>
                <th class="bg-info text-dark">Prioritas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $jumlahKolom = array_fill(0, count($kriteria), 0);
            foreach ($normalisasi as $i => $row):
                $jumlahBaris = array_sum($row);
            ?>
                <tr>
                    <th><?= esc($kriteria[$i]['kriteria']) ?></th>
                    <?php foreach ($row as $j => $val): ?>
                        <?php $jumlahKolom[$j] += $val; ?>
                        <td><?= round($val, 5) ?></td>
                    <?php endforeach; ?>
                    <td class="bg-primary text-white"><?= round($jumlahBaris, 5) ?></td>
                    <td class="bg-info text-dark"><?= round($prioritas[$i], 5) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="fw-bold table-secondary">
                <td>Total</td>
                <?php foreach ($jumlahKolom as $val): ?>
                    <td><?= round($val, 5) ?></td>
                <?php endforeach; ?>
                <td class="bg-primary text-white">-</td>
                <td class="bg-info text-dark"><?= round(array_sum($prioritas), 5) ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Engine Vector -->
    <h4 class="mb-3">Engine Vector (Matriks × Prioritas)</h4>
    <table class="table table-bordered text-center table-sm">
        <thead class="table-warning">
            <tr>
                <th></th>
                <?php foreach ($kriteria as $k): ?>
                    <th><?= esc($k['kriteria']) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($engine_vector as $i => $row): ?>
                <tr>
                    <th><?= esc($kriteria[$i]['kriteria']) ?></th>
                    <?php foreach ($row as $val): ?>
                        <td><?= round($val, 10) ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
            <tr class="fw-bold table-secondary">
                <td>Total</td>
                <?php foreach ($total_engine_vector as $val): ?>
                    <td><?= round($val, 10) ?></td>
                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>

    <!-- Rasio Konsistensi -->
    <h4 class="mb-3 text-start">Menghitung Rasio Konsistensi</h4>
<table class="table table-bordered text-center table-sm">
    <thead class="table-warning">
        <tr>
            <th>Kriteria</th>
            <th>Jumlah</th>
            <th>Prioritas</th>
            <th>Hasil (λi)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_jumlah = 0;
        $total_prioritas_rk = 0;
        $total_lambda_i = 0;
        foreach ($rasio_konsistensi as $row):
            $total_jumlah += $row['jumlah'];
            $total_prioritas_rk += $row['prioritas'];
            $total_lambda_i += $row['hasil'];
        ?>
            <tr>
                <td><?= esc($row['kriteria']) ?></td>
                <td><?= round($row['jumlah'], 10) ?></td>
                <td><?= round($row['prioritas'], 10) ?></td>
                <td><?= round($row['hasil'], 10) ?></td>
            </tr>
        <?php endforeach; ?>

        <!-- Baris Total -->
        <tr class="fw-bold table-secondary">
            <td>Total</td>
            <td><?= round($total_jumlah, 10) ?></td>
            <td><?= round($total_prioritas_rk, 10) ?></td>
            <td><?= round($total_lambda_i, 10) ?></td>
        </tr>
    </tbody>
</table>

<!-- Menampilkan Nilai Evaluasi Konsistensi -->
<table class="table table-bordered text-center w-50 mt-4" style="background-color: #343a40; color: white;">
    <tr>
        <td>λ Max</td>
        <td><?= round($lambda_max, 10) ?></td>
    </tr>
    <tr>
        <td>Consistency Index (CI)</td>
        <td><?= round($ci, 10) ?></td>
    </tr>
    <tr>
        <td>Consistency Ratio (CR)</td>
        <td>
            <?= round($cr, 10) ?>
            <?= ($cr <= 0.1) ? '<span class="text-success fw-bold">(Konsisten)</span>' : '<span class="text-danger fw-bold">(Tidak Konsisten)</span>' ?>
        </td>
    </tr>
</table>


<?php else: ?>
    <div class="alert alert-warning">Belum ada data yang dihitung atau data telah direset.</div>
<?php endif; ?>
</div>




<script>
    // Menambahkan highlight saat label dipilih
    function toggleActive(selectedLabel) {
        const container = selectedLabel.parentElement;
        const labels = container.querySelectorAll("label");
        labels.forEach(label => {
            label.style.backgroundColor = ""; // Reset semua
            label.style.color = "#000";
        });
        selectedLabel.style.backgroundColor = "#0d6efd"; // Bootstrap primary
        selectedLabel.style.color = "#fff";
    }
</script>
<?= $this->endSection() ?>