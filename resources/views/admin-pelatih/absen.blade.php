@extends('partials.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Absen</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Data Absen</li>
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
          <h3 class="card-title">Daftar Pertemuan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pertemuan</th>
                  <th>Nama Jadwal</th>
                  <th>Presentase Absen</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pertemuans as $pertemuan)

                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $pertemuan->pertemuan_nama }} <br><i>
                      @php
                      $date_mulai = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pertemuan->pertemuan_mulai);
                      $bulan_mulai = $date_mulai->format('d F Y');
                      $jam_mulai = $date_mulai->format('H:i');

                      $date_selesai = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pertemuan->pertemuan_selesai);
                      $bulan_selesai = $date_selesai->format('d F Y');
                      $jam_selesai = $date_selesai->format('H:i');
                      @endphp
                      {{ $bulan_mulai. ' pukul '.$jam_mulai }} </i>
                    <b>sampai</b>
                    <i>
                      {{ $bulan_selesai. ' pukul '.$jam_selesai }}
                    </i>
                  </td>
                  @php
                  $a = App\Models\Absen::where('pertemuan_id', $pertemuan->id)->count();
                  $ab = App\Models\Absen::where('pertemuan_id', $pertemuan->id)->whereNotNull('absen_waktu')->count();
                  if ($a > 0 and $ab > 0) {
                  $persen = $ab / $a * 100;
                  $persen = intval($persen);
                  } else {
                  $persen = intval(0);
                  }
                  @endphp
                  <td>
                    {{ $pertemuan->jadwal->jadwal_nama }}
                  </td>
                  <td>
                    <b>
                      {{ $persen }}%
                    </b>
                  </td>

                  <td class="text-center py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <a href="{{ route('absen.show', ['absen'=>$pertemuan->id]) }}" class="btn btn-info"><i
                          class="fas fa-eye"></i></a>
                      <a href="#" class="btn btn-danger" data-toggle="modal"
                        data-target="#modal-sm{{ $pertemuan->id }}"><i class="fas fa-trash"></i></a>
                    </div>
                  </td>

                  <div class="modal fade" id="modal-sm{{ $pertemuan->id }}">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Hapus</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Yakin hapus pertemuan <b>
                              {{ $pertemuan->pertemuan_nama }}
                            </b>?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                          <form action="{{ route('absen.destroy', ['absen'=>$pertemuan->id]) }}" method="post">
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
                </tr>
                @endforeach

              </tbody>
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