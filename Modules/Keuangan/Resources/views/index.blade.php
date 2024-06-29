{{-- @extends('layouts.master') --}}

@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('keuangan::include.chart_realisasi')

                        @include('keuangan::include.progres')
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
                        @include('keuangan::include.chart_serapan')
                    </div>
                    <div class="row mt-4">
                        @include('keuangan::include.tabel_unit')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
