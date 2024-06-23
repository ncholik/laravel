<input type="hidden" name="backurl" value="<?php echo Request::server('HTTP_REFERER') == null ? '/monitoring/realisasi' : Request::server('HTTP_REFERER'); ?>">

<input type="hidden" name="sub_perencanaan_id" id="subPerencanaanId">

<div class="form-group {{ $errors->has('progres') ? 'has-error' : '' }}">
    <label for="progres" class="control-label">{{ 'Progres' }}</label>
    <input class="form-control" name="progres" type="text" id="progres"
        value="{{ isset($realisasi->progres) ? $realisasi->progres : old('progres') }}" required>
    {!! $errors->first('progres', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('realisasi') ? 'has-error' : '' }}">
    <label for="realisasi" class="control-label">{{ 'Realisasi' }}</label>
    <input class="form-control" name="realisasi" type="number" id="realisasi"
        value="{{ isset($realisasi->realisasi) ? $realisasi->realisasi : old('realisasi') }}" required>
    {!! $errors->first('realisasi', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('laporan_keuangan') ? 'has-error' : '' }}">
    <label for="laporan_keuangan" class="control-label">{{ 'Laporan Keuangan' }}</label>
    <input class="form-control" name="laporan_keuangan" type="text" id="laporan_keuangan"
        value="{{ isset($realisasi->laporan_keuangan) ? $realisasi->laporan_keuangan : old('laporan_keuangan') }}"
        required>
    {!! $errors->first('laporan_keuangan', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('laporan_kegiatan') ? 'has-error' : '' }}">
    <label for="laporan_kegiatan" class="control-label">{{ 'Laporan Kegiatan' }}</label>
    <input class="form-control" name="laporan_kegiatan" type="text" id="laporan_kegiatan"
        value="{{ isset($realisasi->laporan_kegiatan) ? $realisasi->laporan_kegiatan : old('laporan_kegiatan') }}"
        required>
    {!! $errors->first('laporan_kegiatan', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('ketercapaian_output') ? 'has-error' : '' }}">
    <label for="ketercapaian_output" class="control-label">{{ 'Ketercapaian Output' }}</label>
    <input class="form-control" name="ketercapaian_output" type="text" id="ketercapaian_output"
        value="{{ isset($realisasi->ketercapaian_output) ? $realisasi->ketercapaian_output : old('ketercapaian_output') }}"
        required>
    {!! $errors->first('ketercapaian_output', '<p class="help-block">:message</p>') !!}
</div>

<div class="row">
    <div class="col-6">
        <div class="form-group {{ $errors->has('tanggal_kontrak') ? 'has-error' : '' }}">
            <label for="tanggal_kontrak" class="control-label">{{ 'Tanggal Kontrak' }}</label>
            <input class="form-control" name="tanggal_kontrak" type="date" id="tanggal_kontrak"
                value="{{ isset($realisasi->tanggal_kontrak) ? $realisasi->tanggal_kontrak : old('tanggal_kontrak') }}"
                required>
            {!! $errors->first('tanggal_kontrak', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-6">
        <div class="form-group {{ $errors->has('tanggal_pembayaran') ? 'has-error' : '' }}">
            <label for="tanggal_pembayaran" class="control-label">{{ 'Tanggal Pembayaran' }}</label>
            <input class="form-control" name="tanggal_pembayaran" type="date" id="tanggal_pembayaran"
                value="{{ isset($realisasi->tanggal_pembayaran) ? $realisasi->tanggal_pembayaran : old('tanggal_pembayaran') }}"
                required>
            {!! $errors->first('tanggal_pembayaran', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'create' ? 'Tambah' : 'Memperbarui' }}">
</div>
