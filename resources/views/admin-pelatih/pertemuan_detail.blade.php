@extends('partials.main')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Detail Pertemuan {{ $pertemuan->pertemuan_nama }} </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">
            Detail Pertemuan {{ $pertemuan->pertemuan_nama }}
          </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12" id="accordion">
      <div class="card card-primary card-outline">
        <a class="d-block w-100" data-toggle="collapse" href="#detail">
          <div class="card-header">
            <h4 class="card-title w-100">
              Detail Pertemuan
            </h4>
          </div>
        </a>
        <div id="detail" class="collapse show" data-parent="#accordion">
          <div class="card-body">
            <table>
              <tr>
                <td><b>Nama Pertemuan</b></td>
                <td>:</td>
                <td>
                  {{ $pertemuan->pertemuan_nama }}
                </td>
              </tr>
              <tr>
                <td><b>Mulai</b></td>
                <td>:</td>
                <td>
                  {{ $pertemuan->pertemuan_mulai }}
                  {{--
                  <?= tgl_indo(substr($query['pertemuan_mulai'], 0, 10)) . " " . substr($query['pertemuan_mulai'], 11, 20); ?>
                  --}}
                </td>
              </tr>
              <tr>
                <td><b>Selesai</b></td>
                <td>:</td>
                <td>
                  {{ $pertemuan->pertemuan_selesai }}
                  {{--
                  <?= tgl_indo(substr($query['pertemuan_selesai'], 0, 10)) . " " . substr($query['pertemuan_selesai'], 11, 20); ?>
                  --}}
                </td>
              </tr>
              <tr>
                <td><b>Deskripsi</b></td>
                <td>:</td>
                <td>
                  {{ $pertemuan->pertemuan_deskripsi }}
                </td>
              </tr>
            </table>
            <br>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#update_materi">Update Materi</a>
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambah_materi">Tambah Materi</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12" id="accordion">
      <div class="card card-info card-outline">
        <a class="d-block w-100" data-toggle="collapse" href="#materi">
          <div class="card-header">
            <h4 class="card-title w-100">
              Materi
            </h4>
          </div>
        </a>
        <div id="materi" class="collapse show" data-parent="#accordion">
          <div class="card-body ">
            <div class="row">
              <div class="col-12 col-sm-6 col-md-4 ">

                @foreach ($pertemuan->pertemuan_materi as $pm)
                <div class="card bg-light">
                  <div class="card-header text-muted border-bottom-0">
                    Materi {{ $loop->iteration }}
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-12">
                        <h2 class="lead"><b>
                            {{ $pm->materi->materi_nama }}
                          </b></h2>
                        <p class="text-muted text-sm"><b>Deskripsi: </b>
                          {{ $pm->materi->materi_deskripsi }}
                        </p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                          <i class="fas fa-file"></i>&nbsp<a href="download.php?file=" target="_blank()">
                          </a><br>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">
                      <a href="#" class="btn btn-danger float-right" data-toggle="modal"
                        data-target="#hapus{{ $pm->id }}">Hapus
                        Materi</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="hapus{{ $pm->id }}">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Hapus</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Yakin hapus materi <b>
                          {{ $pm->materi->materi_nama }}
                        </b>dari pertemuan
                        <b>{{ $pertemuan->pertemuan_nama }}</b>
                        ?
                      </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <form action="{{ route('pertemuan_materi', ['pertemuan_materi'=>$pm->id]) }}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-primary">Ya</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12" id="accordion">
      <div class="card card-success card-outline">
        <a class="d-block w-100" data-toggle="collapse" href="#absen">
          <div class="card-header">
            <h4 class="card-title w-100">
              Absen
            </h4>
          </div>
        </a>
        <div id="absen" class="collapse show" data-parent="#accordion">
          <form action="" method="post">
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width=10px><input type='checkbox' onchange='checkAll(this)' name='chk[]' /></th>
                      <th>No</th>
                      <th>Nama Atlet</th>
                      <th>Waktu Absen</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($atlets as $atlet)
                    <tr>
                      <td><input type='checkbox' class='mycheckbox' name='pilih{{ $loop->iteration }}'
                          value="{{ $atlet->id }}" /></td>
                      <td>
                        {{ $loop->iteration }}
                      </td>
                      <td>
                        {{ $atlet->atlet_nama_lengkap }}
                      </td>
                      {{-- @foreach ($atlet->absen as $absen)
                      {{ $absen->absen_waktu }}
                      @if ($absen->absen_waktu !== null)
                      <td>
                        <?= tgl_indo(substr($absen['absen_waktu'], 0, 10)) . " " . substr($absen['absen_waktu'], 11, 20); ?>
                      </td>
                      @else
                      <td>-</td>
                      @endif
                    </tr>
                    @endforeach --}}
                    @endforeach
                  </tbody>
                </table>
              </div>
              <button class="btn btn-primary  mt-2" type="submit" name="absen" id="saves">Tambah Data</button>
            </div>
          </form>
        </div>
      </div>
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