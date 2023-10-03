@extends('partials.main')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Atlet</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Data Atlet</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="container-fluid" id="elementToFade">
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ $error }}</strong>
  </div>
</div>
@endforeach
@endif

<section class="content">
  <div class="card card-secondary collapsed-card">
    <div class="card-header">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-plus"></i>
      </button>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <h4> Tambah Atlet</h4>
        </div>
      </div>
      <form action="{{ route('atlet.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Nama.."
                required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tempat Lahir</label>
              <input type="text" name="tmpt_lahir" class="form-control" value="{{ old('tmpt_lahir') }}"
                placeholder="Tempat Lahir.." required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input type="date" name="tgl_lahir" class="form-control" placeholder="Password.."
                value="{{ old('tgl_lahir') }}" required>
              <!-- /.form-group -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select name="kelamin" class="form-control select2" style="width: 100%;" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>No HP</label>
              <input type="text" value="{{ old('no_hp') }}" class="form-control"
                data-inputmask="'mask': ['089999999999', '']" data-mask name="no_hp" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" value="{{ old('alamat') }}" class="form-control" placeholder="Alamat.."
                required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Foto</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile" name="atlet_gambar"
                    accept=".jpg,.jpeg,.png" required>
                  <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Kategori</label>
              <select name="kategori" class="form-control select2" required>
                <option value="">Pilih kategori</option>
                @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}">
                  {{ $kategori->kategori_nama }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Kelas Usia</label>
              <select name="kelas_usia" class="form-control select2" required>
                <option value="">Pilih kelas usia</option>
                @foreach ($usias as $usia)
                <option value="{{ $usia->id }}">
                  {{ $usia->kelas_usia_nama }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>E-Mail</label>
              <input type="email" name="atlet_email" value="{{ old('atlet_email') }}" class="form-control"
                placeholder="E-Mail.." required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" placeholder="Password.." required>
              <!-- /.form-group -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Konfirmasi Password</label>
              <input type="password" name="password_confirmation" class="form-control"
                placeholder="Konfirmasi Password.." required>
              <!-- /.form-group -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="keterangan" value="{{ old('keterangan') }}" class="form-control"
                placeholder="Keterangan.." required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Status</label>
              <div class="input-group">
                <div class="icheck-primary d-inline">
                  <input type="radio" name="status" id="radioPrimary1" checked value="Aktif">
                  <label for="radioPrimary1">Aktif</label>
                </div>&nbsp&nbsp&nbsp&nbsp
                <div class="icheck-danger d-inline">
                  <input type="radio" name="status" id="radioDanger1" value="Tidak Aktif">
                  <label for="radioDanger1">Tidak Aktif</label>
                </div>
              </div>
              <!-- /.form-group -->
            </div>
          </div>
        </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Tambah</button>
      </form>
    </div>
  </div>
</section>

{{-- <section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> Daftar Atlet</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Kategori</th>
                  <th>Kelas Usia</th>
                  <th>Jenis Kelamin</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                while ($datas = mysqli_fetch_array($query)) { ?>

                <tr>
                  <td>
                    <?= $no ?>
                  </td>
                  <td>
                    <?= $datas['atlet_nama_lengkap']; ?>
                  </td>
                  <td>
                    <?= $datas['kategori_nama']; ?>
                  </td>
                  <td>
                    <?= $datas['kelas_usia_nama']; ?>
                  </td>
                  <td>
                    <?= $datas['atlet_jenis_kelamin']; ?>
                  </td>
                  <td class="text-center py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <a href="#" class="btn btn-primary" data-toggle="modal"
                        data-target="#modal-lg-image<?= $datas['atlet_id'] ?>"><i class="fas fa-image"></i></a>
                      <a href="#" class="btn btn-info" data-toggle="modal"
                        data-target="#modal-lg<?= $datas['atlet_id'] ?>"><i class="fas fa-eye"></i></a>
                      <a href="#" class="btn btn-danger" data-toggle="modal"
                        data-target="#modal-sm<?= $datas['atlet_id'] ?>"><i class="fas fa-trash"></i></a>
                    </div>
                  </td>

                  <div class="modal fade" id="modal-lg-image<?= $datas['atlet_id'] ?>">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <form action="" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="f_id" value="<?= $datas['atlet_id'] ?>">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Foto Atlet</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <img src="../gambar/user/atlet/<?= $datas['atlet_foto'] ?>" height="300px">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Gambar</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="exampleInputFile"
                                        name="update_gambar" accept=".jpg,.jpeg,.png" required>
                                      <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <div class="row">
                              <div class="col-12">
                                <button type="button" class="btn btn-default  float-right"
                                  data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary" name="edit_gambar">Edit</button>
                                <button type="reset" class="btn btn-danger ">Reset</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>

                  <div class="modal fade" id="modal-sm<?= $datas['atlet_id'] ?>">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Hapus</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Yakin hapus data <b>
                              <?= $datas['atlet_nama_lengkap'] ?>
                            </b>?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                          <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $datas['atlet_id'] ?>">
                            <button type="submit" class="btn btn-primary">Ya</button>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>

                  <div class="modal fade" id="modal-lg<?= $datas['atlet_id'] ?>">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <form action="" method="post">
                          <input type="hidden" name="e_id" value="<?= $datas['atlet_id'] ?>">
                          <input type="hidden" name="e_email" value="<?= $datas['atlet_email'] ?>">
                          <input type="hidden" name="e_no_hp" value="<?= $datas['atlet_no_hp'] ?>">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Atlet</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Nama Lengkap</label>
                                  <input type="text" name="nama" class="form-control" placeholder="Nama.."
                                    value="<?= $datas['atlet_nama_lengkap'] ?>" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Tempat Lahir</label>
                                  <input type="text" name="tmpt_lahir" class="form-control" placeholder="Username.."
                                    value="<?= $datas['atlet_tempat_lahir'] ?>" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Tanggal Lahir</label>
                                  <input type="text" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir.."
                                    value="<?= $datas['atlet_tanggal_lahir'] ?>">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Jenis Kelamin</label>
                                  <select name="kelamin" class="form-control select2" style="width: 100%;" required>
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="L" <?php if ($datas['atlet_jenis_kelamin']=="L" ) { echo "selected" ;
                                      } ?>>Laki-Laki</option>
                                    <option value="P" <?php if ($datas['atlet_jenis_kelamin']=="P" ) { echo "selected" ;
                                      } ?>>Perempuan</option>

                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Alamat</label>
                                  <input type="text" name="alamat" class="form-control" placeholder="Alamat.."
                                    value="<?= $datas['atlet_alamat'] ?>" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>No Hp</label>
                                  <input type="text" class="form-control" data-inputmask="'mask': ['089999999999', '']"
                                    data-mask value="<?= $datas['atlet_no_hp'] ?>" name="no_hp" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Kategori</label>
                                  <select name="kategori" class="form-control select2" style="width: 100%;" required>
                                    <option value="">Pilih kategori</option>
                                    <?php
                                      $data_ktg = mysqli_query($koneksi, "SELECT * FROM kategori");
                                      while ($d = mysqli_fetch_array($data_ktg)) {
                                      ?>
                                    <option value="<?php echo $d['kategori_id']; ?>" <?php if
                                      ($d['kategori_id']==$datas['atlet_kategori']) { echo "selected" ; } ?>>
                                      <?php echo $d['kategori_nama']; ?>
                                    </option>
                                    <?php
                                      }
                                      ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Kelas Usia</label>
                                  <select name="kelas_usia" class="form-control select2" style="width: 100%;" required>
                                    <option value="">Pilih kelas usia</option>
                                    <?php
                                      $data = mysqli_query($koneksi, "SELECT * FROM kelas_usia");
                                      while ($d = mysqli_fetch_array($data)) {
                                      ?>
                                    <option value="<?php echo $d['kelas_usia_id']; ?>" <?php if
                                      ($d['kelas_usia_id']==$datas['atlet_kelas_usia']) { echo "selected" ; } ?>>
                                      <?php echo $d['kelas_usia_nama']; ?>
                                    </option>
                                    <?php
                                      }
                                      ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>E-Mail</label>
                                  <input type="email" name="email" class="form-control" placeholder="E-Mail.."
                                    value="<?= $datas['atlet_email'] ?>" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Keterangan</label>
                                  <input type="text" name="keterangan" class="form-control" placeholder="Keterangan.."
                                    value="<?= $datas['atlet_keterangan'] ?>" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Password Baru *</label>
                                  <input type="password" name="password" class="form-control"
                                    placeholder="Password Baru.." value="">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Konfirmasi Password Baru</label>
                                  <input type="password" name="konf_password" class="form-control"
                                    placeholder="Konfirmasi Pasword Baru.." value="">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Status</label>
                                  <select name="status" class="form-control select2" style="width: 100%;" required>
                                    <option value="">Pilih status</option>
                                    <option value="Aktif" <?php if ($datas['atlet_status']=="Aktif" ) { echo "selected"
                                      ; } ?>>Aktif</option>
                                    <option value="Tidak Aktif" <?php if ($datas['atlet_status']=="Tidak Aktif" ) {
                                      echo "selected" ; } ?>>Tidak Aktif</option>

                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label style="color: red;">* Jika password tidak diganti biarkan saja.</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <div class="row">
                              <div class="col-12">
                                <button type="button" class="btn btn-default  float-right"
                                  data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                                <button type="reset" class="btn btn-danger ">Reset</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </tr>

                <?php $no++;
                } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Kategori</th>
                  <th>Kelas Usia</th>
                  <th>Jenis Kelamin</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
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