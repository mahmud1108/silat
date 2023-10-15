@extends('partials.atlet-main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Pertemuan Jadwal {{ $jadwal->jadwal_nama }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_atlet') }}">Home</a></li>
                        <li class="breadcrumb-item active"> Daftar Pertemuan Jadwal {{ $jadwal->jadwal_nama }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
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
                                        <th>Nama Pertemuan</th>
                                        <th>Jumlah Materi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($datas); $i++)
                                        @php
                                            $firstDate = Illuminate\Support\Carbon::parse($datas[$i]['pertemuan_mulai']);
                                            $firstDateFormat = $firstDate->format('d F Y H:i:s');

                                            $lastDate = Illuminate\Support\Carbon::parse($datas[$i]['pertemuan_selesai']);
                                            $lastDateFormat = $lastDate->format('d F Y H:i:s');
                                        @endphp

                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $datas[$i]['pertemuan_nama'] }}
                                                <br><i>{{ $firstDateFormat }}
                                                    -
                                                    {{ $lastDateFormat }}</i>
                                            </td>
                                            <td>{{ count($datas[$i]['pertemuan_materi']) }}</td>
                                            <td class="text-center py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('absen_detail', ['pertemuan' => $datas[$i]['id']]) }}"
                                                        title="Detail" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                </div>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#modal-sm{{ $datas[$i]['id'] }}" title="Lihat Materi"
                                                        class="btn btn-primary"><i class="fas fa-download"></i></a>
                                                </div>
                                            </td>

                                            <div class="modal fade" id="modal-sm{{ $datas[$i]['id'] }}">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Download Materi</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @for ($j = 0; $j < count($datas[$i]['pertemuan_materi']); $j++)
                                                                @if (count($datas[$i]['pertemuan_materi'][$j]['materi']['galeri']) === 0)
                                                                    <p>
                                                                        Tidak ada file
                                                                    </p>
                                                                @else
                                                                    @php
                                                                        $path = $datas[$i]['pertemuan_materi'][$j]['materi']['galeri'][0]['galeri_nama'];
                                                                        $pathParts = explode('/', $path);
                                                                        $lastWord = end($pathParts);
                                                                    @endphp

                                                                    <a
                                                                        href="{{ route('atlet_download_materi', ['filename' => $lastWord]) }}">
                                                                        <i class="fas fa-file" target="_blank"> Dwonload
                                                                            Materi :
                                                                            {{ $datas[$i]['pertemuan_materi'][$j]['materi']['materi_nama'] }}</i></a>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </tr>
                                    @endfor
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
