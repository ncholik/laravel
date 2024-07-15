@extends('adminlte::page')
@section('title', 'Dashboard')

@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('dashboard') }}">
                        <p class="text-center">
                            <strong id="yearText">Serapan Anggaran Tahun:
                                <input type="text" class="form-control-md" id="year-select" name="year"
                                    value="" />
                            </strong>
                        </p>
                    </form>
                    <div class="row">
                        @include('keuangan::include.dashboard-bulanan.chart_realisasi')
                        @include('keuangan::include.dashboard-bulanan.tabel_progres')
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
                        @include('keuangan::include.dashboard-bulanan.chart_serapan')
                    </div>
                    <div class="row mt-4">
                        @include('keuangan::include.dashboard-bulanan.tabel_unit')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#year-select').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true
            }).on('changeDate', function(e) {
                $(this).closest('form').submit();
            });
        });
    </script>
@endpush
