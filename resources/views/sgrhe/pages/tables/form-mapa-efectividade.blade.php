<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'Funcionários / Index')
        @section('header')
        <!--Style Local-->
          <!-- DataTables -->
          <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
          <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
          <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
          <!-- Theme style -->
          <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
          <link rel="stylesheet" href="../../resources/css/app.css">
        @endsection
        @section('conteudo_principal')
          <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <section class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1>Compor Mapa de Efectividade referente à  {{ \Carbon\Carbon::parse($periodo)->format('d F Y') }}</h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Funcionários Força de Trabalho </li>
                      </ol>
                    </div>
                  </div>
                </div><!-- /.container-fluid -->
              </section>

              <!-- Main content -->
              <!--Funcionarios/Forca de Trabalho-->
                <section class="content">
                  <div class="container-fluid">
                    <div class="row">
                      <div style="padding:10px; border-radius:5px; " class="col-12">
                        <div style="background-color: #ffffff;" class="card card-primary">

                            <div class="card-header">
                                  <h3 class="card-title">Funcionário / Força de Trabaho</h3>  
                            </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                    <th>Número de Agente</th>
                                    <th>Nome Completo</th>
                                    <th>Nº de BI</th>
                                    <th>Validade do BI</th>
                                    <th>Unidade Orgânica</th>
                                    <th>Categoria Funcionário</th>
                                    <th>Data de Admissão</th>
                                    <th>Estado</th>
                                    <th>Opções</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <!--Gerando a Tabela de forma Dinamica-->
                                  @foreach ($funcionarios as $funcionario)
                                                <tr>
                                                    <td>{{ $funcionario->numeroAgente }}</td>
                                                    <td>{{ $funcionario->nomeCompleto }}</td>
                                                    <td>{{ $funcionario->numeroBI }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($funcionario->validadeBI)->format('d/m/Y') }}</td>
                                                    <td>{{ $funcionario->designacao }}</td>
                                                    <td>{{ $funcionario->categoria }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($funcionario->dataAdmissao)->format('d/m/Y')  }}</td>
                                                    <td>{{ $funcionario->estado }}</td>
                                                    <td>
                                                      <form action="{{ route('perfil.show', ['idFuncionario' => $funcionario->id_funcionario]) }}" method="GET" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary w-100 m-1">Ver Perfil</button>
                                                      </form>
                                                        <br>
                                                      <form action="{{ route('add.funcionario.efectividade') }}" method="GET" style="display: inline;">
                                                        @csrf
                                                        @method('GET')
                                                        <input type="hidden" name="numeroAgente" value="{{ $funcionario->numeroAgente }}">
                                                        <input type="hidden" name="nomeCompleto" value="{{ $funcionario->nomeCompleto }}">
                                                        <input type="hidden" name="numeroBI" value="{{ $funcionario->numeroBI }}">
                                                        <input type="hidden" name="unidadeOrganica" value="{{ $funcionario->designacao }}">
                                                        <input type="hidden" name="categoria" value="{{ $funcionario->categoria }}">
                                                        <input type="hidden" name="idMapaEfectividade" value="{{ $idMapaEfectividade }}">
                                                        <input type="hidden" name="estado" value="{{ $funcionario->estado }}">
                                                        <button type="submit" class="btn btn-success w-100 m-1">Adicionar Funcionário</button>
                                                      </form>
                                                    </td>
                                                </tr>
                                  @endforeach
                                  </tbody>
                                  <tfoot>
                                  <tr>
                                    <th>Número de Agente</th>
                                    <th>Nome Completo</th>
                                    <th>Nº de BI</th>
                                    <th>Validade do BI</th>
                                    <th>Unidade Orgânica</th>
                                    <th>Categoria Funcionário</th>
                                    <th>Data de Admissão</th>
                                    <th>Estado</th>
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
                </section>
              <!--Funcionarios/Forca de Trabalho-->
              

              <!--Formulario de Faltas-->
                 <section class="content">
                  <div class="container-fluid">
                    <div class="row">
                      <div style="padding:10px; border-radius:5px; " class="col-12">
                        <div style="background-color: #ffffff;" class="card card-primary">

                            <div class="card-header">
                                  <h3 class="card-title">Funcionário / Força de Trabaho</h3>  
                            </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                                <table id="formFaltas1" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                    <th>Número de Agente</th>
                                    <th>Nome Completo</th>
                                    <th>Unidade Orgânica</th>
                                    <th>Categoria Funcionário</th>
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
                                                    <td>{{ $funcionario->numeroAgente }}</td>
                                                    <td>{{ $funcionario->nomeCompleto }}</td>
                                                    <td>{{ $funcionario->designacao }}</td>
                                                    <td>{{ $funcionario->categoria }}</td>
                                                    <form action="{{ route('aplicar.faltas') }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('POST')
                                                    <td><input type="number" class="form-control text-center" name="Justificadas" id="Justificadas" min="0" max="22" value="{{ old('faltasJustificadas',$funcionario->faltasJustificadas ?? '') }}"></td>
                                                    <td><input type="number" class="form-control text-center" name="Injustificadas" id="Injustificadas" min="0" max="22" value="{{ old('faltasInjustificadas',$funcionario->faltasInjustificadas ?? '') }}"></td>
                                                    <td><textarea name="obs" class="form-control" cols="300" maxlength="250" >{{ old('obs',$funcionario->obs ?? '') }}</textarea></td> 
                                                    <td>
                                                            <input type="hidden" name="nomeCompleto" value="{{ $funcionario->nomeCompleto }}">
                                                            <input type="hidden" name="numeroAgente" value="{{ $funcionario->numeroAgente }}">
                                                            <input type="hidden" name="idMapaEfectividade" value="{{ $idMapaEfectividade }}">
                                                            <button type="submit" class="btn btn-success w-100 m-1"> Aplicar</button>
                                                      </form>
                                                      <br>
                                                      <form action="{{ route('remover.do.mapa.efectividade') }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" name="nomeCompleto" value="{{ $funcionario->nomeCompleto }}">
                                                            <input type="hidden" name="numeroAgente" value="{{ $funcionario->numeroAgente }}">
                                                            <input type="hidden" name="idMapaEfectividade" value="{{ $idMapaEfectividade }}">
                                                            <button type="submit" class="btn btn-danger w-100 m-1">Remover Funcionário</button>
                                                      </form>
                                                    </td>
                                                </tr>
                                  @endforeach
                                  </tbody>
                                  <tfoot>
                                  <tr>
                                    <th>Número de Agente</th>
                                    <th>Nome Completo</th>
                                    <th>Unidade Orgânica</th>
                                    <th>Categoria Funcionário</th> 
                                    <th>faltasJustificadas</th>
                                    <th>faltasInjustificadas</th>
                                    <th>OBS</th>
                                    <th>Opções</th>
                                  </tr>
                                  </tfoot>
                                </table>
                              </div>
                              <div class="card-footer">
                                <form action="{{ route('efectivar.mapa.efectividade') }}">
                                  <input type="hidden" name="idMapaEfectividade" value="{{ $idMapaEfectividade }}">
                                  <input type="hidden" name="categoria" value="MapaEfectividade">
                                  <button type="submit" style="font-weight: bold;" class="btn btn-primary w-100" onclick="confirmAndSubmit(event, 'Confirmar Submeter o Mapa de Efectividade?', 'Sim, Confirmar!', 'Não, Cancelar!')"> Efectivar o Mapa de Efectividade</button>
                                </form>
                              </div>  <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                </section>
              <!--Formulario de Faltas-->
              <!-- /.Main content -->

     
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
      <script>
        $(function () {
          $("#formFaltas1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#formFaltas1_wrapper .col-md-6:eq(0)');
          $('#formFaltas2').DataTable({
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
