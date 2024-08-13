<input type="hidden" name="backurl" value="<?php echo Request::server('HTTP_REFERER') == null ? '/kepegawaian/pejabat' : Request::server('HTTP_REFERER'); ?>">

<div class="form-group {{ $errors->has('jabatan') ? 'has-error' : '' }}">
    <label for="jabatan" class="control-label">{{ 'Jabatan' }}</label>
    <input class="form-control" name="jabatan" type="text" id="jabatan"
        value="{{ isset($pejabat->jabatan) ? $pejabat->jabatan : old('jabatan') }}" required>
    {!! $errors->first('jabatan', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group row">
    <div class="col-md-6 {{ $errors->has('mulai') ? 'has-error' : '' }}">
        <label for="mulai" class="control-label">{{ 'Tanggal Mulai' }}</label>
        <input class="form-control" name="mulai" type="date" id="mulai"
            value="{{ isset($pejabat->mulai) ? $pejabat->mulai : old('mulai') }}" required>
        {!! $errors->first('mulai', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="col-md-6 {{ $errors->has('selesai') ? 'has-error' : '' }}">
        <label for="selesai" class="control-label">{{ 'Tanggal Selesai' }}</label>
        <input class="form-control" name="selesai" type="date" id="selesai"
            value="{{ isset($pejabat->selesai) ? $pejabat->selesai : old('selesai') }}">
        {!! $errors->first('selesai', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6 {{ $errors->has('SK') ? 'has-error' : '' }}">
        <label for="SK" class="control-label">{{ 'Nomor SK' }}</label>
        <input class="form-control" name="SK" type="text" id="SK"
            value="{{ isset($pejabat->SK) ? $pejabat->SK : old('SK') }}">
        {!! $errors->first('SK', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="col-md-6 {{ $errors->has('pegawai_id') ? 'has-error' : '' }}">
        <label for="pegawai_id" class="control-label">{{ 'Pegawai' }}</label>
        <select name="pegawai_id" id="pegawai_id" class="form-control" required>
            <option value="">--- Pilih Pegawai ---</option>
            @foreach ($pegawais as $pegawai)
                <option value="{{ $pegawai->id }}"
                    {{ isset($pejabat->pegawai_id) && $pejabat->pegawai_id == $pegawai->id ? 'selected' : (old('pegawai_id') == $pegawai->id ? 'selected' : '') }}>
                    {{ $pegawai->nama }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('pegawai_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6 {{ $errors->has('unit_id') ? 'has-error' : '' }}">
        <label for="unit_id" class="control-label">{{ 'Unit' }}</label>
        <select name="unit_id" id="unit_id" class="form-control">
            <option value="">--- Pilih Unit ---</option>
            @foreach ($units as $unit)
                <option value="{{ $unit->id }}"
                    {{ isset($pejabat->unit_id) && $pejabat->unit_id == $unit->id ? 'selected' : (old('unit_id') == $unit->id ? 'selected' : '') }}>
                    {{ $unit->nama }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('unit_id', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="col-md-6 {{ $errors->has('status') ? 'has-error' : '' }}">
        <label for="status" class="control-label">{{ 'Status' }}</label>
        <select name="status" id="status" class="form-control" required>
            <option value="Aktif"
                {{ isset($pejabat->status) && $pejabat->status == 'Aktif' ? 'selected' : (old('status') == 'Aktif' ? 'selected' : '') }}>
                Aktif</option>
            <option value="Non Aktif"
                {{ isset($pejabat->status) && $pejabat->status == 'Non Aktif' ? 'selected' : (old('status') == 'Non Aktif' ? 'selected' : '') }}>
                Non Aktif</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Memperbarui' : 'Tambah' }}">
</div>
