@extends('partials.main')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Pengumuman</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Data Pengumuman</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

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
          <h4>Tambah Pengumuman</h4>
        </div>
      </div>
      <form action="{{ route('pengumuman.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Judul Pengumuman</label>
              <input type="text" name="pengumuman_judul" value="{{ old('pengumuman_judul') }}" class="form-control"
                placeholder="Judul Pengumuman..." required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Pengumuman</label>
              <input type="datetime-local" name="pengumuman_tanggal" value="{{ old('pengumuman_tanggal') }}"
                class="form-control" placeholder="Waktu.." required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Isi Pengumuman</label>
              <textarea class="form-control" name="pengumuman_isi" rows="3" placeholder="Isi Pengumuman..."
                required>{{ old('pengumuman_isi') }}</textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>File (jika ada)</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile" name="file"
                    accept=".jpg,.jpeg,.png,.pdf,.docx">
                  <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
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
          <h3 class="card-title"> Daftar Pengumuman</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul Pengumuman</th>
                  <th>Pengirim</th>
                  <th>File</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              @foreach ($pengumumans as $pengumuman)
              <tbody>
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $pengumuman->pengumuman_judul }}
                  </td>
                  <td>
                    {{ $pengumuman->user_nama }}
                  </td>
                  <td>
                    @if (!$pengumuman->file)
                    Tidak ada File
                    @else
                    <a href="{{ $pengumuman->file }}" target="_blank" class="btn btn-success py-0">Download file</a>
                    @endif
                  </td>
                  <td class="text-center py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <a href="#" class="btn btn-info" data-toggle="modal"
                        data-target="#modal-lg{{ $pengumuman->id }}"><i class="fas fa-eye"></i></a>
                      <a href="#" class="btn btn-danger" data-toggle="modal"
                        data-target="#modal-sm{{ $pengumuman->id }}"><i class="fas fa-trash"></i></a>
                    </div>
                  </td>

                  <div class="modal fade" id="modal-sm{{ $pengumuman->id }}">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Hapus Pengumuman</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Yakin hapus pengumuman <b>
                              {{ $pengumuman->pengumuman_judul }}
                            </b>?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                          <form action="{{ route('pengumuman.destroy',['pengumuman'=>$pengumuman->id]) }}"
                            method="post">
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

                  <div class="modal fade" id="modal-lg{{ $pengumuman->id }}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <form action="{{ route('pengumuman.update',['pengumuman'=>$pengumuman->id]) }}" method="post"
                          enctype="multipart/form-data">
                          @method('put')
                          @csrf
                          <div class="modal-header">
                            <h4 class="modal-title">Edit pengumuman</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Judul Pengumuman</label>
                                  <input type="text" name="pengumuman_judul" class="form-control"
                                    placeholder="Nama jadwal.." value="{{ $pengumuman->pengumuman_judul }}" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Tanggal Pengumuman</label>
                                  <input type="datetime-local" name="pengumuman_tanggal" class="form-control"
                                    placeholder="Waktu jadwal.." value="{{ $pengumuman->pengumuman_tanggal }}" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Isi Pengumuman</label>
                                  <textarea class="form-control" name="pengumuman_isi" rows="3"
                                    placeholder="Isi Pengumuman..."
                                    required>{{ $pengumuman->pengumuman_isi }}</textarea>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>File</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                                      <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
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
                              </div>
                            </div>
                          </div>
                        </form>
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