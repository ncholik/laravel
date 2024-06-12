@extends('adminlte::page')
@section('title', 'Perencanaan')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Detail Kegiatan</div>
                <div class="card-body">

                    <a href="#" title="Kembali">
                        <button class="btn btn-warning btn-sm" onclick="window.history.back()">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                        </button>
                    </a>

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
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th> Nama Kegiatan</th>
                                    <td>{{ $subPerencanaan->kegiatan }}</td>
                                </tr>
                                <tr>
                                    <th> Volume </th>
                                    <td> {{ $subPerencanaan->volume }} </td>
                                </tr>
                                <tr>
                                    <th> Satuan </th>
                                    <td> {{ $subPerencanaan->satuan }} </td>
                                </tr>
                                <tr>
                                    <th> Harga Satuan </th>
                                    <td> Rp. {{ str_replace(',', '.', number_format ($subPerencanaan->harga_satuan)) }} </td>
                                </tr>
                                <tr>
                                    <th> output </th>
                                    <td> {{ $subPerencanaan->output }} </td>
                                </tr>
                                <tr>
                                    <th> rencana mulai </th>
                                    <td> {{ $subPerencanaan->rencana_mulai }} </td>
                                </tr>
                                <tr>
                                    <th> Rencana Bayar </th>
                                    <td> {{ $subPerencanaan->rencana_bayar }} </td>
                                </tr>
                                <tr>
                                    <th> file hps </th>
                                    <td> {{ $subPerencanaan->file_hps }} </td>
                                </tr>
                                <tr>
                                    <th> file kak </th>
                                    <td> {{ $subPerencanaan->file_kak }} </td>
                                </tr>
                                <tr>
                                    <th> pic id </th>
                                    <td> {{ $subPerencanaan->pic_id }} </td>
                                </tr>
                                <tr>
                                    <th> ppk id </th>
                                    <td> {{ $subPerencanaan->ppk_id }} </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><strong>Total</strong></td>
                                    <td><strong>Rp. {{ str_replace(',', '.', number_format($total)) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
