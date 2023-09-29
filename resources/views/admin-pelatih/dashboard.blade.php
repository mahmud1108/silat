@extends('partials.main')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard {{ auth()->user()->role }}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard {{ auth()->user()->role }}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>
              {{--
              <?= $jadwal ?> --}}
            </h3>

            <p>Jadwal</p>
          </div>
          <div class="icon">
            <i class="fa fa-rss-square"></i>
          </div>
          <a href="jadwal_tampil.php" class="small-box-footer">Selengkapnya <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>
              {{--
              <?= $pertemuan ?> --}}
            </h3>

            <p>Pertemuan</p>
          </div>
          <div class="icon">
            <i class="fa fa-graduation-cap"></i>
          </div>
          <a href="pertemuan_tampil.php" class="small-box-footer">Selengkapnya <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>
              {{--
              <?= $user ?> --}}
            </h3>

            <p>User</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="user_tampil.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>
              {{--
              <?= $atlet ?> --}}
            </h3>

            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
          <a href="atlet_tampil.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">

        <!-- BAR CHART -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Data Absensi</h3>

            <div class="card-tools">
              <a type="button" class="btn btn-tool" href="absen_tampil.php">
                <i class="fas fa-plus-circle"></i>
              </a>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="barChart"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable">

        <!-- DONUT CHART -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Kelas Usia</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="donutChart"
              style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
@endsection

{{-- @section('javascript')
<script>
  var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
  var donutData = {
    labels: {{ $json_array_ku_cap }},
    datasets: [{
      data: {{ $json_array_ku_data }},
      backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
    }]
  }
  var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
  })

  var areaChartData = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [{
        label: 'Absen',
        backgroundColor: 'rgba(40,167,69,0.9)',
        borderColor: 'rgba(40,167,69,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(40,167,69,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(40,167,69,1)',
        data:  {{ $json_data_ya_per_bulan }}
      },
      {
        label: 'Belum Absen',
        backgroundColor: 'rgba(210, 214, 222, 1)',
        borderColor: 'rgba(210, 214, 222, 1)',
        pointRadius: false,
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: {{ $json_data_no_per_bulan }}
      },
    ]
  }


  //-------------
  //- BAR CHART -
  //-------------
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChartData = $.extend(true, {}, areaChartData)
  var temp0 = areaChartData.datasets[0]
  var temp1 = areaChartData.datasets[1]
  barChartData.datasets[0] = temp1
  barChartData.datasets[1] = temp0

  var barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false
  }

  new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
  })
</script>

@endsection --}}