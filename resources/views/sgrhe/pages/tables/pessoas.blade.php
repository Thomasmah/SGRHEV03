<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'Pessoas / Index')
        @section('header')
        <!--Style Local-->
        @endsection
        @section('conteudo_principal')
          <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <section class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1>Pessoas </h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Entidades Pesoa</li>
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
                                <h3 class="card-title">Pessoas</h3>  
                          </div>
                        <!-- /.card-header -->
                        <!-- card-body -->
                          <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                <th>Nome Completo</th>
                                <th>Genero</th>
                                <th>Nome do Pai</th>
                                <th>Nome da Mãe</th>
                                <th>Grupo Sanguíneo</th>
                                <th>Nº de Bilhete de Identidade (BI)</th>
                                <th>Data Validade do Bilhete de Identidade</th>
                                <th>Estado Civil</th>
                                <th>Data Nascimento</th>
                                <th>Província Naturalidade</th>
                                <th>Município Naturalidade</th>
                                <th>Opções</th>
                              </tr>
                              </thead>
                              <tbody>
                              <!--Gerando a Tabela de forma Dinamica-->
                              @foreach ($pessoas as $pessoa)
                              <!--Invocando outro elementos/ Tabelas -->
                              @php
                                $parente = app('\App\Models\Parente')::find($pessoa->id);
                                $naturalidade = app('\App\Models\Naturalidade')::find($pessoa->id);
                                $isFuncionario = App\Models\Funcionario::where('idPessoa', $pessoa->id)->first();
                              @endphp
                                            <tr class=" {{ isset($isFuncionario) ? ' ' : 'font-weight-bold'}}">
                                                <td>{{ $pessoa->nomeCompleto }}</td>
                                                <td>{{ $pessoa->genero }}</td>
                                                <td>{{ $parente->nomePai}}</td>
                                                <td>{{ $parente->nomeMae}}</td>
                                                <td>{{ $pessoa->grupoSanguineo }}</td>
                                                <td>{{ $pessoa->numeroBI }}</td>
                                                @php
                                                  $data = \Carbon\Carbon::parse($pessoa->validadeBI);
                                                  $class = $data->gt(now()) ? 'text-success' : 'text-danger';
                                                @endphp
                                                <td class="{{ $class }}">{{ \Carbon\Carbon::parse($pessoa->validadeBI)->format('d/m/Y')}}</td>
                                                <td>{{ $pessoa->estadoCivil }}</td>
                                                <td>{{ \Carbon\Carbon::parse($pessoa->dataNascimento)->format('d/m/Y') }}</td>
                                                <td>{{ $naturalidade->provincia}}</td>
                                                <td>{{ $naturalidade->municipio}}</td>
                                                <td>
                                                <form class=" " action="{{ route('funcionarios.verificarPessoa') }}" method="GET" style="display: inline;">
                                                  @csrf
                                                    <input type="hidden" name="numeroBI" id="numeroBI" value="{{$pessoa->numeroBI}}">
                                                    <button type="submit" class="btn btn-success w-100 m-1 {{ isset($isFuncionario) ? 'd-none' : ''}}"> Cadastrar à Funcionário</button>
                                                </form>
                                                <form class=" " action="{{ route('pessoas.form', ['id' => $pessoa->id]) }}" method="POST" style="display: inline;">
                                                  @csrf
                                                  @method('PUT')
                                                    <button type="submit" class="btn btn-warning w-100 m-1">Editar</button>
                                                </form>
                                                <form action="{{ route('eliminar.objecto') }}" method="POST" id="deleteForm{{ $pessoa->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $pessoa->id }}">
                                                    <input type="hidden" name="categoria" value="Pessoa">
                                                    <button type="submit" class="btn btn-danger w-100 m-1" onclick="confirmAndSubmit(event, 'Confirmar deletar Pessoa?', 'Sim, Deletar!', 'Não, Cancelar!')">Deletar</button>
                                                </form>
                                                </td>
                                            </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                              <tr>
                                <th>Nome Completo</th>
                                <th>Genero</th>
                                <th>Nome do Pai</th>
                                <th>Nome da Mãe</th>
                                <th>Grupo Sanguíneo</th>
                                <th>Nº de Bilhete de Identidade (BI)</th>
                                <th>Data Validade do Bilhete de Identidade</th>
                                <th>Estado Civil</th>
                                <th>Data Nascimento</th>
                                <th>Província Naturalidade</th>
                                <th>Município Naturalidade</th>
                                <th>Opções</th>
                              </tr>
                              </tfoot>
                            </table>
                          </div>


                          <div class="card-footer">
                          <a href="{{route('pessoas.form')}}" class="btn btn-primary d-block"> Cadastrar Entidade Pessoa</a>
                          </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
              </section>
            <!-- /.content -->
            </div>
          <!-- /.content-wrapper -->
          @endsection
    @section('scripts')
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
        <script src="{{ asset('plugins/sweetalert2/alerta-deletar.js')}}"></script>
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
