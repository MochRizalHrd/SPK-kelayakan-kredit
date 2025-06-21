<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<style>
    table.wp-table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 30px;
        font-family: Arial, sans-serif;
        text-align: center;
    }

    table.wp-table th,
    table.wp-table td {
        border: 1px solid #000;
        padding: 8px;
    }

    table.wp-table th {
        background-color: #d9ead3; /* Hijau pucat */
        font-weight: bold;
    }

    table.wp-table .total-row {
        font-weight: bold;
        background-color: #f2f2f2;
    }
</style>

<h3 class="mb-4">Hasil Perhitungan Weighted Product (WP)</h3>

<!-- Tabel Alternatif dan Nilai Kriteria -->
<table class="wp-table">
    <thead>
        <tr>
            <th>Kode</th>
            <th>K1</th>
            <th>K2</th>
            <th>K3</th>
            <th>K4</th>
            <th>K5</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>A1</td>
            <td>5</td>
            <td>4</td>
            <td>4</td>
            <td>3</td>
            <td>5</td>
        </tr>
        <tr>
            <td>A2</td>
            <td>4</td>
            <td>3</td>
            <td>5</td>
            <td>4</td>
            <td>4</td>
        </tr>
        <tr>
            <td>A3</td>
            <td>3</td>
            <td>5</td>
            <td>3</td>
            <td>5</td>
            <td>3</td>
        </tr>
        <tr>
            <td>A4</td>
            <td>2</td>
            <td>2</td>
            <td>4</td>
            <td>2</td>
            <td>4</td>
        </tr>
        <tr>
            <td>A5</td>
            <td>4</td>
            <td>4</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
        </tr>
    </tbody>
</table>


<table class="wp-table" style="width: 60%;">
    <thead>
        <tr>
            <th rowspan="2">Kode</th>
            <th colspan="5">Bobot Pangkat</th>
        </tr>
        <tr>
            <th>0,03</th>
            <th>0,07</th>
            <th>0,1</th>
            <th>0,3</th>
            <th>0,5</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>A1</td>
            <td colspan="5">4,129910853</td>
        </tr>
        <tr>
            <td>A2</td>
            <td colspan="5">4,008715922</td>
        </tr>
        <tr>
            <td>A3</td>
            <td colspan="5">3,624142721</td>
        </tr>
        <tr>
            <td>A4</td>
            <td colspan="5">3,031433133</td>
        </tr>
        <tr>
            <td>A5</td>
            <td colspan="5">4,345313594</td>
        </tr>
        <tr class="total-row">
            <td>Jumlah</td>
            <td colspan="5">19,13951622</td>
        </tr>
    </tbody>
</table>

<?= $this->endSection() ?>
