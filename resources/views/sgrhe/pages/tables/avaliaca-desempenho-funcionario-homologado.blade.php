<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'Mapa Geral de Avaliação de Desempenho Funcionários / Index')
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
                      <h1> Avaliação de Desempenho  </h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Avaliação de Desempenho</li>
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
                              <h3 class="card-title">Mapa Geral de Avaliacões de Funcionários</h3>  
                        </div>
                      <!-- /.card-header -->
                          <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                <th>Número de Agente</th> <th>Nome Completo</th> <th>Número de BI</th> <th>Unidade Orgânica</th> <th>Categoria</th> <th>Classificação</th> <th>Periódo Avaliação</th> <th>Função</th> <th>Opções</th>
                              </tr>
                              </thead>
                              <tbody>
                              <!--Gerando a Tabela de forma Dinamica-->
                              @foreach ($dados as $avaliacao)
                                    <tr>
                                              <td>{{ $avaliacao->numeroAgente }}</td> <td>{{ $avaliacao->nomeCompleto }}</td> <td>{{ $avaliacao->numeroBI }}</td> <td>{{ $avaliacao->eqt }}</td> <td>{{ $avaliacao->categoriaFuncionario }}</td> <td>{{ $avaliacao->total }}</td> <td>{{ $avaliacao->periodoAvaliacao }}</td> <td>{{ $avaliacao->designacao_cargo }}</td>
                                                <td>
                                                    <form action="{{ route('exibir.documento') }}" method="POST" style="display: inline;">
                                                      @csrf
                                                      @method('PUT')
                                                      <input type="hidden" name="id" value="{{ $avaliacao->idArquivo }}">
                                                      <button type="submit" class="btn btn-secondary w-100 m-1">Baixar Avaliação</button>
                                                    </form>
                                                </td>
                                    </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Número de Agente</th> <th>Nome Completo</th> <th>Número de BI</th> <th>Unidade Orgânica</th> <th>Categoria</th> <th>Classificação</th> <th>Periódo Avaliação</th> <th>Função</th> <th>Opções</th>
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