@extends('adminlte::page')

@section('title', 'Data Pengajuan Anggaran')
@section('content_header')
<h1 class="m-0 text-dark">Pengajunan Anggaran</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @role('admin')
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('pengajuan.create') }}" class="btn btn-success">Tambah</a>
        </div>
        @endrole
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal Diajukan</th>
                        <th>Status Approval</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rab as $r)
                    <tr class="">
                        <td>{{ $r->nama }}</td>
                        <td>{{ date('d-m-Y', strtotime($r->created_at)) }}</td>
                        <td><b>{{ ucfirst($r->status) }}</b></td>
                        <td>
                            <div class="d-flex" style="gap: 10px">
                                <a href="{{ route('pengajuan.show', ['pengajuan' => $r->id]) }}" type="button" class="btn btn-outline-success"><span class="fa fa-eye"></span></a>
                                @role('admin')
                                @if ($r->status == 'waiting')
                                <a href="{{ route('pengajuan.edit', ['pengajuan' => $r->id]) }}" class="btn btn-outline-warning"><span class="fa fa-edit"></span></a>
                                <form action="{{ route('pengajuan.destroy', ['pengajuan' => $r->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-danger"><span class="fa fa-trash-alt"></span></button>
                                </form>
                                @endif
                                @endrole

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection