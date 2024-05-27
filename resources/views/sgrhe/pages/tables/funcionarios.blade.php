@php
  setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
@endphp
<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , $titulo )
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
                      <h1>{{ $titulo }} </h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $titulo }} </li>
                      </ol>
                    </div>
                  </div>
                </div><!-- /.container-fluid -->
              </section>

              <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div style="padding:10px; border-radius:5px; " class="col-12">
                      <div style="background-color: #ffffff;" class="card card-primary">

                          <div class="card-header">
                                <h3 class="card-title">{{ $titulo }} </h3>  
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
                                  <th>Validade do BI</th>
                                  <th>Unidade Orgânica</th>
                                  <th>Categoria Funcionário</th>
                                  <th>Cargo</th>
                                  <th>Data de Admissão</th>
                                  <th>Email</th>
                                  <th>IBAN</th>
                                  <th>Data Nascimento</th>
                                  <th>Genêro</th>
                                  <th>Grupo Sanguíneo</th>
                                  <th>Estado Civíl</th>
                                  <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!--Gerando a Tabela de forma Dinamica-->
                                @foreach ($dados as $funcionario)
                                              <tr>
                                                  <td class="{{ ($funcionario->estado =='Activo') ? 'text-success' : '' }} {{ ($funcionario->estado =='Inactivo') ? 'text-danger' : '' }} {{ ($funcionario->estado =='Inactivo') ? 'text-danger' : '' }} {{ ($funcionario->estado =='Dispensado') ? 'text-warning' : '' }} {{ ($funcionario->estado =='Ferias') ? 'text-secondary' : '' }}" style="font-weight: bolder;">{{ $funcionario->estado }}</td>
                                                  <td>{{ $funcionario->numeroAgente }}</td>
                                                  <td>{{ $funcionario->nomeCompleto }}</td>
                                                  <td>{{ $funcionario->numeroBI }}</td>
                                                  @php
                                                    $data = \Carbon\Carbon::parse($funcionario->validadeBI);
                                                    $class = $data->gt(now()) ? 'text-success' : 'text-danger';
                                                  @endphp
                                                  <td class="{{ $class }}">{{ \Carbon\Carbon::parse($funcionario->validadeBI)->format('d/m/Y') }}</td>
                                                  <td>{{ $funcionario->designacao_unidadeOrganica }}</td>
                                                  <td>{{ $funcionario->categoria }}</td>
                                                  <td>{{ $funcionario->nomeCargo }}</td>
                                                  <td>{{ \Carbon\Carbon::parse($funcionario->dataAdmissao)->format('d/m/Y') }}</td>
                                                  <td>{{ $funcionario->email }}</td>
                                                  <td>{{ $funcionario->iban }}</td>
                                                  <td>{{ strftime('%d de %B de %Y', strtotime(\Carbon\Carbon::parse( $funcionario->dataNascimento ))) }} </td>
                                                  <td>{{ $funcionario->genero }}</td>
                                                  <td>{{ $funcionario->grupoSanguineo }}</td>
                                                  <td>{{ $funcionario->estadoCivil }}</td>
                                                  <td>
                                                      <form action="{{ route('perfil.show', ['idFuncionario' => $funcionario->id_funcionario]) }}" method="GET" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary w-100 m-1">Ver Perfil</button>
                                                      </form>
                                                      <form action="{{ route('funcionarios.form', ['id' => $funcionario->idPessoa]) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-warning w-100 m-1">Editar</button>
                                                      </form>
                                                      <form action="{{ route('eliminar.objecto') }}" method="POST" id="deleteForm{{ $funcionario->id_funcionario }}">
                                                          @csrf
                                                          @method('DELETE')
                                                          <input type="hidden" name="id" value="{{ $funcionario->id_funcionario }}">
                                                          <input type="hidden" name="categoria" value="Funcionario">
                                                          <button type="submit" class="btn btn-danger w-100 m-1" onclick="confirmAndSubmit(event, 'Confirmar deletar  Funcionário?', 'Sim, Deletar!', 'Não, Cancelar!')">Deletar</button>
                                                      </form>
                                                      <form action="{{ route('estado.funcionario') }}" method="POST" id="deleteForm{{ $funcionario->id_funcionario }}">
                                                          @csrf
                                                          @method('POST')
                                                          <input type="hidden" name="id" value="{{ $funcionario->id_funcionario }}">
                                                          <select name="estado" id="" class="form-control select2">
                                                            <option selected value="">Alterar o Estado do Funcionário</option>
                                                            <option class="text-success font-weight-bold" value="Activo">Activo</option>
                                                            <option class="text-info font-weight-bold" value="Licenca">Licença</option>
                                                            <option class="text-secondary font-weight-bold" value="Aposentado">Aposentado</option>
                                                            <option class="text-danger font-weight-bold" value="Inactivo">Inactivo</option>
                                                          </select>
                                                          <button type="submit" class="btn btn-secondary w-100 m-1" onclick="confirmAndSubmit(event, 'Confirmar Alterar o Estado do Funcionário?', 'Sim, Alterar!', 'Não, Cancelar!')">Alterar Stado</button>
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
                                  <th>Validade do BI</th>
                                  <th>Unidade Orgânica</th>
                                  <th>Categoria Funcionário</th>
                                  <th>Cargo</th>
                                  <th>Data de Admissão</th>
                                  <th>Email</th>
                                  <th>IBAN</th>
                                  <th>Data Nascimento</th>
                                  <th>Genêro</th>
                                  <th>Grupo Sanguíneo</th>
                                  <th>Estado Civíl</th>
                                  <th>Opções</th>
                                </tr>
                                </tfoot>
                              </table>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('funcionarios.form')}}" class="btn btn-primary d-block"> Cadastrar Funcionário</a>
                            </div>  <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </section>
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
            "buttons": ["excel", "pdf", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>
    @endsection
