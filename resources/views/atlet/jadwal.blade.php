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
    {{-- <section class="content">
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
                                        <th>Pertemuan</th>
                                        <th>Peserta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                  while ($datas = mysqli_fetch_array($query)) {
                    $j_ptm = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pertemuan WHERE pertemuan_jadwal='$datas[jadwal_id]'"));
                    $j_atlet = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM jadwal_isi WHERE jadwal='$datas[jadwal_id]'"));
                  ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $datas['jadwal_nama'] ?></td>
                                        <td><?= tgl_indo(substr($datas['jadwal_waktu'], 0, 10)) . ' ' . substr($datas['jadwal_waktu'], 11, 20) ?>
                                        </td>
                                        <td><?= $datas['user_nama'] ?></td>
                                        <td><?= $j_ptm ?> kali &nbsp;
                                            <div class="btn-group btn-group-sm">
                                                <a href="pertemuan_tampil.php?id_jadwal=<?= $datas['jadwal_id'] ?>"
                                                    class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            </div>
                                        </td>
                                        <td class="text-center py-0 align-middle"><?= $j_atlet ?> orang &nbsp;
                                            <div class="btn-group btn-group-sm">
                                                <a href="jadwal_atlet_tampil.php?jadwal=<?= $datas['jadwal_id'] ?>"
                                                    class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            </div>
                                        </td>

                                        <div class="modal fade" id="modal-sm<?= $datas['jadwal_id'] ?>">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Yakin hapus jadwal <b><?= $datas['jadwal_nama'] ?></b>?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Tutup</button>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id"
                                                                value="<?= $datas['jadwal_id'] ?>">
                                                            <button type="submit" class="btn btn-primary">Ya</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                        <div class="modal fade" id="modal-lg<?= $datas['jadwal_id'] ?>">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <form action="" method="post">
                                                        <input type="hidden" name="e_id"
                                                            value="<?= $datas['jadwal_id'] ?>">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit jadwal</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Nama jadwal</label>
                                                                        <input type="text" name="nama"
                                                                            class="form-control" placeholder="Nama jadwal.."
                                                                            value="<?= $datas['jadwal_nama'] ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Waktu jadwal</label>
                                                                        <input type="datetime-local" name="waktu"
                                                                            class="form-control"
                                                                            placeholder="Waktu jadwal.."
                                                                            value="<?= $datas['jadwal_waktu'] ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Pelatih</label>
                                                                        <select name="user_id" class="form-control select2"
                                                                            style="width: 100%;" required>
                                                                            <option value="">Pilih Pelatih</option>
                                                                            <?php
                                                                            $data_usere = mysqli_query($koneksi, 'SELECT * FROM user u where u.user_level=2');
                                                                            while ($ddata_usere = mysqli_fetch_array($data_usere)) {
                                                                                echo "<option value='$ddata_usere[user_id]'";
                                                                                if ($ddata_usere['user_id'] == $datas['user_id']) {
                                                                                    echo 'selected';
                                                                                }
                                                                                echo ">$ddata_usere[user_nama]</option>";
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <button type="button"
                                                                        class="btn btn-default  float-right"
                                                                        data-dismiss="modal">Tutup</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Edit</button>
                                                                    <button type="reset"
                                                                        class="btn btn-danger ">Reset</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    <?php $no++;
                  } ?>
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
    </section> --}}
@endsection
