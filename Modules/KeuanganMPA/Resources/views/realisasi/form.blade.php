<input type="hidden" name="backurl" value="<?php echo Request::server('HTTP_REFERER') == null ? '/keuanganmpa/realisasi' : Request::server('HTTP_REFERER'); ?>">
<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('progres') ? 'has-error' : '' }}">
                        <label for="progres" class="control-label">{{ 'Progres' }}</label>
                        <input class="form-control" name="progres" type="text" id="progres"
                            value="{{ old('progres', $realisasi->progres) }}" readonly>
                        {!! $errors->first('progres', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-md-6 {{ $errors->has('realisasi') ? 'has-error' : '' }}">
                        <label for="realisasi" class="control-label">{{ 'Realisasi' }}</label>
                        <input class="form-control" name="realisasi" type="text" id="realisasi"
                            value="{{ old('realisasi', $realisasi->realisasi) }}" required>
                        {!! $errors->first('realisasi', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6  {{ $errors->has('laporan_keuangan') ? 'has-error' : '' }}">
                        <label for="laporan_keuangan" class="control-label">{{ 'Laporan Keuangan' }}</label>
                        <input class="form-control" name="laporan_keuangan" type="file" id="laporan_keuangan">
                        {!! $errors->first('laporan_keuangan', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-md-6 {{ $errors->has('laporan_kegiatan') ? 'has-error' : '' }}">
                        <label for="laporan_kegiatan" class="control-label">{{ 'Laporan Kegiatan' }}</label>
                        <input class="form-control" name="laporan_kegiatan" type="file" id="laporan_kegiatan">
                        {!! $errors->first('laporan_kegiatan', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->has('ketercapaian_output') ? 'has-error' : '' }}">
                <label for="ketercapaian_output" class="control-label">{{ 'Ketercapaian Output' }}</label>
                <input class="form-control" name="ketercapaian_output" type="text" id="ketercapaian_output"
                    value="{{ old('ketercapaian_output', $realisasi->ketercapaian_output) }}" required>
                {!! $errors->first('ketercapaian_output', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('tanggal_kontrak') ? 'has-error' : '' }}">
                        <label for="tanggal_kontrak" class="control-label">{{ 'Tanggal Kontrak' }}</label>
                        <input class="form-control" name="tanggal_kontrak" type="date" id="tanggal_kontrak"
                            value="{{ old('tanggal_kontrak', $realisasi->tanggal_kontrak) }}"
                            onchange="setProgres('Kontrak')">
                        {!! $errors->first('tanggal_kontrak', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-md-6 {{ $errors->has('tanggal_pembayaran') ? 'has-error' : '' }}">
                        <label for="tanggal_pembayaran" class="control-label">{{ 'Tanggal Pembayaran' }}</label>
                        <input class="form-control" name="tanggal_pembayaran" type="date" id="tanggal_pembayaran"
                            value="{{ old('tanggal_pembayaran', $realisasi->tanggal_pembayaran) }}"
                            onchange="setProgres('Pembayaran')">
                        {!! $errors->first('tanggal_pembayaran', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group text-center">
        <input class="btn btn-primary mt-3" type="submit"
            value="{{ $formMode === 'edit' ? 'Memperbarui' : 'Tambah' }}">
    </div>
</div>

<script>
    function setProgres(progresType) {
        var progresInput = document.getElementById('progres');
        if (progresType === 'Kontrak') {
            progresInput.value = 'Kontrak';
        } else if (progresType === 'Pembayaran') {
            progresInput.parentNode.innerHTML = `
                <label for="laporan_keuangan" class="control-label">{{ 'Laporan Keuangan' }}</label>
                <select class="form-control" name="progres" required>
                    <option value="Pembayaran">Pembayaran</option>
                    <option value="Selesai">Selesai</option>
                </select>
            `;
        }
    }
</script>
