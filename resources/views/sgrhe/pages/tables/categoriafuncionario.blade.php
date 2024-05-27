<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'Categorias de Fucnionários / Index')
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
                    <h1>Categorias de Funcionário</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Categorias de Funcionário</li>
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
                                <h3 class="card-title">Categoria de Funionários</h3>  
                          </div>
                        <!-- /.card-header -->
                         <!-- card-body -->
                          <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                <th>Categoria de Funcionário (id)</th>
                                <th>Categoria</th>
                                <th>Grau</th>
                                <th>Salário Base</th>
                                <th>Opções</th>
                              </tr>
                              </thead>
                              <tbody>
                              <!--Gerando a Tabela de forma Dinamica-->
                              @foreach ($categoriafuncionarios as $categoriafuncionario)
                                            <tr>
                                                <td>{{ $categoriafuncionario->id }}</td>
                                                <td>{{ $categoriafuncionario->categoria }}</td>
                                                <td>{{ $categoriafuncionario->grau }}</td>
                                                <td>{{ $categoriafuncionario->salariobase }}</td>
                                                <td>
                                                <form action="{{ route('categoriafuncionarios.form', ['id' => $categoriafuncionario->id]) }}" method="POST" style="display: inline;">
                                                  @csrf
                                                  @method('PUT')
                                                    <button type="submit" class="btn btn-warning w-100 m-1">Editar</button>
                                                </form>
                                                <form action="{{ route('categoriafuncionarios.delete', ['id' => $categoriafuncionario->id])}}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger w-100 m-1">Excluir</button>
                                                </form>
                                                </td>
                                            </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                              <tr>
                              <th>Categoria de Funcionário (id)</th>
                                <th>Categoria</th>
                                <th>Grau</th>
                                <th>Salário Base</th>
                                <th>Opções</th>
                              </tr>
                              </tfoot>
                            </table>
                          </div>
                          <div class="card-footer">
                          <a href="{{route('categoriafuncionarios.form')}}" class="btn btn-primary d-block">Cadastrar Categoria de Funcionaários</a>
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
