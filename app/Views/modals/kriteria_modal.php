<!-- Modal -->
<div class="modal fade" id="dataKriteriaModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form
            method="POST" enctype="multipart/form-data"
            id="kriteriaForm"
            class="modal-content border-0 shadow rounded-4 overflow-hidden"
            action="<?= base_url('addKriteria') ?>">
            <?= csrf_field() ?>

            <!-- Akan diubah oleh JavaScript saat edit -->
            <input type="hidden" name="id" id="kriteria_id">
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
                    <label for="kriteria" class="form-label">Kriteria</label>
                    <input type="text" name="kriteria" class="form-control" id="kriteria" required>
                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select name="jenis" id="jenis" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="Benefit">Benefit</option>
                        <option value="Cost">Cost</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="bobot" class="form-label">Bobot</label>
                    <input type="decimal" name="bobot" class="form-control" id="bobot" required min="1">
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
    function openAddKriteria() {
        // Reset Form
        const form = document.getElementById('kriteriaForm');
        form.reset();

        // Atur action form untuk "Add"
        form.action = "<?= base_url('addKriteria') ?>";

        // Ganti label dan tombol
        document.getElementById('dataModalLabel').innerHTML = '<i class="material-icons">person</i> Add Kriteria';
        document.getElementById('submitBtn').innerText = 'Add';

        // Kosongkan field value secara eksplisit
        document.querySelector('input[name="id"]').value = '';
        document.getElementById('kriteria').value = '';
        document.getElementById('jenis').value = '';
        document.getElementById('bobot').value = '';

        // Tampilkan modal
        $('#dataKriteriaModal').modal('show');
    }

    // Menampilkan Form Edit
    function openEditKriteriaModal(button) {
        const id = button.getAttribute('data-id');
        const kriteria = button.getAttribute('data-kriteria');
        const jenis = button.getAttribute('data-jenis');
        const bobot = button.getAttribute('data-bobot');


        const form = document.getElementById('kriteriaForm');
        form.action = "<?= base_url('editKriteria') ?>/" + id;

        document.querySelector('input[name="id"]').value = id;
        document.querySelector('input[name="kriteria"]').value = kriteria;
        document.querySelector('select[name="jenis"]').value = jenis;
        document.querySelector('input[name="bobot"]').value = bobot;


        // Ubah label dan tombol
        document.getElementById('dataModalLabel').innerHTML = 'Edit Kriteria';
        document.getElementById('submitBtn').innerText = 'Update';

        // Tampilkan modal
        $('#dataKriteriaModal').modal('show');
    }
</script>