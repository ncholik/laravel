<input type="hidden" name="backurl"
    value="<?php echo Request::server('HTTP_REFERER') == null ? '/monitoring/realisasi' : Request::server('HTTP_REFERER'); ?>">

<input type="hidden" name="sub_perencanaan_id" id="subPerencanaanId">

<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="program" class="control-label">Progres</label>
                <input class="form-control" name="program" type="text" id="program" value="" required>
            </div>
            <div class="form-group">
                <label for="kegiatan" class="control-label">Realisasi</label>
                <input class="form-control" name="kegiatan" type="text" id="kegiatan" value="" required>
            </div>
            <div class="form-group">
                <label for="laporan_keuangan" class="control-label">Laporan Keuangan</label>
                <input class="form-control" name="laporan_keuangan" type="text" id="laporan_keuangan" value="" required>
            </div>
            <div class="form-group">
                <label for="laporan_kegiatan" class="control-label">Laporan Kegiatan</label>
                <input class="form-control" name="laporan_kegiatan" type="text" id="laporan_kegiatan" value="" required>
            </div>
            <div class="form-group">
                <label for="ketercapaian_output" class="control-label">Ketercapaian Output</label>
                <input class="form-control" name="ketercapaian_output" type="text" id="ketercapaian_output" value=""
                    required>
            </div>
            <div class="form-group">
                <label for="tanggal_kontrak" class="control-label">Tanggal Kontrak</label>
                <input class="form-control" name="tanggal_kontrak" type="date" id="tanggal_kontrak" value="" required>
            </div>
            <div class="form-group">
                <label for="tanggal_pembayaran" class="control-label">Tanggal Pembayaran</label>
                <input class="form-control" name="tanggal_pembayaran" type="date" id="tanggal_pembayaran" value=""
                    required>
            </div>
            <!-- <div class="form-group">
                <label for="sub_perencanaan_id" class="control-label">Sub Perencanaanid</label>
                <input class="form-control" name="sub_perencanaan_id" type="text" id="sub_perencanaan_id" value="" required>
            </div> -->
        </div>
    </div>
    <div style="display: flex; gap: 10px;">
        <div class="form-group">
            <input class="btn btn-primary btn-sm" type="submit"
                value="{{ $formMode === 'create' ? 'Tambah' : 'Memperbarui' }}">
        </div>
    </div>
</div>
