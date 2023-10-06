@extends('partials.main')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Jadwal</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Data Jadwal</li>
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
          <h4> Tambah Jadwal</h4>
        </div>
      </div>
      <form action="{{ route('jadwal.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Nama Jadwal</label>
              <input type="text" name="jadwal_nama" class="form-control" placeholder="Nama Jadwal.." required>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Waktu Jadwal</label>
              <input type="datetime-local" name="jadwal_waktu" class="form-control" placeholder="Waktu.." required>
            </div>
          </div>
          @if (auth()->user()->role === 'admin')
          <div class="col-md-4">
            <div class="form-group">
              <label>Pelatih</label>
              <select name="user_id" class="form-control select2" style="width: 100%;" required>
                <option value="">Pilih Pelatih</option>
                @foreach ($pelatihs as $pelatih)
                <option value="{{ $pelatih->id }}" {{ $pelatih->id===auth()->user()->id?'selected':'' }}>
                  {{ $pelatih->user_username }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          @else
          <div class="col-md-4">
            <div class="form-group">
              <label>Pelatih</label>
              <select name="user_id" class="form-control select" style="width: 100%;" required readonly>
                <option value="{{ auth()->user()->id }}">{{ auth()->user()->user_nama }}</option>
              </select>
            </div>
          </div>
          @endif
          <div class="col-md-12">
            <label>Atlet</label>
            <div class="table-responsive">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width=10px><input type='checkbox' onchange='checkAll(this)' name='chk[]' /></th>
                    <th width=10px>No</th>
                    <th>Nama Atlet</th>
                    <th>JK</th>
                    <th>Kategori</th>
                    <th>Kelas Usia</th>
                  </tr>
                </thead>
                @foreach ($atlets as $atlet)
                <tbody>
                  <tr>
                    <td><input type='checkbox' class='mycheckbox' name='pilih{{ $loop->iteration }}'
                        value="{{ $atlet->id }}" />
                    </td>
                    <td>
                      {{ $loop->iteration }}
                    </td>
                    <td>
                      {{ $atlet->atlet_nama_lengkap }}
                    </td>
                    <td>
                      {{ $atlet->atlet_jenis_kelamin }}
                    </td>
                    <td>
                      {{ $atlet->kategori->kategori_nama }}
                    </td>
                    <td>
                      {{ $atlet->kelas_usia->kelas_usia_nama }}
                    </td>
                  </tr>
                </tbody>
                @endforeach
              </table>
            </div>
          </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary" name="save" id="saves">Tambah</button>
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
                  <th>Aksi</th>
                </tr>
              </thead>
              @foreach ($jadwals as $jadwal)
              <tbody>
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $jadwal->jadwal_nama }}
                  </td>
                  <td>
                    @php
                    $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $jadwal->jadwal_waktu);
                    $bulan = $date->format('d F Y');
                    $jam = $date->format('H:i');
                    @endphp
                    {{ $bulan. ' pukul '.$jam }}
                  </td>
                  <td>
                    {{ $jadwal->user->user_nama }}
                  </td>
                  <td>
                    {{ count($jadwal->pertemuan) }}
                    <div class="btn-group btn-group-sm float-right">
                      <a href="{{route('pertemuan_create', ['pertemuan'=> $jadwal->id]) }}" title="Tambah Pertemuan"
                        class="btn btn-primary"><i class="fas fa-plus"></i></a>
                      @if (count($jadwal->pertemuan)>0)
                      <a href="{{ route('pertemuan.show', ['pertemuan'=>$jadwal->id]) }}" title="Detail Pertemuan"
                        class="btn btn-info"><i class="fas fa-eye"></i></a>
                      @endif
                    </div>
                  </td>
                  <td class="text-center py-0 align-middle">
                    {{ count($jadwal->jadwal_isi) }}
                    @if (count($jadwal->jadwal_isi) > 0)
                    <div class="btn-group btn-group-sm float-right">
                      <a href="{{ route('jadwal_isi.show', ['jadwal_isi'=> $jadwal->id]) }}" title="Detail peserta"
                        class="btn btn-info"><i class="fas fa-eye"></i></a>
                    </div>
                    @endif
                  </td>
                  <td class="text-center py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <a href="#" class="btn btn-info" data-toggle="modal" title="Ubah jadwal"
                        data-target="#modal-lg{{ $jadwal->id }}"><i class="fas fa-eye"></i></a>
                      <a href="#" class="btn btn-danger" title="Hapus jadwal" data-toggle="modal"
                        data-target="#modal-sm{{ $jadwal->id }}"><i class="fas fa-trash"></i></a>
                    </div>
                  </td>

                  <div class="modal fade" id="modal-sm{{ $jadwal->id }}">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Hapus</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Yakin hapus jadwal <b>
                              {{ $jadwal->jadwal_nama }}
                            </b>?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                          <form action="{{ route('jadwal.destroy', ['jadwal'=>$jadwal->id]) }}" method="post">
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

                  <div class="modal fade" id="modal-lg{{ $jadwal->id }}">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <form action="{{ route('jadwal.update',['jadwal'=>$jadwal->id]) }}" method="post">
                          @method('put')
                          @csrf
                          <div class="modal-header">
                            <h4 class="modal-title">Edit jadwal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Nama jadwal</label>
                                  <input type="text" name="nama" class="form-control" placeholder="Nama jadwal.."
                                    value="{{ $jadwal->jadwal_nama }}" required>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Waktu jadwal</label>
                                  <input type="datetime-local" name="waktu" class="form-control"
                                    placeholder="Waktu jadwal.." value="{{ $jadwal->jadwal_waktu }}" required>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Pelatih</label>
                                  <select name="user_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Pilih Pelatih</option>
                                    @foreach ($pelatihs as $pelatih)
                                    <option value="{{ $pelatih->id }}" {{ $jadwal->user_id===$pelatih->id ?
                                      'selected':'' }}>
                                      {{ $pelatih->user_nama }}
                                    </option>
                                    @endforeach
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