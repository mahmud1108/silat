@extends('partials.atlet-main')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Cek Rutin {{ $nama->atlet->atlet_nama_lengkap }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_atlet') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Cek Rutin</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tinggi Badan</th>
                                        <th>Berat Badan</th>
                                        <th>Mental</th>
                                        <th>Fisik</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($datas); $i++)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $datas[$i]['cr_tb'] }} </td>
                                            <td>{{ $datas[$i]['cr_bb'] }} </td>
                                            <td>{{ $datas[$i]['cr_mentals'] }} %<sup> ({{ $datas[$i]['cr_mental'] }} )</sup>
                                            </td>
                                            <td>{{ $datas[$i]['cr_fisiks'] }} %<sup> ({{ $datas[$i]['cr_fisik'] }})</sup>
                                            </td>
                                            <td>
                                                {{ $datas[$i]['cr_waktu'] }}
                                            </td>
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
