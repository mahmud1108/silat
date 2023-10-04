@extends('partials.main')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Jadwal
          {{ $jadwal->jadwal_nama }}
        </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Data Jadwal
            {{ $jadwal->jadwal_nama }}
          </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> Data Jadwal Atlet</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="{{ route('jadwal_isi.update', ['jadwal_isi'=>$jadwal->id]) }}" method="post">
            @method('put')
            @csrf
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
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
                    <td>
                      <input type='checkbox' class='mycheckbox' name='pilih{{ $loop->iteration }}'
                        value="{{ $atlet->id }}" @foreach ($jadwal_details as $jadwal_detail) {{
                        $jadwal_detail->atlet->id === $atlet->id ? 'checked' : '' }}
                      @endforeach
                      />

                      <input type="hidden" name="atlet{{ $loop->iteration }}" value="{{ $atlet->id }}">
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
            <button class="btn btn-primary" type="submit" id="saves">Update Data</button>
            <a href="{{ route('jadwal.index') }}" class="btn btn-danger">kembali</a>
          </form>
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