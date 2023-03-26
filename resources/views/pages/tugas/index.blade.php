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
                                    <td>Nama Jabatan</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($jabatan as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama_jabatan }}</td>

                                        <td>
                                            <a href="{{ URL::to('/admin/tugas/' . $row->id_jabatan) }}"
                                                class="btn btn-dark">Tugas</a>
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {





        });

        $('#lijabatan').addClass('active');
        $('#liManajemenjabatan').addClass('active');
    </script>
@endsection
