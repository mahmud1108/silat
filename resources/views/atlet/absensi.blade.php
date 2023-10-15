@extends('partials.atlet-main')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Absen</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_atlet') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Absen</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pertemuan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Status Absen</th>
                                        <th>Nama Pertemuan</th>
                                        <th>Nama Jadwal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absens as $absen)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $absen->absen_waktu === null ? 'Belum Absen' : 'Telah Absen' }}</td>
                                            <td>
                                                {{ $absen->pertemuan->pertemuan_nama }} <br><i>
                                                    @php
                                                        $date_mulai = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $absen->pertemuan->pertemuan_mulai);
                                                        $bulan_mulai = $date_mulai->format('d F Y');
                                                        $jam_mulai = $date_mulai->format('H:i');

                                                        $date_selesai = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $absen->pertemuan->pertemuan_selesai);
                                                        $bulan_selesai = $date_selesai->format('d F Y');
                                                        $jam_selesai = $date_selesai->format('H:i');
                                                    @endphp
                                                    {{ $bulan_mulai . ' pukul ' . $jam_mulai }} </i>
                                                <b>sampai</b>
                                                <i>
                                                    {{ $bulan_selesai . ' pukul ' . $jam_selesai }}
                                                </i>
                                            </td>

                                            <td>{{ $absen->pertemuan->jadwal->jadwal_nama }}</td>


                                            <td class="text-center py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('absen_detail', ['pertemuan' => $absen->pertemuan_id]) }}"
                                                        class="btn
                                                        btn-info"
                                                        title="Daftar Absen"><i class="fas fa-eye"></i></a>
                                                </div>

                                                <div class="btn-group btn-group-sm">
                                                    @if ($absen->absen_waktu === null)
                                                        <a href="{{ route('input_absen', ['absen' => $absen->id]) }}"
                                                            class="btn
                                                            btn-success"
                                                            title="Absen"><i class="fas fa-clock"></i></a>
                                                    @endif

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
