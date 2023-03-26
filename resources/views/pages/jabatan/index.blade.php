@extends('layouts.v_template')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex  justify-content-between">
                        <h4>Data jabatan</h4>
                        <div class="table-tools d-flex justify-content-around ">
                            <input type="text" class="form-control card-form-header mr-3"
                                placeholder="Cari Data jabatan ..." id="cari-data-jabatan">
                            <button type="button" class="btn btn-dark float-right" data-toggle="modal" id="addUserBtn"
                                data-target="#modaljabatan"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-hover table-user table-action-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th width="5%" class="sorting" data-sorting_type="asc" data-column_name="id"
                                        style="cursor: pointer">ID <span id="id_icon"></span></th>
                                    <td>Nama jabatan</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($jabatan as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama_jabatan }}</td>
                                        <td class="option">
                                            <div class="btn-group dropleft btn-option">
                                                <i type="button" class="dropdown-toggle" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </i>
                                                <div class="dropdown-menu">
                                                    <a data-jabatan='@json($row)' data-toggle="modal"
                                                        data-target="#modaljabatan" class="dropdown-item edit"
                                                        href="#"><i class="fas fa-pen"> Edit</i></a>
                                                    <a data-id_jabatan="{{ $row->id_jabatan }}" class="dropdown-item hapus"
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
    {{-- MODAL TAMBAH jabatan --}}
    <div class="modal fade" id="modaljabatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Tambah jabatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                {{-- MODAL BODY UNTUK TAMBAH USER DAN EDIT USER --}}
                <div class="modal-body" id="main-body">

                    <form id="formjabatan" action="{{ URL::to('/admin/create_jabatan') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_jabatan">nama_jabatan</label>
                            <input type="hidden" class="form-control" name="id" id="id">
                            <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan">
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {




            // TOMBOL EDIT USER
            $('.table-user tbody').on('click', 'tr td a.edit', function() {
                let datajabatan = $(this).data('jabatan');
                $('#nama_jabatan').val(datajabatan.nama_jabatan);
                $('#id').val(datajabatan.id_jabatan);
                $('#formjabatan').attr('action', '/admin/update_jabatan');
            })

            // TOMBOL TAMBAH USER
            $('#addUserBtn').on('click', function() {
                $('#ModalLabel').html('Tambah jabatan');
                $('#modalBtn').html('Tambah');
                $('.modal-footer').show();
                $('#main-body').show();
                $('#kaitkan-body').hide();
                $('#batal-kaitkan-body').hide();
                $('#formjabatan').attr('action', '/admin/create_jabatan');
            });

            // TOMBOL HAPUS USER
            $('.table-user tbody').on('click', 'tr td a.hapus', function() {
                let idjabatan = $(this).data('id_jabatan');
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
                            url: '/admin/delete_jabatan',
                            method: 'post',
                            dataType: 'json',
                            data: {
                                id_jabatan: idjabatan
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

        $('#lijabatan').addClass('active');
        $('#liManajemenjabatan').addClass('active');
    </script>
@endsection
