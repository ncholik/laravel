@extends('adminlte::page')
@section('title', 'Laporan Bulanan')

@section('content_header')
<h1>Laporan Bulanan</h1>
@stop

@push('css')
<link rel="stylesheet" href="path/to/your/custom.css">
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Pencarian</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- search-->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between" style="gap: 10px;">
                        <div class="form-group" style="width: 32%;">
                            <label>Nama Unit</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                            </select>
                        </div>
                        <div class="form-group" style="width: 32%;">
                            <label>Nama Program</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                            </select>
                        </div>
                        <div class="form-group" style="width: 32%;">
                            <label>Nama Kegiatan</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between" style="gap: 10px;">
                        <div class="form-group" style="width: 48%;">
                            <label>Sampai Dengan Bulan</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                            </select>
                        </div>
                        <div class="form-group" style="width: 48%;">
                            <label>Sampai Dengan Tahun</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end-->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Data</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 m-4">
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-print"></i> Cetak Excel
                            </button>
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-print"></i> Cetak Pdf
                            </button>
                        </div>
                    </div>


                    <!-- chart-->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="d-flex flex-column"><span>Realisasi Keuangan</span></p>
                                <div class="position-relative mb-4">
                                    <canvas id="visitors-chart" height="200"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            @include('monitoring::include.tabel_bulanan')
                        </div>
                    </div>
                    <!-- end-->
                </div>
            </div>
        </div>

    </div>
</div>
@stop

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Realisasi Keuangan
    var ctxVisitors = document.getElementById('visitors-chart').getContext('2d');
    var visitorsChart = new Chart(ctxVisitors, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Visitors',
                data: [65, 59, 80, 81, 56, 55, 40],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Realisasi fisik
    var ctxSales = document.getElementById('sales-chart').getContext('2d');
    var salesChart = new Chart(ctxSales, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Sales',
                data: [28, 48, 40, 19, 86, 27, 90],
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>
@endpush
