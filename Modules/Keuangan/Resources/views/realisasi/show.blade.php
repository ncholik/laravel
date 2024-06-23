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

                                    <td> Total Anggaran </td>
                                    <td> Rp. {{ number_format($jumlah_anggaran, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td> Program </td>
                                    <td> {{ $perencanaans->nama }} </td>

                                    <td> Total Realisasi </td>
                                    <td style="{{ $realisasi_keuangan == 0 ? 'color: red;' : 'red' }}">
                                        Rp. {{ number_format($realisasi_keuangan, 2, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td> Kegiatan </td>
                                    <td>
                                        <select class="form-control-sm" id="kegiatanSelect">
                                            @foreach ($perencanaans->subPerencanaan as $sub)
                                                <option value="{{ $sub->id }}"
                                                    data-realisasi="{{ json_encode($sub->realisasi) }}"
                                                    data-volume="{{ $sub->volume }}" data-harga="{{ $sub->harga_satuan }}">
                                                    {{ $sub->kegiatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
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
                        <a href="#" id="tambahButton" class="btn btn-success btn-sm" title="Tambah Realisasi"
                            data-toggle="modal" data-target="#tambahRealisasiModal">
                            <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                        </a>
                        <a href="#" id="ubahButton" class="btn btn-info btn-sm" title="Ubah Realisasi"
                            data-toggle="modal" data-target="#editRealisasiModal">
                            <i class="fa fa-pen" aria-hidden="true"></i> Ubah
                        </a>

                        <!-- Modal tambah-->
                        <div class="modal fade" id="tambahRealisasiModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Realisasi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('realisasi.store') }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            {{ csrf_field() }}

                                            @include ('keuangan::realisasi.form', ['formMode' => 'create'])

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal ubah-->
                        <div class="modal fade" id="editRealisasiModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Realisasi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" id="realisasiForm" class="form-horizontal"
                                            enctype="multipart/form-data">
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}

                                            @include ('keuangan::realisasi.form', ['formMode' => 'edit'])

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <input type="text" class="form-control" id="anggaran" disabled>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <h6>Progres</h6>
                                        <input type="text" class="form-control" id="progresKeuangan" disabled>
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
        $(document).ready(function() {
            $('#kegiatanSelect').on('change', function() {
                var subId = $(this).val();
                var realisasiData = $(this).find('option').data('realisasi');
                var volume = $('option:selected', this).data('volume');
                var hargaSatuan = $('option:selected', this).data('harga');

                console.log('ID:', subId);
                console.log('Realisasi Data:', realisasiData);
                console.log('Anggaran Keuangan:', volume * hargaSatuan);

                var data = realisasiData.find(function(item) {
                    return item.sub_perencanaan_id == subId;
                });


                if (data) {
                    var anggaranKeuangan = volume * hargaSatuan;

                    $('#anggaran').val(anggaranKeuangan);
                    $('#progresKeuangan').val(data.progres);
                    $('#realisasiKeuangan').val(data.realisasi);
                    $('#tanggalPembayaran').val(data.tanggal_pembayaran);
                    $('#laporanKeuangan').val(data.laporan_keuangan);
                    $('#laporanKegiatan').val(data.laporan_kegiatan);
                    $('#ketercapaianOutput').val(data.ketercapaian_output);

                    $('#sub_perencanaan_id').val(subId);
                    
                    var baseUrl = '{{ route('realisasi.update', ':id') }}';
                    baseUrl = baseUrl.replace(':id', subId);
                    $('#realisasiForm').attr('action', baseUrl)
                    $('#tambahButton').addClass('disabled');
                    $('#ubahButton').removeClass('disabled');
                } else {
                    // Kosongkan field form jika tidak ada data realisasi yang sesuai
                    $('#anggaran').val(anggaranKeuangan);
                    $('#progresKeuangan').val('');
                    $('#realisasiKeuangan').val('');
                    $('#tanggalPembayaran').val('');
                    $('#laporanKeuangan').val('');
                    $('#laporanKegiatan').val('');
                    $('#ketercapaianOutput').val('');

                    $('#realisasiForm').attr('action', '');
                    $('#tambahButton').removeClass('disabled');
                    $('#ubahButton').addClass('disabled');
                }
            });
            $('#kegiatanSelect').trigger('change');
        });
    </script>


    {{-- <script>
        (document).ready(function() {
            function updateRealisasiDetails(realisasi) {
                if (realisasi && realisasi.length > 0) {
                    const data = realisasi[
                    0]; // Assuming each subPerencanaan has a single realisasi for this example
                    $('#anggaranKeuangan').val(data.anggaran_keuangan);
                    $('#progres').val(data.progres);
                    $('#realisasi').val(data.realisasi);
                    $('#tanggalPembayaran').val(data.tanggal_pembayaran);
                    $('#laporanKeuangan').val(data.laporan_keuangan);
                    $('#laporanKegiatan').val(data.laporan_kegiatan);
                    $('#ketercapaianOutput').val(data.ketercapaian_output);
                }
            }

            // Set initial data on page load
            const initialRealisasi = $('#kegiatanSelect').find('option:selected').data('realisasi');
            updateRealisasiDetails(initialRealisasi);

            // Update data on change
            $('#kegiatanSelect').on('change', function() {
                const realisasi = $(this).find('option:selected').data('realisasi');
                updateRealisasiDetails(realisasi);
            });
        });$
    </script> --}}
@endpush
