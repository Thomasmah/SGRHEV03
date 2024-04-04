<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'Unidades Orgânicas / Index')
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
                      <h1>Unidades Orgânicas </h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Unidades Orgânicas  </li>
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
                                <h3 class="card-title">Unidades Orgânicas </h3>  
                          </div>
                        <!-- /.card-header -->
                        <!-- Card-body -->
                          <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                <th>Unidade Orgânica (id)</th>
                                <th>Designacao</th>
                                <th>Descricao</th>
                                <th>EQT</th>
                                <th>Decreto Criação</th>
                                <th>Localidade</th>
                                <th>Telefone</th>
                                <th>Email</th>
                                <th>Opções</th>
                              </tr>
                              </thead>
                              <tbody>
                              <!--Gerando a Tabela de forma Dinamica-->
                              @foreach ($dados as $unidadeOrganica)
                                            <tr>
                                                <td>{{ $unidadeOrganica->id }}</td>
                                                <td>{{ $unidadeOrganica->designacao }}</td>
                                                <td>{{ $unidadeOrganica->descricao }}</td>
                                                <td>{{ $unidadeOrganica->eqt }}</td>
                                                <td>{{ $unidadeOrganica->decretoCriacao }}</td>
                                                <td>{{ $unidadeOrganica->localidade }}</td>
                                                <td>{{ $unidadeOrganica->telefone }}</td>
                                                <td>{{ $unidadeOrganica->email }}</td>
                                                <td>
                                                <form action="{{ route('unidadeOrganica.show', ['idUnidadeOrganica' => $unidadeOrganica->id]) }}" method="POST" style="display: inline;">
                                                  @csrf
                                                  @method('PUT')
                                                    <button type="submit" class="btn btn-secondary">Ver U-O</button>
                                                </form>
                                                <form action="{{ route('unidadeorganicas.form', ['id' => $unidadeOrganica->id]) }}" method="POST" style="display: inline;">
                                                  @csrf
                                                  @method('PUT')
                                                    <button type="submit" class="btn btn-primary">Editar</button>
                                                </form>
                                                <form action="{{ route('eliminar.objecto') }}" method="POST" id="deleteForm{{ $unidadeOrganica->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $unidadeOrganica->id }}">
                                                    <input type="hidden" name="categoria" value="UnidadeOrganica">
                                                    <button type="submit" class="btn btn-danger" onclick="confirmAndSubmit(event, 'Confirmar deletar Unidade Orgânica?', 'Sim, Deletar!', 'Não, Cancelar!')">Deletar</button>
                                                </form>
                                                </td>
                                            </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                              <tr>
                              <th>Unidade Orgânica (id)</th>
                                <th>Designacao</th>
                                <th>Descricao</th>
                                <th>EQT</th>
                                <th>Decreto Criação</th>
                                <th>Localidade</th>
                                <th>Telefone</th>
                                <th>Email</th>
                                <th>Opções</th>
                              </tr>
                              </tfoot>
                              </table>
                          </div>

                        <div class="card-footer">
                          <a href="{{route('unidadeorganicas.form')}}" class="btn btn-primary d-block"> Cadastrar Unidade Orgânica</a>
                        </div>
                        <!--/.Card-body -->
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
