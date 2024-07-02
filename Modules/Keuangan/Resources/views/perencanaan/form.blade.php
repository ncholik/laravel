<input type="hidden" name="backurl" value="<?php echo Request::server('HTTP_REFERER') == null ? '/monitoring/perencanaan' : Request::server('HTTP_REFERER'); ?>">

<div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
    <label for="nama" class="control-label">{{ 'Nama Kegiatan' }}</label>
    <input class="form-control" name="nama" type="text" id="nama"
        value="{{ isset($perencanaan->nama) ? $perencanaan->nama : old('nama') }}" required>
    {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('kode') ? 'has-error' : '' }}">
    <label for="kode" class="control-label">{{ 'Kode' }}</label>
    <input class="form-control" name="kode" type="text" id="kode"
        value="{{ isset($perencanaan->kode) ? $perencanaan->kode : old('kode') }}" required>
    {!! $errors->first('kode', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('sumber') ? 'has-error' : '' }}">
    <label for="sumber" class="control-label">{{ 'Sumber' }}</label>
    <input class="form-control" name="sumber" type="text" id="sumber"
        value="{{ isset($perencanaan->sumber) ? $perencanaan->sumber : old('sumber') }}" required>
    {!! $errors->first('sumber', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('revisi') ? 'has-error' : '' }}">
    <label for="revisi" class="control-label">{{ 'Revisi' }}</label>
    <input class="form-control" name="revisi" type="text" id="revisi"
        value="{{ isset($perencanaan->revisi) ? $perencanaan->revisi : old('revisi') }}" required>
    {!! $errors->first('revisi', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('unit_id') ? 'has-error' : '' }}">
    <label for="unit_id" class="control-label">{{ 'Unit ID' }}</label>
    <input class="form-control" name="unit_id" type="text" id="unit_id"
        value="{{ isset($perencanaan->unit_id) ? $perencanaan->unit_id : old('unit_id') }}" required>
    {!! $errors->first('unit_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Memperbarui' : 'Tambah' }}">
</div>
