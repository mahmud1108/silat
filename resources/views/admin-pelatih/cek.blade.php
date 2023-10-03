@extends('partials.main')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Cek Rutin</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Data Cek Rutin</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="card card-secondary">
    <div class=" card-header">
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
          <h4>Tambah Cek Rutin</h4>
        </div>
      </div>
      <form action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Atlet</label>
                  <select name="cr_atlet" id="cek_atlet" class="form-control select2" style="width: 100%;" required>
                    <option value="">Pilih Atlet</option>
                    {{--
                    <?php
                    $atlet = mysqli_query($koneksi, "SELECT * FROM atlet a LEFT JOIN kategori k ON a.atlet_kategori=k.kategori_id LEFT JOIN kelas_usia ku ON a.atlet_kelas_usia=ku.kelas_usia_id WHERE a.atlet_status='Aktif'");
                    while ($datlet = mysqli_fetch_array($atlet)) {
                      echo "<option value='$datlet[atlet_id]'";
                      if ($num_id == $datlet['atlet_id']) {
                        echo "selected";
                      }
                      echo ">$datlet[atlet_nama_lengkap]</option>";
                    }
                    ?> --}}
                  </select>
                </div>
              </div>
              <div class="col-md-12" id="form_isi">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tinggi Badan <sup>(Cm)</sup></label>
                      <input type="number" min=100 max=250 name="cr_tb" class="form-control"
                        placeholder="Tinggi Badan.." required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Berat Badan <sup>(Kg)</sup></label>
                      <input type="number" min=30 max=200 name="cr_bb" class="form-control" placeholder="Berat Badan.."
                        required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Kondisi Mental <sup>(%)</sup></label>
                      <input type="number" min=0 max=100 name="cr_mental" class="form-control"
                        placeholder="Kondisi Mental.." required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Kondisi Fisik <sup>(%)</sup></label>
                      <input type="number" min=0 max=100 name="cr_fisik" class="form-control"
                        placeholder="Kondisi Fisik.." required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>acuan cek rutin <sup>(%)</sup></label> <br>
                      <= 50 "Kurang Baik" ; <br>
                        <= 70 "Baik" ; <br>
                          <= 100 "Baik Sekali" ; <br>


                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row" id="display_info">

              <div class="col-md-12 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                  <div class="card-header text-muted border-bottom-0" id="atlet_kategori">
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-7">
                        <h2 class="lead" id="atlet_nama_lengkap"></h2>
                        <p class="text-muted text-sm" id="ttl"></p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                            <div id="atlet_alamat"></div>
                          </li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                            <div id="atlet_no_hp"></div>
                          </li>
                        </ul>
                      </div>
                      <div class="col-5 text-center">
                        <img src="" id="atlet_foto" alt="user-avatar" class="img-circle img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">
                      <a href="" id="detail_cr" class="btn btn-sm btn-primary">
                        <i class="fas fa-search"></i> Lihat
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- /.card-body -->

    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary" name="save">Tambah</button>
      <button type="reset" class="btn btn-danger float-right">Reset</button>
      </form>
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->
<!-- Main content -->
{{-- <section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>J/K</th>
                  <th>Kategori</th>
                  <th>Kelas Usia</th>
                  <th>Jumlah Cek</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                while ($datas = mysqli_fetch_array($query)) {
                  $jumlah_cek = mysqli_num_rows(mysqli_query($koneksi, "select * from cek_rutin where cr_atlet='$datas[atlet_id]'"));
                ?>
                <tr>
                  <td>
                    <?= $no ?>
                  </td>
                  <td>
                    <?= $datas['atlet_nama_lengkap'] ?>
                  </td>
                  <td>
                    <?= $datas['atlet_jenis_kelamin'] ?>
                  </td>
                  <td>
                    <?= $datas['kategori_nama'] ?>
                  </td>
                  <td>
                    <?= $datas['kelas_usia_nama'] ?>
                  </td>
                  <td>
                    <?= $jumlah_cek ?>
                  </td>
                  <td class="text-center py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <a href="cek_rutin_tampil.php?id=<?= $datas['atlet_id'] ?>" class="btn btn-primary"><i
                          class="fas fa-plus"></i></a>
                      <a href="cek_rutin_detail.php?id=<?= $datas['atlet_id'] ?>" class="btn btn-info"><i
                          class="fas fa-eye"></i></a>
                    </div>
                  </td>
                </tr>

                <?php $no++;
                } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>J/K</th>
                  <th>Kategori</th>
                  <th>Kelas Usia</th>
                  <th>Jumlah Cek</th>
                  <th>Aksi</th>
                </tr>
              </tfoot>
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
</section> --}}
@endsection