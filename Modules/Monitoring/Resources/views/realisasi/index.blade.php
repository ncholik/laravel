@extends('adminlte::page')
@section('title', 'Realisasi')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
    <div class="row">
        <div class="col-md-5">
            <div class="info-box">
                <span class="info-box-icon bg-secondary"><i class="fa fa-money-bill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">JUMLAH PROGRAM KERJA</span>
                    <span class="info-box-number">{{ $jumlahProgramKerja }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="info-box">
                <span class="info-box-icon bg-secondary"><i class="far fa-envelope"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">TOTAL BIAYA DPA</span>
                    <span class="info-box-number">Rp. {{ str_replace(',', '.', number_format($totalDPA)) }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-money-bill-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">TOTAL RENCANA KEUANGAN</span>
                    <span class="info-box-number">1,410</span>
                </div>
                <span class="info-box-icon bg-success"><i class="far fa-money-bill-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">TOTAL REALISASI KEUANGAN</span>
                    <span class="info-box-number">1,410</span>
                </div>

                <div class="mt-auto mb-auto mr-3">
                    <button class="btn btn-light" type="button" id="toggleContentButton">
                        Detail <i class="fas fa-sort-down"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="dropdownContent" style="display: none;">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">RENCANA TERTIMBANG FISIK</span>
                        <span class="info-box-number">1,410</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">REALISASI TERTIMBANG FISIK</span>
                        <span class="info-box-number">1,410</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">DEVIASI</span>
                        <span class="info-box-number">1,410</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Data Realisasi</div>
                <div class="card-body">
                    <a href="{{ url('/kepegawaian/pegawai/create') }}" class="btn btn-success btn-sm"
                        title="Tambah Pegawai">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                    </a>

                    <form method="GET" action="{{ url('/kepegawaian/pegawai') }}" accept-charset="UTF-8"
                        class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari..."
                                value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <br />
                    <br />
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>kode</th>
                                    <th>Nama Program Kerja</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perencanaans as $perencanaan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $perencanaan->kode }}</td>
                                        <td>{{ $perencanaan->nama }}</td>
                                        <td>
                                            <a href="{{ route('realisasi.sub_index', $perencanaan->id) }}"
                                                title="View Realisasi">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                            <a href="{{ url('/realisasi/' . $perencanaan->id . '/edit') }}"
                                                title="Edit Realisasi">
                                                <button class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit" arria-hidden="true"></i>
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ url('/realisasi/' . $perencanaan->id) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    title="Delete Realisasi"
                                                    onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex">
                            {!! $perencanaans->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.getElementById("toggleContentButton").addEventListener("click", function() {
            var content = document.getElementById("dropdownContent");
            content.style.display = (content.style.display === "none") ? "block" : "none";
        });
    </script>
@endpush
