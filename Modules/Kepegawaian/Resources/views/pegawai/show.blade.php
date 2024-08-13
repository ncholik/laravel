@extends('adminlte::page')
@section('title', 'Jenisluaran')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Pegawai {{ $pegawai->nama }}</div>
                <div class="card-body">

                    <a href="{{ url('/kepegawaian/pegawai') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                                class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button></a>
                    <a href="{{ url('/kepegawaian/pegawai/' . $pegawai->id . '/edit') }}" title="Edit JenisLuaran"><button
                            class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Ubah</button></a>

                    <form method="POST" action="{{ url('/kepegawaian/pegawai' . '/' . $pegawai->id) }}"
                        accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete JenisLuaran"
                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                aria-hidden="true"></i> Hapus</button>
                    </form>
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>NIP/NIPPPK/NIK</th>
                                    <td>{{ $pegawai->nip }}</td>
                                    <th>Nama</th>
                                    <td>{{ $pegawai->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <td>{{ $pegawai->agama }}</td>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $pegawai->jenis_kelamin == 'L' ? 'Perempuan' : 'Laki-Laki' }}</td>
                                </tr>
                                <tr>
                                    <th>Golongan Darah</th>
                                    <td>{{ $pegawai->gol_darah }}</td>
                                    <th>Telepon</th>
                                    <td>{{ $pegawai->no_tlp }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat Lahir</th>
                                    <td>{{ $pegawai->tmp_lahir }}</td>
                                    <th>Tanggal Lahir</th>
                                    <td>{{ $pegawai->tgl_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Gelar Depan</th>
                                    <td>{{ $pegawai->gelar_dpn }}</td>
                                    <th>Gelar Belakang</th>
                                    <td>{{ $pegawai->gelar_blk }}</td>
                                </tr>
                                <tr>
                                    <th>Status Kawin</th>
                                    <td>{{ $pegawai->status_kawin == 'K' ? 'Kawin' : 'Belum Kawin' }}</td>
                                    <th>Kelurahan</th>
                                    <td>{{ $pegawai->kelurahan }}</td>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td>{{ $pegawai->kecamatan }}</td>
                                    <th>Kota</th>
                                    <td>{{ $pegawai->kota }}</td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td>{{ $pegawai->provinsi }}</td>
                                    <th>Kode Dosen</th>
                                    <td>{{ $pegawai->kode_dosen }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $pegawai->status }}</td>
                                    <th>Jenis Pegawai</th>
                                    <td>{{ $pegawai->jenis_pegawai }}</td>
                                </tr>
                                <tr>
                                    <th>Askes</th>
                                    <td>{{ $pegawai->askes }}</td>
                                    <th>NPWP</th>
                                    <td>{{ $pegawai->npwp }}</td>
                                </tr>
                                <tr>
                                    <th>NIDN</th>
                                    <td>{{ $pegawai->nidn }}</td>
                                    <th>Username</th>
                                    <td>{{ $pegawai->username }}</td>
                                </tr>
                                <tr>
                                    <th>Status Karyawan</th>
                                    <td>{{ $pegawai->status_karyawan }}</td>
                                    <th></th>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
