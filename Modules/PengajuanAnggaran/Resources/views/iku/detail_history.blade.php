@extends('adminlte::page')

@section('title', 'Data IKU')
@section('content_header')
    <h1 class="m-0 text-dark">Data IKU</h1>
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
                            <th>Sasaran Kinerja</th>
                            <th>Indikator Kinerja Kegiatan</th>
                            <th style="white-space: nowrap">Target Perjanjian Kinerja</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $show = [];
                        @endphp
                        @foreach ($iku as $i)
                            @if (!in_array($i->iku_id, $show))
                                <tr>
                                    <td>{{ $i->iku_text }}</td>
                                    <td>{{ $i->indikator }}</td>
                                    <td>{{ $i->target }}</td>
                                </tr>
                                @php
                                    $show[] = $i->iku_id;
                                @endphp
                            @else
                                <tr>
                                    <td></td>
                                    <td>{{ $i->indikator }}</td>
                                    <td>{{ $i->target }}</td>
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
            layout: {
                topStart: {
                    buttons: ['excelHtml5', 'pdfHtml5']
                }
            }
        });
    </script>
@stop
