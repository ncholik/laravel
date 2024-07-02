@extends('adminlte::page')

@section('title', 'Data Pengajuan Anggaran')
@section('content_header')
<h1 class="m-0 text-dark">
    Detail RAB</h1>
@stop

@section('content')
<div class="card">

    <div class="card-body">
        <table>
            <tbody>
                <tr>
                    <th>Judul</th>
                    <td>: {{ $rab->nama }}</td>
                </tr>
                <tr>
                    <th>Tanggal Diajukan</th>
                    <td>: {{ date('d-m-Y', strtotime($rab->created_at)) }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>: {{ ucfirst($rab->status) }}

                    </td>
                </tr>
                @role('admin')
                @if ($rab->status == 'waiting')
                <tr>
                    <td colspan="2">
                        <a href="{{ route('detailRab.approve', ['id' => $rab->id]) }}?status=reject" class="btn btn-danger">Reject
                            RAB</a>
                        <a href="{{ route('detailRab.approve', ['id' => $rab->id]) }}?status=approve" class="btn btn-primary">Approve
                            RAB</a>
                    </td>
                </tr>
                @endif
                @endrole
            </tbody>
        </table>

        @if ($rab->status == 'waiting')
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('detailRab.create', ['id' => $rab->id]) }}" class="btn btn-success">Tambah</a>
        </div>
        @endif
        <div class="table-responsive">
            <table class="table">
                {{-- @dd($rab->detail) --}}
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Aktifitas Terkait/Pelatihan</th>
                        <th>Nama Peserta</th>
                        <th colspan="2">Akun Belanja Detail</th>
                        <th>Relevansi Iku</th>
                        <th>Bukti Surat Penawaran</th>
                        @role('admin')
                        @if ($rab->status == 'waiting')
                        <th>Aksi</th>
                        @endif
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rab->detail as $r)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            <b>{{ $r->aktivitas }}</b>
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Lokasi</th>
                                        <td>{{ $r->lokasi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Penyedia</th>
                                        <td>{{ $r->penyedia }}</td>
                                    </tr>
                                    <tr>
                                        <th>Durasi</th>
                                        <td>{{ $r->durasi }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <ol>

                                @foreach (json_decode($r->nama_peserta) as $p)
                                <li>{{ $p }}</li>
                                @endforeach
                            </ol>
                        </td>
                        <td style="white-space: nowrap">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#akunModal{{ $r->id }}"><span class="fa fa-eye"></span>
                                Akun</button>
                            <div class="modal fade" id="akunModal{{ $r->id }}" tabindex="-1" aria-labelledby="akunModal{{ $r->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="akunModal{{ $r->id }}Label">
                                                Detail Akun</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Akun</th>
                                                            <th colspan="2">Jumlah</th>
                                                            <th colspan="2">Jam/Hari</th>
                                                            <th colspan="2">Frek</th>
                                                            <th>Total</th>
                                                            <th>Satuan</th>
                                                            <th>Harga Satuan</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="body-akun">
                                                        @php
                                                        $sbmSelected = [];
                                                        $total = 0;
                                                        @endphp
                                                        @foreach ($r->akunDetail->sortBy('sbm_id') as $a)
                                                        @if (!in_array($a->sbm_id, $sbmSelected))
                                                        @php
                                                        $sbmSelected[] = $a->sbm_id;
                                                        @endphp
                                                        <tr>
                                                            <th colspan="12">{{ $a->sbm_text }}</th>
                                                        </tr>
                                                        @endif
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $a->sbm_detail_text }}</td>
                                                            <td>{{ $a->jumlah }}</td>
                                                            <td>{{ $a->jumlah_satuan }}</td>
                                                            <td>{{ $a->jam }}</td>
                                                            <td>{{ $a->jam_satuan }}</td>
                                                            <td>{{ $a->frek }}</td>
                                                            <td>{{ $a->frek_satuan }}</td>
                                                            <td>{{ $a->total }}</td>
                                                            <td>{{ $a->total_satuan }}</td>
                                                            <td>{{ $a->harga_satuan }}</td>
                                                            <td>{{ $a->harga_satuan * $a->total }}</td>
                                                        </tr>
                                                        @php
                                                        $total += $a->harga_satuan * $a->total;
                                                        @endphp
                                                        @endforeach

                                                    </tbody>
                                                    <tfoot class="table-info">
                                                        <tr>
                                                            <th colspan="11">Total</th>
                                                            <th>{{ $total }}</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </td>
                        <td style="white-space: nowrap">Rp. {{ $total }}</td>
                        <td>
                            {{ $r->iku_text }}
                        </td>
                        <td>
                            <a href="{{ asset('storage/bukti_file/' . $r->bukti) }}" target="_blank">Download
                                Bukti</a>
                        </td>
                        @role('admin')
                        @if ($rab->status == 'waiting')
                        <td style="white-space: nowrap">
                            <a href="{{ route('detailRab.edit', ['id' => $r->id]) }}" class="btn btn-outline-warning "><span class="fa fa-edit"></span></a>
                            <a href="{{ route('detailRab.delete', ['id' => $r->id]) }}" class="btn btn-outline-danger "><span class="fa fa-trash"></span></a>
                        </td>
                        @endif
                        @endrole
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>
@section('js')
@if (session('message'))
<script>
    Swal.fire({
        icon: 'success',
        title: "{!! session('message') !!}",
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 7000,
        timerProgressBar: true,

    });
</script>
@endif
@if ($errors->any())
@php
$error = '<ul class="mb-0">';
    foreach ($errors->all() as $err) {
    $error .= '<li>' . $err . '</li>';
    }
    $error .= '</ul>';

@endphp
<script>
    Swal.fire({
        icon: 'error',
        title: '{!! $error !!}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 7000,
        timerProgressBar: true,
    });
</script>
@endif

@stop
@endsection