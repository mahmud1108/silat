@extends('partials.main')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Materi</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Data Materi</li>
        </ol>
      </div>
    </div>
  </div>
</div>

@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="container-fluid" id="">
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
          <h4> Tambah Materi</h4>
        </div>
      </div>
      <form action="{{ route('materi.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama Materi</label>
              <input type="text" name="nama" class="form-control" placeholder="Nama.." required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>File</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile" name="file[]" multiple>
                  <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Deskripsi Materi</label>
              <textarea class="summernote" name="deskripsi" required>
            </textarea>
            </div>
          </div>
        </div>
        <div class="row">
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
            </div>
          </div>
        </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Tambah</button>
      <button type="reset" class="btn btn-danger float-right">Reset</button>
      </form>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> Daftar Materi</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Materi</th>
                  <th>Status</th>
                  <th>Pelatih</th>
                  <th>Jumlah file</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              @foreach ($materis as $materi)
              <tbody>
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $materi->materi_nama }}
                  </td>
                  <td>
                    {{ $materi->materi_status }}
                  </td>
                  <td>
                    {{ $materi->user->user_nama }}
                  </td>
                  <td>
                    {{ count($materi->galeri) }}
                  </td>
                  <td class="text-center py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <a href="#" class="btn btn-primary" data-toggle="modal"
                        data-target="#modal-lg-image{{ $materi->id }}" title="Lihat Materi"><i
                          class="fas fa-book"></i></a>
                      <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal-lg{{ $materi->id }}"
                        title="Detail Materi"><i class="fas fa-eye"></i></a>
                      <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal-sm{{ $materi->id }}"
                        title="Hapus Materi"><i class="fas fa-trash"></i></a>
                    </div>
                  </td>

                  <div class="modal fade" id="modal-lg-image{{ $materi->id }}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Materi</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-12">
                              @foreach ($materi->galeri as $galeri)
                              <div class="form-group">
                                <i class="fas fa-file"></i>&nbsp<a href="" target="_blank()">
                                </a>
                                <form action="{{ route('galeri.destroy',['galeri'=>$galeri->id]) }}" method="post">
                                  @method('delete')
                                  @csrf
                                  <button style="float:right" type="submit">Materi {{ $loop->iteration }}<i
                                      class="fas fa-trash"></i></button>
                                </form>
                                @endforeach
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Tambah Materi</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <form action="{{ route('galeri.store') }}" method="post"
                                      enctype="multipart/form-data">
                                      @csrf
                                      <input type="file" class="custom-file-input" id="exampleInputFile" name="file[]"
                                        accept="jpg, .jpeg, .png, .gif, .docx, .doc, . pdf, .txt, .odt, .mp4, .avi, .mkv, .mov, .wmv"
                                        multiple>
                                      <input type="hidden" name="materi_id" value="{{ $materi->id }}">
                                      <label class="custom-file-label" for="exampleInputFile">Pilih Materi</label>
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
                              <button type="submit" class="btn btn-primary">Tambah materi</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="modal-sm{{ $materi->id }}">
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
                              {{ $materi->materi_nama }}
                            </b>?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                          <form action="{{ route('materi.destroy', ['materi'=>$materi->id]) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-primary">Ya</button>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>

                  <div class="modal fade" id="modal-lg{{ $materi->id }}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <form action="{{ route('materi.update', ['materi'=>$materi->id]) }}" method="post">
                          @csrf
                          @method('put')
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Materi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Nama Materi</label>
                                  <input type="text" name="nama" class="form-control" placeholder="Nama.."
                                    value="{{ $materi->materi_nama }}" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Status</label>
                                  <select name="status" class="form-control select2" style="width: 100%;" required>
                                    <option value="">Pilih status</option>
                                    <option value="aktif" {{ $materi->materi_status==='aktif'?'selected':'' }}>Aktif
                                    </option>
                                    <option value="tidak aktif" {{ $materi->materi_status==='tidak aktif'?'selected':''
                                      }}>Tidak Aktif</option>

                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Deskripsi</label>
                                  <textarea class="summernote" name="deskripsi" required>
                                      {{ $materi->materi_deskripsi }}
                                    </textarea>
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