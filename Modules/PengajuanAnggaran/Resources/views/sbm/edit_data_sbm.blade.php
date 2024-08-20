<div class="modal-header">
    <h5 class="modal-title" id="moditTitleEdit">Edit SBM</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
<div class="modal-body">
    <form id="form-edit-data-sbm-{{ $id }}" action="/pengajuananggaran/edit-data-sbm/{{ $id }}"
        method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Item</label>
            <input type="text" class="form-control" name="nama" id="nama" value="{{ $nama }}"
                placeholder="Item" required>
        </div>
        <div class="mb-3">
            <label for="jumlah_satuan" class="form-label">Jumlah Satuan</label>
            <input type="number" class="form-control" name="jumlah_satuan" id="jumlah_satuan"
                placeholder="Jumlah Satuan" value="{{ $jumlah_satuan }}">
        </div>
        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan"
                value="{{ $satuan }}">
        </div>
        <div class="mb-3">
            <label for="harga_satuan" class="form-label">Harga</label>
            <input type="text" class="form-control" name="harga_satuan" id="harga_satuan" placeholder="Harga"
                value="{{ $harga_satuan }}">
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keterangan" rows="3">{{ $keterangan }}</textarea>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" onclick="submitEdit()" class="btn btn-primary">Save</button>
</div>

<script>
    function submitEdit() {
        $("#form-edit-data-sbm-{{ $id }}").submit();
    }
</script>
