@extends('adminlte::page')
@section('title', 'Laporan')

@section('content_header')
@stop

@push('css')
    <link rel="stylesheet" href="path/to/your/custom.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Parameter</h3>
                </div>
                <!-- search-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <h5>Tanggal</h5>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="anggaran_program" type="date" id="anggaran_program"
                                    value="" required>
                            </div>
                        </div>

                        <div class="col-md-1 text-center align-middle">
                            <span class="sd-text">s.d</span>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="anggaran_kegiatan" type="date" id="anggaran_kegiatan"
                                    value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 d-flex justify-content-end">
                        <div class="col-1 ">
                            <a href="" title="cari">
                                <button class="btn btn-warning btn-sm col-md-12">
                                    Reset
                                </button>
                            </a>
                        </div>
                        <div class="col-1 ">
                            <a href="" title="cari">
                                <button class="btn btn-info btn-sm col-md-12">
                                    Cari
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama File</th>
                                            <th>Timeline</th>
                                            <th>Status</th>
                                            <th>aksi</th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td>laporan realisasi TA 2024</td>
                                        <td>28 juli 2024</td>
                                        <td>selesai</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#pdfModal">
                                                <i class="fa fa-solid fa-file-excel" aria-hidden="true"></i>
                                                Excel
                                            </button>
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#pdfModal">
                                                <i class="fa fa-solid fa-file-pdf" aria-hidden="true"></i>
                                                Pdf
                                            </button>
                                        </td>
                                    </tr>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Laporan Realisasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfFrame" src="" style="width:100%; height:500px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

@stop

@push('js')
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                function updateChart(year, unit, program, kegiatan) {
                    var url = '/api/data?year=' + year;

                    if (unit !== '') {
                        url += '&unit=' + unit;
                    }

                    if (program !== '') {
                        url += '&program=' + program;
                    }

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            var ctx = document.getElementById('realisasi-keuangan').getContext('2d');
                            if (window.myChart) {
                                window.myChart.destroy();
                            }
                            window.myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                                        'September', 'Oktober', 'November', 'Desember'
                                    ],
                                    datasets: [{
                                        label: 'Target Keuangan',
                                        data: data.target,
                                        backgroundColor: 'rgba(251, 135, 0, 1',
                                        borderColor: 'rgba(251, 135, 0, 1',
                                        fill: true,
                                        borderWidth: 0,
                                        tension: 0.5,
                                        order: 2
                                    }, {
                                        label: 'Realisasi Keuangan',
                                        data: data.realisasi,
                                        backgroundColor: 'rgba(0, 128, 0, 1)',
                                        borderColor: 'rgba(0, 128, 0, 1)',
                                        fill: true,
                                        borderWidth: 0,
                                        tension: 0.5,
                                        order: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: function(tooltipItem) {
                                                    let value = tooltipItem.raw;
                                                    return `${tooltipItem.label}: Rp ${value.toLocaleString('id-ID')}`;
                                                }
                                            }
                                        },
                                        legend: {
                                            position: 'bottom',
                                            labels: {
                                                boxWidth: 15,
                                                padding: 20
                                            }
                                        },
                                    }
                                }
                            });
                        })
                        .catch(error => console.error('Error fetching financial data:', error));
                }

                document.addEventListener('DOMContentLoaded', function() {
                    var yearSelect = document.getElementById('year-select');
                    var unitSelect = document.getElementById('unit-select');
                    var programSelect = document.getElementById('perencanaan-select');
                    var kegiatanSelect = document.getElementById('subperencanaan-select');
                    var currentYear = new Date().getFullYear();

                    // Populate the yearSelect dropdown with options
                    for (var i = currentYear; i >= currentYear - 4; i--) {
                        var option = document.createElement('option');
                        option.value = i;
                        option.textContent = i;
                        yearSelect.appendChild(option);
                    }

                    function fetchUnits() {
                        fetch('/api/data?year=' + currentYear)
                            .then(response => response.json())
                            .then(data => {
                                unitSelect.innerHTML = '';
                                var allOption = document.createElement('option');
                                allOption.value = '';
                                allOption.textContent = 'Semua Unit';
                                unitSelect.appendChild(allOption);

                                data.units.forEach(unit => {
                                    var option = document.createElement('option');
                                    option.value = unit.id;
                                    option.textContent = unit.nama;
                                    unitSelect.appendChild(option);
                                });

                                unitSelect.value = data.units[0].id;

                                unitSelect.dispatchEvent(new Event('change'));
                            })
                            .catch(error => console.error('Error fetching units:', error));
                    }

                    function fetchPrograms(unitId) {
                        fetch(`/api/program?unit=${unitId}`)
                            .then(response => response.json())
                            .then(data => {
                                programSelect.innerHTML = '';
                                var allOption = document.createElement('option');
                                allOption.value = '';
                                allOption.textContent = 'Semua Program';
                                programSelect.appendChild(allOption);

                                data.programs.forEach(program => {
                                    var option = document.createElement('option');
                                    option.value = program.id;
                                    option.textContent = program.nama;
                                    programSelect.appendChild(option);
                                });

                                programSelect.disabled = false;
                                fetchKegiatan(programSelect.value);
                            })
                            .catch(error => console.error('Error fetching programs:', error));
                    }

                    function fetchKegiatan(programId) {
                        fetch(`/api/kegiatan?program=${programId}`)
                            .then(response => response.json())
                            .then(data => {
                                kegiatanSelect.innerHTML = '';
                                var allOption = document.createElement('option');
                                allOption.value = '';
                                allOption.textContent = 'Semua Kegiatan';
                                kegiatanSelect.appendChild(allOption);

                                data.kegiatan.forEach(kegiatan => {
                                    var option = document.createElement('option');
                                    option.value = kegiatan.id;
                                    option.textContent = kegiatan.kegiatan;
                                    kegiatanSelect.appendChild(option);
                                });

                                kegiatanSelect.disabled = false;
                                updateChart(yearSelect.value, unitSelect.value, programSelect.value, kegiatanSelect
                                    .value);
                            })
                            .catch(error => console.error('Error fetching kegiatan:', error));
                    }

                    fetchUnits();

                    yearSelect.addEventListener('change', function() {
                        updateChart(this.value, unitSelect.value, programSelect.value, kegiatanSelect.value);
                    });

                    unitSelect.addEventListener('change', function() {
                        var selectedUnit = this.value;
                        fetchPrograms(selectedUnit);
                    });

                    programSelect.addEventListener('change', function() {
                        var selectProgram = this.value;
                        fetchKegiatan(this.value);
                    });

                    kegiatanSelect.addEventListener('change', function() {
                        updateChart(yearSelect.value, unitSelect.value, programSelect.value, this.value);
                    });
                });
            </script>

            {{-- tabel bulanan --}}
            <script>
                document.addEventListener('DOMContentLoaded', (event) => {
                    const table1 = document.getElementById('table-1');
                    const table2 = document.getElementById('table-2');
                    const btnTable1 = document.getElementById('btn-table-1');
                    const btnTable2 = document.getElementById('btn-table-2');

                    btnTable1.addEventListener('click', () => {
                        table1.style.display = 'block';
                        table2.style.display = 'none';
                        btnTable1.classList.add('btn-primary');
                        btnTable1.classList.remove('btn-outline-primary');
                        btnTable2.classList.add('btn-outline-primary');
                        btnTable2.classList.remove('btn-primary');
                    });

                    btnTable2.addEventListener('click', () => {
                        table1.style.display = 'none';
                        table2.style.display = 'block';
                        btnTable1.classList.add('btn-outline-primary');
                        btnTable1.classList.remove('btn-primary');
                        btnTable2.classList.add('btn-primary');
                        btnTable2.classList.remove('btn-outline-primary');
                    });
                });
            </script>

            {{-- AJAX untuk mendapatkan perencanaan berdasarkan unit --}}
            {{-- <script>
        $('#unit-select').change(function() {
            var unitId = $(this).val();
            $('#perencanaan-select').prop('disabled', true).html('<option selected="selected">Memuat...</option>');
            $('#subperencanaan-select').prop('disabled', true).html(
                '<option selected="selected">Pilih Kegiatan</option>');

            if (unitId) {
                $.ajax({
                    type: 'GET',
                    url: '/api/getPerencanaanByUnit/' + unitId,
                    success: function(data) {
                        var options = '<option selected="selected">Pilih Program</option>';
                        data.forEach(function(perencanaan) {
                            options += '<option value="' + perencanaan.id + '">' + perencanaan
                                .nama + '</option>';
                        });
                        $('#perencanaan-select').html(options).prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + ' - ' + error);
                        $('#perencanaan-select').html(
                            '<option selected="selected">Error memuat data</option>');
                    }
                });
            } else {
                $('#perencanaan-select').html('<option selected="selected">Pilih Program</option>').prop('disabled',
                    true);
            }
        });

        $('#perencanaan-select').change(function() {
            var perencanaanId = $(this).val();
            $('#subperencanaan-select').prop('disabled', true).html(
                '<option selected="selected">Memuat...</option>');

            if (perencanaanId) {
                $.ajax({
                    type: 'GET',
                    url: '/api/getSubPerencanaanByPerencanaan/' + perencanaanId,
                    success: function(data) {
                        var options = '<option selected="selected">Pilih Kegiatan</option>';
                        data.forEach(function(subperencanaan) {
                            options += '<option value="' + subperencanaan.id + '">' +
                                subperencanaan.kegiatan + '</option>';
                        });
                        $('#subperencanaan-select').html(options).prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + ' - ' + error);
                        $('#subperencanaan-select').html(
                            '<option selected="selected">Error memuat data</option>');
                    }
                });
            } else {
                $('#subperencanaan-select').html('<option selected="selected">Pilih Kegiatan</option>').prop(
                    'disabled', true);
            }
        });
    </script> --}} -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const downloadButton = document.querySelector('.btn-info[data-target="#pdfModal"]');
            downloadButton.addEventListener('click', function() {
                const pdfUrl = '{{ route('laporan.cetak_laporan') }}';
                document.getElementById('pdfFrame').src = pdfUrl;
            });
        });
    </script>
@endpush
