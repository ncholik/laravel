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
                    Detail Realisasi : <strong>{{ $perencanaan->kegiatan }}</strong>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <button class="btn btn-warning btn-sm mr-2" onclick="window.history.back()">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                        </button>
                        @if (!empty($data))
                            <a href="{{ route('realisasi.edit', $perencanaan->id) }}" class="btn btn-success btn-sm mr-2">
                                <i class="fa fa-pen" aria-hidden="true"></i> Ubah
                            </a>
                        @endif
                    </div>
                    @if (empty($data))
                        <h4 class="text-center"><strong>Belum ada Laporan Realisasi</strong></h4>
                        <p class="text-center">Silahkan isikan data dengan menekan tombol di bawah ini</p>
                        <div class="text-center mt-4">
                            <hr>
                            <a href="{{ route('realisasi.create', ['sub_perencanaan_id' => $perencanaan->id]) }}" title="Tambah">
                                <button class="btn btn-success btn-sm"> <i class="fa fa-plus" aria-hidden="true"></i>
                                    Tambah Realisasi
                                </button>
                            </a>
                        </div>
                    @else
                        @foreach ($data as $item)
                            <form>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="progres">Progres</label>
                                                    <input type="text" class="form-control" id="progres"
                                                        value="{{ $item['progres'] }}" readonly>
                                                </div>
                                                <div class="col-6">
                                                    <label for="realisasi">Realisasi</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="realisasi"
                                                            value="{{ str_replace(',', '.', number_format($item['realisasi'])) }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="laporan_keuangan">Laporan Keuangan</label>
                                                    @if ($item['laporan_keuangan'])
                                                        <a href="{{ Storage::url($item['laporan_keuangan']) }}"
                                                            target="_blank" class="form-control-plaintext">
                                                            {{ basename($item['laporan_keuangan']) }}
                                                        </a>
                                                    @else
                                                        <input type="text" class="form-control" id="laporan_keuangan"
                                                            value="Tidak ada file" readonly>
                                                    @endif
                                                </div>
                                                <div class="col-6">
                                                    <label for="laporan_kegiatan">Laporan Kegiatan</label>
                                                    @if ($item['laporan_kegiatan'])
                                                        <a href="{{ Storage::url($item['laporan_kegiatan']) }}"
                                                            target="_blank" class="form-control-plaintext">
                                                            {{ basename($item['laporan_kegiatan']) }}
                                                        </a>
                                                    @else
                                                        <input type="text" class="form-control" id="laporan_kegiatan"
                                                            value="Tidak ada file" readonly>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_kontrak">Tanggal Kontrak</label>
                                            <input type="text" class="form-control" id="tanggal_kontrak"
                                                value="{{ $item['tanggal_kontrak'] }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                                            <input type="text" class="form-control" id="tanggal_pembayaran"
                                                value="{{ $item['tanggal_pembayaran'] }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="ketercapaian_output">Ketercapaian Output</label>
                                            <textarea class="form-control" id="ketercapaian_output" rows="12" readonly>{{ $item['ketercapaian_output'] }}
                                        </textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
