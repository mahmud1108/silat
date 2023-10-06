@extends('partials.main')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Absensi Pertemuan
          {{ $pertemuan->pertemuan_nama }}
        </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Absensi Pertemuan
            {{ $pertemuan->pertemuan_nama }}
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
          <h3 class="card-title">Daftar Absen</h3>
        </div>
        <!-- /.card-header -->
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
                  @foreach ($absens as $absen)

                  <tr>
                    <td><input type='checkbox' class='mycheckbox' name='pilih{{ $loop->iteration }}'
                        value="{{ $absen->atlet->id }}" {{ $absen->absen_waktu === null ? '' : 'checked' }}/></td>
                    <td>
                      {{ $loop->iteration }}
                    </td>
                    <td>
                      {{ $absen->atlet->atlet_nama_lengkap }}
                    </td>
                    <?php
                      if (!empty($absen['absen_waktu'])) {
                      ?>
                    <td>

                      @php
                      $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $absen->absen_waktu);
                      $bulan = $date->format('d F Y');
                      $jam = $date->format('H:i');
                      @endphp
                      {{ $bulan. ' pukul '.$jam }}

                    </td>
                    <?php } else { ?>
                    <td>-</td>
                    <?php } ?>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
            <button class="btn btn-primary  mt-2" type="submit" name="absen" id="saves">Edit Absen</button>
          </div>
        </form>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection