@extends('partials.atlet-main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pengumuman</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Data Pengumuman</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Daftar Pengum</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Pengumuman</th>
                                        <th>Isi Pengumuman</th>
                                        <th>Tanggal Pengumuman</th>
                                        <th>User</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengumumans as $pengumuman)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pengumuman->pengumuman_judul }}</td>
                                            <td>{{ $pengumuman->pengumuman_isi }}</td>
                                            @php
                                                $date = Illuminate\Support\Carbon::parse($pengumuman->pengumuman_tanggal);
                                                $dateFormat = $date->format('d F Y');
                                            @endphp
                                            <td>{{ $dateFormat }}</td>
                                            <td>{{ $pengumuman->user->user_nama }}</td>

                                            @php
                                                $path = $pengumuman->file;
                                                $pathParts = explode('/', $path);
                                                $lastWord = end($pathParts);
                                            @endphp

                                            <td>
                                                @if ($pengumuman->file === null)
                                                    -
                                                @else
                                                    <a href="{{ route('download_pengumuman', ['filename' => $lastWord]) }}"
                                                        target="_blank" class="btn btn-success py-1">Download
                                                        file</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
