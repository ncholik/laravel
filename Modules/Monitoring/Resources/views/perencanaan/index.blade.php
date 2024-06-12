@extends('adminlte::page')
@section('title', 'Perencanaan')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Data Perencanaan</div>
                <div class="card-body">
                    <a href="{{ url('/monitoring/perencanaan/create') }}" class="btn btn-success btn-sm"
                        title="Tambah Perencanaan">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                    </a>

                    <form method="GET" action="{{ url('/monitoring/perencanaan') }}" accept-charset="UTF-8"
                        class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari..."
                                value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <br />
                    <br />
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Program</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perencanaans as $perencanaan)
                                    <tr>
                                        <td>{{ $perencanaan->kode }}</td>
                                        <td>{{ $perencanaan->nama }}</td>
                                        <td>
                                            <div class="btn-group dropright">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                        href="{{ route('perencanaan.sub_index', $perencanaan->id) }}"
                                                        title="Lihat Perencanaan">
                                                        <button class="btn btn-info btn-sm btn-block">
                                                            <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                                                        </button>
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('perencanaan.edit', $perencanaan->id) }}"
                                                        title="Edit Perencanaan">
                                                        <button class="btn btn-primary btn-sm btn-block">
                                                            <i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit
                                                        </button>
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('perencanaan.destroy', $perencanaan->id) }}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a class="dropdown-item">
                                                            <button type="submit" class="btn btn-danger btn-sm btn-block"
                                                                title="Hapus Perencanaan"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus perencanaan ini?')">
                                                                <i class="fas fa-trash" aria-hidden="true"></i> Hapus
                                                            </button>
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex">
                            {!! $perencanaans->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
