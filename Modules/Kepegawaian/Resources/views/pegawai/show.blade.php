@extends('adminlte::page')
@section('title', 'Jenisluaran')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
                    <div class="card-header">Pegawai {{ $pegawai->nama }}</div>
                    <div class="card-body">

                        <a href="{{ url('/kepegawaian/pegawai') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button></a>
                        <a href="{{ url('/kepegawaian/pegawai/' . $pegawai->id . '/edit') }}" title="Edit JenisLuaran"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah</button></a>

                        <form method="POST" action="{{ url('/kepegawaian/pegawai' . '/' . $pegawai->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete JenisLuaran" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $pegawai->id }}</td>
                                    </tr>
                                    <tr><th> NIP/NIPPPK/NIK </th><td> {{ $pegawai->nip }} </td></tr>
                                    <tr><th> Nama </th><td> {{ $pegawai->nama }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                
        </div>
    </div>
</div>
@endsection
