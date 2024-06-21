@extends('adminlte::page')
@section('title', 'Perencanaan')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Detail Kegiatan: {{ $perencanaan->nama }}</div>
                <div class="card-body">
                    <a href="{{ route('realisasi.index') }}" title="Kembali">
                        <button class="btn btn-warning btn-sm">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                        </button>
                    </a>
                    {{-- <a href="#" class="btn btn-success btn-sm" title="Tambah Sub Perencanaan" data-toggle="modal"
                        data-target="#addSubPerencanaanModal">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                    </a> --}}

                    <!-- Add SubPerencanaan Modal -->
                    {{-- <div class="modal fade" id="addSubPerencanaanModal" tabindex="-1" role="dialog"
                        aria-labelledby="addSubPerencanaanModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addSubPerencanaanModalLabel">Tambah Sub Perencanaan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('subPerencanaan.store', ['perencanaan' => $perencanaan->id]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="kegiatan">Nama Kegiatan</label>
                                            <input type="text" class="form-control" id="kegiatan" name="kegiatan"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="volume">Volume</label>
                                            <input type="number" class="form-control" id="volume" name="volume"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" class="form-control" id="satuan" name="satuan"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_satuan">Harga Satuan</label>
                                            <input type="number" class="form-control" id="harga_satuan" name="harga_satuan"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="output">Output</label>
                                            <input type="text" class="form-control" id="output" name="output"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="rencana_mulai">Rencana Mulai</label>
                                            <input type="date" class="form-control" id="rencana_mulai"
                                                name="rencana_mulai" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="rencana_bayar">Rencana Bayar</label>
                                            <input type="date" class="form-control" id="rencana_bayar"
                                                name="rencana_bayar" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="file_hps">file_hps</label>
                                            <input type="text" class="form-control" id="file_hps" name="file_hps"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="file_kak">file_kak</label>
                                            <input type="text" class="form-control" id="file_kak" name="file_kak"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pic_id">pic_id</label>
                                            <input type="text" class="form-control" id="pic_id" name="pic_id"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="ppk_id">ppk_id</label>
                                            <input type="text" class="form-control" id="ppk_id" name="ppk_id"
                                                required>
                                        </div>
                                        <input type="hidden" name="perencanaan_id" value="{{ $perencanaan->id }}">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <br />
                    <br />
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subPerencanaan as $subPerencanaan)
                                    <tr>
                                        <td>{{ $subPerencanaan->volume }}</td>
                                        <td>{{ $subPerencanaan->kegiatan }}</td>
                                        <td>
                                            <div class="btn-group dropright">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                        href="{{ route('perencanaan.show', $subPerencanaan->id) }}"
                                                        title="Lihat Perencanaan">
                                                        <button class="btn btn-info btn-sm btn-block">
                                                            <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                                                        </button>
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('perencanaan.edit', $subPerencanaan->id) }}"
                                                        title="Edit Perencanaan">
                                                        <button class="btn btn-primary btn-sm btn-block">
                                                            <i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit
                                                        </button>
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('perencanaan.destroy', $subPerencanaan->id) }}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a class="dropdown-item">
                                                            <button type="submit" class="btn btn-danger btn-sm btn-block"
                                                                title="Hapus Perencanaan"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus perencanaan ini?')">
                                                                <i class="fas fa-trash" aria-hidden="true"></i> Hapus
                                                            </button>
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
@endpush
