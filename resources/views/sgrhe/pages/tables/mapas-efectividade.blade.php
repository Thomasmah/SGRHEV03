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
                            <table id="example1" class="table table-bordered table-striped text-center">
                              <thead>
                              <tr>
                                <th>Número de Ordem</th>
                                <th>Mês / Periódo</th>
                                <th>Estado</th>
                                <th>Opções</th>
                              </tr>
                              </thead>
                              <tbody>
                              <!--Gerando a Tabela de forma Dinamica-->
                              @foreach ($dados as $mapas)
                                            <tr>
                                                <td>{{ $mapas->numerOrdem }}</td>
                                                <td>{{ $mapas->dataPeriodo }}</td>
                                                <td>{{ $mapas->estado }}</td>
                                                <td>
                                                    <a href="{{ route('form.mapa.efectividade', ['idMapaEfectividade' => $mapas->id ]) }}" class="btn btn-warning  w-100 m-1">Editar Mapa</a>
                                                    <form action="{{ route('efectivar.mapa.efectividade') }}">
                                                      <input type="hidden" name="idMapaEfectividade" value="{{ $mapas->id }}">
                                                      <input type="hidden" name="categoria" value="MapaEfectividade">
                                                      <button type="submit" class="btn btn-primary  w-100 m-1">Ver / Baixar o Mapa </button>
                                                    </form>
                                                </td>
                                            </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                              <tr>
                                <th>Número de Ordem</th>
                                <th>Mês / Periódo</th>
                                <th>Estado</th>
                                <th>Opções</th>
                              </tr>
                              </tfoot>
                            </table>
                          </div>
                          <button class="btn btn-primary d-block" data-toggle="modal" data-target="#addMapaEfectividade">
                                Criar no Mapa de Efectividade
                          </button>
                                                              <div class="modal fade" id="addMapaEfectividade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h6 class="modal-title" id="exampleModalLabel">Novo Mapa de Efectividade </h6>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <!-- Formulário dentro da modal -->
                                                                              
                                                                              <form action="{{ route('criar.mapa.efectividade') }}" method="POST">
                                                                                  @method('POST')
                                                                                  @csrf
                                                                                  <label for="mes">Seleccione o Mês para o Plano de Efectividade</label>
                                                                                  <select name="mes" id="" class="form-control" style="width: 100%;">
                                                                                    <option value="janeiro">Janeiro</option>
                                                                                    <option value="fevereiro">Fevereiro</option>
                                                                                    <option value="marco">Março</option>
                                                                                    <option value="abril">Abril</option>
                                                                                    <option value="Janeiro">Maio</option>
                                                                                    <option value="Janeiro">Junho</option>
                                                                                    <option value="Janeiro">Julho</option>
                                                                                    <option value="Janeiro">Agosto</option>
                                                                                    <option value="Janeiro">Setembro</option>
                                                                                    <option value="Janeiro">Outubro</option>
                                                                                    <option value="Janeiro">Novenbro</option>
                                                                                    <option value="Janeiro">Dezembro</option>
                                                                                  </select>
                                                                                  <label for="mes">Seleccione o Ano para o Plano de Efectividade</label>
                                                                                  <input name="ano" class="form-control d-block" style="width: 100%;" type="number" min="2020" max="{{ date('Y') }}" step="1" value="" placeholder="{{ date('Y') }}"/>
                                                                                  <label for="data"> Data</label>
                                                                                  <input type="date" class="form-control" name="data">
                                                                                  <br>
                                                                                  <input type="submit" class="form-control btn btn-primary" style="width: 100%;" value="Abrir novo Mapa de Efectividade" >
                                                                                <br>
                                                                              </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
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
