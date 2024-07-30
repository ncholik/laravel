@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('dashboard_triwulan') }}" id="triwulan-form">
                    <p class="text-center">
                    <strong id="yearText">Serapan Anggaran :
                            <select class="form-control-md" name="triwulan" id="subperencanaan-select"
                                onchange="document.getElementById('triwulan-form').submit()">
                                <option value="1" {{ $triwulan == 1 ? 'selected' : '' }}>Triwulan 1</option>
                                <option value="2" {{ $triwulan == 2 ? 'selected' : '' }}>Triwulan 2</option>
                                <option value="3" {{ $triwulan == 3 ? 'selected' : '' }}>Triwulan 3</option>
                                <option value="4" {{ $triwulan == 4 ? 'selected' : '' }}>Triwulan 4</option>
                            </select>
                        </strong>
                    </p>
                </form>
                    <div class="row">
                        @include('keuangan::include.dashboard-triwulan.chart_realisasi_triwulan')
                        @include('keuangan::include.dashboard-triwulan.tabel_progres_triwulan')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent bg-warning">
                    <h3 class="card-title"><i class="fas fa-database"></i> Data Serapan</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        @include('keuangan::include.dashboard-triwulan.chart_serapan_triwulan')
                    </div>
                    <div class="row mt-4">
                        @include('keuangan::include.dashboard-triwulan.tabel_unit_triwulan')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
