<div class="modal-header">
    <h5 class="modal-title" id="moditTitleEdit">Edit Indikator Kinerja</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
<div class="modal-body">
    <form id="form-edit-data-iku-{{ $id }}" action="/pengajuananggaran/edit-data-iku/{{ $id }}"
        method="POST">
        @csrf
        <div class="mb-3">
            <label for="indikator" class="form-label">Indikator Kinerja Kegiatan</label>
            <input type="text" class="form-control" name="indikator" id="indikator" value="{{ $indikator }}"
                placeholder="Indikator Kinerja Kegiatan" required>
        </div>
        <div class="mb-3">
            <label for="target" class="form-label">Target Perjanjian Kinerja</label>
            <input type="text" class="form-control" name="target" id="target"
                placeholder="Target Perjanjian Kinerja" value="{{ $target }}" required>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" onclick="submitEdit()" class="btn btn-primary">Save</button>
</div>

<script>
    function submitEdit() {
        $("#form-edit-data-iku-{{ $id }}").submit();
    }
</script>
