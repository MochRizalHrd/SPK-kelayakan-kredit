<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4"><?= esc($title) ?></h2>

    <!-- Informasi Singkat -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-primary shadow">
                <div class="card-body text-primary">
                    <h5 class="card-title">Jumlah Kriteria</h5>
                    <p class="card-text fs-4"><?= $jumlahKriteria ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-success shadow">
                <div class="card-body text-success">
                    <h5 class="card-title">Jumlah Alternatif</h5>
                    <p class="card-text fs-4"><?= $jumlahAlternatif ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="card shadow mb-5">
        <div class="card-header bg-dark text-white">
            Visualisasi Hasil Perhitungan Nilai V
        </div>
        <div class="card-body">
            <canvas id="rankingChart" height="120"></canvas>
        </div>
    </div>

    <!-- Deskripsi -->
    <div class="card shadow mb-5">
        <div class="card-body">
            <h5 class="card-title">Kesimpulan</h5>
            <p class="card-text">
                Berdasarkan hasil perangkingan menggunakan metode Weighted Product (WP), alternatif dengan nilai V tertinggi dianggap sebagai alternatif paling layak. Visualisasi di atas menunjukkan perbandingan nilai preferensi antar alternatif.
                Alternatif dengan bar tertinggi menunjukkan hasil evaluasi terbaik berdasarkan kriteria yang ditentukan.
            </p>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('rankingChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= $labels ?>,
            datasets: [{
                label: 'Nilai Preferensi (V)',
                data: <?= $data ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 1
                }
            }
        }
    });
</script>

<?= $this->endSection() ?>
