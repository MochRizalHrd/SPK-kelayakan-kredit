<!-- Modal -->
<div class="modal fade" id="dataRatingModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form
            method="POST" enctype="multipart/form-data"
            id="ratingForm"
            class="modal-content border-0 shadow rounded-4 overflow-hidden"
            action="<?= base_url('addRating') ?>">
            <?= csrf_field() ?>

            <!-- Akan diubah oleh JavaScript saat edit -->
            <input type="hidden" name="id" id="rating_id">
            <input type="hidden" name="_method" id="form_method" value="POST">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold d-flex align-items-center gap-2" id="dataModalLabel">
                    Add Rating / Edit Rating
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
                    <input type="number" name="kelayakan_usaha" class="form-control" id="kelayakan_usaha" required min="1">
                </div>

                <div class="mb-3">
                    <label for="riwayat_kredit" class="form-label">Riwayat Kredit</label>
                    <input type="number" name="riwayat_kredit" class="form-control" id="riwayat_kredit" required min="1">
                </div>

                <div class="mb-3">
                    <label for="potensi_pendapatan" class="form-label">Potensi Pendapatan</label>
                    <input type="number" name="potensi_pendapatan" class="form-control" id="potensi_pendapatan" required min="1">
                </div>

                <div class="mb-3">
                    <label for="jaminan" class="form-label">Jaminan</label>
                    <input type="number" name="jaminan" class="form-control" id="jaminan" required min="1">
                </div>

                <div class="mb-3">
                    <label for="analisis_pasar" class="form-label">Analisis Pasar</label>
                    <input type="number" name="analisis_pasar" class="form-control" id="analisis_pasar" required min="1">
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
    function openAddRating() {
        // Reset Form
        const form = document.getElementById('ratingForm');
        form.reset();

        // Atur action form untuk "Add"
        form.action = "<?= base_url('addRating') ?>";

        // Ganti label dan tombol
        document.getElementById('dataModalLabel').innerHTML = '<i class="material-icons">person</i> Add Rating';
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
        $('#dataRatingModal').modal('show');
    }

    // Menampilkan Form Edit
    function openEditRatingModal(button) {
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');
        const kelayakan_usaha = button.getAttribute('data-kelayakan_usaha');
        const riwayat_kredit = button.getAttribute('data-riwayat_kredit');
        const potensi_pendapatan = button.getAttribute('data-potensi_pendapatan');
        const jaminan = button.getAttribute('data-jaminan');
        const analisis_pasar = button.getAttribute('data-analisis_pasar');


        const form = document.getElementById('ratingForm');
        form.action = "<?= base_url('editRating') ?>/" + id;

        document.querySelector('input[name="id"]').value = id;
        document.querySelector('input[name="nama"]').value = nama;
        document.querySelector('input[name="kelayakan_usaha"]').value = kelayakan_usaha;
        document.querySelector('input[name="riwayat_kredit"]').value = riwayat_kredit;
        document.querySelector('input[name="potensi_pendapatan"]').value = potensi_pendapatan;
        document.querySelector('input[name="jaminan"]').value = jaminan;
        document.querySelector('input[name="analisis_pasar"]').value = analisis_pasar;


        // Ubah label dan tombol
        document.getElementById('dataModalLabel').innerHTML = 'Edit Rating';
        document.getElementById('submitBtn').innerText = 'Update';

        // Tampilkan modal
        $('#dataRatingModal').modal('show');
    }
</script>