@extends('partials.main')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Data User</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card card-secondary collapsed-card">
    <div class="card-header">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-plus"></i>
      </button>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <h4> Tambah Admin</h4>
        </div>
      </div>
      <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="user_nama" class="form-control" placeholder="Nama.." required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="user_username" class="form-control" placeholder="Username.." required>
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
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Gambar</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile" name="user_gambar"
                    accept=".jpg,.jpeg,.png" required>
                  <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>No HP</label>
              <input type="text" class="form-control" data-inputmask="'mask': ['089999999999', '']" data-mask
                name="user_no_hp" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>E-Mail</label>
              <input type="email" name="user_email" class="form-control" placeholder="E-mail.." required>
              <!-- /.form-group -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="user_alamat" class="form-control" placeholder="Alamat.." required>
              <!-- /.form-group -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Level</label>
              <select name="role" class="form-control select2" style="width: 100%;" required>
                <option value="admin">admin</option>
                <option value="pelatih">pelatih</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Status</label>
              <div class="input-group">
                <div class="icheck-primary d-inline">
                  <input type="radio" name="user_status" id="radioPrimary1" checked value="Aktif">
                  <label for="radioPrimary1">Aktif</label>
                </div>&nbsp&nbsp&nbsp&nbsp
                <div class="icheck-danger d-inline">
                  <input type="radio" name="user_status" id="radioDanger1" value="Tidak Aktif">
                  <label for="radioDanger1">Tidak Aktif</label>
                </div>
              </div>
              <!-- /.form-group -->
            </div>
          </div>
        </div>
    </div>
    <!-- /.card-body -->

    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary" name="save">Tambah</button>
      <button type="reset" class="btn btn-danger float-right">Reset</button>
      </form>
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->

<!-- Main content -->
{{-- <section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> Daftar User</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>No HP</th>
                  <th>Alamat</th>
                  <th>E-Mail</th>
                  <th>Status</th>
                  <th>level</th>
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
                    <?= $datas['user_nama']; ?>
                  </td>
                  <td>
                    <?= $datas['user_username']; ?>
                  </td>
                  <td>
                    <?= $datas['user_no_hp']; ?>
                  </td>
                  <td>
                    <?= $datas['user_alamat']; ?>
                  </td>
                  <td>
                    <?= $datas['user_email']; ?>
                  </td>
                  <td>
                    <?= $datas['user_status']; ?>
                  </td>
                  <td>
                    <?= $datas['level_nama'] ?>
                  </td>
                  <td class="text-center py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <a href="#" class="btn btn-primary" data-toggle="modal"
                        data-target="#modal-lg-image<?= $datas['user_id'] ?>"><i class="fas fa-image"></i></a>
                      <a href="#" class="btn btn-info" data-toggle="modal"
                        data-target="#modal-lg<?= $datas['user_id'] ?>"><i class="fas fa-eye"></i></a>
                      <?php if ($datas['user_id'] != $_SESSION['user_id']) : ?>
                      <a href="#" class="btn btn-danger" data-toggle="modal"
                        data-target="#modal-sm<?= $datas['user_id'] ?>"><i class="fas fa-trash"></i></a>
                      <?php endif; ?>
                    </div>
                  </td>

                  <div class="modal fade" id="modal-lg-image<?= $datas['user_id'] ?>">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <form action="" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="f_id" value="<?= $datas['user_id'] ?>">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Foto Admin</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <img src="../gambar/user/<?= $datas['user_gambar'] ?>" height="300px">
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

                  <div class="modal fade" id="modal-sm<?= $datas['user_id'] ?>">
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
                              <?= $datas['user_username'] ?>
                            </b>?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                          <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $datas['user_id'] ?>">
                            <button type="submit" class="btn btn-primary">Ya</button>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>

                  <div class="modal fade" id="modal-lg<?= $datas['user_id'] ?>">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <form action="" method="post">
                          <input type="hidden" name="e_id" value="<?= $datas['user_id'] ?>">
                          <input type="hidden" name="e_username" value="<?= $datas['user_username'] ?>">
                          <input type="hidden" name="e_email" value="<?= $datas['user_email'] ?>">
                          <input type="hidden" name="e_no_hp" value="<?= $datas['user_no_hp'] ?>">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Admin</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Nama</label>
                                  <input type="text" name="user_nama" class="form-control" placeholder="Nama.."
                                    value="<?= $datas['user_nama'] ?>" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Username</label>
                                  <input type="text" name="user_username" class="form-control" placeholder="Username.."
                                    value="<?= $datas['user_username'] ?>" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Password Baru*</label>
                                  <input type="password" name="password" class="form-control"
                                    placeholder="Password Baru.." value="">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Konfirmasi Password Baru*</label>
                                  <input type="password" name="konf_password" class="form-control"
                                    placeholder="Konfirmasi Password Baru.." value="">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>No HP</label>
                                  <input type="text" class="form-control" data-inputmask="'mask': ['089999999999', '']"
                                    data-mask value="<?= $datas['user_no_hp'] ?>" name="user_no_hp" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>E-Mail</label>
                                  <input type="email" name="user_email" class="form-control" placeholder="E-Mail.."
                                    value="<?= $datas['user_email'] ?>" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Alamat</label>
                                  <input type="text" name="user_alamat" class="form-control" placeholder="Alamat.."
                                    value="<?= $datas['user_alamat'] ?>" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Level</label>
                                  <select name="user_level" class="form-control select2" style="width: 100%;" required>
                                    <option value="">Pilih level</option>
                                    <?php
                                      $data = mysqli_query($koneksi, "SELECT * FROM level");
                                      while ($d = mysqli_fetch_array($data)) {
                                      ?>
                                    <option value="<?php echo $d['level_id']; ?>" <?php if
                                      ($d['level_id']==$datas['user_level']) { echo "selected" ; } ?>>
                                      <?php echo $d['level_nama']; ?>
                                    </option>
                                    <?php
                                      }
                                      ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Status</label>
                                  <select name="user_status" class="form-control select2" style="width: 100%;" required>
                                    <option value="">Pilih status</option>
                                    <option value="Aktif" <?php if ($datas['user_status']=="Aktif" ) { echo "selected" ;
                                      } ?>>Aktif</option>
                                    <option value="Tidak Aktif" <?php if ($datas['user_status']=="Tidak Aktif" ) {
                                      echo "selected" ; } ?>>Tidak Aktif</option>

                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>* Jika password tidak diganti biarkan saja.</label>
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
                  <th>Nama</th>
                  <th>Username</th>
                  <th>No HP</th>
                  <th>Alamat</th>
                  <th>E-Mail</th>
                  <th>Status</th>
                  <th>level</th>
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