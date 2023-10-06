@extends('partials.main')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">
          Jadwal {{ $jadwal->jadwal_nama }}
        </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Jadwal {{ $jadwal->jadwal_nama }}
          </li>
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
          <h3 class="card-title">Tambah Pertemuan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="{{ route('pertemuan.store') }}" method="post">
            @csrf
            <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nama Pertemuan</label>
                    <input type="text" name="nama_pertemuan" class="form-control" placeholder="Nama Pertemuan.."
                      required>

                    <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mulai</label>
                    <input type="datetime-local" name="mulai" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Selesai</label>
                    <input type="datetime-local" name="selesai" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Deskripsi Pertemuan</label>
                    <textarea class="summernote" name="deskripsi" required>
                    </textarea>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width=10px><input type='checkbox' onchange='checkAll(this)' name='chk[]' /></th>
                      <th>No</th>
                      <th>Nama Materi</th>
                      <th>Status</th>
                      <th>Penulis</th>
                      <th>Jumlah file</th>
                      <th>Download file</th>
                    </tr>
                  </thead>
                  @foreach ($materis as $materi)

                  <tbody>
                    <tr>
                      <td><input type='checkbox' class='mycheckbox' name='pilih{{ $loop->iteration }}'
                          value="{{ $materi->id }}" /></td>
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
                          @if (count($materi->galeri) > 1)
                          <a href="" class="btn btn-primary" data-toggle="modal" title="Download Materi"
                            data-target="#modal-sm{{ $materi->id }}"><i class="fas fa-download"></i></a>
                          @else
                          download
                          @endif
                        </div>
                      </td>

                      <div class="modal fade" id="modal-sm{{ $materi->id }}">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <form action="" method="post" enctype="multipart/form-data">
                              <div class="modal-header">
                                <h4 class="modal-title">Download File</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">

                                  @foreach ($materi->galeri as $galeri)

                                  @php
                                  $path = $galeri->galeri_nama;
                                  $pathParts = explode('/', $path);
                                  $lastWord = end($pathParts);
                                  @endphp

                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <i class="fas fa-file"></i>&nbsp<a
                                        href="{{ route('download_materi', ['filename'=>$lastWord]) }}"
                                        target="_blank()">
                                        Materi {{ $loop->iteration }}</a>
                                    </div>
                                  </div>
                                  @endforeach

                                </div>
                              </div>
                              <div class="card-footer">
                                <div class="row">
                                  <div class="col-12">
                                    <button type="button" class="btn btn-danger  float-right"
                                      data-dismiss="modal">Tutup</button>
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
            <button class="btn btn-primary" type="submit" id="saves">Tambah Data</button>
            <a href="" class="btn btn-info">Daftar Pertemuan</a>
            <a href="jadwal_tampil.php" class="btn btn-danger  float-right">kembali</a>
            <a href="#" class="btn btn-info" class="btn btn-primary" data-toggle="modal"
              data-target="#tambah-materi">Tambah Materi</a>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</section>

@endsection

@section('javascript')
<script type="text/javascript">
  document.getElementById("saves").style.display = "none";
  const checkboxes = document.querySelectorAll(".mycheckbox");

  checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener("change", function() {
      const isChecked = Array.from(checkboxes).some(function(cb) {
        return cb.checked;
      });

      if (isChecked) {
        document.getElementById("saves").style.display = "inline-block";
      } else {
        document.getElementById("saves").style.display = "none";
      }
    });
  });


  function checkAll(ele) {
    var checkboxes = document.getElementsByTagName('input');
    if (ele.checked) {
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].type == 'checkbox' && !(checkboxes[i].disabled)) {
          checkboxes[i].checked = true;
          document.getElementById("saves").style.display = "inline-block";
        }
      }
    } else {
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].type == 'checkbox') {
          document.getElementById("saves").style.display = "none";
          checkboxes[i].checked = false;
        }
      }
    }
  }
</script>
@endsection