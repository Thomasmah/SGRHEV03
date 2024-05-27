<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'Cargos / Index')
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
                    <h1>Cargos</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Cargos </li>
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
                                <h3 class="card-title">Cargos</h3>  
                          </div>
                          
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>Cargos (id)</th>
                              <th>Designacao</th>
                              <th>Descrisao</th>
                              <th>Permissoes</th>
                              <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--Gerando a Tabela de forma Dinamica-->
                            @foreach ($dados as $cargo)
                                          <tr>
                                           
                                              <td>{{ $cargo->id }}</td>
                                              <td>{{ $cargo->designacao }}</td>
                                              <td>{{ $cargo->descrisao }}</td>
                                              <td>{{ $cargo->permissoes }}</td>
                                              <td>
                                                <form action="{{ route('cargos.form', ['id' => $cargo->id]) }}" method="POST" style="display: inline;">
                                                  @csrf
                                                  @method('PUT')
                                                    <button type="submit" class="btn btn-warning w-100 m-1">Editar</button>
                                                </form>
                                                <form action="{{ route('eliminar.objecto') }}" method="POST" id="deleteForm{{ $cargo->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $cargo->id }}">
                                                    <input type="hidden" name="categoria" value="Cargo">
                                                    <button type="submit" class="btn btn-danger w-100 m-1" onclick="confirmAndSubmit(event, 'Confirmar deletar Cargo?', 'Sim, Deletar!', 'Não, Cancelar!')">Deletar</button>
                                                </form>
                                              </td>
                                          </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                              <th>Cargos (id)</th>
                              <th>Designacao</th>
                              <th>Descrisao</th>
                              <th>Permissoes</th>
                              <th>Opções</th>
                            </tr>
                            </tfoot>
                          </table>
                        </div>


                        <div class="card-footer">
                              <a href="{{route('cargos.form')}}" class="btn btn-primary d-block">Cadastrar Cargos</a>
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
      <!--Algoritmo interactivo no processo de delectar Objectos em SweetAlert 2-->
      <script src="{{ asset('plugins/sweetalert2/alerta-deletar.js')}}"></script>

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
