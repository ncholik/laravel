@extends('adminlte::page')
@section('title', 'Detail Jabatan')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Jabatan {{ $pejabat->jabatan }}</div>
                <div class="card-body">

                    <a href="{{ url('/kepegawaian/pejabat') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                                class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button></a>
                    <a href="{{ url('/kepegawaian/pejabat/' . $pejabat->id . '/edit') }}" title="Edit Jabatan"><button
                            class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Ubah</button></a>

                    <form method="POST" action="{{ url('/kepegawaian/pejabat' . '/' . $pejabat->id) }}"
                        accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Jabatan"
                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                aria-hidden="true"></i> Hapus</button>
                    </form>
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Jabatan</th>
                                    <td>{{ $pejabat->jabatan }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Mulai</th>
                                    <td>{{ $pejabat->mulai ? $pejabat->mulai->format('d-m-Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Selesai</th>
                                    <td>{{ $pejabat->selesai ? $pejabat->selesai->format('d-m-Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor SK</th>
                                    <td>{{ $pejabat->SK ? $pejabat->SK : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Pegawai</th>
                                    <td>{{ $pejabat->pegawai ? $pejabat->pegawai->nama : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Unit</th>
                                    <td>{{ $pejabat->unit ? $pejabat->unit->nama : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $pejabat->status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
