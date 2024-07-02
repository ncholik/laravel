@extends('adminlte::page')

@section('title', 'Data SBM')
@section('content_header')
    <h1 class="m-0 text-dark">Data SBM</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3 ">
                @role('admin')
                    <a href="{{ route('saveSbm') }}" class="btn btn-warning mr-2"><span class="fa fa-save">
                        </span> Simpan Data Terakhir</a>
                @endrole
                <a href="{{ route('historySbm') }}" class="btn btn-success"><span class="fa fa-history">
                    </span> Riwayat SBM</a>
            </div>
            <div class="table-responsive">
                <table class="table bg-transparent table-bordered ">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Jenis Kegiatan</th>
                            <th scope="col">Item</th>
                            <th scope="col" colspan="3">Volume</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $n = 1;
                        @endphp
                        @foreach ($sbm as $i)
                            @foreach ($i->detail as $d)
                                <tr>
                                    @if ($loop->iteration == 1)
                                        <td class="align-middle" rowspan="{{ $i->detail->count() }}">{{ $n }}
                                        </td>
                                        <td class="align-middle" rowspan="{{ $i->detail->count() }}">
                                            {{ $i->jenis_kegiatan }}</td>
                                    @endif
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->jumlah_satuan }}</td>
                                    <td>{{ $d->satuan }}</td>
                                    <td>{{ $d->harga_satuan }}</td>
                                    <td>{{ $d->keterangan }}</td>
                                    @if ($loop->iteration == 1)
                                        <td class="align-middle" rowspan="{{ $i->detail->count() }}">
                                            <a href="/pengajuananggaran/sbm/{{ $i->id }}"
                                                class="btn btn-outline-success"><span class="fa fa-eye">
                                                </span>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            @php
                                $n++;
                            @endphp
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
