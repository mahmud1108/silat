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

@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="container-fluid" id="elementToFade">
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ $error }}</strong>
  </div>
</div>
@endforeach
@endif

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card card-secondary collapsed-card">
    <div class="card-header">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-plus"></i>
      </button>
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
              <input type="text" name="user_nama" class="form-control" placeholder="Nama.."
                value="{{ old('user_nama') }}" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="user_username" class="form-control" placeholder="Username.."
                value="{{ old('user_username') }}" required>
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
                name="user_no_hp" value="{{ old('user_no_hp') }}" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>E-Mail</label>
              <input type="email" name="user_email" class="form-control" placeholder="E-mail.."
                value="{{ old('user_email') }}" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="user_alamat" class="form-control" placeholder="Alamat.."
                value="{{ old('user_alamat') }}" required>
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
      <button type="submit" class="btn btn-primary">Tambah</button>
      <button type="reset" class="btn btn-danger float-right">Reset</button>
      </form>
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->

<!-- Main content -->
<section class="content">
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
                  <th>Status</th>
                  <th>Role</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              @foreach ($users as $user)

              <tbody>
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $user->user_nama }}
                  </td>
                  <td>
                    {{$user->user_status}}
                  </td>
                  <td>
                    {{ $user->role }}
                  </td>
                  <td class="text-center py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-lg{{ $user->id }}"><i
                          class="fas fa-eye"></i></a>
                      @if ($user->id != auth()->user()->id)
                      <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal-sm{{ $user->id }}"><i
                          class="fas fa-trash"></i></a>
                      @endif
                    </div>
                  </td>


                  <div class="modal fade" id="modal-sm{{ $user->id }}">
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
                              {{ $user->user_username }}
                            </b>?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                          <form action="{{ route('user.destroy', ['user'=>$user->id]) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-primary">Ya</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="modal-lg{{ $user->id }}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
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
                                <input class="form-control" value="{{ $user->user_nama }}" readonly>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" value="{{ $user->user_username }}" readonly>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>No HP</label>
                                <input class="form-control" value="{{ $user->user_no_hp }}" readonly>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>E-Mail</label>
                                <input class="form-control" value="{{ $user->user_email }}" readonly>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..."
                                  disabled>{{ $user->user_alamat }}</textarea>
                              </div>
                            </div>
                            <form action="{{ route('user_role',['user'=>$user->id]) }}" method="post">
                              @csrf
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Role</label>
                                  <select name="role" class="form-control select2" style="width: 100%;" required>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' :''}}>
                                      Admin
                                    </option>
                                    <option value="pelatih" {{ $user->role === 'pelatih' ? 'selected' :''}}>
                                      Pelatih
                                    </option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Status</label>
                                  <select name="user_status" class="form-control select2" style="width: 100%;" required>
                                    <option value="aktif" {{ $user->user_status ==='aktif' ? 'selected' : ''}}>
                                      Aktif
                                    </option>
                                    <option value="tidak aktif" {{ $user->user_status ==='tidak aktif' ?
                                      'selected':''}}>
                                      Tidak Aktif
                                    </option>
                                  </select>
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
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </tr>
              </tbody>
              @endforeach

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