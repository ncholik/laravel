@extends('adminlte::page')
@section('title', 'Jenisluaran')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
                    <div class="card-header">Data Pegawai</div>
                    <div class="card-body">
                        <a href="{{ url('/kepegawaian/pegawai/create') }}" class="btn btn-success btn-sm" title="Tambah Pegawai">
                            <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                        </a>

                        <form method="GET" action="{{ url('/kepegawaian/pegawai') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Cari..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th><th>NIP/NIPPPK/NIK</th><th>Nama</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pegawai as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nip }}</td><td>{{ $item->nama }}</td>
                                        <td>
                                            <a href="{{ url('/kepegawaian/pegawai/' . $item->id) }}" title="View JenisLuaran"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/kepegawaian/pegawai/' . $item->id . '/edit') }}" title="Edit JenisLuaran"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/kepegawaian/pegawai' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete JenisLuaran" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex">
                                {!! $pegawai->links('pagination::bootstrap-4') !!}
                            </div>
                        </div>

                    </div>
                
        </div>
    </div>
</div>
@endsection
