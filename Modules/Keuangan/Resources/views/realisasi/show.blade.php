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
                <div class="card-header">Detail Realisasi</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Pagu</th>
                                    <th>Periode Lalu</th>
                                    <th>Periode ini</th>
                                    <th>s.d Periode</th>
                                    <th>Persentase</th>
                                    <th>sisa</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>cek</td>
                                <td>cek</td>
                                <td>cek</td>
                                <td>cek</td>
                                <td>cek</td>
                                <td>cek</td>
                            </tr>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mb-3">
                            {{-- {!! $perencanaans->links('pagination::bootstrap-4') !!} --}}
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-warning btn-sm mr-2" onclick="window.history.back()">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                    </button>
                    <button class="btn btn-success btn-sm">
                        <i class="fas fa-file-pdf" aria-hidden="true"></i> Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>

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

                    {{-- <div class="fixed-table">
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

                        <a href="#" id="hapusButton" class="btn btn-danger btn-sm" title="Hapus Realisasi">
                            <i class="fa fa-trash" aria-hidden="true"></i> Hapus
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
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
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
    </div> --}}
@endsection

@push('js')
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#kegiatanSelect').on('change', function() {
                var subId = $(this).val();
                var realisasiData = @json($realisasi);
                var volume = $('option:selected', this).data('volume');
                var hargaSatuan = $('option:selected', this).data('harga');
                var nama = $('option:selected', this).text();

                console.log('ID:', subId);
                console.log('Realisasi Data:', nama);

                var data = realisasiData[subId];
                var anggaranKeuangan = volume * hargaSatuan;

                console.log(data);
                $('#subPerencanaanId').val(subId);

                if (data && data.length > 0) {
                    $('#anggaran').val(anggaranKeuangan);
                    $('#progresKeuangan').val(data[0].progres);
                    $('#realisasiKeuangan').val(data[0].realisasi);
                    $('#tanggalPembayaran').val(data[0].tanggal_pembayaran);
                    $('#laporanKeuangan').val(data[0].laporan_keuangan);
                    $('#laporanKegiatan').val(data[0].laporan_kegiatan);
                    $('#ketercapaianOutput').val(data[0].ketercapaian_output);

                    // tombol tambah
                    var baseUrl = '{{ route('realisasi.update', ':id') }}';
                    baseUrl = baseUrl.replace(':id', subId);
                    $('#realisasiForm').attr('action', baseUrl);
                    $('#tambahButton').addClass('disabled');
                    // tombol ubah
                    $('#ubahButton').removeClass('disabled');

                    // tombol hapus
                    var deleteUrl = '{{ route('realisasi.destroy', ':id') }}';
                    deleteUrl = deleteUrl.replace(':id', data[0].id);
                    $('#hapusButton').data('url', deleteUrl).data('nama', nama);
                    $('#hapusButton').removeClass('disabled');
                } else {
                    // Kosongkan field form dan anggaran jika tidak ada data realisasi yang sesuai
                    $('#anggaran').val('');
                    $('#progresKeuangan').val('');
                    $('#realisasiKeuangan').val('');
                    $('#tanggalPembayaran').val('');
                    $('#laporanKeuangan').val('');
                    $('#laporanKegiatan').val('');
                    $('#ketercapaianOutput').val('');

                    $('#realisasiForm').attr('action', '');
                    $('#tambahButton').removeClass('disabled');
                    $('#ubahButton').addClass('disabled');
                    $('#hapusButton').addClass('disabled');
                }
            });
            $('#kegiatanSelect').trigger('change');

            // Add click event for the delete button
            $('#hapusButton').on('click', function() {
                var deleteUrl = $(this).data('url');
                var namaKegiatan = $(this).data('nama');

                if (deleteUrl) {
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        html: '<p>Menghapus realisasi <b>"' + namaKegiatan +
                            '"</b> akan menghapus seluruh realisasi didalamnya.</p>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: deleteUrl,
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(result) {
                                    // Handle success response
                                    Swal.fire('Realisasi berhasil dihapus.', '',
                                        'success');
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                },
                                error: function(xhr) {
                                    // Handle error response
                                    Swal.fire('Gagal menghapus realisasi.', '',
                                        'error');
                                }
                            });
                        }
                    });
                }
            });

            $('#tambahRealisasiModal form').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        // Handle success response
                        Swal.fire('Tambah realisasi berhasil.', '', 'success');
                        $('#tambahRealisasiModal').modal('hide'); // Hide the modal
                        setTimeout(function() {
                            location.reload();
                        }, 5000);
                    },
                    error: function(xhr) {
                        // Handle error response
                        Swal.fire('Gagal menambah realisasi.', '', 'error');
                    }
                });
            });

            $('#editRealisasiModal form').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        // Handle success response
                        Swal.fire('Edit realisasi berhasil.', '', 'success');
                        $('#editRealisasiModal').modal('hide'); // Hide the modal
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function(xhr) {
                        // Handle error response
                        Swal.fire('Gagal mengedit realisasi.', '', 'error');
                    }
                });
            });
        });
    </script>
@endpush
