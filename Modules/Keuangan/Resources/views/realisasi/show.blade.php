@extends('adminlte::page')
@section('title', 'Realisasi')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@endpush()
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Detail Realisasi : <strong>{{ $perencanaan->nama }}</strong>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <button class="btn btn-warning btn-sm mr-2" onclick="window.history.back()">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>progres</th>
                                    <th>realisasi</th>
                                    <th>laporan keuangan</th>
                                    <th>laporan kegiatan</th>
                                    <th>ketercapaian output</th>
                                    <th>tgl kontrak</th>
                                    <th>tgl pembayaran</th>
                                </tr>
                            </thead>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item['progres'] }}</td>
                                    <td>{{ str_replace(',', '.', number_format($item['realisasi'])) }}</td>
                                    <td>{{ $item['laporan_keuangan'] }}</td>
                                    <td>{{ $item['laporan_kegiatan'] }}</td>
                                    <td>{{ $item['ketercapaian_output'] }}</td>
                                    <td>{{ $item['tanggal_kontrak'] }}</td>
                                    <td>{{ $item['tanggal_pembayaran'] }}</td>
                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mb-3">
                            {{-- {!! $perencanaans->links('pagination::bootstrap-4') !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
