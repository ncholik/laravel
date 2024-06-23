@extends('adminlte::page')

@section('title', 'History IKU')
@section('content_header')
    <h1 class="m-0 text-dark">History IKU</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table bg-transparent table-bordered ">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Waktu Penyimpanan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($time as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('D, d F Y H:i:s', strtotime($t)) }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('detailHistoryIku', ['date' => $t]) }}"
                                        class="btn btn-outline-success"><span class="fa fa-eye">
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
