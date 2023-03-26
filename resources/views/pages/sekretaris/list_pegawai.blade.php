@extends('layouts.v_template')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Data Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-user table-action-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <td>Nama</td>
                                    <td>Bagian</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawai as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->jabatan->nama_jabatan }}</td>
                                        <td>
                                            @if (auth()->user()->role == 'sekretaris')
                                                <a href="{{ URL::to('/sekretaris/verifikasi_berkas/' . $row->id) }}"
                                                    class="btn btn-dark">Berkas</a>
                                            @else
                                                <a href="{{ URL::to('/pejabat/timeline/' . $row->id) }}"
                                                    class="btn btn-dark">Berkas</a>
                                            @endif
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
        $('#liBantuan').addClass('active');
    </script>
@endsection
