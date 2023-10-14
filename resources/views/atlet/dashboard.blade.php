@extends('partials.atlet-main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard Administrator</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $jadwal }}</h3>

                            <p>Jadwal</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-rss-square"></i>
                        </div>
                        <a href="{{ route('jadwal') }}" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3></h3>
                            <p>Pertemuan</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <a href="{{ route('pertemuan') }}" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $absen }}</h3>
                            <p>Absensi</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-check"></i>
                        </div>
                        <a href="{{ route('absensi') }}" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $cek }}</h3>
                            <p>Cek Rutin</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <a href="{{ route('cek') }}" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6" id="accordion">
                        <div class="card card-info card-outline col-12">
                            <a class="d-block w-100" data-toggle="collapse" href="#pertemuan">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        Pertemuan Baru {{ $pertemuan->pertemuan_nama }}
                                    </h4>
                                </div>
                            </a>
                            <div id="pertemuan" class="collapse show" data-parent="#accordion">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 ">
                                            <div class="card bg-light">
                                                <div class="card-header border-bottom-0 h3">
                                                    <b>{{ $pertemuan->pertemuan_nama }}</b>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h2 class="lead">
                                                                <b>
                                                                    Deskripsi Pertemuan
                                                                    :{{ $pertemuan->pertemuan_deskripsi }}
                                                                </b>
                                                            </h2>

                                                            @php
                                                                $firstDate = Illuminate\Support\Carbon::parse($pertemuan->pertemuan_mulai);
                                                                $firstDateFormat = $firstDate->format('d F Y H:i:s');

                                                                $lastDate = Illuminate\Support\Carbon::parse($pertemuan->pertemuan_selesai);
                                                                $lastDateFormat = $lastDate->format('d F Y H:i:s');
                                                            @endphp

                                                            <p class="text-muted text-sm">
                                                                Tanggal Pengumuman:
                                                                <b>{{ $firstDateFormat }}</b> sampai
                                                                <b>{{ $lastDateFormat }}</b>
                                                            </p>

                                                            <a href="{{ route('absensi') }}" class="btn btn-success"
                                                                target="_blank">Absen</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" id="accordion">
                        <div class="card card-info card-outline col-12">
                            <a class="d-block w-100" data-toggle="collapse" href="#pengumuman">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        Pengumuman Baru
                                    </h4>
                                </div>
                            </a>
                            <div id="pengumuman" class="collapse show" data-parent="#accordion">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 ">
                                            <div class="card bg-light">
                                                <div class="card-header border-bottom-0 h3">
                                                    <b>{{ $lastPengumuman->pengumuman_judul }}</b>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h2 class="lead">
                                                                <b>
                                                                    Isi Pengumuman
                                                                    :{{ $lastPengumuman->pengumuman_isi }}
                                                                </b>
                                                            </h2>

                                                            @php
                                                                $date = Illuminate\Support\Carbon::parse($lastPengumuman->pengumuman_tanggal);
                                                                $dateFormat = $date->format('d F Y');
                                                            @endphp

                                                            <p class="text-muted text-sm"><b>Tanggal Pengumuman:
                                                                    {{ $dateFormat }}
                                                            </p>

                                                            @php
                                                                $path = $lastPengumuman->file;
                                                                $pathParts = explode('/', $path);
                                                                $lastWord = end($pathParts);
                                                            @endphp

                                                            <a href="{{ route('download_pengumuman', ['filename' => $lastWord]) }}"
                                                                class="btn btn-success" target="_blank">Download file</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
