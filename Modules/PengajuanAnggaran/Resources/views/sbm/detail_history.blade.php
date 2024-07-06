@extends('adminlte::page')

@section('title', 'Data SBM')
@section('content_header')
    <h1 class="m-0 text-dark">Data SBM</h1>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            Waktu Penyimpanan : <b>{{ date('D, d F Y H:i:s', strtotime($date)) }}</b>
            <div class="table-responsive">
                <table class="table table-bordered" id="history">
                    <thead>
                        <tr>
                            <th rowspan="2">Jenis Kegiatan</th>
                            <th rowspan="2">Item</th>
                            <th colspan="3">Volume</th>
                            <th rowspan="2">Keterangan</th>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $show = [];
                        @endphp
                        @foreach ($sbm as $i)
                            @if (!in_array($i->sbm_id, $show))
                                <tr>
                                    <td>{{ $i->sbm_text }}</td>
                                    <td>{{ $i->nama }}</td>
                                    <td>{{ $i->jumlah_satuan }}</td>
                                    <td>{{ $i->satuan }}</td>
                                    <td>{{ $i->harga_satuan }}</td>
                                    <td>{{ $i->keterangan }}</td>
                                </tr>
                                @php
                                    $show[] = $i->sbm_id;
                                @endphp
                            @else
                                <tr>
                                    <td></td>
                                    <td>{{ $i->nama }}</td>
                                    <td>{{ $i->jumlah_satuan }}</td>
                                    <td>{{ $i->satuan }}</td>
                                    <td>{{ $i->harga_satuan }}</td>
                                    <td>{{ $i->keterangan }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {{-- @dd($show) --}}
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script>
        $('#history').DataTable({
            ordering: false,
            searching: false,
            paging: false,
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ]
        });
    </script>
@stop
