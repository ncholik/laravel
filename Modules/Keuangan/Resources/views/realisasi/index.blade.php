@extends('adminlte::page')
@section('title', 'Realisasi')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('content')
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    showConfirmButton: true,
                    timer: 3000
                });
            });
        </script>
    @endif
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
                                    <select class="form-control select2" id="periode-select" name="periode">
                                        <option value="">All</option>
                                        <option value="01" {{ $periode_anggaran == '01' ? 'selected' : '' }}>Januari
                                        </option>
                                        <option value="02" {{ $periode_anggaran == '02' ? 'selected' : '' }}>Februari
                                        </option>
                                        <option value="03" {{ $periode_anggaran == '03' ? 'selected' : '' }}>Maret
                                        </option>
                                        <option value="04" {{ $periode_anggaran == '04' ? 'selected' : '' }}>April
                                        </option>
                                        <option value="05" {{ $periode_anggaran == '05' ? 'selected' : '' }}>Mei
                                        </option>
                                        <option value="06" {{ $periode_anggaran == '06' ? 'selected' : '' }}>Juni
                                        </option>
                                        <option value="07" {{ $periode_anggaran == '07' ? 'selected' : '' }}>Juli
                                        </option>
                                        <option value="08" {{ $periode_anggaran == '08' ? 'selected' : '' }}>Agustus
                                        </option>
                                        <option value="09" {{ $periode_anggaran == '09' ? 'selected' : '' }}>September
                                        </option>
                                        <option value="10" {{ $periode_anggaran == '10' ? 'selected' : '' }}>Oktober
                                        </option>
                                        <option value="11" {{ $periode_anggaran == '11' ? 'selected' : '' }}>November
                                        </option>
                                        <option value="12" {{ $periode_anggaran == '12' ? 'selected' : '' }}>Desember
                                        </option>
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
                        <!-- chart-->
                        <div class="card-body">
                            {{-- <div class="row">
                                @include('keuangan::include.chart_realisasi_unit')
                            </div> --}}

                            {{-- tabel rekapitulasi --}}
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="text-center">
                                            <tr>
                                                <th>PIC</th>
                                                <th>Uraian</th>
                                                <th>Pagu</th>
                                                {{-- <th>RPD</th> --}}
                                                <th>Realisasi</th>
                                                <th>Sisa</th>
                                                <th>Persentase</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subPerencanaans as $item)
                                                <tr class="text-center">
                                                    <td class="text-left">
                                                        {{ $item['pic'] }}
                                                    </td>
                                                    <td class="text-left">
                                                        {{ $item['kode'] }}. {{ $item['kegiatan'] }}
                                                    </td>
                                                    <td class="{{ $item['pagu'] == 0 ? 'text-danger' : '' }}">
                                                        {{ str_replace(',', '.', number_format($item['pagu'])) }}
                                                    </td>
                                                    {{-- <td
                                                        class="{{ $item['total_anggaran'] == 0 ? 'text-danger' : '' }}">
                                                        {{ str_replace(',', '.', number_format($item['total_anggaran'])) }}
                                                    </td> --}}
                                                    <td class="{{ $item['realisasi'] == 0 ? 'text-danger' : '' }}">
                                                        {{ str_replace(',', '.', number_format($item['realisasi'])) }}
                                                    </td>
                                                    <td class="{{ $item['sisa'] == 0 ? 'text-danger' : '' }}">
                                                        {{ str_replace(',', '.', number_format($item['sisa'])) }}
                                                    </td>
                                                    <td class="{{ $item['persentase'] == 0 ? 'text-danger' : '' }}">
                                                        {{ number_format($item['persentase'], 2) }} %
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
                                                                    href="{{ route('realisasi.show', ['perencanaan' => $item['id']]) }}"
                                                                    title="lihat">
                                                                    <button class="btn btn-info btn-sm btn-block"> <i
                                                                            class="fas fa-eye" aria-hidden="true"></i>
                                                                        lihat
                                                                    </button>
                                                                </a>
                                                                @hasanyrole('admin|penanggung')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('realisasi.create', ['sub_perencanaan_id' => $item['id']]) }}"
                                                                        title="Tambah">
                                                                        <button class="btn btn-success btn-sm btn-block"> <i
                                                                                class="fa fa-plus" aria-hidden="true"></i>
                                                                            Tambah
                                                                        </button>
                                                                    </a>
                                                                @endhasanyrole
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex">
                                        {{-- {!! $subPerencanaans->links('pagination::bootstrap-4') !!} --}}
                                    </div>

                                    @hasanyrole('admin|keuangan|pimpinan')
                                        <form action="{{ route('laporan.generate') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="sub_perencanaans"
                                                value="{{ json_encode($subPerencanaans) }}">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-success btn-sm col-md-12"> Cetak
                                                </button>
                                            </div>
                                        </form>
                                    @endhasanyrole
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
    <script src="assets/vendor/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#unit-select, #sumber-select, #akun-select, #periode-select, #tahun-select').change(function() {
                this.form.submit();
            });
        });
    </script>
@endpush
