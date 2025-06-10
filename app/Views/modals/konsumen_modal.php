<!-- Modal -->
<div class="modal fade" id="dataKonsumenModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form
            method="POST" enctype="multipart/form-data"
            id="konsumenForm"
            class="modal-content border-0 shadow rounded-4 overflow-hidden"
            action="<?= base_url('addKonsumen') ?>">
            <?= csrf_field() ?>

            <!-- Akan diubah oleh JavaScript saat edit -->
            <input type="hidden" name="id" id="konsumen_id">
            <input type="hidden" name="_method" id="form_method" value="POST">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold d-flex align-items-center gap-2" id="dataModalLabel">
                    Add Kriteria / Edit Kriteria
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Konsumen</label>
                    <input type="text" name="nama" class="form-control" id="nama" required>
                </div>
                <div class="mb-3">
                    <label for="kelayakan_usaha" class="form-label">Kelayakan Usaha</label>
                    <select name="kelayakan_usaha" id="kelayakan_usaha" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="Sangat Baik">Sangat Baik</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Buruk">Buruk</option>
                        <option value="Sangat Buruk">Sangat Buruk</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="riwayat_kredit" class="form-label">Riwayat Kredit</label>
                    <select name="riwayat_kredit" id="riwayat_kredit" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="Sangat Baik">Sangat Baik</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Buruk">Buruk</option>
                        <option value="Sangat Buruk">Sangat Buruk</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="potensi_pendapatan" class="form-label">Potensi Pendapatan</label>
                    <select name="potensi_pendapatan" id="potensi_pendapatan" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="Sangat Baik">Sangat Baik</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Buruk">Buruk</option>
                        <option value="Sangat Buruk">Sangat Buruk</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jaminan" class="form-label">Jaminan</label>
                    <select name="jaminan" id="jaminan" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="Sangat Baik">Sangat Baik</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Buruk">Buruk</option>
                        <option value="Sangat Buruk">Sangat Buruk</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="analisis_pasar" class="form-label">Analisis Pasar</label>
                    <select name="analisis_pasar" id="analisis_pasar" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="Sangat Baik">Sangat Baik</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Buruk">Buruk</option>
                        <option value="Sangat Buruk">Sangat Buruk</option>
                    </select>
                </div>
            </div>


            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="submitBtn">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT -->
<script>
    // Menampilkan form tambah domba
    function openAddKonsumen() {
        // Reset Form
        const form = document.getElementById('konsumenForm');
        form.reset();

        // Atur action form untuk "Add"
        form.action = "<?= base_url('addKonsumen') ?>";

        // Ganti label dan tombol
        document.getElementById('dataModalLabel').innerHTML = '<i class="material-icons">person</i> Add Konsumen';
        document.getElementById('submitBtn').innerText = 'Add';

        // Kosongkan field value secara eksplisit
        document.querySelector('input[name="id"]').value = '';
        document.getElementById('nama').value = '';
        document.getElementById('kelayakan_usaha').value = '';
        document.getElementById('riwayat_kredit').value = '';
        document.getElementById('potensi_pendapatan').value = '';
        document.getElementById('jaminan').value = '';
        document.getElementById('analisis_pasar').value = '';

        // Tampilkan modal
        $('#dataKonsumenModal').modal('show');
    }

    // Menampilkan Form Edit
    function openEditKonsumenModal(button) {
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');
        const kelayakan_usaha = button.getAttribute('data-kelayakan_usaha');
        const riwayat_kredit = button.getAttribute('data-riwayat_kredit');
        const potensi_pendapatan = button.getAttribute('data-potensi_pendapatan');
        const jaminan = button.getAttribute('data-jaminan');
        const analisis_pasar = button.getAttribute('data-analisis_pasar');


        const form = document.getElementById('konsumenForm');
        form.action = "<?= base_url('editKonsumen') ?>/" + id;

        document.querySelector('input[name="id"]').value = id;
        document.querySelector('input[name="nama"]').value = nama;
        document.querySelector('select[name="kelayakan_usaha"]').value = kelayakan_usaha;
        document.querySelector('select[name="riwayat_kredit"]').value = riwayat_kredit;
        document.querySelector('select[name="potensi_pendapatan"]').value = potensi_pendapatan;
        document.querySelector('select[name="jaminan"]').value = jaminan;
        document.querySelector('select[name="analisis_pasar"]').value = analisis_pasar;


        // Ubah label dan tombol
        document.getElementById('dataModalLabel').innerHTML = 'Edit Konsumen';
        document.getElementById('submitBtn').innerText = 'Update';

        // Tampilkan modal
        $('#dataKonsumenModal').modal('show');
    }
</script>