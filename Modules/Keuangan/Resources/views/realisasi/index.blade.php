@extends('adminlte::page')
@section('title', 'Realisasi')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Data Realisasi</div>
                <div class="card-body">
                    <a href="{{ route('realisasi.create') }}" class="btn btn-success btn-sm" title="Tambah Realisasi">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                    </a>

                    <form method="GET" action="{{ route('realisasi.index') }}" accept-charset="UTF-8"
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
                                    <th>kode</th>
                                    <th>Nama Program</th>
                                    <th>Jumlah Anggaran</th>
                                    <th>Realisasi Keuangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perencanaans as $perencanaan)
                                    <tr>
                                        <td>{{ $perencanaan->kode }}</td>
                                        <td>{{ $perencanaan->nama }}</td>
                                        @foreach ($perencanaan->subPerencanaan as $sub)
                                            {{-- <td>{{ $sub->kegiatan }}</td> --}}
                                            <td>Rp.{{ str_replace(',', '.', number_format($sub->volume * $sub->harga_satuan)) }}</td>
                                            <td>Rp.{{ str_replace(',', '.', number_format($sub->realisasi->sum('realisasi'))) }}</td>
                                        @endforeach
                                        <td>
                                            <a href="{{ route('realisasi.show', $perencanaan->id) }}"
                                                title="View Realisasi">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                            <a href="{{ url('/realisasi/' . $perencanaan->id . '/edit') }}"
                                                title="Edit Realisasi">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit" arria-hidden="true"></i>
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ url('/realisasi/' . $perencanaan->id) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    title="Delete Realisasi"
                                                    onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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
