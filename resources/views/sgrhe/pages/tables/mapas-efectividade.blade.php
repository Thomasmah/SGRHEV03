<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'Mapas de Efectividade')
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
                      <h1>Mapas de Efectividade </h1>
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
              <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div style="padding:10px; border-radius:5px; " class="col-12">
                    <div style="background-color: #ffffff;" class="card card-primary">

                        <div class="card-header">
                              <h3 class="card-title">Mapas de Efectividade por cada mês</h3>  
                        </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                <th>Mês / Periódo</th>
                                <th>Estado</th>
                                <th>Opções</th>
                              </tr>
                              </thead>
                              <tbody>
                              <!--Gerando a Tabela de forma Dinamica-->
                              @foreach ($dados as $mapas)
                                            <tr>
                                                <td>{{ $mapas->dataPeriodo }}</td>
                                                <td>{{ $mapas->estado }}</td>
                                                <td>
                                                    <form action="" method="GET" style="display: inline;">
                                                      @csrf
                                                      <button type="submit" class="btn btn-info">Editar</button>
                                                    </form>
                                                    <form action="{{ route('funcionarios.form', ['id' => $funcionario->idPessoa]) }}" method="POST" style="display: inline;">
                                                      @csrf
                                                      @method('PUT')
                                                      <button type="submit" class="btn btn-primary">Ver Mapa</button>
                                                    </form>
                                                </td>
                                            </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                              <tr>
                                <th>Mês / Periódo</th>
                                <th>Estado</th>
                                <th>Opções</th>
                              </tr>
                              </tfoot>
                            </table>
                          </div>
                          <div class="card-footer">
                              <a href="{{ route('form.mapa.efectividade') }}" class="btn btn-primary d-block"> Criar Mapa de Efectividade</a>
                          </div>  <!-- /.card-body -->
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
