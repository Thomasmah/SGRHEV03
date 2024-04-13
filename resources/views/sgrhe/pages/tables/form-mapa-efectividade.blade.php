<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'Criar Mapa de Efectividade')
        @section('header')
        <!--Style Local-->
          <!-- DataTables -->
          <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
          <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
          <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
          <!-- Theme style -->
          <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
          <link rel="stylesheet" href="../../resources/css/app.css">

          <style>
              input[type="numeric"]{
                border:1px solid #e0e0e0;
                width: 100%;
                max-width: 100%;
                box-sizing: border-box;
                border-radius: 5px;
                text-align: center;
              
              }
              .inputNumeric:hover{
                box-shadow: 0 0  3px 2px #007bff;
                transition: border-color 0.3;
              }
              .cell{          
                width: 100px;
              }
              .cell-left {
                background-color: #f0f0f0;
                padding: 20px;
                position: relative;
              }
              .cell-right {
                background-color: #fff;
                padding: 20px;
              }
          </style>
        @endsection
        @section('conteudo_principal')
          <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <section class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1>Constituir Mapa de Efectividade </h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Mapas de Efectividade </li>
                      </ol>
                    </div>
                  </div>
                </div><!-- /.container-fluid -->
              </section>

              <!-- Main content -->
            <!--Formulario Abrir Mapa-->
              <section class="content d-none">
                <div class="container-fluid">
                    <div class="row">
                      <div style="padding:10px; border-radius:5px; " class="col-12">
                        <div style="background-color: #ffffff;" class="card card-primary">
                          <div class="card-header">
                                <h3 class="card-title">Novo Mapa de Efectividade</h3>  
                          </div>
                          <div class="card-body">
                                  Corpo do Card
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </section>
            <!--Formulario Abrir Mapa-->
            <!--Funcionarios-->
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div style="padding:10px; border-radius:5px; " class="col-12">
                      <div style="background-color: #ffffff;" class="card card-primary">

                          <div class="card-header">
                                <h3 class="card-title">Funcionários / Força de Trabalho Geral</h3>  
                          </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                  <th>Estado</th>
                                  <th>Número de Agente</th>
                                  <th>Nome Completo</th>
                                  <th>Nº de BI</th>
                                  <th>Unidade Orgânica</th>
                                  <th>Categoria Funcionário</th>
                                  <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!--Gerando a Tabela de forma Dinamica-->
                                @foreach ($funcionarios as $funcionario)
                                              <tr>
                                                  <td>{{ $funcionario->estado }}</td>
                                                  <td>{{ $funcionario->numeroAgente }}</td>
                                                  <td>{{ $funcionario->nomeCompleto }}</td>
                                                  <td>{{ $funcionario->numeroBI }}</td>
                                                  <td>{{ $funcionario->designacao }}</td>
                                                  <td>{{ $funcionario->categoria }}</td>
                                                  <td>
                                                      <form action="{{ route('perfil.show', ['idFuncionario' => $funcionario->id_funcionario]) }}" method="GET" style="display: inline;">
                                                        @csrf
                                                      <button type="submit" class="btn btn-primary w-100 m-1">Ver Perfil</button>
                                                      </form>
                                                      <br>
                                                      <form action="{{ route('add.funcionario.efectividade') }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="numeroAgente" value="{{ $funcionario->numeroAgente }}">
                                                        <input type="hidden" name="nomeCompleto" value="{{ $funcionario->nomeCompleto }}">
                                                        <input type="hidden" name="numeroBI" value="{{ $funcionario->numeroBI }}">
                                                        <input type="hidden" name="unidadeOrganica" value="{{ $funcionario->designacao }}">
                                                        <input type="hidden" name="categoria" value="{{ $funcionario->categoria }}">
                                                        <input type="hidden" name="idMapaEfectividade" value="{{ $idMapaEfectividade }}">
                                                        <button type="submit" class="btn btn-success w-100 m-1">Adicionar</button>
                                                      </form>
                                                      <br>
                                                      <form action="{{ route('funcionarios.form', ['id' => $funcionario->idPessoa]) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-danger w-100 m-1">Remover</button>
                                                      </form>
                                                  </td>
                                              </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th>Estado</th>
                                  <th>Número de Agente</th>
                                  <th>Nome Completo</th>
                                  <th>Nº de BI</th>
                                  <th>Unidade Orgânica</th>
                                  <th>Categoria Funcionário</th>
                                  <th>Opções</th>
                                </tr>
                                </tfoot>
                              </table>
                            </div>
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
              </section>
            <!--/Funcionarios-->


            <!--Formulario Mapa Efectividade-->
              <section class="content">
                <div class="container-fluid">
                    <div class="row">
                      <div style="padding:10px; border-radius:5px; " class="col-12">
                        <div style="background-color: #ffffff;" class="card card-primary">
                          <div class="card-header">
                                <h3 class="card-title">Editar Mapa de Efectividade</h3>  
                          </div>
                          <div class="card-body">    
                            <p class="text-muted">OBS: Pesquise o funcionário pelo número de Agente ou número de BI.  Seleccione e Remova conforme os mapas das Unidades Orgânicas. </p>
                            <form action="#" method="POST" id="deleteForm">
                                @csrf
                                @method('POST')
                              <div class="table-responsive">
                              <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                  <th>Número de Ordem</th>
                                  <th>Número de Agente</th>
                                  <th>Nome Completo</th>
                                  <th>Unidade Orgânica</th>
                                  <th>Categoria do Funcionário</th>
                                  <th>faltasJustificadas</th>
                                  <th>faltasInjustificadas</th>
                                  <th>OBS</th>
                                  <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!--Gerando a Tabela de forma Dinamica-->
                                @foreach ($faltas as $funcionario)
                                              <tr>
                                                  <td>{{ $funcionario->numerOrdem }}</td>
                                                  <td>{{ $funcionario->numeroAgente }}</td>
                                                  <td>{{ $funcionario->nomeCompleto }}</td>
                                                  <td>{{ $funcionario->eqt }}</td>
                                                  <td>{{ $funcionario->categoria }}</td>
                                                  <td><input type="number" class="form-control text-center" name="faltasJustificadas" min="0" max="22" step="1" value=""></td>
                                                  <td><input type="number" class="form-control text-center" name="faltasInjustificadas" min="0" max="22" step="1" value=""></td>
                                                  <td><textarea name="obs" class="form-control" cols="300" maxlength="250"></textarea></td>

                                                  <td>
                                                      <form action="{{ route('aplicar.faltas') }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('POST')
                                                          <input type="hidden" name="numerOrdem" value="{{ $funcionario->numerOrdem }}">
                                                          <input type="hidden" name="numeroAgente" value="{{ $funcionario->numeroAgente }}">
                                                          <input type="hidden" name="nomeCompleto" value="{{ $funcionario->nomeCompleto }}">
                                                          <input type="hidden" name="eqt" value="{{ $funcionario->eqt }}">
                                                          <input type="hidden" name="categoria" value="{{ $funcionario->categoria }}">
                                                          <input type="hidden" name="" value="">
                                                          <input type="hidden" name="" value="">
                                                          
                                                        <button type="submit" class="btn btn-success w-100 m-1">Aplicar</button>
                                                      </form>
                                                      <form action="" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-danger w-100 m-1">Remover</button>
                                                      </form>
                                                  </td>
                                              </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th>Número de Ordem</th>
                                  <th>Número de Agente</th>
                                  <th>Nome Completo</th>
                                  <th>Unidade Orgânica</th>
                                  <th>Categoria do Funcionário</th>
                                  <th>faltasJustificadas</th>
                                  <th>faltasInjustificadas</th>
                                  <th>OBS</th>
                                  <th>Opções</th>
                                </tr>
                                </tfoot>
                              </table>
                              </div>
                              <!--Inputs Automaticos com dados da Unidade Organica etc..-->
                        
                              <input type="hidden" name="anoLectivo" value="2023-2024">
                              <button type="submit" style="font-weight: bold;" class="btn btn-primary w-100" onclick="confirmAndSubmit(event, 'Confirmar Submeter o Mapa de Efectividade?', 'Sim, Confirmar!', 'Não, Cancelar!')"> Efectivar o Mapa de Efectividade</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </section>
            <!--Formulario Mapa Efectividade-->

            </div>
          <!-- /.content-wrapper -->
          @endsection
    @section('scripts')
      <!-- DataTables  & Plugins -->
      <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
      <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      <script src="../../plugins/jszip/jszip.min.js"></script>
      <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
      <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
      <!--Algoritmo interactivo no processo de delectar Objectos em SweetAlert 2-->
      <script src="{{ asset('plugins/sweetalert2/alerta-deletar.js') }}"></script>
      <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>
    @endsection
