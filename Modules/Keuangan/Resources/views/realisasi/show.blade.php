@extends('adminlte::page')
@section('title', 'Realisasi')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <a href="#" title="Kembali">
                        <button class="btn btn-warning btn-sm" onclick="window.history.back()">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                        </button>
                    </a> --}}

                    {{-- <a href="{{ route('perencanaan.edit', $perencanaan->id) }}" title="Edit Perencanaan"><button
                            class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Ubah</button></a> --}}

                    {{-- <form method="POST" action="{{ route('perencanaan.destroy', $perencanaan->id) }}"
                        accept-charset="UTF-8" style="display:inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Perencanaan"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus perencanaan ini?')"><i
                                class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
                    </form> --}}

                    <div class="fixed-table">
                        <table class="table table-bordered">
                            <tbody id="collapsibleTable">
                                <tr>
                                    <td> Kode </td>
                                    <td>{{ $perencanaans->kode }}</td>

                                    <td> Jumlah Anggaran </td>
                                    <td> Rp. {{ number_format($jumlah_anggaran, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td> Program </td>
                                    <td> {{ $perencanaans->nama }} </td>

                                    <td> Realisasi Keuangan </td>
                                    <td style="{{ $realisasi_keuangan == 0 ? 'color: red;' : 'red' }}">
                                        Rp. {{ number_format($realisasi_keuangan, 2, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td> Kegiatan </td>
                                    <td>
                                        <select class="form-control-sm">
                                            @foreach ($perencanaans->subPerencanaan as $sub)
                                                <option value="{{ $sub->id }}">{{ $sub->kegiatan }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td> Efisiensi </td>
                                    <td> Rp. {{ number_format($efisiensi, 2, ',', '.') }}</td>
                                </tr>
                            </tbody>
                            <tr>
                                <td> Bulan </td>
                                <td colspan="3">
                                    <select class="form-control-sm">
                                        @foreach ($filterBulan as $bulan)
                                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                                        @endforeach
                                    </select>
                                    / 2024
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{-- <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Progres</th>
                                <th>Realisasi</th>
                                <th>Laporan Keuangan</th>
                                <th>Laporan Kegiatan</th>
                                <th>Ketercapian Output</th>
                                <th>Tanggal Kontrak</th>
                                <th>Tanggal Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($perencanaans->subPerencanaan as $sub)
                                @forelse ($sub->realisasi as $realisasi)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $realisasi->progres }}</td>
                                        <td>Rp. {{ number_format($realisasi->realisasi, 2, ',', '.') }}</td>
                                        <td>{{ $realisasi->laporan_keuangan }}</td>
                                        <td>{{ $realisasi->laporan_kegiatan }}</td>
                                        <td>{{ $realisasi->ketercapian_output }}</td>
                                        <td>{{ \Carbon\Carbon::parse($realisasi->tanggal_kontrak)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($realisasi->tanggal_pembayaran)->format('d-m-Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            Tidak ada data yang tersedia pada tabel ini
                                        </td>
                                    </tr>
                                @endforelse
                            @endforeach
                        </tbody>
                    </table> --}}

                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <h6>Anggaran Keuangan</h6>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control" disabled>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <h6>Progres</h6>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <h6>Realisasi</h6>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h6>Tanggal Pembayaran</h6>
                                <input type="text" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <h6>Laporan Keuangan</h6>
                                <input type="text" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <h6>Laporan Kegiatan</h6>
                                <input type="text" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <h6>Ketercapaian Output</h6>
                                <textarea class="form-control" rows="3" disabled></textarea>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
