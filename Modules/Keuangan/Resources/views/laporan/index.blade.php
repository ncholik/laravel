@extends('adminlte::page')
@section('title', 'Laporan')

@section('content_header')
@stop

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
                    <div class="row mt-2 d-flex justify-content-center">
                        <div class="col-1 ">
                            <form action="{{ route('laporan.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset laporan?');">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm col-md-12">
                                    Reset
                                </button>
                            </form>
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
                                    <tbody>
                                        @php
                                            $laporan = session('laporan', []);
                                        @endphp

                                        @if (count($laporan) > 0)
                                            @foreach ($laporan as $item)
                                                @php
                                                    $pdfExists = $item['pdf_path'];
                                                    $excelExists = $item['excel_path'];
                                                @endphp

                                                <tr>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td>{{ $item['date'] }}</td>
                                                    <td>Selesai</td>
                                                    <td>
                                                        @if ($pdfExists)
                                                            <button class="btn btn-info btn-sm" data-toggle="modal"
                                                                data-target="#pdfModal"
                                                                data-pdf-url="{{ route('laporan.show_pdf', basename($item['pdf_path'])) }}">
                                                                <i class="fas fa-file-pdf"></i> PDF
                                                            </button>
                                                        @endif

                                                        @if ($excelExists)
                                                            <a href="{{ url($item['excel_path']) }}"
                                                                class="btn btn-info btn-sm" target="_blank">
                                                                <i class="fas fa-file-excel"></i> Excel
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada laporan yang tersedia.</td>
                                            </tr>
                                        @endif
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pdfButtons = document.querySelectorAll('.btn-info[data-target="#pdfModal"]');

            pdfButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const pdfUrl = this.getAttribute('data-pdf-url');
                    document.getElementById('pdfFrame').src = pdfUrl;
                });
            });
        });
    </script>
@endpush
