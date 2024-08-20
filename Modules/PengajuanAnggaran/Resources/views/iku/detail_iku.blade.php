@extends('adminlte::page')

@section('title', 'Data IKU')
@section('content_header')
    <h1 class="m-0 text-dark">Detail IKU</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h4><b>Sasaran Kinereja :</b>{{ $sasaran_kinerja }}</h4>
            @role('admin')
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-success " data-toggle="modal" data-target="#modalAdd">Tambah</button>
                </div>
            @endrole

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Indikator Kinerja Kegiatan</th>
                            <th scope="col" style="white-space: nowrap">Target Perjanjian Kinerja</th>
                            @role('admin')
                                <th scope="col">Action</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataIku as $d)
                            <tr>
                                <td>{{ $d->indikator }}</td>
                                <td>{{ $d->target }}</td>
                                @role('admin')
                                    <td style="white-space: nowrap">
                                        <button type="button" onclick="modalEdit({{ $d->id }})"
                                            class="btn btn-outline-success">
                                            <span class="fa fa-edit"></span>
                                        </button>
                                        <a href="/pengajuananggaran/delete-data-iku/{{ $d->id }}"
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
                    <h5 class="modal-title">Add Indikator Kinerja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-add" action="/pengajuananggaran/add-data-iku/{{ $id }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="indikator" class="form-label">Indikator Kinerja Kegiatan</label>
                            <input type="text" class="form-control" name="indikator" id="indikator"
                                placeholder="Indikator Kinerja Kegiatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="target" class="form-label">Target Perjanjian Kinerja</label>
                            <input type="text" class="form-control" name="target" id="target"
                                placeholder="Target Perjanjian Kinerja" required>
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
                url: "/pengajuananggaran/modal-edit-iku/" + id,
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
