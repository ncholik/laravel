@extends('adminlte::page')

@section('title', 'Data IKU')
@section('content_header')
    <h1 class="m-0 text-dark">Data IKU</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3 ">
                @role('admin')
                    <a href="{{ route('saveIku') }}" class="btn btn-warning mr-2"><span class="fa fa-save">
                        </span> Simpan Data Terakhir</a>
                @endrole
                <a href="{{ route('historyIku') }}" class="btn btn-success"><span class="fa fa-history">
                    </span> Riwayat IKU</a>
            </div>
            <div class="table-responsive">
                <table class="table bg-transparent table-bordered ">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Sasaran Kinerja</th>
                            <th scope="col">Indikator Kinerja Kegiatan</th>
                            <th scope="col">Target</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $n = 1;
                        @endphp
                        @foreach ($iku as $i)
                            @foreach ($i->dataIku as $d)
                                <tr>
                                    @if ($loop->iteration == 1)
                                        <td class="align-middle" rowspan="{{ $i->dataIku->count() }}">{{ $n }}
                                        </td>
                                        <td class="align-middle" rowspan="{{ $i->dataIku->count() }}">
                                            {{ $i->sasaran_kinerja }}</td>
                                    @endif
                                    <td>{{ $d->indikator }}</td>
                                    <td class="align-middle">{{ $d->target }}</td>
                                    @if ($loop->iteration == 1)
                                        <td class="align-middle" rowspan="{{ $i->dataIku->count() }}">
                                            <a href="/pengajuananggaran/iku/{{ $i->id }}"
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
