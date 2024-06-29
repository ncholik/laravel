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
                    <h3 class="card-title">Pencarian</h3>
                </div>
                <!-- search-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Unit</label>
                                <select class="form-control select2" id="unit-select">
                                    <!-- Options will be populated by JS -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Program</label>
                                <select class="form-control select2" id="perencanaan-select">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kegiatan</label>
                                <select class="form-control select2" id="subperencanaan-select">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sumber Dana</label>
                                <select class="form-control select2" id="unit-select">
                                    <!-- Options will be populated by JS -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Periode</label>
                                <select class="form-control select2" id="perencanaan-select">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Level</label>
                                <select class="form-control select2" id="subperencanaan-select">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tahun</label>
                                <select class="form-control select2" id="year-select">
                                    <!-- Options will be populated by JS -->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <!-- chart-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="d-flex flex-column"><span><i class="fas fa-chart-line"></i> Grafik
                                            Realisasi
                                            Keuangan</span></p>
                                    <div class="position-relative mb-4">
                                        <canvas id="realisasi-keuangan" height="100px"></canvas>
                                    </div>
                                </div>
                            </div>

                            {{-- tabel rekapitulasi --}}
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Uraian</th>
                                                <th>Anggaran Keuangan</th>
                                                <th>Realisasi Keuangan</th>
                                                <th>Sumber Dana</th>
                                                <th>aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($perencanaans as $perencanaan)
                                                <tr data-tt-id="{{ $perencanaan->id }}">
                                                    <td class="text-left">
                                                        {{ $perencanaan->kode }} {{ $perencanaan->nama }}
                                                    </td>
                                                    <td>
                                                        {{ str_replace(',', '.', number_format($perencanaan->anggaran)) }}
                                                    </td>
                                                    <td>
                                                        {{ str_replace(',', '.', number_format($perencanaan->realisasi_ini)) }}
                                                    </td>
                                                    <td colspan="2">{{ $perencanaan->sumber}}</td>
                                                </tr>
                                                @foreach ($perencanaan->subPerencanaan as $kegiatan)
                                                    <tr data-tt-id="{{ $kegiatan->id }}"
                                                        data-tt-parent-id="{{ $perencanaan->id }}" class="text-indigo">
                                                        <td class="text-left" style="padding-left: 50px">
                                                            {{ $kegiatan->kegiatan }}
                                                        </td>
                                                        <td>
                                                            {{ str_replace(',', '.', number_format($kegiatan->sub_anggaran)) }}
                                                        </td>
                                                        <td>
                                                            {{ str_replace(',', '.', number_format($kegiatan->sub_realisasi)) }}
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <a href="{{ route('realisasi.show', $perencanaan->id)}}" title="View Realisasi">
                                                                <button class="btn btn-info btn-sm">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                                    lihat
                                                                </button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
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
            </div>
            <!-- end-->
        </div>
    </div>
    <!-- <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Data Realisasi</div>
                    <div class="card-body">
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
                                            <td>
                                                Rp.{{ str_replace(',', '.', number_format($perencanaan->jumlah_anggaran)) }}
                                            </td>
                                            <td>
                                                Rp.{{ str_replace(',', '.', number_format($perencanaan->realisasi_keuangan)) }}
                                            </td>
                                            <td>
                                                <a href="{{ route('realisasi.show', $perencanaan->id) }}"
                                                    title="View Realisasi">
                                                    <button class="btn btn-info btn-sm">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                        lihat
                                                    </button>
                                                </a>
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
        </div> -->
@endsection
