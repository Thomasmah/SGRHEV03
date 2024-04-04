<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'DashBoard')
        @section('header')
        <!--JS e CSS do LivWare Integrado -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        @livewireStyles
        @endsection
  @section('conteudo_principal')
  <x-sgrhe-preloader />
    <div class="wrapper">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
              
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Início</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
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
             <!-- Funcionário -->
             <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>{{ $funcionarios->count() }}</h3>
                    <p>Funcionários</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- Unidades Organicas -->
              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{ $unidadesOrganicas->count() }}</h3>
                    <p>Unidades Orgânicas</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- Escolas Primárias -->
              <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{ $unidadesOrganicas->where('descricao','ESCOLA')->count() }}</h3>
                    <p>Escolas Primárias</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!--Escola do 2º Ciclo do Ensino Secundário -->
              <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>1<sup style="font-size: 20px">%</sup></h3>
                    <p>Escola Secundária</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>10</h3>

                    <p>Funcionários Inativos</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              
              <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
              <!-- Left col -->
              <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-chart-pie mr-1"></i>
                     Aproveitamento
                    </h3>
                    <div class="card-tools d-block">
                      <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                          <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Gráfico</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#sales-chart" data-toggle="tab">Gráfico de Barras</a>
                        </li>
                      </ul>
                    </div>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content p-0">
                      <!-- Morris chart - Sales -->
                      <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"> 
                      <canvas id="doubleDatasetChart" width="400" height="200"></canvas>
                      </div>
                      <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                        <canvas id="revenue-chart-canvas" width="400" height="200" ></canvas>
                      </div>
                    </div>
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->

   

                <!-- /.card -->
              </section>
              <!-- /.Left col -->
              <!-- right col (We are only adding the ID to make the widgets sortable)-->
              <section class="col-lg-5 connectedSortable">
              <!-- Calendar -->
                <div class="card bg-gradient-success">
                  <div class="card-header border-0">

                    <h3 class="card-title">
                      <i class="far fa-calendar-alt"></i>
                      Calendario
                    </h3>
                    <!-- tools card -->
                    <div class="card-tools">
                      <!-- button with a dropdown -->
                      <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                          <i class="fas fa-bars"></i>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a href="#" class="dropdown-item">Adicionar novo evento</a>
                          <a href="#" class="dropdown-item">Limpar eventos</a>
                          <div class="dropdown-divider"></div>
                          <a href="#" class="dropdown-item">Ver calendário</a>
                        </div>
                      </div>
                      <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                    <!-- /. tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body pt-0">
                    <!--The calendar -->
                    <div id="calendar" style="width: 100%"></div>
                  </div>
                  <!-- /.card-body -->
                </div>
              <!-- /.card -->

              <!-- Map card -->
                <div class="card bg-gradient-primary">
                  <div class="card-header border-0">
                    <h3 class="card-title">
                      <i class="fas fa-map-marker-alt mr-1"></i>
                      Visitantes
                    </h3>
                    <!-- card tools -->
                    <div class="card-tools">
                      <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                        <i class="far fa-calendar-alt"></i>
                      </button>
                      <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <div class="card-body">
                    <div id="world-map" style="height: 250px; width: 100%;"></div>
                  </div>
                  <!-- /.card-body-->
                  <div class="card-footer bg-transparent">
                    <div class="row">
                      <div class="col-4 text-center">
                        <div id="sparkline-1"></div>
                        <div class="text-white">Visitantes</div>
                      </div>
                      <!-- ./col -->
                      <div class="col-4 text-center">
                        <div id="sparkline-2"></div>
                        <div class="text-white">Online</div>
                      </div>
                      <!-- ./col -->
                      <div class="col-4 text-center">
                        <div id="sparkline-3"></div>
                        <div class="text-white">Solicitações</div>
                      </div>
                      <!-- ./col -->
                    </div>
                    <!-- /.row -->
                  </div>
                </div>
              <!-- Map card -->

           
              </section>
              <!-- right col -->
            </div>
            <!-- /.row (main row) -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
    </div>
  @endsection
  @section('scripts')
      <!-- ChartJS -->
      <script src="{{ asset('plugins/chart.js/Chart.min.js') }} "></script>
      <!-- Sparkline -->
      <script src="{{ asset('plugins/sparklines/sparkline.js') }} "></script>
      <!-- Summernote / Calendar -->
      <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }} "></script>
      <!-- jQuery Knob Chart -->
      <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }} "></script>
      <!-- JQVMap -->
      <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }} "></script>
      <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }} "></script>
      <script src="{{ asset('plugins/jqvmap/maps/continents/jquery.vmap.africa.js') }} "></script>
      <!--/Aproveitamento Grafico-->
        <!--Grafico de Barras -->
        <script>
              // Sample data
              const data = {
                  labels: ['I Trimestre', 'II Trimestre', 'III Trimestre'],
                  datasets: [
                      {
                          label: 'Aprovados',
                          data: [65, 35, 73],
                          backgroundColor: 'rgba(75, 192, 192, 0.6)',
                          borderColor: 'rgba(75, 192, 192, 1)',
                          borderWidth: 2,
                      },
                      {
                          label: 'Reprovados',
                          data: [35, 65, 17],
                          backgroundColor: 'rgba(255, 99, 132, 0.6)',
                          borderColor: 'rgba(255, 99, 132, 1)',
                          borderWidth: 2,
                      },
                  ],
              };

              // Chart configuration
              const config = {
                  type: 'bar',
                  data: data,
                  options: {
                      scales: {
                          x: {
                              stacked: false,
                          },
                          y: {
                              stacked: false,
                              beginAtZero: true,
                          },
                      },
                  },
              };
              

              // Create the chart
              const ctx = document.getElementById('doubleDatasetChart').getContext('2d');
              new Chart(ctx, config);
          </script>
        <!--Grafico em Linha -->
          <script>
              /* Chart.js Charts */
            // Aproveitamento Grafico
            var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
            // $('#revenue-chart').get(0).getContext('2d');

            var salesChartData = {
              labels: ['I Trimestre', 'II Trimestre', 'III Trimestre'],
              datasets: [
                {
                  label: 'Aprovados',
                  backgroundColor: 'rgba(60,141,188,0.9)',
                  borderColor: 'rgba(60,141,188,0.8)',
                  pointRadius: false,
                  pointColor: '#3b8bba',
                  pointStrokeColor: 'rgba(60,141,188,1)',
                  pointHighlightFill: '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data: [35, 100, 100]
                },
                {
                  label: 'Reprovados',
                  backgroundColor: 'rgba(210, 214, 222, 1)',
                  borderColor: 'rgba(210, 214, 222, 1)',
                  pointRadius: false,
                  pointColor: 'rgba(210, 214, 222, 1)',
                  pointStrokeColor: '#c1c7d1',
                  pointHighlightFill: '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data: [65, 100, 100]
                }
              ]
            }

            var salesChartOptions = {
              maintainAspectRatio: false,
              responsive: true,
              legend: {
                display: true
              },
              scales: {
                xAxes: [{
                  gridLines: {
                    display: true
                  }
                }],
                yAxes: [{
                  gridLines: {
                    display: true
                  }
                }]
              }
            }

            // This will get the first returned node in the jQuery collection.
            // eslint-disable-next-line no-unused-vars
            var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
              type: 'line',
              data: salesChartData,
              options: salesChartOptions
            })
          </script>
      <!--/Aproveitamento Grafico-->
    @endsection
