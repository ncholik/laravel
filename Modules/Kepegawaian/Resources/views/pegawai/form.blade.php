<input type="hidden" name="backurl" value="<?php echo (Request::server('HTTP_REFERER')==null?'/kepegawaian/pegawai':Request::server('HTTP_REFERER')); ?>">

<div class="form-group {{ $errors->has('nip') ? 'has-error' : ''}}">
    <label for="nip" class="control-label">{{ 'NIP/NIPPPK/NIK' }}</label>
    <input class="form-control" name="nip" type="text" id="nip" value="{{ isset($pegawai->nip) ? $pegawai->nip : old('nip')}}" required>
    {!! $errors->first('nip', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('nama') ? 'has-error' : ''}}">
    <label for="nama" class="control-label">{{ 'Nama' }}</label>
    <input class="form-control" name="nama" type="text" id="nama" value="{{ isset($pegawai->nama) ? $pegawai->nama : old('nama')}}" required>
    {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : ''}}">
    <label for="jenis_kelamin" class="control-label">{{ 'Kenis Kelamin' }}</label>
    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
        <option>--- Pilih ---</option>
        <option value="L" {{ isset($pegawai->nama) ? (($pegawai->jenis_kelamin=='L')?"selected":"") : ((old('jenis_kelamin')=='L')?"selected":"")}}>Laki - Laki</option>
        <option value="P" {{ isset($pegawai->nama) ? (($pegawai->jenis_kelamin=='P')?"selected":"") : ((old('jenis_kelamin')=='P')?"selected":"")}}>Perempuan</option>
    </select>    
    {!! $errors->first('jenis_kelamin', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Memperbarui' : 'Tambah' }}">
</div>
