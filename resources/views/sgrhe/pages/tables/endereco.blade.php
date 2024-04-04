<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} | Endreco / Index</title>
  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- Styles -->
  @livewireStyles
  <!--
Google Font: Source Sans Pro
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">
-->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  
   <!-- Navbar -->
   <x-sgrhe-navbar />
      <!-- /.navbar -->
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Logo -->
        <x-sgrhe-logo />
        <!-- /.logo -->
        <!-- Sidebar -->
        <x-sgrhe-sidebar />
        <!-- /.sidebar -->
      </aside>

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
          <div class="col-12">
              <div class="card card-primary">
                  <div class="card-header">
                        <h3 class="card-title">Endereços</h3>  
                  </div>
                @if (session('error'))
                    <div class="alert alert-warning card-body">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                      <div class="alert alert-success card-body">
                          {{ session('success') }}
                      </div>
                @endif
                <!--Todas as Mensagens e Erros de Validacao-->
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ( $errors->all() as $error)
                      <li>
                        {{ $error }}
                      </li>
                    @endforeach
                  </ul>
                </div> 
                @endif
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
                                    <form action="{{ route('cargos.form', ['id' => $cargo->id]) }}" method="POST"style="display: inline;">
                                      @csrf
                                      @method('PUT')
                                        <button type="submit" class="btn btn-primary">Editar</button>
                                    </form>
                                    <form action="{{ route('cargos.delete', ['id' => $cargo->id])}}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Excluir</button>
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
                    <a href="{{route('cargos.form')}}" class="btn btn-primary" style="width: 100%;">Cadastrar Cargos</a>
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
<x-sgrhe-footer />

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
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
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
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
</body>
</html>
