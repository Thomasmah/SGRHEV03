<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'DashBoard Unidade Orgânica')
        @section('header')
        <!--JS e CSS do LivWare Integrado -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        <style>
          .row > a {
            margin: 10px;
          }
        </style>
        @livewireStyles
        @endsection
  @section('conteudo_principal')
  <x-sgrhe-preloader />
      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>{{  $unidadeOrganicaSelected->designacao  }}</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active"> $unidadeOrganicaSelected->designacao </li>
                    </ol>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

       

            <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <!--col -->
                        <div class="col-md-12">
                                          <div class="card card-secondary">
                                            <div class="card-header">
                                              <h3 class="card-title">Album de Fotos da Escola</h3>
                                            </div>
                                            <div class="card-body">
                                              
                                                <div class="container">
                                                  <div class="row row col-lg-10 offset-md-1 text-center">
                                                        @foreach ($fotos as $foto)
                                                       
                                                            <a href="{{ route('Exibir.Imagem', ['imagem' => base64_encode($foto->caminho)]) }}" data-toggle="lightbox" data-gallery="gallery" class="col-md-3 d-inline-block">
                                                              <img src="{{ route('Exibir.Imagem', ['imagem' => base64_encode($foto->caminho)]) }}" class="img-fluid rounded">
                                                            </a>
                                                        
                                                        @endforeach
                                                  </div>
                                                </div>
                                            
                                            </div>
                                          </div>
                        </div>
                    <!--/col -->        
                  </div>
                </div>
                  <!-- /.row -->
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
    @endsection
