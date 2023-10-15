@extends('partials.atlet-main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Jadwal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_atlet') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Jadwal</li>
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
                        <h3 class="card-title"> Daftar jadwal</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama jadwal</th>
                                        <th>Waktu</th>
                                        <th>Pelatih</th>
                                        <th>Jumlah Pertemuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($jadwal_isis as $jadwal_isi)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $jadwal_isi->jadwal->jadwal_nama }}</td>

                                            @php
                                                $date = Illuminate\Support\Carbon::parse($jadwal_isi->jadwal->jadwal_waktu);
                                                $dateFormat = $date->format('d F Y H:i:s');
                                            @endphp

                                            <td>
                                                {{ $dateFormat }}
                                            </td>
                                            <td>{{ $jadwal_isi->jadwal->user->user_nama }}</td>

                                            @if (count($jadwal_isi->jadwal->pertemuan) > 0)
                                                <td>{{ count($jadwal_isi->jadwal->pertemuan) }}</td>
                                            @else
                                                <td>Belum ada pertemuan</td>
                                            @endif

                                            <td class="text-center py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('jadwal_detail', ['jadwal' => $jadwal_isi->jadwal->id]) }}"
                                                        class="btn btn-info" title="Lihat Pertemuan"><i
                                                            class="fas fa-eye"></i></a>
                                                </div>
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
