@extends('adminlte::page')

@section('title', 'Pengajuan Anggaran')
@section('content_header')
    <h1 class="m-0 text-dark">Tambah Aktivitas</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('detailRab.store', ['id' => $rab->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row row-cols-3 ">
                    <div class="col mb-3">
                        <label for="aktivitas" class="form-label">Nama Aktivitas</label>
                        <input type="text" class="form-control" name="aktivitas" id="aktivitas"
                            placeholder="Nama Aktivitas" required>
                    </div>
                    <div class="col mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi"
                            required>
                    </div>
                    <div class="col mb-3">
                        <label for="penyedia" class="form-label">Penyedia</label>
                        <input type="text" class="form-control" name="penyedia" id="penyedia" placeholder="Penyedia"
                            required>
                    </div>
                    <div class="col mb-3">
                        <label for="durasi" class="form-label">Durasi</label>
                        <input type="text" class="form-control" name="durasi" id="durasi" placeholder="durasi"
                            required>
                    </div>
                    <div class="col mb-3">
                        <label for="bukti_file" class="form-label">Bukti Surat Penawaran</label>
                        <input type="file" class="form-control" name="bukti_file" id="bukti_file" placeholder=""
                            required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="iku" class="form-label">IKU</label>
                    <select class="form-control" name="iku" id="iku" required>
                        <option value="">Pilih IKU</option>
                        @foreach ($iku as $i)
                            <optgroup label="{{ $i->sasaran_kinerja }}">
                                @foreach ($i->dataIku as $d)
                                    <option value="{{ $d->id }}|{{ $d->indikator }}">{{ $d->indikator }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <b>Nama Peserta :</b> <button type="button" class="btn btn-outline-success border-0"
                                data-toggle="modal" data-target="#modalTambahNama"><span class="fa fa-plus-circle"></span>
                                Tambah Nama</button>
                            <input type="hidden" name="nama_peserta" id="nama_peserta" required>

                            <div id="nama-peserta">
                                <ol>
                                    <li>...</li>
                                </ol>
                            </div>

                        </div>

                        <div class="col-12 col-lg-8">
                            <b>Akun Belanja / Detail : </b><button type="button" class="btn btn-outline-success border-0"
                                data-toggle="modal" data-target="#modalTambahAkun"><span class="fa fa-plus-circle"></span>
                                Tambah Akun</button>
                            <input type="hidden" name="akun" id="akun" required>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
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
                                        <tr>
                                            <td colspan="13" style="height: 100px" class="text-center">
                                                <h1 class="text-muted">Isi data untuk mengisi tabel ini</h1>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mb-5 text-center">
                    <button class="btn btn-primary">Simpan <span class="fa fa-save"></span></button>
                </div>

            </form>
        </div>
    </div>


    <div class="modal fade" id="modalTambahNama" tabindex="-1" aria-labelledby="modalTambahNamaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahNamaLabel">Tambah Nama Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="modal_nama" class="form-label">Nama Peserta</label>
                        <input type="text" class="form-control" name="modal_nama" id="modal_nama" required
                            placeholder="Nama Peserta">
                        <div id="modal_namaFeedback" class="invalid-feedback">
                            Nama tidak boleh kosong
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="addNama()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTambahAkun" tabindex="-1" role="dialog" aria-labelledby="modalTambahAkunLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahAkunLabel">Tambah Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="modal_form_akun">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="modal_sbm_detail_id" class="form-label">Akun</label>
                                    <select type="text" class="form-control" name="modal_sbm_detail_id"
                                        id="modal_sbm_detail_id" onchange="selectSbm()" required>
                                        <option value="">Pilih SBM</option>
                                        @foreach ($sbm as $s)
                                            <optgroup label="{{ $s->jenis_kegiatan }}">
                                                @foreach ($s->detail as $d)
                                                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <div id="mdoal_sbm_idFeedback" class="invalid-feedback">
                                        Akun tidak boleh kosong
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="modal_sbm_text" class="form-label">Jenis Kegiatan</label>
                                    <input type="hidden" name="modal_sbm_detail_text" id="modal_sbm_detail_text">
                                    <input type="hidden" name="modal_sbm_id" id="modal_sbm_id">
                                    <input type="text" class="form-control" name="modal_sbm_text" id="modal_sbm_text"
                                        aria-describedby="helpId" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="modal_harga_satuan" class="form-label">Harga Satuan</label>
                                    <input type="text" class="form-control" name="modal_harga_satuan"
                                        id="modal_harga_satuan" placeholder="" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="my-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Jumlah</span>
                                        </div>
                                        <input type="text" aria-label="Jumlah" placeholder="Jumlah" id="modal_jumlah"
                                            name="modal_jumlah" class="form-control">
                                        <input type="text" aria-label="Satuan" placeholder="Satuan"
                                            id="modal_jumlah_satuan" name="modal_jumlah_satuan" class="form-control">
                                        <div id="modal_jumlah-Feedback" class="invalid-feedback">
                                            Jumlah tidak boleh kosong
                                        </div>
                                    </div>

                                </div>
                                <div class="my-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Jam/Hari</span>
                                        </div>
                                        <input type="text" aria-label="Jam/Hari" placeholder="Jam/Hari"
                                            id="modal_jam" name="modal_jam" class="form-control">
                                        <input type="text" aria-label="Satuan" placeholder="Satuan"
                                            id="modal_jam_satuan" name="modal_jam_satuan" class="form-control">
                                        <div id="modal_jam-Feedback" class="invalid-feedback">
                                            Jam/Hari tidak boleh kosong
                                        </div>
                                    </div>

                                </div>
                                <div class="my-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Frek</span>
                                        </div>
                                        <input type="text" aria-label="Frek" placeholder="Frek" id="modal_frek"
                                            name="modal_frek" class="form-control">
                                        <input type="text" aria-label="Satuan" placeholder="Satuan"
                                            id="modal_frek_satuan" name="modal_frek_satuan" class="form-control">
                                        <div id="modal_frek-Feedback" class="invalid-feedback">
                                            Frek tidak boleh kosong
                                        </div>
                                    </div>

                                </div>
                                <div class="my-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Total</span>
                                        </div>
                                        <input type="number" aria-label="Total" placeholder="Total" id="modal_total"
                                            name="modal_total" class="form-control">
                                        <input type="text" aria-label="Satuan" placeholder="Satuan"
                                            id="modal_total_satuan" name="modal_total_satuan" class="form-control"
                                            readonly>
                                        <div id="modal_total-Feedback" class="invalid-feedback">
                                            Total tidak boleh kosong
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onclick="addAkun()" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        let namaPeserta = [];

        const detailSbm = @json($detail_sbm);

        function drawNama() {
            var html = `<ol>`
            namaPeserta.forEach(function(nama, i) {
                html += `<li>${nama} <button type="button" class="btn btn-outline-danger btn-sm border-0" onclick="deleteNama(${i})"><span
            class="fa fa-trash"></span></button></li>`
            });

            html += ` </ol>`;
            $('#nama-peserta').html(html);
            $('input#nama_peserta').val(JSON.stringify(namaPeserta));
        }

        function addNama() {
            let input = $('#modal_nama');
            let val = $(input).val()
            if (!val) {
                $(input).addClass('is-invalid');
            } else {
                namaPeserta.push(val);
                drawNama();
                $(input).removeClass('is-invalid');
                $(input).val(null);
                $('#modalTambahNama').modal('hide');

            }
        }

        function deleteNama(index) {
            namaPeserta.splice(index, 1);
            drawNama()
        }

        function selectSbm() {
            let select = $('#modal_sbm_detail_id');
            let val = $(select).val();
            let selectedSbm = detailSbm.filter(s => val == s.id)[0];
            if (val) {
                $('#modal_sbm_id').val(selectedSbm.sbm_id)
                $('#modal_sbm_text').val(selectedSbm.sbm.jenis_kegiatan)
                $('#modal_sbm_detail_text').val(selectedSbm.nama)
                $('#modal_harga_satuan').val(selectedSbm.harga_satuan)
                $('#modal_total_satuan').val(selectedSbm.satuan)

            } else {
                clearForm()
            }

        }

        function clearForm(all = false) {
            $('#modal_sbm_id').val(null)
            $('#modal_sbm_text').val(null)
            $('#modal_sbm_detail_id').val(null)
            $('#modal_sbm_detail_text').val(null)
            $('#modal_harga_satuan').val(null)
            $('#modal_total_satuan').val(null)

            if (all) {
                $('#modal_jumlah').val(null)
                $('#modal_jumlah_satuan').val(null)
                $('#modal_jam').val(null)
                $('#modal_jam_satuan').val(null)
                $('#modal_frek').val(null)
                $('#modal_frek_satuan').val(null)
                $('#modal_total').val(null)
            }
        }

        let akun = {};

        function addAkun() {
            let selectSbmDetail = $('#modal_sbm_detail_id');
            if ($(selectSbmDetail).val()) {
                let data = $('#modal_form_akun').serializeArray().reduce(function(obj, item) {
                    obj[item.name] = item.value;
                    return obj;
                }, {});

                let id = "sbm_" + data.modal_sbm_id;
                if (!akun.hasOwnProperty(id)) {
                    akun[id] = {};
                    akun[id].sbm_id = data.modal_sbm_id;
                    akun[id].sbm_text = data.modal_sbm_text;
                    akun[id].data = [];
                }
                akun[id].data.push(data);

                clearForm(true);
                drawAkun();
                $('#modalTambahAkun').modal('hide');

                $(selectSbmDetail).removeClass('is-invalid');

            } else {
                $(selectSbmDetail).addClass('is-invalid');
            }


        }

        function drawAkun() {
            let tbody = $('#body-akun')
            $('#akun').val(JSON.stringify(akun));
            let html = ``;
            for (let a in akun) {
                html += `<tr>
                    <td colspan=13> <b>${akun[a].sbm_text} </b></td>
                </tr>`;
                akun[a].data.forEach(function(d, i) {
                    html += `<tr>
                                <td><button type="button" class="btn btn-outline-danger border-0 btn-sm" data-id=${i} data-sbm="${a}" onclick="deleteAkun(this)"><span class="fa fa-trash"></span></button></td>
                                <td>${d.modal_sbm_detail_text}</td>
                                <td>${d.modal_jumlah}</td>
                                <td>${d.modal_jumlah_satuan}</td>
                                <td>${d.modal_jam}</td>
                                <td>${d.modal_jam_satuan}</td>
                                <td>${d.modal_frek}</td>
                                <td>${d.modal_frek_satuan}</td>
                                <td>${d.modal_total}</td>
                                <td>${d.modal_total_satuan}</td>
                                <td>${d.modal_harga_satuan}</td>
                                <td>${d.modal_total*d.modal_harga_satuan}</td>
                                
                            </tr>`;
                });

            }
            $(tbody).html(html);
        }

        function deleteAkun(data) {
            let index = $(data).data('id');
            let sbm = $(data).data('sbm');
            akun[sbm].data.splice(index, 1);
            if (akun[sbm].data.length === 0) {
                delete akun[sbm];
            }
            drawAkun();
        }

        $(document).ready(function() {

        });
    </script>
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
