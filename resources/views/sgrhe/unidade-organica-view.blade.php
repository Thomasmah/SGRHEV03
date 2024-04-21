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
                  <!-- Small boxes (Stat box) -->
                  <div class="row">
                    <!-- Funcionário -->
                      <div class="col-lg-3 col-6">
                          <div class="small-box bg-danger">
                            <div class="inner">
                              <h3>{{ $Funcionarios->count() }}</h3>
                              <p>Número de Funcionários</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-person-add"></i>
                            </div>
                           <form class="small-box-footer" action="{{ route('funcionarios.unidade_organica.index') }}">
                            @csrf
                            <input type="hidden" name="idUnidadeOrganica" value="{{ $unidadeOrganicaSelected->id }}">
                            <input type="hidden" name="designacao" value="{{ $unidadeOrganicaSelected->designacao }}">
                            <button type="submit">Ver mais  <i class="fas fa-arrow-circle-right"></i> </button>
                           </form>
                            
                          </div>
                      </div>
                    <!-- /Funcionário -->
                    <!-- Unidades Organicas -->
                      <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3>Funcionario</h3>
                            <p>Funcionários Inativos</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-bag"></i>
                          </div>
                          <a href="#" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                    <!-- /Unidades Organicas -->
                    <!-- Escolas Primárias -->
                      <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                          <div class="inner">
                            <h3>Funcionario</h3>
                            <p>Escolas Primárias</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                          </div>
                          <a href="#" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                    <!-- /Escolas Primárias -->
                    <!--Funcionarios Inactivos-->
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
                    <!--Funcionarios Inactivos-->
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
                          Aproveitamento Escolar
                          </h3>
                          <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                              <li class="nav-item">
                                <a class="nav-link active" href="#sales-chart" data-toggle="tab">Gráfico de Barras</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link " href="#revenue-chart" data-toggle="tab">Gráfico</a>
                              </li>
                            </ul>
                          </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                          <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 300px;"> 
                            <canvas id="doubleDatasetChart" width="400" height="200"></canvas>
                            </div>
                            <div class="chart tab-pane " id="revenue-chart" style="position: relative; height: 300px;">
                              <canvas id="revenue-chart-canvas" width="400" height="200"></canvas>
                            </div>
                          </div>
                        </div><!-- /.card-body -->
                      </div>
                      <!-- /.card -->

                      <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                  </div>
                  <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
              </section>
            <!-- /.content -->

            <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <!--col -->
                        <div class="col-md-12">
                            <div class="card">
                              <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                  <li class="nav-item"><a class="nav-link active" href="#SobreFuncionario" data-toggle="tab">Sobre a Escola</a></li>
                                  <li class="nav-item"><a class="nav-link" href="#ITrimestre" data-toggle="tab">Aproveitamento I Trimestre</a></li>
                                  <li class="nav-item"><a class="nav-link" href="#IITrimestre" data-toggle="tab">Aproveitamento II Trimestre</a></li>
                                  <li class="nav-item"><a class="nav-link" href="#IIITrimestre" data-toggle="tab">Aproveitamento III Trimestre</a></li>
                                </ul>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                <div class="tab-content">
                                      
                                        <!--tab-pane-->
                                        <div class="tab-pane active" id="SobreFuncionario">
                                          <div class="card card-info">
                                            <div class="card-header">
                                              <h3 class="card-title">
                                                Sobre a Unidade Orgânica
                                              </h3>
                                            </div>
                                            <div class="card-body">
                                              <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                  <p><b>EQT:</b> {{ $unidadeOrganicaSelected->eqt }} </p> 
                                                  <p><b>Decreto de Criação:</b> {{ $unidadeOrganicaSelected->decretoCriacao }} </p>
                                                  <p><b>Nível de Ensino:</b> {{ 'Nivel de Ensino' }} </p>  
                                                  <p><b>Telefone:</b> {{ $unidadeOrganicaSelected->telefone }} </p>
                                                  <p><b>E-mail:</b> {{ $unidadeOrganicaSelected->email }} </p>
                                                  <p><b>Localidade:</b> {{ $unidadeOrganicaSelected->localidade }} </p>
                                                  <p><b>Coordenadas Geograficas:</b> {{ 'N/D' }} </p>
                                                </li>
                                              </ul>
                                            </div>
                                            <div class="card-footer">

                                            </div>
                                          </div>
                                          <div class="card card-secondary">
                                            <div class="card-header">
                                              <h3 class="card-title">Galeria de Fotos da {{  $unidadeOrganicaSelected->designacao  }} </h3>
                                            </div>
                                            <div class="card-body">
                                                <a href="{{ route('galeria.unidade.organica', ['idUnidadeOrganica' => $unidadeOrganicaSelected->id]) }}" class="btn btn-primary w-100"><i class="fa fa-galery "></i> Abrir Galeria de Fotos</a>
                                            </div>
                                            <div class="card-footer">
                                               <button class="btn btn-primary w-100" data-toggle="modal" data-target="#addfotosUnidadeOrganica" >
                                                  <i class="fa fa-plus "></i> Adicionar Fotos da Escola
                                                </button>
                                            </div>
                                          </div>
                                                                <div class="modal fade" id="addfotosUnidadeOrganica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                                  <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h6 class="modal-title" id="exampleModalLabel">Adicionar Fotos no Album da Escola</h6>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <!-- Formulário dentro da modal -->
                                                                                <form method="POST" enctype="multipart/form-data" action="{{ route('add.foto.uo') }}">
                                                                                    @csrf
                                                                                    @method('POST')
                                                                                    <div class="form-group">
                                                                                        <label for="arquivo">A Foto deve estar no Formato "png e jpg"</label>
                                                                                        <div class="input-group">
                                                                                            <div class="custom-file">
                                                                                                <input type="file" class="custom-file-input" name="arquivo">
                                                                                                <label class="custom-file-label" for="arquivo">Escolha a foto </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input type="checkbox" name="confirmar" class="form-check-input">
                                                                                        <label class="form-check-label" for="confirmar">Clique para Confirmar</label>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                          <input type="hidden" name="idUnidadeOrganica" value="{{ $unidadeOrganicaSelected->id }}">
                                                                                          <button type="submit" class="btn btn-primary">Adicionar Fotos</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                  </div>
                                                                </div>
                                        </div>
                               
                                        <!--/tab-pane-->
                                        <!--tab-pane-->
                                        <div class="tab-pane" id="ITrimestre">
                                          <!-- Formulario I  Trimestre -->
                                          

                                            @if (isset($aproveitamentoITrimestre))
                                              <div class="card card-primary">
                                                <div class="card-header">
                                                  <h3 class="card-title">
                                                    Aproveitamento escolar do I Trimestre
                                                  </h3>
                                                </div>
                                                <div class="card-body">
                                                  <div class="table-responsive">
                                                    <table class="table table-hover table-bordered border-secondary table-striped" style="text-align:center;">
                                                        <thead class="bg-primary">
                                                          <tr>
                                                            <th scope="col" rowspan="2" colspan="1" style=" vertical-align:middle" >Alunos</th><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Matriculados no Início do Ano Lectivo</th><!--<th scope="col">Matriculados</th>--> <th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Matriculados no Final do Ano Lectivo</th><!--<th scope="col">Matriculados</th>--><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Aprovados</th><!--<th scope="col">Aprovados</th>--><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Reprovados</th><!--<th scope="col">Reprovados</th>--><th scope="col" colspan="4" rowspan="1" style="vertical-align: middle;">Trasferidos</th><!--<th scope="col">Trasferidos</th><th scope="col">Trasferidos</th><th scope="col">Trasferidos</th> --><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Desistentes</th> <!--<th scope="col">Total</th>-->
                                                          </tr>
                                                          <tr>
                                                            <!--<th scope="col">Alunos</th> --><!--<th scope="col" colspan="2">Matriculados</th><th scope="col">Matriculados</th>--> <!--<th scope="col">Aprovados</th><th scope="col">Aprovados</th>--><!--<th scope="col">Reprovados</th><th scope="col">Reprovados</th>--><th scope="col" colspan="2" rowspan="1" style="vertical-align: middle;">Entrada</th><!--<th scope="col">Entrada</th> --> <th scope="col" colspan="2" rowspan="1" style="vertical-align: middle;">Saida</th><!--<th scope="col">Saida</th>--><!--<th scope="col">Total</th> <th scope="col">Total</th>-->
                                                          </tr>
                                                          <tr>
                                                            <th scope="col">Classe</th><th scope="col">MF</th><th scope="col">F</th> <th scope="col">MF</th><th scope="col">F</th> <th scope="col">MF</th><th scope="col">F</th><th scope="col">MF</th><th scope="col">F</th> <th scope="col">MF</th><th scope="col">F</th><th scope="col">MF</th><th scope="col">F</th><th scope="col">MF</th> <th scope="col">F</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                              <th scope="row">1ª</th>   <td class="col-1" id="Ta11"> {{ isset($aproveitamentoITrimestre['a11']) ? $aproveitamentoITrimestre['a11'] : '0' }} </td> <td class="col-1" id="Ta12"> {{  isset($aproveitamentoITrimestre['a12']) ? $aproveitamentoITrimestre['a12'] : '0' }}  </td> <td class="col-1" id="Ta13"> {{  isset($aproveitamentoITrimestre['a13']) ? $aproveitamentoITrimestre['a13'] : '0' }}  </td> <td class="col-1" id="Ta14"> {{ isset($aproveitamentoITrimestre['a14']) ? $aproveitamentoITrimestre['a14'] : '0' }}  </td> <td class="col-1" id="Ta15"> {{   isset($aproveitamentoITrimestre['a15']) ? $aproveitamentoITrimestre['a15'] : '0' }}  </td> <td class="col-1" id="Ta16"> {{  isset($aproveitamentoITrimestre['a16']) ? $aproveitamentoITrimestre['a16'] : '0' }}  </td> <td class="col-1" id="Ta17"> {{  isset($aproveitamentoITrimestre['a17']) ? $aproveitamentoITrimestre['a17'] : '0' }}  </td> <td class="col-1" id="Ta18"> {{ isset($aproveitamentoITrimestre['a18']) ? $aproveitamentoITrimestre['a18'] : '0' }}  </td> <td class="col-1" id="Ta19"> {{   isset($aproveitamentoITrimestre['a19']) ? $aproveitamentoITrimestre['a19'] : '0' }}  </td> <td class="col-1" id="Ta110"> {{   isset($aproveitamentoITrimestre['a110']) ? $aproveitamentoITrimestre['a110'] : '0' }}   </td> <td class="col-1" id="Ta111"> {{  isset($aproveitamentoITrimestre['a111']) ? $aproveitamentoITrimestre['a111'] : '0' }}   </td> <td class="col-1" id="Ta112"> {{  isset($aproveitamentoITrimestre['a112']) ? $aproveitamentoITrimestre['a112'] : '0' }}   </td> <td class="col-1" id="Ta113"> {{ isset($aproveitamentoITrimestre['a113']) ? $aproveitamentoITrimestre['a113'] : '0' }}  </td> <td class="col-1" id="Ta114"> {{  isset($aproveitamentoITrimestre['a114']) ? $aproveitamentoITrimestre['a114'] : '0' }}  </td>
                                                          </tr>
                                                          <tr>
                                                              <th scope="row">2ª</th>   <td class="col-1" id="Ta21"> {{ isset($aproveitamentoITrimestre['a21']) ? $aproveitamentoITrimestre['a21'] : '0' }}  </td> <td class="col-1" id="Ta22"> {{   isset($aproveitamentoITrimestre['a22']) ? $aproveitamentoITrimestre['a22'] : '0' }}  </td> <td class="col-1" id="Ta23"> {{  isset($aproveitamentoITrimestre['a23']) ? $aproveitamentoITrimestre['a23'] : '0' }}  </td> <td class="col-1" id="Ta24"> {{  isset($aproveitamentoITrimestre['a24']) ? $aproveitamentoITrimestre['a24'] : '0' }}  </td> <td class="col-1" id="Ta25"> {{ isset($aproveitamentoITrimestre['a25']) ? $aproveitamentoITrimestre['a25'] : '0' }}  </td> <td class="col-1" id="Ta26"> {{   isset($aproveitamentoITrimestre['a26']) ? $aproveitamentoITrimestre['a26'] : '0' }}  </td> <td class="col-1" id="Ta27"> {{  isset($aproveitamentoITrimestre['a27']) ? $aproveitamentoITrimestre['a27'] : '0' }}  </td> <td class="col-1" id="Ta28"> {{  isset($aproveitamentoITrimestre['a28']) ? $aproveitamentoITrimestre['a28'] : '0' }}  </td> <td class="col-1" id="Ta29"> {{ isset($aproveitamentoITrimestre['a29']) ? $aproveitamentoITrimestre['a29'] : '0' }}  </td> <td class="col-1" id="Ta210"> {{  isset($aproveitamentoITrimestre['a210']) ? $aproveitamentoITrimestre['a210'] : '0' }}   </td> <td class="col-1" id="Ta211"> {{  isset($aproveitamentoITrimestre['a211']) ? $aproveitamentoITrimestre['a211'] : '0' }}   </td> <td class="col-1" id="Ta212"> {{ isset($aproveitamentoITrimestre['a212']) ? $aproveitamentoITrimestre['a212'] : '0' }}   </td> <td class="col-1" id="Ta213"> {{   isset($aproveitamentoITrimestre['a213']) ? $aproveitamentoITrimestre['a213'] : '0' }}  </td> <td class="col-1" id="Ta214"> {{   isset($aproveitamentoITrimestre['a214']) ? $aproveitamentoITrimestre['a214'] : '0' }}  </td>
                                                          </tr>
                                                          <tr>
                                                              <th scope="row">3ª</th>   <td class="col-1" id="Ta31"> {{ isset($aproveitamentoITrimestre['a31']) ? $aproveitamentoITrimestre['a31'] : '0' }}  </td> <td class="col-1" id="Ta32"> {{   isset($aproveitamentoITrimestre['a32']) ? $aproveitamentoITrimestre['a32'] : '0' }}  </td> <td class="col-1" id="Ta33"> {{  isset($aproveitamentoITrimestre['a33']) ? $aproveitamentoITrimestre['a33'] : '0' }}  </td> <td class="col-1" id="Ta34"> {{  isset($aproveitamentoITrimestre['a34']) ? $aproveitamentoITrimestre['a34'] : '0' }}  </td> <td class="col-1" id="Ta35"> {{ isset($aproveitamentoITrimestre['a35']) ? $aproveitamentoITrimestre['a35'] : '0' }}  </td> <td class="col-1" id="Ta36"> {{   isset($aproveitamentoITrimestre['a36']) ? $aproveitamentoITrimestre['a36'] : '0' }}  </td> <td class="col-1" id="Ta37"> {{  isset($aproveitamentoITrimestre['a37']) ? $aproveitamentoITrimestre['a37'] : '0' }}  </td> <td class="col-1" id="Ta38"> {{  isset($aproveitamentoITrimestre['a38']) ? $aproveitamentoITrimestre['a38'] : '0' }}  </td> <td class="col-1" id="Ta39"> {{ isset($aproveitamentoITrimestre['a39']) ? $aproveitamentoITrimestre['a39'] : '0' }}  </td> <td class="col-1" id="Ta310"> {{  isset($aproveitamentoITrimestre['a310']) ? $aproveitamentoITrimestre['a310'] : '0' }}   </td> <td class="col-1" id="Ta311"> {{  isset($aproveitamentoITrimestre['a311']) ? $aproveitamentoITrimestre['a311'] : '0' }}   </td> <td class="col-1" id="Ta312"> {{ isset($aproveitamentoITrimestre['a312']) ? $aproveitamentoITrimestre['a312'] : '0' }}   </td> <td class="col-1" id="Ta313"> {{   isset($aproveitamentoITrimestre['a313']) ? $aproveitamentoITrimestre['a313'] : '0' }}  </td> <td class="col-1" id="Ta314"> {{   isset($aproveitamentoITrimestre['a314']) ? $aproveitamentoITrimestre['a314'] : '0' }}  </td>
                                                          </tr>
                                                          <tr>
                                                              <th scope="row">4ª</th>   <td class="col-1" id="Ta41"> {{ isset($aproveitamentoITrimestre['a41']) ? $aproveitamentoITrimestre['a41'] : '0' }}  </td> <td class="col-1" id="Ta42"> {{   isset($aproveitamentoITrimestre['a42']) ? $aproveitamentoITrimestre['a42'] : '0' }}  </td> <td class="col-1" id="Ta43"> {{  isset($aproveitamentoITrimestre['a43']) ? $aproveitamentoITrimestre['a43'] : '0' }}  </td> <td class="col-1" id="Ta44"> {{  isset($aproveitamentoITrimestre['a44']) ? $aproveitamentoITrimestre['a44'] : '0' }}  </td> <td class="col-1" id="Ta45"> {{ isset($aproveitamentoITrimestre['a45']) ? $aproveitamentoITrimestre['a45'] : '0' }}  </td> <td class="col-1" id="Ta46"> {{   isset($aproveitamentoITrimestre['a46']) ? $aproveitamentoITrimestre['a46'] : '0' }}  </td> <td class="col-1" id="Ta47"> {{  isset($aproveitamentoITrimestre['a47']) ? $aproveitamentoITrimestre['a47'] : '0' }}  </td> <td class="col-1" id="Ta48"> {{  isset($aproveitamentoITrimestre['a48']) ? $aproveitamentoITrimestre['a48'] : '0' }}  </td> <td class="col-1" id="Ta49"> {{ isset($aproveitamentoITrimestre['a49']) ? $aproveitamentoITrimestre['a49'] : '0' }}  </td> <td class="col-1" id="Ta410"> {{  isset($aproveitamentoITrimestre['a410']) ? $aproveitamentoITrimestre['a410'] : '0' }}   </td> <td class="col-1" id="Ta411"> {{  isset($aproveitamentoITrimestre['a411']) ? $aproveitamentoITrimestre['a411'] : '0' }}   </td> <td class="col-1" id="Ta412"> {{ isset($aproveitamentoITrimestre['a412']) ? $aproveitamentoITrimestre['a412'] : '0' }}   </td> <td class="col-1" id="Ta413"> {{   isset($aproveitamentoITrimestre['a413']) ? $aproveitamentoITrimestre['a413'] : '0' }}  </td> <td class="col-1" id="Ta414"> {{   isset($aproveitamentoITrimestre['a414']) ? $aproveitamentoITrimestre['a414'] : '0' }}  </td>
                                                          </tr>
                                                          <tr>
                                                              <th scope="row">5ª</th>   <td class="col-1" id="Ta51"> {{ isset($aproveitamentoITrimestre['a51']) ? $aproveitamentoITrimestre['a51'] : '0' }}  </td> <td class="col-1" id="Ta52"> {{   isset($aproveitamentoITrimestre['a52']) ? $aproveitamentoITrimestre['a52'] : '0' }}  </td> <td class="col-1" id="Ta53"> {{  isset($aproveitamentoITrimestre['a53']) ? $aproveitamentoITrimestre['a53'] : '0' }}  </td> <td class="col-1" id="Ta54"> {{  isset($aproveitamentoITrimestre['a54']) ? $aproveitamentoITrimestre['a54'] : '0' }}  </td> <td class="col-1" id="Ta55"> {{ isset($aproveitamentoITrimestre['a55']) ? $aproveitamentoITrimestre['a55'] : '0' }}  </td> <td class="col-1" id="Ta56"> {{   isset($aproveitamentoITrimestre['a56']) ? $aproveitamentoITrimestre['a56'] : '0' }}  </td> <td class="col-1" id="Ta57"> {{  isset($aproveitamentoITrimestre['a57']) ? $aproveitamentoITrimestre['a57'] : '0' }}  </td> <td class="col-1" id="Ta58"> {{  isset($aproveitamentoITrimestre['a58']) ? $aproveitamentoITrimestre['a58'] : '0' }}  </td> <td class="col-1" id="Ta59"> {{ isset($aproveitamentoITrimestre['a59']) ? $aproveitamentoITrimestre['a59'] : '0' }}  </td> <td class="col-1" id="Ta510"> {{  isset($aproveitamentoITrimestre['a510']) ? $aproveitamentoITrimestre['a510'] : '0' }}   </td> <td class="col-1" id="Ta511"> {{  isset($aproveitamentoITrimestre['a511']) ? $aproveitamentoITrimestre['a511'] : '0' }}   </td> <td class="col-1" id="Ta512"> {{ isset($aproveitamentoITrimestre['a512']) ? $aproveitamentoITrimestre['a512'] : '0' }}   </td> <td class="col-1" id="Ta513"> {{   isset($aproveitamentoITrimestre['a513']) ? $aproveitamentoITrimestre['a513'] : '0' }}  </td> <td class="col-1" id="Ta514"> {{   isset($aproveitamentoITrimestre['a514']) ? $aproveitamentoITrimestre['a514'] : '0' }}  </td>
                                                          </tr>
                                                          <tr>
                                                              <th scope="row">6ª</th>   <td class="col-1" id="Ta61"> {{ isset($aproveitamentoITrimestre['a61']) ? $aproveitamentoITrimestre['a61'] : '0' }}  </td> <td class="col-1" id="Ta62"> {{   isset($aproveitamentoITrimestre['a62']) ? $aproveitamentoITrimestre['a62'] : '0' }}  </td> <td class="col-1" id="Ta63"> {{  isset($aproveitamentoITrimestre['a63']) ? $aproveitamentoITrimestre['a63'] : '0' }}  </td> <td class="col-1" id="Ta64"> {{  isset($aproveitamentoITrimestre['a64']) ? $aproveitamentoITrimestre['a64'] : '0' }}  </td> <td class="col-1" id="Ta65"> {{ isset($aproveitamentoITrimestre['a65']) ? $aproveitamentoITrimestre['a65'] : '0' }}  </td> <td class="col-1" id="Ta66"> {{   isset($aproveitamentoITrimestre['a66']) ? $aproveitamentoITrimestre['a66'] : '0' }}  </td> <td class="col-1" id="Ta67"> {{  isset($aproveitamentoITrimestre['a67']) ? $aproveitamentoITrimestre['a67'] : '0' }}  </td> <td class="col-1" id="Ta68"> {{  isset($aproveitamentoITrimestre['a68']) ? $aproveitamentoITrimestre['a68'] : '0' }}  </td> <td class="col-1" id="Ta69"> {{ isset($aproveitamentoITrimestre['a69']) ? $aproveitamentoITrimestre['a69'] : '0' }}  </td> <td class="col-1" id="Ta610"> {{  isset($aproveitamentoITrimestre['a610']) ? $aproveitamentoITrimestre['a610'] : '0' }}   </td> <td class="col-1" id="Ta611"> {{  isset($aproveitamentoITrimestre['a611']) ? $aproveitamentoITrimestre['a611'] : '0' }}   </td> <td class="col-1" id="Ta612"> {{ isset($aproveitamentoITrimestre['a612']) ? $aproveitamentoITrimestre['a612'] : '0' }}   </td> <td class="col-1" id="Ta613"> {{   isset($aproveitamentoITrimestre['a613']) ? $aproveitamentoITrimestre['a613'] : '0' }}  </td> <td class="col-1" id="Ta614"> {{   isset($aproveitamentoITrimestre['a614']) ? $aproveitamentoITrimestre['a614'] : '0' }}  </td>
                                                          </tr>
                                                          
                                                        </tbody>
                                                        <tfoot>
                                                          <tr class="bg-warning">
                                                            <th scope="row">Total</th>    <td id="TmatriculadosIAMF"> {{ isset($aproveitamentoITrimestre['matriculadosIAMF']) ? $aproveitamentoITrimestre['matriculadosIAMF'] : '0'}}   </td><td id="TmatriculadosIAF"> {{ isset($aproveitamentoITrimestre['matriculadosIAF']) ? $aproveitamentoITrimestre['matriculadosIAF'] : '0'}}   </td><td id="TmatriculadosFAMF">  {{ isset($aproveitamentoITrimestre['matriculadosFAMF']) ? $aproveitamentoITrimestre['matriculadosFAMF'] : '0'}}   </td><td id="TmatriculadosFAF">  {{ isset($aproveitamentoITrimestre['matriculadosFAF']) ? $aproveitamentoITrimestre['matriculadosFAF'] : '0'}}  </td><td id="TaprovadosMF"> {{ isset($aproveitamentoITrimestre['aprovadosMF']) ? $aproveitamentoITrimestre['aprovadosMF'] : '0'}}    </td><td id="TaprovadosF"> {{ isset($aproveitamentoITrimestre['aprovadosF']) ? $aproveitamentoITrimestre['aprovadosF'] : '0'}}    </td> <td id="TreprovadosMF">  {{ isset($aproveitamentoITrimestre['reprovadosMF']) ? $aproveitamentoITrimestre['reprovadosMF'] : '0'}}   </td> <td id="TreprovadosF"> {{ isset($aproveitamentoITrimestre['reprovadosF']) ? $aproveitamentoITrimestre['reprovadosF'] : '0'}}  </td> <td id="TtransferidosEMF"> {{ isset($aproveitamentoITrimestre['transferidosEMF']) ? $aproveitamentoITrimestre['transferidosEMF'] : '0'}}   </td> <td id="TtransferidosEF"> {{ isset($aproveitamentoITrimestre['transferidosEF']) ? $aproveitamentoITrimestre['transferidosEF'] : '0'}}   </td> <td id="TtransferidosSMF">  {{ isset($aproveitamentoITrimestre['transferidosSMF']) ? $aproveitamentoITrimestre['transferidosSMF'] : '0'}}   </td> <td id="TtransferidosSF">  {{ isset($aproveitamentoITrimestre['transferidosSF']) ? $aproveitamentoITrimestre['transferidosSF'] : '0'}}  </td> <td id="TdesistentesMF">  {{ isset($aproveitamentoITrimestre['desistentesMF']) ? $aproveitamentoITrimestre['desistentesMF'] : '0'}}   </td> <td id="TdesistentesF">  {{ isset($aproveitamentoITrimestre['desistentesF']) ? $aproveitamentoITrimestre['desistentesF'] : '0'}}   </td>
                                                          </tr>
                                                        </tfoot>
                                                    </table>
                                                  </div>
                                                </div>
                                                <div class="card-footer">

                                                </div>
                                              </div>
                                            @else
                                            <h4 class="text-info"> Não Foram Submetidos Formulário para o I Trimestre. </h4>
                                            @endif

                                            <!-- /.CardContet -->
                                        </div>
                                      <!--/tab-pane-->
                                      <!--tab-pane-->
                                        <div class="tab-pane" id="IITrimestre">
                                            <!-- Formulario II Trimestre -->
                                            @if (isset($aproveitamentoIITrimestre))
                                              <div class="card card-primary">
                                                <div class="card-header">
                                                  <h3 class="card-title">
                                                    Aproveitamento escolar do II Trimestre
                                                  </h3>
                                                </div>
                                                <div class="card-body">
                                                <div class="table-responsive">
                                                  <table class="table table-hover table-bordered border-secondary table-striped" style="text-align:center;">
                                                      <thead class="bg-primary">
                                                        <tr>
                                                          <th scope="col" rowspan="2" colspan="1" style=" vertical-align:middle" >Alunos</th><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Matriculados no Início do Ano Lectivo</th><!--<th scope="col">Matriculados</th>--> <th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Matriculados no Final do Ano Lectivo</th><!--<th scope="col">Matriculados</th>--><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Aprovados</th><!--<th scope="col">Aprovados</th>--><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Reprovados</th><!--<th scope="col">Reprovados</th>--><th scope="col" colspan="4" rowspan="1" style="vertical-align: middle;">Trasferidos</th><!--<th scope="col">Trasferidos</th><th scope="col">Trasferidos</th><th scope="col">Trasferidos</th> --><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Desistentes</th> <!--<th scope="col">Total</th>-->
                                                        </tr>
                                                        <tr>
                                                          <!--<th scope="col">Alunos</th> --><!--<th scope="col" colspan="2">Matriculados</th><th scope="col">Matriculados</th>--> <!--<th scope="col">Aprovados</th><th scope="col">Aprovados</th>--><!--<th scope="col">Reprovados</th><th scope="col">Reprovados</th>--><th scope="col" colspan="2" rowspan="1" style="vertical-align: middle;">Entrada</th><!--<th scope="col">Entrada</th> --> <th scope="col" colspan="2" rowspan="1" style="vertical-align: middle;">Saida</th><!--<th scope="col">Saida</th>--><!--<th scope="col">Total</th> <th scope="col">Total</th>-->
                                                        </tr>
                                                        <tr>
                                                          <th scope="col">Classe</th><th scope="col">MF</th><th scope="col">F</th> <th scope="col">MF</th><th scope="col">F</th> <th scope="col">MF</th><th scope="col">F</th><th scope="col">MF</th><th scope="col">F</th> <th scope="col">MF</th><th scope="col">F</th><th scope="col">MF</th><th scope="col">F</th><th scope="col">MF</th> <th scope="col">F</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                            <th scope="row">1ª</th>   <td class="col-1" id="Ta11"> {{ isset($aproveitamentoIITrimestre['a11']) ? $aproveitamentoIITrimestre['a11'] : '0' }} </td> <td class="col-1" id="Ta12"> {{  isset($aproveitamentoIITrimestre['a12']) ? $aproveitamentoIITrimestre['a12'] : '0' }}  </td> <td class="col-1" id="Ta13"> {{  isset($aproveitamentoIITrimestre['a13']) ? $aproveitamentoIITrimestre['a13'] : '0' }}  </td> <td class="col-1" id="Ta14"> {{ isset($aproveitamentoIITrimestre['a14']) ? $aproveitamentoIITrimestre['a14'] : '0' }}  </td> <td class="col-1" id="Ta15"> {{   isset($aproveitamentoIITrimestre['a15']) ? $aproveitamentoIITrimestre['a15'] : '0' }}  </td> <td class="col-1" id="Ta16"> {{  isset($aproveitamentoIITrimestre['a16']) ? $aproveitamentoIITrimestre['a16'] : '0' }}  </td> <td class="col-1" id="Ta17"> {{  isset($aproveitamentoIITrimestre['a17']) ? $aproveitamentoIITrimestre['a17'] : '0' }}  </td> <td class="col-1" id="Ta18"> {{ isset($aproveitamentoIITrimestre['a18']) ? $aproveitamentoIITrimestre['a18'] : '0' }}  </td> <td class="col-1" id="Ta19"> {{   isset($aproveitamentoIITrimestre['a19']) ? $aproveitamentoIITrimestre['a19'] : '0' }}  </td> <td class="col-1" id="Ta110"> {{   isset($aproveitamentoIITrimestre['a110']) ? $aproveitamentoIITrimestre['a110'] : '0' }}   </td> <td class="col-1" id="Ta111"> {{  isset($aproveitamentoIITrimestre['a111']) ? $aproveitamentoIITrimestre['a111'] : '0' }}   </td> <td class="col-1" id="Ta112"> {{  isset($aproveitamentoIITrimestre['a112']) ? $aproveitamentoIITrimestre['a112'] : '0' }}   </td> <td class="col-1" id="Ta113"> {{ isset($aproveitamentoIITrimestre['a113']) ? $aproveitamentoIITrimestre['a113'] : '0' }}  </td> <td class="col-1" id="Ta114"> {{  isset($aproveitamentoIITrimestre['a114']) ? $aproveitamentoIITrimestre['a114'] : '0' }}  </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2ª</th>   <td class="col-1" id="Ta21"> {{ isset($aproveitamentoIITrimestre['a21']) ? $aproveitamentoIITrimestre['a21'] : '0' }}  </td> <td class="col-1" id="Ta22"> {{   isset($aproveitamentoIITrimestre['a22']) ? $aproveitamentoIITrimestre['a22'] : '0' }}  </td> <td class="col-1" id="Ta23"> {{  isset($aproveitamentoIITrimestre['a23']) ? $aproveitamentoIITrimestre['a23'] : '0' }}  </td> <td class="col-1" id="Ta24"> {{  isset($aproveitamentoIITrimestre['a24']) ? $aproveitamentoIITrimestre['a24'] : '0' }}  </td> <td class="col-1" id="Ta25"> {{ isset($aproveitamentoIITrimestre['a25']) ? $aproveitamentoIITrimestre['a25'] : '0' }}  </td> <td class="col-1" id="Ta26"> {{   isset($aproveitamentoIITrimestre['a26']) ? $aproveitamentoIITrimestre['a26'] : '0' }}  </td> <td class="col-1" id="Ta27"> {{  isset($aproveitamentoIITrimestre['a27']) ? $aproveitamentoIITrimestre['a27'] : '0' }}  </td> <td class="col-1" id="Ta28"> {{  isset($aproveitamentoIITrimestre['a28']) ? $aproveitamentoIITrimestre['a28'] : '0' }}  </td> <td class="col-1" id="Ta29"> {{ isset($aproveitamentoIITrimestre['a29']) ? $aproveitamentoIITrimestre['a29'] : '0' }}  </td> <td class="col-1" id="Ta210"> {{  isset($aproveitamentoIITrimestre['a210']) ? $aproveitamentoIITrimestre['a210'] : '0' }}   </td> <td class="col-1" id="Ta211"> {{  isset($aproveitamentoIITrimestre['a211']) ? $aproveitamentoIITrimestre['a211'] : '0' }}   </td> <td class="col-1" id="Ta212"> {{ isset($aproveitamentoIITrimestre['a212']) ? $aproveitamentoIITrimestre['a212'] : '0' }}   </td> <td class="col-1" id="Ta213"> {{   isset($aproveitamentoIITrimestre['a213']) ? $aproveitamentoIITrimestre['a213'] : '0' }}  </td> <td class="col-1" id="Ta214"> {{   isset($aproveitamentoIITrimestre['a214']) ? $aproveitamentoIITrimestre['a214'] : '0' }}  </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">3ª</th>   <td class="col-1" id="Ta31"> {{ isset($aproveitamentoIITrimestre['a31']) ? $aproveitamentoIITrimestre['a31'] : '0' }}  </td> <td class="col-1" id="Ta32"> {{   isset($aproveitamentoIITrimestre['a32']) ? $aproveitamentoIITrimestre['a32'] : '0' }}  </td> <td class="col-1" id="Ta33"> {{  isset($aproveitamentoIITrimestre['a33']) ? $aproveitamentoIITrimestre['a33'] : '0' }}  </td> <td class="col-1" id="Ta34"> {{  isset($aproveitamentoIITrimestre['a34']) ? $aproveitamentoIITrimestre['a34'] : '0' }}  </td> <td class="col-1" id="Ta35"> {{ isset($aproveitamentoIITrimestre['a35']) ? $aproveitamentoIITrimestre['a35'] : '0' }}  </td> <td class="col-1" id="Ta36"> {{   isset($aproveitamentoIITrimestre['a36']) ? $aproveitamentoIITrimestre['a36'] : '0' }}  </td> <td class="col-1" id="Ta37"> {{  isset($aproveitamentoIITrimestre['a37']) ? $aproveitamentoIITrimestre['a37'] : '0' }}  </td> <td class="col-1" id="Ta38"> {{  isset($aproveitamentoIITrimestre['a38']) ? $aproveitamentoIITrimestre['a38'] : '0' }}  </td> <td class="col-1" id="Ta39"> {{ isset($aproveitamentoIITrimestre['a39']) ? $aproveitamentoIITrimestre['a39'] : '0' }}  </td> <td class="col-1" id="Ta310"> {{  isset($aproveitamentoIITrimestre['a310']) ? $aproveitamentoIITrimestre['a310'] : '0' }}   </td> <td class="col-1" id="Ta311"> {{  isset($aproveitamentoIITrimestre['a311']) ? $aproveitamentoIITrimestre['a311'] : '0' }}   </td> <td class="col-1" id="Ta312"> {{ isset($aproveitamentoIITrimestre['a312']) ? $aproveitamentoIITrimestre['a312'] : '0' }}   </td> <td class="col-1" id="Ta313"> {{   isset($aproveitamentoIITrimestre['a313']) ? $aproveitamentoIITrimestre['a313'] : '0' }}  </td> <td class="col-1" id="Ta314"> {{   isset($aproveitamentoIITrimestre['a314']) ? $aproveitamentoIITrimestre['a314'] : '0' }}  </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">4ª</th>   <td class="col-1" id="Ta41"> {{ isset($aproveitamentoIITrimestre['a41']) ? $aproveitamentoIITrimestre['a41'] : '0' }}  </td> <td class="col-1" id="Ta42"> {{   isset($aproveitamentoIITrimestre['a42']) ? $aproveitamentoIITrimestre['a42'] : '0' }}  </td> <td class="col-1" id="Ta43"> {{  isset($aproveitamentoIITrimestre['a43']) ? $aproveitamentoIITrimestre['a43'] : '0' }}  </td> <td class="col-1" id="Ta44"> {{  isset($aproveitamentoIITrimestre['a44']) ? $aproveitamentoIITrimestre['a44'] : '0' }}  </td> <td class="col-1" id="Ta45"> {{ isset($aproveitamentoIITrimestre['a45']) ? $aproveitamentoIITrimestre['a45'] : '0' }}  </td> <td class="col-1" id="Ta46"> {{   isset($aproveitamentoIITrimestre['a46']) ? $aproveitamentoIITrimestre['a46'] : '0' }}  </td> <td class="col-1" id="Ta47"> {{  isset($aproveitamentoIITrimestre['a47']) ? $aproveitamentoIITrimestre['a47'] : '0' }}  </td> <td class="col-1" id="Ta48"> {{  isset($aproveitamentoIITrimestre['a48']) ? $aproveitamentoIITrimestre['a48'] : '0' }}  </td> <td class="col-1" id="Ta49"> {{ isset($aproveitamentoIITrimestre['a49']) ? $aproveitamentoIITrimestre['a49'] : '0' }}  </td> <td class="col-1" id="Ta410"> {{  isset($aproveitamentoIITrimestre['a410']) ? $aproveitamentoIITrimestre['a410'] : '0' }}   </td> <td class="col-1" id="Ta411"> {{  isset($aproveitamentoIITrimestre['a411']) ? $aproveitamentoIITrimestre['a411'] : '0' }}   </td> <td class="col-1" id="Ta412"> {{ isset($aproveitamentoIITrimestre['a412']) ? $aproveitamentoIITrimestre['a412'] : '0' }}   </td> <td class="col-1" id="Ta413"> {{   isset($aproveitamentoIITrimestre['a413']) ? $aproveitamentoIITrimestre['a413'] : '0' }}  </td> <td class="col-1" id="Ta414"> {{   isset($aproveitamentoIITrimestre['a414']) ? $aproveitamentoIITrimestre['a414'] : '0' }}  </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">5ª</th>   <td class="col-1" id="Ta51"> {{ isset($aproveitamentoIITrimestre['a51']) ? $aproveitamentoIITrimestre['a51'] : '0' }}  </td> <td class="col-1" id="Ta52"> {{   isset($aproveitamentoIITrimestre['a52']) ? $aproveitamentoIITrimestre['a52'] : '0' }}  </td> <td class="col-1" id="Ta53"> {{  isset($aproveitamentoIITrimestre['a53']) ? $aproveitamentoIITrimestre['a53'] : '0' }}  </td> <td class="col-1" id="Ta54"> {{  isset($aproveitamentoIITrimestre['a54']) ? $aproveitamentoIITrimestre['a54'] : '0' }}  </td> <td class="col-1" id="Ta55"> {{ isset($aproveitamentoIITrimestre['a55']) ? $aproveitamentoIITrimestre['a55'] : '0' }}  </td> <td class="col-1" id="Ta56"> {{   isset($aproveitamentoIITrimestre['a56']) ? $aproveitamentoIITrimestre['a56'] : '0' }}  </td> <td class="col-1" id="Ta57"> {{  isset($aproveitamentoIITrimestre['a57']) ? $aproveitamentoIITrimestre['a57'] : '0' }}  </td> <td class="col-1" id="Ta58"> {{  isset($aproveitamentoIITrimestre['a58']) ? $aproveitamentoIITrimestre['a58'] : '0' }}  </td> <td class="col-1" id="Ta59"> {{ isset($aproveitamentoIITrimestre['a59']) ? $aproveitamentoIITrimestre['a59'] : '0' }}  </td> <td class="col-1" id="Ta510"> {{  isset($aproveitamentoIITrimestre['a510']) ? $aproveitamentoIITrimestre['a510'] : '0' }}   </td> <td class="col-1" id="Ta511"> {{  isset($aproveitamentoIITrimestre['a511']) ? $aproveitamentoIITrimestre['a511'] : '0' }}   </td> <td class="col-1" id="Ta512"> {{ isset($aproveitamentoIITrimestre['a512']) ? $aproveitamentoIITrimestre['a512'] : '0' }}   </td> <td class="col-1" id="Ta513"> {{   isset($aproveitamentoIITrimestre['a513']) ? $aproveitamentoIITrimestre['a513'] : '0' }}  </td> <td class="col-1" id="Ta514"> {{   isset($aproveitamentoIITrimestre['a514']) ? $aproveitamentoIITrimestre['a514'] : '0' }}  </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">6ª</th>   <td class="col-1" id="Ta61"> {{ isset($aproveitamentoIITrimestre['a61']) ? $aproveitamentoIITrimestre['a61'] : '0' }}  </td> <td class="col-1" id="Ta62"> {{   isset($aproveitamentoIITrimestre['a62']) ? $aproveitamentoIITrimestre['a62'] : '0' }}  </td> <td class="col-1" id="Ta63"> {{  isset($aproveitamentoIITrimestre['a63']) ? $aproveitamentoIITrimestre['a63'] : '0' }}  </td> <td class="col-1" id="Ta64"> {{  isset($aproveitamentoIITrimestre['a64']) ? $aproveitamentoIITrimestre['a64'] : '0' }}  </td> <td class="col-1" id="Ta65"> {{ isset($aproveitamentoIITrimestre['a65']) ? $aproveitamentoIITrimestre['a65'] : '0' }}  </td> <td class="col-1" id="Ta66"> {{   isset($aproveitamentoIITrimestre['a66']) ? $aproveitamentoIITrimestre['a66'] : '0' }}  </td> <td class="col-1" id="Ta67"> {{  isset($aproveitamentoIITrimestre['a67']) ? $aproveitamentoIITrimestre['a67'] : '0' }}  </td> <td class="col-1" id="Ta68"> {{  isset($aproveitamentoIITrimestre['a68']) ? $aproveitamentoIITrimestre['a68'] : '0' }}  </td> <td class="col-1" id="Ta69"> {{ isset($aproveitamentoIITrimestre['a69']) ? $aproveitamentoIITrimestre['a69'] : '0' }}  </td> <td class="col-1" id="Ta610"> {{  isset($aproveitamentoIITrimestre['a610']) ? $aproveitamentoIITrimestre['a610'] : '0' }}   </td> <td class="col-1" id="Ta611"> {{  isset($aproveitamentoIITrimestre['a611']) ? $aproveitamentoIITrimestre['a611'] : '0' }}   </td> <td class="col-1" id="Ta612"> {{ isset($aproveitamentoIITrimestre['a612']) ? $aproveitamentoIITrimestre['a612'] : '0' }}   </td> <td class="col-1" id="Ta613"> {{   isset($aproveitamentoIITrimestre['a613']) ? $aproveitamentoIITrimestre['a613'] : '0' }}  </td> <td class="col-1" id="Ta614"> {{   isset($aproveitamentoIITrimestre['a614']) ? $aproveitamentoIITrimestre['a614'] : '0' }}  </td>
                                                        </tr>
                                                        
                                                      </tbody>
                                                      <tfoot>
                                                        <tr class="bg-warning">
                                                          <th scope="row">Total</th>    <td id="TmatriculadosIAMF"> {{ isset($aproveitamentoIITrimestre['matriculadosIAMF']) ? $aproveitamentoIITrimestre['matriculadosIAMF'] : '0'}}   </td><td id="TmatriculadosIAF"> {{ isset($aproveitamentoIITrimestre['matriculadosIAF']) ? $aproveitamentoIITrimestre['matriculadosIAF'] : '0'}}   </td><td id="TmatriculadosFAMF">  {{ isset($aproveitamentoIITrimestre['matriculadosFAMF']) ? $aproveitamentoIITrimestre['matriculadosFAMF'] : '0'}}   </td><td id="TmatriculadosFAF">  {{ isset($aproveitamentoIITrimestre['matriculadosFAF']) ? $aproveitamentoIITrimestre['matriculadosFAF'] : '0'}}  </td><td id="TaprovadosMF"> {{ isset($aproveitamentoIITrimestre['aprovadosMF']) ? $aproveitamentoIITrimestre['aprovadosMF'] : '0'}}    </td><td id="TaprovadosF"> {{ isset($aproveitamentoIITrimestre['aprovadosF']) ? $aproveitamentoIITrimestre['aprovadosF'] : '0'}}    </td> <td id="TreprovadosMF">  {{ isset($aproveitamentoIITrimestre['reprovadosMF']) ? $aproveitamentoIITrimestre['reprovadosMF'] : '0'}}   </td> <td id="TreprovadosF"> {{ isset($aproveitamentoIITrimestre['reprovadosF']) ? $aproveitamentoIITrimestre['reprovadosF'] : '0'}}  </td> <td id="TtransferidosEMF"> {{ isset($aproveitamentoIITrimestre['transferidosEMF']) ? $aproveitamentoIITrimestre['transferidosEMF'] : '0'}}   </td> <td id="TtransferidosEF"> {{ isset($aproveitamentoIITrimestre['transferidosEF']) ? $aproveitamentoIITrimestre['transferidosEF'] : '0'}}   </td> <td id="TtransferidosSMF">  {{ isset($aproveitamentoIITrimestre['transferidosSMF']) ? $aproveitamentoIITrimestre['transferidosSMF'] : '0'}}   </td> <td id="TtransferidosSF">  {{ isset($aproveitamentoIITrimestre['transferidosSF']) ? $aproveitamentoIITrimestre['transferidosSF'] : '0'}}  </td> <td id="TdesistentesMF">  {{ isset($aproveitamentoIITrimestre['desistentesMF']) ? $aproveitamentoIITrimestre['desistentesMF'] : '0'}}   </td> <td id="TdesistentesF">  {{ isset($aproveitamentoIITrimestre['desistentesF']) ? $aproveitamentoIITrimestre['desistentesF'] : '0'}}   </td>
                                                        </tr>
                                                      </tfoot>
                                                  </table>
                                                </div>
                                                </div>
                                                <div class="card-footer">

                                                </div>
                                              </div>
                                            @else
                                            <h4 class="text-info"> Não Foram Submetidos Formulário para o II Trimestre. </h4>
                                            @endif

                                            <!-- /.CardContet -->
                             
                                        </div>
                                      <!-- /tab-pane -->
                                      <!--tab-pane -->
                                          <div class="tab-pane" id="IIITrimestre">
                                            <!-- Formulario III  Trimestre -->
                                            @if (isset($aproveitamentoIIITrimestre))
                                              <div class="card card-primary">
                                                <div class="card-header">
                                                  <h3 class="card-title">
                                                    Aproveitamento escolar do III Trimestre
                                                  </h3>
                                                </div>
                                                <div class="card-body">
                                                  <div class="table-responsive">
                                                    <table class="table table-hover table-bordered border-secondary table-striped" style="text-align:center;">
                                                        <thead class="bg-primary">
                                                          <tr>
                                                            <th scope="col" rowspan="2" colspan="1" style=" vertical-align:middle" >Alunos</th><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Matriculados no Início do Ano Lectivo</th><!--<th scope="col">Matriculados</th>--> <th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Matriculados no Final do Ano Lectivo</th><!--<th scope="col">Matriculados</th>--><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Aprovados</th><!--<th scope="col">Aprovados</th>--><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Reprovados</th><!--<th scope="col">Reprovados</th>--><th scope="col" colspan="4" rowspan="1" style="vertical-align: middle;">Trasferidos</th><!--<th scope="col">Trasferidos</th><th scope="col">Trasferidos</th><th scope="col">Trasferidos</th> --><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Desistentes</th> <!--<th scope="col">Total</th>-->
                                                          </tr>
                                                          <tr>
                                                            <!--<th scope="col">Alunos</th> --><!--<th scope="col" colspan="2">Matriculados</th><th scope="col">Matriculados</th>--> <!--<th scope="col">Aprovados</th><th scope="col">Aprovados</th>--><!--<th scope="col">Reprovados</th><th scope="col">Reprovados</th>--><th scope="col" colspan="2" rowspan="1" style="vertical-align: middle;">Entrada</th><!--<th scope="col">Entrada</th> --> <th scope="col" colspan="2" rowspan="1" style="vertical-align: middle;">Saida</th><!--<th scope="col">Saida</th>--><!--<th scope="col">Total</th> <th scope="col">Total</th>-->
                                                          </tr>
                                                          <tr>
                                                            <th scope="col">Classe</th><th scope="col">MF</th><th scope="col">F</th> <th scope="col">MF</th><th scope="col">F</th> <th scope="col">MF</th><th scope="col">F</th><th scope="col">MF</th><th scope="col">F</th> <th scope="col">MF</th><th scope="col">F</th><th scope="col">MF</th><th scope="col">F</th><th scope="col">MF</th> <th scope="col">F</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                              <th scope="row">1ª</th>   <td class="col-1" id="Ta11"> {{ isset($aproveitamentoIIITrimestre['a11']) ? $aproveitamentoIIITrimestre['a11'] : '0' }} </td> <td class="col-1" id="Ta12"> {{  isset($aproveitamentoIIITrimestre['a12']) ? $aproveitamentoIIITrimestre['a12'] : '0' }}  </td> <td class="col-1" id="Ta13"> {{  isset($aproveitamentoIIITrimestre['a13']) ? $aproveitamentoIIITrimestre['a13'] : '0' }}  </td> <td class="col-1" id="Ta14"> {{ isset($aproveitamentoIIITrimestre['a14']) ? $aproveitamentoIIITrimestre['a14'] : '0' }}  </td> <td class="col-1" id="Ta15"> {{   isset($aproveitamentoIIITrimestre['a15']) ? $aproveitamentoIIITrimestre['a15'] : '0' }}  </td> <td class="col-1" id="Ta16"> {{  isset($aproveitamentoIIITrimestre['a16']) ? $aproveitamentoIIITrimestre['a16'] : '0' }}  </td> <td class="col-1" id="Ta17"> {{  isset($aproveitamentoIIITrimestre['a17']) ? $aproveitamentoIIITrimestre['a17'] : '0' }}  </td> <td class="col-1" id="Ta18"> {{ isset($aproveitamentoIIITrimestre['a18']) ? $aproveitamentoIIITrimestre['a18'] : '0' }}  </td> <td class="col-1" id="Ta19"> {{   isset($aproveitamentoIIITrimestre['a19']) ? $aproveitamentoIIITrimestre['a19'] : '0' }}  </td> <td class="col-1" id="Ta110"> {{   isset($aproveitamentoIIITrimestre['a110']) ? $aproveitamentoIIITrimestre['a110'] : '0' }}   </td> <td class="col-1" id="Ta111"> {{  isset($aproveitamentoIIITrimestre['a111']) ? $aproveitamentoIIITrimestre['a111'] : '0' }}   </td> <td class="col-1" id="Ta112"> {{  isset($aproveitamentoIIITrimestre['a112']) ? $aproveitamentoIIITrimestre['a112'] : '0' }}   </td> <td class="col-1" id="Ta113"> {{ isset($aproveitamentoIIITrimestre['a113']) ? $aproveitamentoIIITrimestre['a113'] : '0' }}  </td> <td class="col-1" id="Ta114"> {{  isset($aproveitamentoIIITrimestre['a114']) ? $aproveitamentoIIITrimestre['a114'] : '0' }}  </td>
                                                          </tr>
                                                          <tr>
                                                              <th scope="row">2ª</th>   <td class="col-1" id="Ta21"> {{ isset($aproveitamentoIIITrimestre['a21']) ? $aproveitamentoIIITrimestre['a21'] : '0' }}  </td> <td class="col-1" id="Ta22"> {{   isset($aproveitamentoIIITrimestre['a22']) ? $aproveitamentoIIITrimestre['a22'] : '0' }}  </td> <td class="col-1" id="Ta23"> {{  isset($aproveitamentoIIITrimestre['a23']) ? $aproveitamentoIIITrimestre['a23'] : '0' }}  </td> <td class="col-1" id="Ta24"> {{  isset($aproveitamentoIIITrimestre['a24']) ? $aproveitamentoIIITrimestre['a24'] : '0' }}  </td> <td class="col-1" id="Ta25"> {{ isset($aproveitamentoIIITrimestre['a25']) ? $aproveitamentoIIITrimestre['a25'] : '0' }}  </td> <td class="col-1" id="Ta26"> {{   isset($aproveitamentoIIITrimestre['a26']) ? $aproveitamentoIIITrimestre['a26'] : '0' }}  </td> <td class="col-1" id="Ta27"> {{  isset($aproveitamentoIIITrimestre['a27']) ? $aproveitamentoIIITrimestre['a27'] : '0' }}  </td> <td class="col-1" id="Ta28"> {{  isset($aproveitamentoIIITrimestre['a28']) ? $aproveitamentoIIITrimestre['a28'] : '0' }}  </td> <td class="col-1" id="Ta29"> {{ isset($aproveitamentoIIITrimestre['a29']) ? $aproveitamentoIIITrimestre['a29'] : '0' }}  </td> <td class="col-1" id="Ta210"> {{  isset($aproveitamentoIIITrimestre['a210']) ? $aproveitamentoIIITrimestre['a210'] : '0' }}   </td> <td class="col-1" id="Ta211"> {{  isset($aproveitamentoIIITrimestre['a211']) ? $aproveitamentoIIITrimestre['a211'] : '0' }}   </td> <td class="col-1" id="Ta212"> {{ isset($aproveitamentoIIITrimestre['a212']) ? $aproveitamentoIIITrimestre['a212'] : '0' }}   </td> <td class="col-1" id="Ta213"> {{   isset($aproveitamentoIIITrimestre['a213']) ? $aproveitamentoIIITrimestre['a213'] : '0' }}  </td> <td class="col-1" id="Ta214"> {{   isset($aproveitamentoIIITrimestre['a214']) ? $aproveitamentoIIITrimestre['a214'] : '0' }}  </td>
                                                          </tr>
                                                          <tr>
                                                              <th scope="row">3ª</th>   <td class="col-1" id="Ta31"> {{ isset($aproveitamentoIIITrimestre['a31']) ? $aproveitamentoIIITrimestre['a31'] : '0' }}  </td> <td class="col-1" id="Ta32"> {{   isset($aproveitamentoIIITrimestre['a32']) ? $aproveitamentoIIITrimestre['a32'] : '0' }}  </td> <td class="col-1" id="Ta33"> {{  isset($aproveitamentoIIITrimestre['a33']) ? $aproveitamentoIIITrimestre['a33'] : '0' }}  </td> <td class="col-1" id="Ta34"> {{  isset($aproveitamentoIIITrimestre['a34']) ? $aproveitamentoIIITrimestre['a34'] : '0' }}  </td> <td class="col-1" id="Ta35"> {{ isset($aproveitamentoIIITrimestre['a35']) ? $aproveitamentoIIITrimestre['a35'] : '0' }}  </td> <td class="col-1" id="Ta36"> {{   isset($aproveitamentoIIITrimestre['a36']) ? $aproveitamentoIIITrimestre['a36'] : '0' }}  </td> <td class="col-1" id="Ta37"> {{  isset($aproveitamentoIIITrimestre['a37']) ? $aproveitamentoIIITrimestre['a37'] : '0' }}  </td> <td class="col-1" id="Ta38"> {{  isset($aproveitamentoIIITrimestre['a38']) ? $aproveitamentoIIITrimestre['a38'] : '0' }}  </td> <td class="col-1" id="Ta39"> {{ isset($aproveitamentoIIITrimestre['a39']) ? $aproveitamentoIIITrimestre['a39'] : '0' }}  </td> <td class="col-1" id="Ta310"> {{  isset($aproveitamentoIIITrimestre['a310']) ? $aproveitamentoIIITrimestre['a310'] : '0' }}   </td> <td class="col-1" id="Ta311"> {{  isset($aproveitamentoIIITrimestre['a311']) ? $aproveitamentoIIITrimestre['a311'] : '0' }}   </td> <td class="col-1" id="Ta312"> {{ isset($aproveitamentoIIITrimestre['a312']) ? $aproveitamentoIIITrimestre['a312'] : '0' }}   </td> <td class="col-1" id="Ta313"> {{   isset($aproveitamentoIIITrimestre['a313']) ? $aproveitamentoIIITrimestre['a313'] : '0' }}  </td> <td class="col-1" id="Ta314"> {{   isset($aproveitamentoIIITrimestre['a314']) ? $aproveitamentoIIITrimestre['a314'] : '0' }}  </td>
                                                          </tr>
                                                          <tr>
                                                              <th scope="row">4ª</th>   <td class="col-1" id="Ta41"> {{ isset($aproveitamentoIIITrimestre['a41']) ? $aproveitamentoIIITrimestre['a41'] : '0' }}  </td> <td class="col-1" id="Ta42"> {{   isset($aproveitamentoIIITrimestre['a42']) ? $aproveitamentoIIITrimestre['a42'] : '0' }}  </td> <td class="col-1" id="Ta43"> {{  isset($aproveitamentoIIITrimestre['a43']) ? $aproveitamentoIIITrimestre['a43'] : '0' }}  </td> <td class="col-1" id="Ta44"> {{  isset($aproveitamentoIIITrimestre['a44']) ? $aproveitamentoIIITrimestre['a44'] : '0' }}  </td> <td class="col-1" id="Ta45"> {{ isset($aproveitamentoIIITrimestre['a45']) ? $aproveitamentoIIITrimestre['a45'] : '0' }}  </td> <td class="col-1" id="Ta46"> {{   isset($aproveitamentoIIITrimestre['a46']) ? $aproveitamentoIIITrimestre['a46'] : '0' }}  </td> <td class="col-1" id="Ta47"> {{  isset($aproveitamentoIIITrimestre['a47']) ? $aproveitamentoIIITrimestre['a47'] : '0' }}  </td> <td class="col-1" id="Ta48"> {{  isset($aproveitamentoIIITrimestre['a48']) ? $aproveitamentoIIITrimestre['a48'] : '0' }}  </td> <td class="col-1" id="Ta49"> {{ isset($aproveitamentoIIITrimestre['a49']) ? $aproveitamentoIIITrimestre['a49'] : '0' }}  </td> <td class="col-1" id="Ta410"> {{  isset($aproveitamentoIIITrimestre['a410']) ? $aproveitamentoIIITrimestre['a410'] : '0' }}   </td> <td class="col-1" id="Ta411"> {{  isset($aproveitamentoIIITrimestre['a411']) ? $aproveitamentoIIITrimestre['a411'] : '0' }}   </td> <td class="col-1" id="Ta412"> {{ isset($aproveitamentoIIITrimestre['a412']) ? $aproveitamentoIIITrimestre['a412'] : '0' }}   </td> <td class="col-1" id="Ta413"> {{   isset($aproveitamentoIIITrimestre['a413']) ? $aproveitamentoIIITrimestre['a413'] : '0' }}  </td> <td class="col-1" id="Ta414"> {{   isset($aproveitamentoIIITrimestre['a414']) ? $aproveitamentoIIITrimestre['a414'] : '0' }}  </td>
                                                          </tr>
                                                          <tr>
                                                              <th scope="row">5ª</th>   <td class="col-1" id="Ta51"> {{ isset($aproveitamentoIIITrimestre['a51']) ? $aproveitamentoIIITrimestre['a51'] : '0' }}  </td> <td class="col-1" id="Ta52"> {{   isset($aproveitamentoIIITrimestre['a52']) ? $aproveitamentoIIITrimestre['a52'] : '0' }}  </td> <td class="col-1" id="Ta53"> {{  isset($aproveitamentoIIITrimestre['a53']) ? $aproveitamentoIIITrimestre['a53'] : '0' }}  </td> <td class="col-1" id="Ta54"> {{  isset($aproveitamentoIIITrimestre['a54']) ? $aproveitamentoIIITrimestre['a54'] : '0' }}  </td> <td class="col-1" id="Ta55"> {{ isset($aproveitamentoIIITrimestre['a55']) ? $aproveitamentoIIITrimestre['a55'] : '0' }}  </td> <td class="col-1" id="Ta56"> {{   isset($aproveitamentoIIITrimestre['a56']) ? $aproveitamentoIIITrimestre['a56'] : '0' }}  </td> <td class="col-1" id="Ta57"> {{  isset($aproveitamentoIIITrimestre['a57']) ? $aproveitamentoIIITrimestre['a57'] : '0' }}  </td> <td class="col-1" id="Ta58"> {{  isset($aproveitamentoIIITrimestre['a58']) ? $aproveitamentoIIITrimestre['a58'] : '0' }}  </td> <td class="col-1" id="Ta59"> {{ isset($aproveitamentoIIITrimestre['a59']) ? $aproveitamentoIIITrimestre['a59'] : '0' }}  </td> <td class="col-1" id="Ta510"> {{  isset($aproveitamentoIIITrimestre['a510']) ? $aproveitamentoIIITrimestre['a510'] : '0' }}   </td> <td class="col-1" id="Ta511"> {{  isset($aproveitamentoIIITrimestre['a511']) ? $aproveitamentoIIITrimestre['a511'] : '0' }}   </td> <td class="col-1" id="Ta512"> {{ isset($aproveitamentoIIITrimestre['a512']) ? $aproveitamentoIIITrimestre['a512'] : '0' }}   </td> <td class="col-1" id="Ta513"> {{   isset($aproveitamentoIIITrimestre['a513']) ? $aproveitamentoIIITrimestre['a513'] : '0' }}  </td> <td class="col-1" id="Ta514"> {{   isset($aproveitamentoIIITrimestre['a514']) ? $aproveitamentoIIITrimestre['a514'] : '0' }}  </td>
                                                          </tr>
                                                          <tr>
                                                              <th scope="row">6ª</th>   <td class="col-1" id="Ta61"> {{ isset($aproveitamentoIIITrimestre['a61']) ? $aproveitamentoIIITrimestre['a61'] : '0' }}  </td> <td class="col-1" id="Ta62"> {{   isset($aproveitamentoIIITrimestre['a62']) ? $aproveitamentoIIITrimestre['a62'] : '0' }}  </td> <td class="col-1" id="Ta63"> {{  isset($aproveitamentoIIITrimestre['a63']) ? $aproveitamentoIIITrimestre['a63'] : '0' }}  </td> <td class="col-1" id="Ta64"> {{  isset($aproveitamentoIIITrimestre['a64']) ? $aproveitamentoIIITrimestre['a64'] : '0' }}  </td> <td class="col-1" id="Ta65"> {{ isset($aproveitamentoIIITrimestre['a65']) ? $aproveitamentoIIITrimestre['a65'] : '0' }}  </td> <td class="col-1" id="Ta66"> {{   isset($aproveitamentoIIITrimestre['a66']) ? $aproveitamentoIIITrimestre['a66'] : '0' }}  </td> <td class="col-1" id="Ta67"> {{  isset($aproveitamentoIIITrimestre['a67']) ? $aproveitamentoIIITrimestre['a67'] : '0' }}  </td> <td class="col-1" id="Ta68"> {{  isset($aproveitamentoIIITrimestre['a68']) ? $aproveitamentoIIITrimestre['a68'] : '0' }}  </td> <td class="col-1" id="Ta69"> {{ isset($aproveitamentoIIITrimestre['a69']) ? $aproveitamentoIIITrimestre['a69'] : '0' }}  </td> <td class="col-1" id="Ta610"> {{  isset($aproveitamentoIIITrimestre['a610']) ? $aproveitamentoIIITrimestre['a610'] : '0' }}   </td> <td class="col-1" id="Ta611"> {{  isset($aproveitamentoIIITrimestre['a611']) ? $aproveitamentoIIITrimestre['a611'] : '0' }}   </td> <td class="col-1" id="Ta612"> {{ isset($aproveitamentoIIITrimestre['a612']) ? $aproveitamentoIIITrimestre['a612'] : '0' }}   </td> <td class="col-1" id="Ta613"> {{   isset($aproveitamentoIIITrimestre['a613']) ? $aproveitamentoIIITrimestre['a613'] : '0' }}  </td> <td class="col-1" id="Ta614"> {{   isset($aproveitamentoIIITrimestre['a614']) ? $aproveitamentoIIITrimestre['a614'] : '0' }}  </td>
                                                          </tr>
                                                          
                                                        </tbody>
                                                        <tfoot>
                                                          <tr class="bg-warning">
                                                            <th scope="row">Total</th>    <td id="TmatriculadosIAMF"> {{ isset($aproveitamentoIIITrimestre['matriculadosIAMF']) ? $aproveitamentoIIITrimestre['matriculadosIAMF'] : '0'}}   </td><td id="TmatriculadosIAF"> {{ isset($aproveitamentoIIITrimestre['matriculadosIAF']) ? $aproveitamentoIIITrimestre['matriculadosIAF'] : '0'}}   </td><td id="TmatriculadosFAMF">  {{ isset($aproveitamentoIIITrimestre['matriculadosFAMF']) ? $aproveitamentoIIITrimestre['matriculadosFAMF'] : '0'}}   </td><td id="TmatriculadosFAF">  {{ isset($aproveitamentoIIITrimestre['matriculadosFAF']) ? $aproveitamentoIIITrimestre['matriculadosFAF'] : '0'}}  </td><td id="TaprovadosMF"> {{ isset($aproveitamentoIIITrimestre['aprovadosMF']) ? $aproveitamentoIIITrimestre['aprovadosMF'] : '0'}}    </td><td id="TaprovadosF"> {{ isset($aproveitamentoIIITrimestre['aprovadosF']) ? $aproveitamentoIIITrimestre['aprovadosF'] : '0'}}    </td> <td id="TreprovadosMF">  {{ isset($aproveitamentoIIITrimestre['reprovadosMF']) ? $aproveitamentoIIITrimestre['reprovadosMF'] : '0'}}   </td> <td id="TreprovadosF"> {{ isset($aproveitamentoIIITrimestre['reprovadosF']) ? $aproveitamentoIIITrimestre['reprovadosF'] : '0'}}  </td> <td id="TtransferidosEMF"> {{ isset($aproveitamentoIIITrimestre['transferidosEMF']) ? $aproveitamentoIIITrimestre['transferidosEMF'] : '0'}}   </td> <td id="TtransferidosEF"> {{ isset($aproveitamentoIIITrimestre['transferidosEF']) ? $aproveitamentoIIITrimestre['transferidosEF'] : '0'}}   </td> <td id="TtransferidosSMF">  {{ isset($aproveitamentoIIITrimestre['transferidosSMF']) ? $aproveitamentoIIITrimestre['transferidosSMF'] : '0'}}   </td> <td id="TtransferidosSF">  {{ isset($aproveitamentoIIITrimestre['transferidosSF']) ? $aproveitamentoIIITrimestre['transferidosSF'] : '0'}}  </td> <td id="TdesistentesMF">  {{ isset($aproveitamentoIIITrimestre['desistentesMF']) ? $aproveitamentoIIITrimestre['desistentesMF'] : '0'}}   </td> <td id="TdesistentesF">  {{ isset($aproveitamentoIIITrimestre['desistentesF']) ? $aproveitamentoIIITrimestre['desistentesF'] : '0'}}   </td>
                                                          </tr>
                                                        </tfoot>
                                                    </table>
                                                  </div>
                                                </div>
                                                <div class="card-footer">

                                                </div>
                                              </div>
                                            @else
                                            <h4 class="text-info"> Não Foram Submetidos Formulário para o III Trimestre. </h4>
                                            @endif                                    
                                       
                                           

                                            <!-- /.CardContet -->
                                        
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
        <!--/Aproveitamento Grafico-->
        <!--Grafico de Barras -->
        <script>
              // Sample data
              const data = {
                  labels: ['I Trimestre', 'II Trimestre', 'III Trimestre'],
                  datasets: [
                      {
                          label: 'Aprovados',
                          data: [("{{ isset($aproveitamentoITrimestre['aprovadosMF']) ? $aproveitamentoITrimestre['aprovadosMF'] : '0' }}"*100)/("{{ isset($aproveitamentoITrimestre['matriculadosIAMF']) ? $aproveitamentoITrimestre['matriculadosIAMF'] : '0'}}"), ("{{ isset($aproveitamentoIITrimestre['aprovadosMF']) ? $aproveitamentoIITrimestre['aprovadosMF'] : '0' }}"*100)/("{{ isset($aproveitamentoIITrimestre['matriculadosIAMF']) ? $aproveitamentoIITrimestre['matriculadosIAMF'] : '0'}}"), ("{{ isset($aproveitamentoIIITrimestre['aprovadosMF']) ? $aproveitamentoIIITrimestre['aprovadosMF'] : '0' }}"*100)/("{{ isset($aproveitamentoIIITrimestre['matriculadosIAMF']) ? $aproveitamentoIIITrimestre['matriculadosIAMF'] : '0'}}")],
                          backgroundColor: 'rgba(75, 192, 192, 0.6)',
                          borderColor: 'rgba(75, 192, 192, 1)',
                          borderWidth: 2,
                      },
                      {
                          label: 'Reprovados',
                          
                          data: [("{{ isset($aproveitamentoITrimestre['reprovadosMF']) ? $aproveitamentoITrimestre['reprovadosMF'] : '0' }}"*100)/("{{ isset($aproveitamentoITrimestre['matriculadosIAMF']) ? $aproveitamentoITrimestre['matriculadosIAMF'] : '0'}}"), ("{{ isset($aproveitamentoIITrimestre['reprovadosMF']) ? $aproveitamentoIITrimestre['reprovadosMF'] : '0' }}"*100)/("{{ isset($aproveitamentoIITrimestre['matriculadosIAMF']) ? $aproveitamentoIITrimestre['matriculadosIAMF'] : '0'}}"), ("{{ isset($aproveitamentoIIITrimestre['reprovadosMF']) ? $aproveitamentoIIITrimestre['reprovadosMF'] : '0' }}"*100)/("{{ isset($aproveitamentoIIITrimestre['matriculadosIAMF']) ? $aproveitamentoIIITrimestre['matriculadosIAMF'] : '0'}}")],
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
                              stacked: true,
                          },
                          y: {
                              stacked: true,
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
                  pointRadius: true,
                  pointColor: '#3b8bba',
                  pointStrokeColor: 'rgba(60,141,188,1)',
                  pointHighlightFill: '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data: [("{{ isset($aproveitamentoITrimestre['aprovadosMF']) ? $aproveitamentoITrimestre['aprovadosMF'] : '0' }}"*100)/("{{ isset($aproveitamentoITrimestre['matriculadosIAMF']) ? $aproveitamentoITrimestre['matriculadosIAMF'] : '0'}}"), ("{{ isset($aproveitamentoIITrimestre['aprovadosMF']) ? $aproveitamentoIITrimestre['aprovadosMF'] : '0' }}"*100)/("{{ isset($aproveitamentoIITrimestre['matriculadosIAMF']) ? $aproveitamentoIITrimestre['matriculadosIAMF'] : '0'}}"), ("{{ isset($aproveitamentoIIITrimestre['aprovadosMF']) ? $aproveitamentoIIITrimestre['aprovadosMF'] : '0' }}"*100)/("{{ isset($aproveitamentoIIITrimestre['matriculadosIAMF']) ? $aproveitamentoIIITrimestre['matriculadosIAMF'] : '0'}}")],
                },
                {
                  label: 'Reprovados',
                  backgroundColor: 'rgba(210, 214, 222, 1)',
                  borderColor: 'rgba(210, 214, 222, 1)',
                  pointRadius: true,
                  pointColor: 'rgba(210, 214, 222, 1)',
                  pointStrokeColor: '#c1c7d1',
                  pointHighlightFill: '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data: [("{{ isset($aproveitamentoITrimestre['reprovadosMF']) ? $aproveitamentoITrimestre['reprovadosMF'] : '0' }}"*100)/("{{ isset($aproveitamentoITrimestre['matriculadosIAMF']) ? $aproveitamentoITrimestre['matriculadosIAMF'] : '0'}}"), ("{{ isset($aproveitamentoIITrimestre['reprovadosMF']) ? $aproveitamentoIITrimestre['reprovadosMF'] : '0' }}"*100)/("{{ isset($aproveitamentoIITrimestre['matriculadosIAMF']) ? $aproveitamentoIITrimestre['matriculadosIAMF'] : '0'}}"), ("{{ isset($aproveitamentoIIITrimestre['reprovadosMF']) ? $aproveitamentoIIITrimestre['reprovadosMF'] : '0' }}"*100)/("{{ isset($aproveitamentoIIITrimestre['matriculadosIAMF']) ? $aproveitamentoIIITrimestre['matriculadosIAMF'] : '0'}}")],
                }
              ]
            }

            var salesChartOptions = {
              maintainAspectRatio: true,
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
