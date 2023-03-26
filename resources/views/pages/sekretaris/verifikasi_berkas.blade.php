@extends('layouts.v_template')

@section('content')
    <section class="section">

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

                                                                @if (cekBerkas($bulan, $row->id_tugas, $id_user) == 0)
                                                                @else
                                                                    @php
                                                                        $berkas = getBerkas($bulan, $row->id_tugas, $id_user);
                                                                    @endphp
                                                                    <p>Status berkas :
                                                                        @if ($berkas->status == '1')
                                                                            <a href="{{ URL::to('sekretaris/pending_berkas/' . $berkas->id_berkas) }}"
                                                                                class="badge badge-success">Approved</a>
                                                                        @else
                                                                            <a href="{{ URL::to('sekretaris/approve_berkas/' . $berkas->id_berkas) }}"
                                                                                class="badge badge-warning">Pending</a>
                                                                        @endif
                                                                        <a target="_blank"
                                                                            href="{{ asset('data/berkas/' . $berkas->berkas) }}"
                                                                            class="badge badge-primary"><i
                                                                                class="fas fa-file"></i></a>
                                                                    </p>
                                                                @endif
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

    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-header">
                    <h4>Upload berkas</h4>
                </div>
                <div class="card-body">
                    <form action="{{ URL::to('/pegawai/create_upload_berkas') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="berkas" id="berkas" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Upload</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div> --}}

    {{-- @if ($berkas)
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @if ($berkas->status == '0')
                            <span class="badge badge-danger"> Belum di approve</span>
                        @else
                            <span class="badge badge-success"> approve</span>
                        @endif
                    </div>
                    <div class="card-body" style="height: 500px">
                        <iframe style="width: 100%; height:100%" src="{{ asset('data/berkas/' . $berkas->berkas) }}"
                            frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    @endif --}}



    </section>
@endsection
@section('script')
    <script>
        $('#liBantuan').addClass('active');
    </script>
@endsection
