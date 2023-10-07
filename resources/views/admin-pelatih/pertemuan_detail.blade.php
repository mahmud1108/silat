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

                        @foreach ($galeri_nama as $galeri)
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                          <i class="fas fa-file"></i>&nbsp<a
                            href="{{ route('download_materi', ['filename'=>$galeri['galeri_nama']]) }}"
                            target="_blank()">
                            Materi {{
                            $loop->iteration }}
                          </a><br>
                        </ul>
                        @endforeach

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
          <form action="{{ route('absen.store') }}" method="post">
            @csrf
            <input type="hidden" name="pertemuan_id"
              value="{{ $datas[0]['jadwal_isi'][0]['atlet'][0]['absen'][0]['pertemuan_id'] }}">
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
                    @for ($i = 0; $i < count($datas[0]['jadwal_isi']); $i++) <tr>

                      <td><input type='checkbox' class='mycheckbox' name='pilih{{ $i }}'
                          value="{{ $datas[0]['jadwal_isi'][$i]['atlet'][0]['absen'][0]['id'] }}" {{
                          $datas[0]['jadwal_isi'][$i]['atlet'][0]['absen'][0]['absen_waktu']===null ? '' : 'checked'
                          }} />
                      </td>
                      <td>
                        {{ $i+1 }}
                      </td>
                      <td>
                        {{ $datas[0]['jadwal_isi'][$i]['atlet'][0]['atlet_nama_lengkap'] }}
                      </td>
                      <td>
                        @if ($datas[0]['jadwal_isi'][$i]['atlet'][0]['absen'][0]['absen_waktu']!==null)
                        @php
                        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                        $datas[0]['jadwal_isi'][$i]['atlet'][0]['absen'][0]['absen_waktu']);
                        $bulan = $date->format('d F Y');
                        $jam = $date->format('H:i');
                        @endphp
                        {{ $bulan. ' pukul '.$jam }}
                        @else
                        -
                        @endif
                        </tr>
                        @endfor

                  </tbody>
                </table>
              </div>
              <button class="btn btn-primary  mt-2" type="submit" id="saves">Edit Absen</button>
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