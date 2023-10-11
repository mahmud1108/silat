@extends('partials.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset($user->user_gambar) }}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->user_nama }}</h3>

                            <p class="text-muted text-center">{{ $user->role }}</p>

                            <a href="#" class="btn btn-primary btn-block" data-toggle="modal"
                                data-target="#modal-lg-image"><b>Ganti Foto</b></a>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav">
                                <li class="nav-item">Profil</li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <form action="{{ route('save_profil', ['user' => auth()->user()->id]) }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-3 col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="user_nama"
                                                value="{{ $user->user_nama }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-3 col-form-label">Username</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="user_username"
                                                value="{{ $user->user_username }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-3 col-form-label">No HP</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                data-inputmask="'mask': ['089999999999', '']" data-mask
                                                value="{{ $user->user_no_hp }}" name="user_no_hp" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="user_alamat"
                                                value="{{ $user->user_alamat }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-3 col-form-label">E-Mail</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="user_email"
                                                value="{{ $user->user_email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-3 col-form-label">Password Baru*</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Masukan password baru...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-3 col-form-label">Konfirmasi Password
                                            *</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password_confirmation"
                                                placeholder="Konfirmasi password baru...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <label style="color: red;">* Jika password tidak diganti biarkan saja.</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-block"
                                                name="submit"><b>Ubah
                                                    Profil</b></button>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="modal fade" id="modal-lg-image">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('image_update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Ganti Foto {{ $user->user_nama }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <img src="{{ asset($user->user_gambar) }}" height="300px">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gambar</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile"
                                                    name="update_gambar" accept=".jpg,.jpeg,.png" required>
                                                <label class="custom-file-label" for="exampleInputFile">Pilih
                                                    Gambar</label>
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
            <!-- /.modal-dialog -->
        </div>
    </section>
@endsection
