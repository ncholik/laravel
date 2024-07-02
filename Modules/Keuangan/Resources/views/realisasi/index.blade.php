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
                        <br>

                        <!-- chart-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="d-flex flex-column"><span><i class="fas fa-chart-line"></i>
                                            Grafik Realisasi Keuangan
                                        </span></p>
                                    <div class="position-relative mb-4">
                                        <canvas id="myBarChart" height="100px"></canvas>
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
                                                <th>RPD</th>
                                                <th>Realisasi</th>
                                                <th>Sumber Dana</th>
                                                <th>Sisa</th>
                                                <th>Persentase</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($perencanaans as $perencanaan)
                                                <tr data-tt-id="{{ $perencanaan->id }}">
                                                    <td class="text-left">
                                                        {{ $perencanaan->kode }}. {{ $perencanaan->nama }}
                                                    </td>
                                                    <td>
                                                        {{ str_replace(',', '.', number_format($perencanaan->anggaran)) }}
                                                    </td>
                                                    <td>
                                                        {{ str_replace(',', '.', number_format($perencanaan->realisasi_ini)) }}
                                                    </td>
                                                    <td colspan="2">{{ $perencanaan->sumber }}</td>
                                                    <td></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-info btn-sm dropdown-toggle"
                                                                type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Aksi
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#" title="Tambah">
                                                                    <i class="fas fa-plus"></i> Tambah
                                                                </a>
                                                                <a class="dropdown-item" href="#" title="Edit">
                                                                    <i class="fas fa-pen"></i> Edit
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
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('myBarChart').getContext('2d');
            const myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'Sample Data',
                        data: [12, 19, 3, 5, 2, 3, 9],
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endpush
