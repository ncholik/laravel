@extends('adminlte::page')

@section('title', 'Pengajuan Anggaran')
@section('content_header')
    <h1 class="m-0 text-dark">Pengajunan Anggaran</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pengajuan.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Judul</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Judul" required>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary">Save <span class="fa fa-save"></span></button>
                </div>
            </form>
        </div>
    </div>
@endsection
