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
                                        <select class="form-control-sm" id="kegiatanSelect">
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
                        <a href="#" title="Kembali">
                            <button class="btn btn-warning btn-sm" onclick="window.history.back()">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <h6>Anggaran Keuangan</h6>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control" id="anggaranKeuangan" disabled>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <h6>Progres</h6>
                                        <input type="text" class="form-control" id="progres" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <h6>Realisasi</h6>
                                        <input type="text" class="form-control" id="realisasiKeuangan" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h6>Tanggal Pembayaran</h6>
                                <input type="text" class="form-control" id="tanggalPembayaran" disabled>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <h6>Laporan Keuangan</h6>
                                <input type="text" class="form-control" id="laporanKeuangan" disabled>
                            </div>
                            <div class="form-group">
                                <h6>Laporan Kegiatan</h6>
                                <input type="text" class="form-control" id="laporanKegiatan" disabled>
                            </div>
                            <div class="form-group">
                                <h6>Ketercapaian Output</h6>
                                <textarea class="form-control" rows="3" id="ketercapaianOutput" disabled></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.getElementById('kegiatanSelect').addEventListener('change', function() {
            var subId = this.value;
            fetch(`realisasi/kegiatan/${subId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('jumlahAnggaran').innerText = data.jumlah_anggaran;
                    document.getElementById('realisasiKeuangan').innerText = data.realisasi_keuangan;
                    document.getElementById('efisiensi').innerText = data.efisiensi;
                    document.getElementById('anggaranKeuangan').value = data.anggaran_keuangan;
                    document.getElementById('progres').value = data.progres;
                    document.getElementById('tanggalPembayaran').value = data.tanggal_pembayaran;
                    document.getElementById('laporanKeuangan').value = data.laporan_keuangan;
                    document.getElementById('laporanKegiatan').value = data.laporan_kegiatan;
                    document.getElementById('ketercapaianOutput').value = data.ketercapaian_output;
                });
        });
    </script>
@endpush
