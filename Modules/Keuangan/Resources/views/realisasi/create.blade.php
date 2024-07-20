@extends('adminlte::page')
@section('title', 'Tambah Realisasi')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Tambah Realisasi</div>
                <div class="card-body">
                    <a href="{{ route('realisasi.index') }}" class="btn btn-warning btn-sm mr-2">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                    </a>                    
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form id="realisasi-tambah" method="POST" action="{{ route('realisasi.store') }}" accept-charset="UTF-8"
                        class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="sub_perencanaan_id" value="{{ $subPerencanaanId }}">
                        @include ('keuangan::realisasi.form', ['formMode' => 'create'])

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('realisasi-tambah').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin mengirimkan data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, kirim!',
                cancelButtonText: 'Tidak, batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit the form if confirmed
                }
            });
        });
    </script>
@endpush
