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
                            <h3></h3>
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
                            <h3></h3>
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

            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3>Cek Rutin</h3>
                    </div>
                </div>
                <div class="card-body">

                    <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square" style="color: #007bff;"></i> Tinggi Badan
                        </span>

                        <span>
                            <i class="fas fa-square" style="color: #FF000080;"></i> Berat Badan
                        </span>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-6" id="accordion">
                    <div class="card card-info card-outline col-12">
                        <a class="d-block w-100" data-toggle="collapse" href="#pertemuan">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    Pertemuan Terakhir
                                </h4>
                            </div>
                        </a>
                        <div id="pertemuan" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pertemuan</th>
                                                <th>Nama Jadwal</th>
                                                <th>Jumlah Materi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                      $query_data = mysqli_query($koneksi, "SELECT * FROM pertemuan p left join jadwal j on p.pertemuan_jadwal=j.jadwal_id left join jadwal_isi ji on j.jadwal_id=ji.jadwal left join atlet a on ji.jadwal_isi_atlet=a.atlet_id where a.atlet_id='$_SESSION[atlet_id]' order by pertemuan_mulai desc limit 1");

                      while ($datas = mysqli_fetch_array($query_data)) {
                        $m = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pertemuan_materi where pm_pertemuan=$datas[pertemuan_id]"));
                        $a = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen WHERE absen_pertemuan=$datas[pertemuan_id] and absen_waktu IS NOT NULL"));
                        $ab =  mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM absen WHERE absen_pertemuan=$datas[pertemuan_id]"));

                        if ($a > 0 and $ab > 0) {
                          $persen = $a / $ab * 100;
                          $persen = intval($persen);
                        } else {
                          $persen = intval(0);
                        }
                      ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $datas['pertemuan_nama'] ?>
                                                    <br><i><?= tgl_indo(substr($datas['pertemuan_mulai'], 0, 10)) . ' ' . substr($datas['pertemuan_mulai'], 11, 20) ?>
                                                        -
                                                        <?= tgl_indo(substr($datas['pertemuan_selesai'], 0, 10)) . ' ' . substr($datas['pertemuan_selesai'], 11, 20) ?></i>
                                                </td>
                                                <td><?= $datas['jadwal_nama'] ?></td>
                                                <td><?= $m ?></td>

                                                <td class="text-center py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('') }}?pertemuan_id=<?= $datas['pertemuan_id'] ?>"
                                                            title="Detail" class="btn btn-info"><i
                                                                class="fas fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no++;
                      } ?>
                                        </tbody>
                                    </table>
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
                                    Pengumuman
                                </h4>
                            </div>
                        </a>
                        <div id="pengumuman" class="collapse show" data-parent="#accordion">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 ">
                                        <div class="card bg-light">
                                            <div class="card-header border-bottom-0 h3">
                                                <b><?= $pengumuman['pengumuman_judul'] ?></b>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h2 class="lead"><b>Isi Pengumuman
                                                                :<?= $pengumuman['pengumuman_isi'] ?></b></h2>


                                                        <p class="text-muted text-sm"><b>Tanggal Pengumuman:
                                                            </b><?= tgl_indo(substr($pengumuman['pengumuman_tanggal'], 0, 10)) . ' ' . substr($pengumuman['pengumuman_tanggal'], 11, 20) ?>
                                                            <br>
                                                            <b>Update Pengumuman:
                                                            </b><?= tgl_indo(substr($pengumuman['pengumuman_update'], 0, 10)) . ' ' . substr($pengumuman['pengumuman_update'], 11, 20) ?>
                                                        </p>
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
            </div> --}}


            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
