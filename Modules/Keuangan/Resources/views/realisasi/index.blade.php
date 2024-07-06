@extends('adminlte::page')
@section('title', 'Realisasi')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-search"></i> Pencarian</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- search-->
                <div class="card-body">
                    <form method="GET" action="{{ route('realisasi.index') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <select class="form-control select2" id="unit-select" name="unit_id">
                                        <option value="">All</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}"
                                                {{ $unitId == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sumber Dana</label>
                                    <select class="form-control select2" id="sumber-select" name="sumber">
                                        <option value="">All</option>
                                        @foreach ($sumber as $sumber)
                                            <option value="{{ $sumber }}"
                                                {{ $sumber_dana == $sumber ? 'selected' : '' }}>
                                                {{ $sumber }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Akun Belanja</label>
                                    <select class="form-control select2" id="akun-select" name="akun">
                                        <option value="">All</option>
                                        @foreach ($akun as $akun)
                                            <option value="{{ $akun }}"
                                                {{ $akun_belanja == $akun ? 'selected' : '' }}>
                                                {{ $akun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Periode</label>
                                    <select class="form-control select2" id="perencanaan-select">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select class="form-control select2" id="tahun-select" name="tahun">
                                        @foreach ($tahun as $item)
                                            <option value="{{ $item }}"
                                                {{ $tahun_anggaran == $item ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <br>

                        <!-- chart-->
                        <div class="card-body">
                            <div class="row">

                                @include('keuangan::include.chart_realisasi_unit')

                            </div>

                            {{-- tabel rekapitulasi --}}
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Kode</th>
                                                <th>Uraian</th>
                                                <th>Pagu</th>
                                                <th>RPD</th>
                                                <th>Realisasi</th>
                                                <th>Sisa</th>
                                                <th>Persentase</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($perencanaans as $perencanaan)
                                                <tr class="text-center">
                                                    <td>{{ $perencanaan->kode }}</td>
                                                    <td class="text-left">
                                                        {{ $perencanaan->nama }}
                                                    </td>
                                                    <td class="{{ $perencanaan->pagu == 0 ? 'text-danger' : '' }}">
                                                        {{ str_replace(',', '.', number_format($perencanaan->pagu)) }}
                                                    </td>
                                                    <td
                                                        class="{{ $perencanaan->total_anggaran == 0 ? 'text-danger' : '' }}">
                                                        {{ str_replace(',', '.', number_format($perencanaan->total_anggaran)) }}
                                                    </td>
                                                    <td
                                                        class="{{ $perencanaan->total_realisasi == 0 ? 'text-danger' : '' }}">
                                                        {{ str_replace(',', '.', number_format($perencanaan->total_realisasi)) }}
                                                    </td>
                                                    <td
                                                        class="{{ $perencanaan->sisa_anggaran == 0 ? 'text-danger' : '' }}">
                                                        {{ str_replace(',', '.', number_format($perencanaan->sisa_anggaran)) }}
                                                    </td>
                                                    <td class="{{ $perencanaan->persentase == 0 ? 'text-danger' : '' }}">
                                                        {{ number_format($perencanaan->persentase, 2) }} %
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-info btn-sm dropdown-toggle"
                                                                type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Aksi
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('realisasi.create') }}" title="Tambah">
                                                                    <button class="btn btn-success btn-sm btn-block"> <i
                                                                            class="fa fa-plus" aria-hidden="true"></i>
                                                                        Tambah
                                                                    </button>
                                                                </a>
                                                                {{-- <a class="dropdown-item"
                                                                    href="{{ route('realisasi.edit', $perencanaan->id) }}" title="Ubah">
                                                                    <button class="btn btn-warning btn-sm btn-block"> <i
                                                                            class="fas fa-pencil-alt"
                                                                            aria-hidden="true"></i>
                                                                        Ubah
                                                                    </button>
                                                                </a> --}}
                                                                <a class="dropdown-item"
                                                                    href="{{ route('realisasi.show', $perencanaan->id) }}" title="lihat">
                                                                    <button class="btn btn-info btn-sm btn-block"> <i
                                                                            class="fas fa-eye"
                                                                            aria-hidden="true"></i>
                                                                        lihat
                                                                    </button>
                                                                </a>
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

                                    <div class="col-12 ">
                                        <a href="" title="cetak">
                                            <button class="btn btn-success btn-sm col-md-12"> Cetak </button>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end-->
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            $('#unit-select, #sumber-select, #akun-select, #tahun-select').change(function() {
                this.form.submit();
            });
        });
    </script>
@endpush
