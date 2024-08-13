@extends('adminlte::page')
@section('title', 'Jenisluaran')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
                    <div class="card-header">Ubah JenisLuaran #{{ $pegawai->nama }}</div>
                    <div class="card-body">
                        
                        <a href="{{ url( (Request::server('HTTP_REFERER')==null?'/kepegawaian/pegawai':Request::server('HTTP_REFERER')) ) }}" title="Kembali"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/kepegawaian/pegawai/' . $pegawai->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('kepegawaian::pegawai.form', ['formMode' => 'edit'])

                        </form>

                    </div>
              
        </div>
    </div>
</div>
@endsection
