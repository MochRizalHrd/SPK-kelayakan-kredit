<!-- Modal -->
<div class="modal fade" id="dataPembobotanModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form
            method="POST" enctype="multipart/form-data"
            id="pembobotanForm"
            class="modal-content border-0 shadow rounded-4 overflow-hidden"
            action="<?= base_url('addPembobotan') ?>">
            <?= csrf_field() ?>

            <!-- Akan diubah oleh JavaScript saat edit -->
            <input type="hidden" name="id" id="pembobotan_id">
            <input type="hidden" name="_method" id="form_method" value="POST">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold d-flex align-items-center gap-2" id="dataModalLabel">
                    Add Pembobotan Nilai Kriteria / Edit Pembobotan Nilai Kriteria
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" id="keterangan" required>
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
    // Menampilkan form tambah keriteria berat
    function openAddPembobotan() {
        // Reset Form
        const form = document.getElementById('pembobotanForm');
        form.reset();

        // Atur action form untuk "Add"
        form.action = "<?= base_url('addPembobotan') ?>";

        // Ganti label dan tombol
        document.getElementById('dataModalLabel').innerHTML = '<i class="material-icons">person</i> Add Pembobotan Nilai Kriteria';
        document.getElementById('submitBtn').innerText = 'Add';

        // Kosongkan field value secara eksplisit
        document.querySelector('input[name="id"]').value = '';
        document.getElementById('keterangan').value = '';
        document.getElementById('bobot').value = '';
        // document.getElementById('password').required = true;

        // Tampilkan modal
        $('#dataPembobotanModal').modal('show');
    }

    // Menampilkan Form Edit
    function openEditPembobotanModal(button) {
        const id = button.getAttribute('data-id');
        const keterangan = button.getAttribute('data-keterangan');
        const bobot = button.getAttribute('data-bobot');


        const form = document.getElementById('pembobotanForm');
        form.action = "<?= base_url('editPembobotan') ?>/" + id;

        document.querySelector('input[name="id"]').value = id;
        document.querySelector('input[name="keterangan"]').value = keterangan;
        document.querySelector('input[name="bobot"]').value = bobot;


        // Ubah label dan tombol
        document.getElementById('dataModalLabel').innerHTML = 'Edit Pembobotan Nilai Kriteria';
        document.getElementById('submitBtn').innerText = 'Update';

        // Tampilkan modal
        $('#dataPembobotanModal').modal('show');
    }
</script>