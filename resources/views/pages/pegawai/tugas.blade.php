@extends('layouts.v_template')

@section('content')
    <section class="section">
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex  justify-content-between">
                        <h4> tugas jabatan</h4>
                        <div class="table-tools d-flex justify-content-around ">
                            <input type="text" class="form-control card-form-header mr-3" placeholder="Cari Data tugas ..."
                                id="cari-data-tugas">

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-hover table-user table-action-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th width="5%" class="sorting" data-sorting_type="asc" data-column_name="id"
                                        style="cursor: pointer">ID <span id="id_icon"></span></th>
                                    <td>Nama tugas</td>
                                    <td>Bulan</td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($tugas as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->tugas }}</td>
                                        <td>{{ $row->bulan }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
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
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {






        });

        $('#litugas').addClass('active');
        $('#liManajementugas').addClass('active');
    </script>
@endsection
