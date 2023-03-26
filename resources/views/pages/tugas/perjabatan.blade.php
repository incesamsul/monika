@extends('layouts.v_template')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex  justify-content-between">
                        <h4><a href="{{ URL::to('/admin/tugas') }}"><i class="fas fa-arrow-left"></i></a> tugas jabatan
                            {{ $jabatan->nama_jabatan }}</h4>
                        <div class="table-tools d-flex justify-content-around ">
                            <input type="text" class="form-control card-form-header mr-3" placeholder="Cari Data tugas ..."
                                id="cari-data-tugas">
                            <button type="button" class="btn btn-dark float-right" data-toggle="modal" id="addUserBtn"
                                data-target="#modaltugas"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-hover table-user table-action-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th width="5%" class="sorting" data-sorting_type="asc" data-column_name="id"
                                        style="cursor: pointer">ID <span id="id_icon"></span></th>
                                    <td>Nama tugas</td>
                                    <td>Status</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($tugas as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->tugas }}</td>
                                        <td>
                                            {{ $row->bulan }}
                                        </td>
                                        <td class="option">
                                            <div class="btn-group dropleft btn-option">
                                                <i type="button" class="dropdown-toggle" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </i>
                                                <div class="dropdown-menu">
                                                    <a data-tugas='@json($row)' data-toggle="modal"
                                                        data-target="#modaltugas" class="dropdown-item edit"
                                                        href="#"><i class="fas fa-pen"> Edit</i></a>
                                                    <a data-id_tugas="{{ $row->id_tugas }}" class="dropdown-item hapus"
                                                        href="#"><i class="fas fa-trash"> Hapus</i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    {{-- MODAL TAMBAH tugas --}}
    <div class="modal fade" id="modaltugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Tambah tugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                {{-- MODAL BODY UNTUK TAMBAH USER DAN EDIT USER --}}
                <div class="modal-body" id="main-body">

                    <form id="formtugas" action="{{ URL::to('/admin/create_tugas') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tugas">tugas</label>
                            <input type="hidden" class="form-control" name="id" id="id">
                            <input type="hidden" class="form-control" value="{{ $jabatan->id_jabatan }}" name="id_jabatan"
                                id="id_jabatan">
                            <input type="text" class="form-control" name="tugas" id="tugas">
                        </div>
                        <P>Masa aktif tugas</P>
                        <div class="form-group">
                            @foreach (getMonth() as $bulan)
                                <input value="{{ $bulan }}" type="checkbox" name="bulan[]" id="{{ $bulan }}">
                                <label for="{{ $bulan }}">{{ $bulan }}</label><br>
                            @endforeach
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark" id="modalBtn">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <link href='https://fonts.googleapis.com/css?family=Open+Sans:600,400' rel='stylesheet'
                        type='text/css'>
                    <div class="container">
                        <div class="page-header">
                            <h1 id="timeline">Timeline Tugas</h1>
                        </div>
                        <ul class="timeline">

                            @foreach (getMonth() as $bulan)
                                <li>
                                    <div class="timeline-badge"></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title text-capitalize">{{ $bulan }}</h4>
                                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>
                                                    {{ date('Y') }}</small></p>
                                        </div>
                                        <div class="timeline-body">
                                            @foreach ($tugas as $row)
                                                @php
                                                    $arrBulan = explode(',', $row->bulan);
                                                @endphp
                                                @if (in_array($bulan, $arrBulan))
                                                    <ul>
                                                        <li>
                                                            <p>{{ $row->tugas }}</p>
                                                        </li>
                                                    </ul>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {




            // TOMBOL EDIT USER
            $('.table-user tbody').on('click', 'tr td a.edit', function() {
                let datatugas = $(this).data('tugas');
                $('#tugas').val(datatugas.tugas);
                $('#id').val(datatugas.id_tugas);
                let bulan = datatugas.bulan;
                let arrBulan = bulan.split(",");
                arrBulan.forEach(el => {
                    $('#' + el).prop('checked', true);
                });
                $('#formtugas').attr('action', '/admin/update_tugas');
            })

            // TOMBOL TAMBAH USER
            $('#addUserBtn').on('click', function() {
                $('#ModalLabel').html('Tambah tugas');
                $('#modalBtn').html('Tambah');
                $('.modal-footer').show();
                $('#main-body').show();
                $('#kaitkan-body').hide();
                $('#batal-kaitkan-body').hide();
                $('#formtugas').attr('action', '/admin/create_tugas');
            });

            // TOMBOL HAPUS USER
            $('.table-user tbody').on('click', 'tr td a.hapus', function() {
                let idtugas = $(this).data('id_tugas');
                Swal.fire({
                    title: 'Apakah yakin?',
                    text: "Data tidak bisa kembali lagi!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Konfirmasi'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/admin/delete_tugas',
                            method: 'post',
                            dataType: 'json',
                            data: {
                                id_tugas: idtugas
                            },
                            success: function(data) {
                                if (data == 1) {
                                    Swal.fire('Berhasil', 'Data telah terhapus',
                                        'success').then((result) => {
                                        location.reload();
                                    });
                                }
                            }
                        })
                    }
                })
            });





        });

        $('#litugas').addClass('active');
        $('#liManajementugas').addClass('active');
    </script>
@endsection
