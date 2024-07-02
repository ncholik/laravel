@extends('adminlte::page')

@section('title', 'Data SBM')
@section('content_header')
    <h1 class="m-0 text-dark">Detail SBM</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h4><b>Jenis Kegiatn :</b>{{ $jenis_kegiatan }}</h4>
            @role('admin')
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-success " data-toggle="modal" data-target="#modalAdd">Tambah</button>
                </div>
            @endrole

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col" colspan="3">Volume</th>
                            <th scope="col">Keterangan</th>
                            @role('admin')
                                <th scope="col">Action</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail as $d)
                            <tr>
                                <td>{{ $d['nama'] }}</td>
                                <td>{{ $d['jumlah_satuan'] }}</td>
                                <td>{{ $d['satuan'] }}</td>
                                <td>{{ $d['harga_satuan'] }}</td>
                                <td>{{ $d['keterangan'] }}</td>
                                @role('admin')
                                    <td style="white-space: nowrap">
                                        <button type="button" onclick="modalEdit({{ $d['id'] }})"
                                            class="btn btn-outline-success">
                                            <span class="fa fa-edit"></span>
                                        </button>
                                        <a href="/pengajuananggaran/delete-data-sbm/{{ $d['id'] }}"
                                            class="btn btn-outline-danger">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    </td>
                                @endrole
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- Modal Body -->

    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content " id="modalEditBody">

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content " id="modalAddBody">
                <div class="modal-header">
                    <h5 class="modal-title">Add Data SBM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-add" action="/pengajuananggaran/add-data-sbm/{{ $id }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Item</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Item"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_satuan" class="form-label">Jumlah Satuan</label>
                            <input type="number" class="form-control" name="jumlah_satuan" id="jumlah_satuan"
                                placeholder="Jumlah Satuan">
                        </div>
                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan">
                        </div>
                        <div class="mb-3">
                            <label for="harga_satuan" class="form-label">Harga</label>
                            <input type="text" class="form-control" name="harga_satuan" id="harga_satuan"
                                placeholder="Harga">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="submitAdd()" class="btn btn-primary">Save changes</button>
                </div>

            </div>
        </div>
    </div>




@endsection

@section('js')
    <script>
        function modalEdit(id) {
            $('#modalEdit').modal('show');
            $.ajax({
                type: "get",
                url: "/pengajuananggaran/modal-edit-sbm/" + id,
                beforeSend: function(response) {
                    $('#modalEditBody').html(
                        `<div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`
                    );
                },
                success: function(response) {
                    $('#modalEditBody').html(response);
                }
            });
        }

        function submitAdd() {
            $('#form-add').submit()
        }
    </script>
@stop
