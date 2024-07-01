<input type="hidden" name="backurl"
    value="<?php echo Request::server('HTTP_REFERER') == null ? '/monitoring/realisasi' : Request::server('HTTP_REFERER'); ?>">

<input type="hidden" name="sub_perencanaan_id" id="subPerencanaanId">

<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="program" class="control-label">Program</label>
                <input class="form-control" name="program" type="text" id="program" value="" required>
            </div>
            <div class="form-group">
                <label for="kegiatan" class="control-label">Kegiatan</label>
                <input class="form-control" name="kegiatan" type="text" id="kegiatan" value="" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="anggaran_program" class="control-label">Anggaran Keuangan Program</label>
                        <input class="form-control" name="anggaran_program" type="text" id="anggaran_program" value=""
                            required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="anggaran_kegiatan" class="control-label">Anggaran Keuangan Kegiatan</label>
                        <input class="form-control" name="anggaran_kegiatan" type="text" id="anggaran_kegiatan" value=""
                            required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="uang_program" class="control-label">Realisasi Keuangan Program</label>
                        <input class="form-control" name="uang_program" type="text" id="uang_program" value="" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="uang_realisasi" class="control-label">Realisasi Keuangan Kegiatan</label>
                        <input class="form-control" name="uang_realisasi" type="text" id="uang_realisasi" value=""
                            required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Sumber Dana</label>
                        <select class="form-control select2" id="unit-select">
                            <!-- Options will be populated by JS -->
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="sisa" class="control-label">Sisa</label>
                        <input class="form-control" name="sisa" type="text" id="sisa" value="" required>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="Persentase" class="control-label">Persentase</label>
                        <div class="input-group">
                            <input class="form-control" name="Persentase" type="text" id="Persentase" value="" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-percent"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ url(Request::server('HTTP_REFERER') == null ? '/monitoring/realisasi' : Request::server('HTTP_REFERER')) }}"
                        title="Kembali"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"
                                aria-hidden="true"></i> Kembali</button></a>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'create' ? 'Tambah' : 'Memperbarui' }}">
    </div>
</div>
