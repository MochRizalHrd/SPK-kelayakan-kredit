<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<style>
    table.wp-ranking {
        border-collapse: collapse;
        width: 50%;
        margin-top: 30px;
        font-family: Arial, sans-serif;
        text-align: center;
    }

    table.wp-ranking th,
    table.wp-ranking td {
        border: 1px solid #000;
        padding: 8px;
    }

    table.wp-ranking th {
        background-color: #d9ead3; /* Hijau pucat */
        font-weight: bold;
    }

    table.wp-ranking .total-row {
        font-weight: bold;
        background-color: #f2f2f2;
    }
</style>

<h3 class="mb-4">Hasil Ranking WP</h3>

<table class="wp-ranking">
    <thead>
        <tr>
            <th>Kode</th>
            <th>V</th>
            <th>Ranking</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>A1</td>
            <td>0,2157792708</td>
            <td>2</td>
        </tr>
        <tr>
            <td>A2</td>
            <td>0,2094470872</td>
            <td>3</td>
        </tr>
        <tr>
            <td>A3</td>
            <td>0,1893539355</td>
            <td>4</td>
        </tr>
        <tr>
            <td>A4</td>
            <td>0,1583860897</td>
            <td>5</td>
        </tr>
        <tr>
            <td>A5</td>
            <td>0,2270336169</td>
            <td>1</td>
        </tr>
        <tr class="total-row">
            <td>Jumlah</td>
            <td>1</td>
            <td></td>
        </tr>
    </tbody>
</table>

<?= $this->endSection() ?>
