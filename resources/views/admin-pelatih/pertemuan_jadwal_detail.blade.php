@extends('partials.main')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">
          Daftar Pertemuan di Jadwal {{ $jadwal->jadwal_nama }}
        </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">
            Daftar Pertemuan di Jadwal {{ $jadwal->jadwal_nama }}
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
                  <th>Jumlah Materi</th>
                  <th>Presentase Absen</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                {{--
                <?php
                  if ($a > 0 and $ab > 0) {
                    $persen = $a / $ab * 100;
                    $persen = intval($persen);
                  } else {
                    $persen = intval(0);
                  }
                ?> --}}
                @foreach ($pertemuans as $pertemuan)
                <tr>
                  <td>
                    {{ $loop->iteration }}
                  </td>
                  <td>
                    {{ $pertemuan->pertemuan_nama }}
                    <br>
                    <i>
                      {{--
                      <?= tgl_indo(substr($datas['pertemuan_mulai'], 0, 10)) . " " . substr($datas['pertemuan_mulai'], 11, 20); ?>
                      -
                      <?= tgl_indo(substr($datas['pertemuan_selesai'], 0, 10)) . " " . substr($datas['pertemuan_selesai'], 11, 20); ?>
                      --}}
                    </i>
                  </td>
                  <td>
                    {{ $pertemuan->jadwal->jadwal_nama }}
                  </td>
                  <td>
                    {{ count($pertemuan->pertemuan_materi) }}
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
                  <td><b>
                      {{ $persen }}%
                    </b></td>

                  <td class="text-center py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <a href="{{ route('pertemuan_detail', ['pertemuan'=>$pertemuan->id]) }}" class="btn btn-info"><i
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
                          <form action="{{ route('pertemuan.destroy', ['pertemuan'=>$pertemuan->id]) }}" method="post">
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

                  {{-- <div class="modal fade" id="modal-lg{{ $pertemuan->id }}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <form action="" method="post">
                          <input type="hidden" name="id_pertemuan" value="{{ $pertemuan->id }}">
                          <div class="modal-header">
                            <h4 class="modal-title">Materi Pertemuan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <label for="">Materi
                                <?= $datas['materi_nama']; ?>
                              </label>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <i class="fas fa-file"></i>&nbsp<a
                                    href="download.php?file=<?= $datas['galeri_nama']; ?>" target="_blank()">
                                    <?= $datas['galeri_nama']; ?>
                                  </a>
                                  <a style="float:right" href="materi_tampil.php?del=<?= $datas['galeri_id']; ?>"><i
                                      class="fas fa-trash"></i></a>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Materi</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="exampleInputFile"
                                        name="update_gambar[]"
                                        accept="jpg, .jpeg, .png, .gif, .docx, .doc, . pdf, .txt, .odt, .mp4, .avi, .mkv, .mov, .wmv"
                                        multiple>
                                      <label class="custom-file-label" for="exampleInputFile">Pilih Materi</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
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
                    </div>
                  </div> --}}
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