<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'DashBoard Unidade Orgânica')
        @section('header')
        <!--JS e CSS do LivWare Integrado -->
       <style>
         input[type="numeric"]{
          border:1px solid #e0e0e0;
          width: 100%;
          max-width: 100%;
          box-sizing: border-box;
          border-radius: 5px;
          text-align: center;
         
        }
        .inputNumeric:hover{
          box-shadow: 0 0  3px 2px #007bff;
          transition: border-color 0.3;
        }
        .cell{          
          width: 100px;
        }
        .cell-left {
          background-color: #f0f0f0;
          padding: 20px;
          position: relative;
        }
        .cell-right {
          background-color: #fff;
          padding: 20px;
        }
        .diagonal-line {
          position: absolute;
          top: 0;
          bottom: 0;
          right: 0;
          width: 2px;
          background-color: #000;
          transform: rotate(-45);
          transform-origin:top right ;
        }
      
       </style>
        @endsection
  @section('conteudo_principal')
  <x-sgrhe-preloader />
      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>Formulário de Aproveitamento da {{ $unidadeOrganicaSelected->designacao }} {{$trimestre }} do Ano Lectivo {{ $anoLectivo }}</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Página Inicial</a></li>
                      <li class="breadcrumb-item active"> Formulário de Aproveitamento </li>
                    </ol>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
              <!--Formulario -->
                <section class="content">
                  <div class="container-fluid">
                    <div class="row">
                      <!--col -->
                          <div class="col-md-12">
                              <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">Formulário</p>
                                </div>
                                <div class="card-body">
                               
                            <form action="{{ route('cadastrar.formulario') }}" method="POST">
                              @csrf
                              @method('POST')
                            <div class="table-responsive">
                              <table class="table table-hover table-bordered border-secondary table-striped" style="text-align:center;">
                                  <thead class="bg-primary">
                                    <tr>
                                      <th scope="col" rowspan="2" colspan="1" style=" vertical-align:middle" >Alunos</th><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Matriculados no Início do Ano Lectivo</th><!--<th scope="col">Matriculados</th>--> <th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Matriculados no Final do Ano Lectivo</th><!--<th scope="col">Matriculados</th>--><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Aprovados</th><!--<th scope="col">Aprovados</th>--><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Reprovados</th><!--<th scope="col">Reprovados</th>--><th scope="col" colspan="4" rowspan="1" style="vertical-align: middle;">Trasferidos</th><!--<th scope="col">Trasferidos</th><th scope="col">Trasferidos</th><th scope="col">Trasferidos</th> --><th scope="col" colspan="2" rowspan="2" style="vertical-align: middle;">Desistentes</th> <!--<th scope="col">Total</th>-->
                                    </tr>
                                    <tr>
                                      <!--<th scope="col">Alunos</th> --><!--<th scope="col" colspan="2">Matriculados</th><th scope="col">Matriculados</th>--> <!--<th scope="col">Aprovados</th><th scope="col">Aprovados</th>--><!--<th scope="col">Reprovados</th><th scope="col">Reprovados</th>--><th scope="col" colspan="2" rowspan="1" style="vertical-align: middle;">Entrada</th><!--<th scope="col">Entrada</th> --> <th scope="col" colspan="2" rowspan="1" style="vertical-align: middle;">Saida</th><!--<th scope="col">Saida</th>--><!--<th scope="col">Total</th> <th scope="col">Total</th>-->
                                    </tr>
                                    <tr>
                                      <th scope="col">Classe</th><th scope="col">MF</th><th scope="col">F</th> <th scope="col">MF</th><th scope="col">F</th> <th scope="col">MF</th><th scope="col">F</th><th scope="col">MF</th><th scope="col">F</th> <th scope="col">MF</th><th scope="col">F</th><th scope="col">MF</th><th scope="col">F</th><th scope="col">MF</th> <th scope="col">F</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                        <th scope="row">1ª</th>   <td><input type="numeric" class="inputNumeric" name="a11" id="a11" placeholder="*" required></td><td><input type="numeric" class="inputNumeric" name="a12" id="a12"  placeholder="*" required></td><td><input type="numeric" class="inputNumeric" name="a13" id="a13"></td><td><input type="numeric" class="inputNumeric" name="a14" id="a14"></td><td><input type="numeric" class="inputNumeric" name="a15" id="a15"></td><td><input type="numeric" class="inputNumeric" name="a16" id="a16"></td> <td><input type="numeric" class="inputNumeric" name="a17" id="a17"></td> <td><input type="numeric" class="inputNumeric" name="a18" id="a18"></td> <td><input type="numeric" class="inputNumeric" name="a19" id="a19"></td> <td><input type="numeric" class="inputNumeric" name="a110" id="a110"></td> <td><input type="numeric" class="inputNumeric" name="a111" id="a111"></td> <td><input type="numeric" class="inputNumeric" name="a112" id="a112"></td> <td><input type="numeric" class="inputNumeric" name="a113" id="a113"></td> <td><input type="numeric" class="inputNumeric" name="a114" id="a114"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2ª</th>   <td><input type="numeric" class="inputNumeric" name="a21" id="a21" placeholder="*" required></td><td><input type="numeric" class="inputNumeric" name="a22" id="a22"  placeholder="*" required></td><td><input type="numeric" class="inputNumeric" name="a23" id="a23"></td><td><input type="numeric" class="inputNumeric" name="a24" id="a24"></td><td><input type="numeric" class="inputNumeric" name="a25" id="a25"></td><td><input type="numeric" class="inputNumeric" name="a26" id="a26"></td> <td><input type="numeric" class="inputNumeric" name="a27" id="a27"></td> <td><input type="numeric" class="inputNumeric" name="a28" id="a28"></td> <td><input type="numeric" class="inputNumeric" name="a29" id="a29"></td> <td><input type="numeric" class="inputNumeric" name="a210" id="a210"></td> <td><input type="numeric" class="inputNumeric" name="a211" id="a211"></td> <td><input type="numeric" class="inputNumeric" name="a212" id="a212"></td> <td><input type="numeric" class="inputNumeric" name="a213" id="a213"></td> <td><input type="numeric" class="inputNumeric" name="a214" id="a214"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3ª</th>   <td><input type="numeric" class="inputNumeric" name="a31" id="a31" placeholder="*" required></td><td><input type="numeric" class="inputNumeric" name="a32" id="a32"  placeholder="*" required></td><td><input type="numeric" class="inputNumeric" name="a33" id="a33"></td><td><input type="numeric" class="inputNumeric" name="a34" id="a34"></td><td><input type="numeric" class="inputNumeric" name="a35" id="a35"></td><td><input type="numeric" class="inputNumeric" name="a36" id="a36"></td> <td><input type="numeric" class="inputNumeric" name="a37" id="a37"></td> <td><input type="numeric" class="inputNumeric" name="a38" id="a38"></td> <td><input type="numeric" class="inputNumeric" name="a39" id="a39"></td> <td><input type="numeric" class="inputNumeric" name="a310" id="a310"></td> <td><input type="numeric" class="inputNumeric" name="a311" id="a311"></td> <td><input type="numeric" class="inputNumeric" name="a312" id="a312"></td> <td><input type="numeric" class="inputNumeric" name="a313" id="a313"></td> <td><input type="numeric" class="inputNumeric" name="a314" id="a314"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4ª</th>   <td><input type="numeric" class="inputNumeric" name="a41" id="a41" placeholder="*" required></td><td><input type="numeric" class="inputNumeric" name="a42" id="a42"  placeholder="*" required></td><td><input type="numeric" class="inputNumeric" name="a43" id="a43"></td><td><input type="numeric" class="inputNumeric" name="a44" id="a44"></td><td><input type="numeric" class="inputNumeric" name="a45" id="a45"></td><td><input type="numeric" class="inputNumeric" name="a46" id="a46"></td> <td><input type="numeric" class="inputNumeric" name="a47" id="a47"></td> <td><input type="numeric" class="inputNumeric" name="a48" id="a48"></td> <td><input type="numeric" class="inputNumeric" name="a49" id="a49"></td> <td><input type="numeric" class="inputNumeric" name="a410" id="a410"></td> <td><input type="numeric" class="inputNumeric" name="a411" id="a411"></td> <td><input type="numeric" class="inputNumeric" name="a412" id="a412"></td> <td><input type="numeric" class="inputNumeric" name="a413" id="a413"></td> <td><input type="numeric" class="inputNumeric" name="a414" id="a414"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5ª</th>   <td><input type="numeric" class="inputNumeric" name="a51" id="a51" placeholder="*" required></td><td><input type="numeric" class="inputNumeric" name="a52" id="a52"  placeholder="*" required></td><td><input type="numeric" class="inputNumeric" name="a53" id="a53"></td><td><input type="numeric" class="inputNumeric" name="a54" id="a54"></td><td><input type="numeric" class="inputNumeric" name="a55" id="a55"></td><td><input type="numeric" class="inputNumeric" name="a56" id="a56"></td> <td><input type="numeric" class="inputNumeric" name="a57" id="a57"></td> <td><input type="numeric" class="inputNumeric" name="a58" id="a58"></td> <td><input type="numeric" class="inputNumeric" name="a59" id="a59"></td> <td><input type="numeric" class="inputNumeric" name="a510" id="a510"></td> <td><input type="numeric" class="inputNumeric" name="a511" id="a511"></td> <td><input type="numeric" class="inputNumeric" name="a512" id="a512"></td> <td><input type="numeric" class="inputNumeric" name="a513" id="a513"></td> <td><input type="numeric" class="inputNumeric" name="a514" id="a514"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6ª</th>   <td><input type="numeric" class="inputNumeric" name="a61" id="a61" placeholder="*" required></td><td><input type="numeric" class="inputNumeric" name="a62" id="a62"  placeholder="*" required></td><td><input type="numeric" class="inputNumeric" name="a63" id="a63"></td><td><input type="numeric" class="inputNumeric" name="a64" id="a64"></td><td><input type="numeric" class="inputNumeric" name="a65" id="a65"></td><td><input type="numeric" class="inputNumeric" name="a66" id="a66"></td> <td><input type="numeric" class="inputNumeric" name="a67" id="a67"></td> <td><input type="numeric" class="inputNumeric" name="a68" id="a68"></td> <td><input type="numeric" class="inputNumeric" name="a69" id="a69"></td> <td><input type="numeric" class="inputNumeric" name="a610" id="a610"></td> <td><input type="numeric" class="inputNumeric" name="a611" id="a611"></td> <td><input type="numeric" class="inputNumeric" name="a612" id="a612"></td> <td><input type="numeric" class="inputNumeric" name="a613" id="a613"></td> <td><input type="numeric" class="inputNumeric" name="a614" id="a614"></td>
                                    </tr>
                                    
                                  </tbody>
                                  <tfoot>
                                    <tr class="bg-warning">
                                      <th scope="row">Total</th>    <td><input id="matriculadosIAMF" type="numeric" value="0" readonly></td><td><input id="matriculadosIAF" type="numeric" value="0" readonly></td><td><input id="matriculadosFAMF" type="numeric" value="0" readonly></td><td><input id="matriculadosFAF" type="numeric" value="0" readonly></td><td><input id="aprovadosMF" type="numeric" value="0" readonly></td><td><input id="aprovadosF" type="numeric" value="0" readonly></td> <td><input id="reprovadosMF" type="numeric" value="0" readonly></td> <td><input id="reprovadosF" type="numeric" value="0" readonly></td> <td><input id="transferidosEMF" type="numeric" value="0" readonly></td> <td><input id="transferidosEF" type="numeric" value="0" readonly></td> <td><input id="transferidosSMF" type="numeric" value="0" readonly></td> <td><input id="transferidosSF" type="numeric" value="0" readonly></td> <td><input id="desistentesMF" type="numeric" value="0" readonly></td> <td><input id="desistentesF" type="numeric" value="0" readonly></td>
                                    </tr>
                                  </tfoot>
                              </table>
                            </div>
                            <!--Inputs Automaticos com dados da Unidade Organica etc..-->
                            <input type="hidden" name="idUnidadeOrganica" value="{{ $unidadeOrganicaSelected->id}}">
                            <input type="hidden" name="idDirector" value="{{  session()->only(['idFuncionario'])['idFuncionario'] }}">
                            <input type="hidden" name="trimestre" value="{{ $trimestre }}">
                            <input type="hidden" name="anoLectivo" value="{{ $anoLectivo }}">
                            <button type="submit" style="font-weight: bold;" class="btn btn-primary w-100" onclick="confirmAndSubmit(event, 'Confirmar Submeter o Formulário de Aproveitamento?', 'Sim, Confirmar!', 'Não, Cancelar!')"> Verificar e Enviar</button>
                            </form>


                                </div>
                              </div>
                          </div>
                      <!--/col -->        
                    </div>
                  </div>
                    <!-- /.row -->
                </section>
            <!-- /.content -->
        </div>
           <!-- /.content-wrapper -->
    </div>
    
  @endsection
  @section('scripts')


      <!-- ChartJS -->
      <script src="{{ asset('plugins/chart.js/Chart.min.js') }} "></script>
      <!-- Sparkline -->
      <script src="{{ asset('plugins/sparklines/sparkline.js') }} "></script>
      <!-- Summernote / Calendar -->
      <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }} "></script>
      <!-- jQuery Knob Chart -->
      <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }} "></script>
      <!-- JQVMap -->
      <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }} "></script>
      <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }} "></script>
      <script src="{{ asset('plugins/jqvmap/maps/continents/jquery.vmap.africa.js') }} "></script>
      <!--Algoritmo interactivo no processo de delectar Objectos em SweetAlert 2-->
      <script src="{{ asset('plugins/sweetalert2/alerta-deletar.js')}}"></script>
      <!--/Aproveitamento Grafico-->
        <!--Grafico de Barras -->
        <script>
              // Sample data
              const data = {
                  labels: ['I Trimestre', 'II Trimestre', 'III Trimestre'],
                  datasets: [
                      {
                          label: 'Aprovados',
                          data: [65, 35, 73],
                          backgroundColor: 'rgba(75, 192, 192, 0.6)',
                          borderColor: 'rgba(75, 192, 192, 1)',
                          borderWidth: 2,
                      },
                      {
                          label: 'Reprovados',
                          data: [35, 65, 17],
                          backgroundColor: 'rgba(255, 99, 132, 0.6)',
                          borderColor: 'rgba(255, 99, 132, 1)',
                          borderWidth: 2,
                      },
                  ],
              };

              // Chart configuration
              const config = {
                  type: 'bar',
                  data: data,
                  options: {
                      scales: {
                          x: {
                              stacked: false,
                          },
                          y: {
                              stacked: false,
                              beginAtZero: true,
                          },
                      },
                  },
              };
              

              // Create the chart
              const ctx = document.getElementById('doubleDatasetChart').getContext('2d');
              new Chart(ctx, config);
          </script>
        <!--Grafico em Linha -->
          <script>
              /* Chart.js Charts */
            // Aproveitamento Grafico
            var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
            // $('#revenue-chart').get(0).getContext('2d');

            var salesChartData = {
              labels: ['I Trimestre', 'II Trimestre', 'III Trimestre'],
              datasets: [
                {
                  label: 'Aprovados',
                  backgroundColor: 'rgba(60,141,188,0.9)',
                  borderColor: 'rgba(60,141,188,0.8)',
                  pointRadius: false,
                  pointColor: '#3b8bba',
                  pointStrokeColor: 'rgba(60,141,188,1)',
                  pointHighlightFill: '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data: [35, 100, 100]
                },
                {
                  label: 'Reprovados',
                  backgroundColor: 'rgba(210, 214, 222, 1)',
                  borderColor: 'rgba(210, 214, 222, 1)',
                  pointRadius: false,
                  pointColor: 'rgba(210, 214, 222, 1)',
                  pointStrokeColor: '#c1c7d1',
                  pointHighlightFill: '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data: [65, 100, 100]
                }
              ]
            }

            var salesChartOptions = {
              maintainAspectRatio: false,
              responsive: true,
              legend: {
                display: true
              },
              scales: {
                xAxes: [{
                  gridLines: {
                    display: true
                  }
                }],
                yAxes: [{
                  gridLines: {
                    display: true
                  }
                }]
              }
            }

            // This will get the first returned node in the jQuery collection.
            // eslint-disable-next-line no-unused-vars
            var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
              type: 'line',
              data: salesChartData,
              options: salesChartOptions
            })
          </script>
      <!--/Aproveitamento Grafico-->


      <!--Soma dinamica dos dados inseridos no formulário-->
      <script>
          //Matriculados Inicio do Ano Lectivo Masculino Femininos
          function atualizarSomatorioMatriculadosIAMF() {
              // Obter os valores dos inputs
              var a11 = parseFloat(document.getElementById('a11').value) || 0;
              var a21 = parseFloat(document.getElementById('a21').value) || 0;
              var a31 = parseFloat(document.getElementById('a31').value) || 0;
              var a41 = parseFloat(document.getElementById('a41').value) || 0;
              var a51 = parseFloat(document.getElementById('a51').value) || 0;
              var a61 = parseFloat(document.getElementById('a61').value) || 0;
              // Calcular o somatório
              var SomatorioMatriculadosIAMF = a11 + a21 + a31 + a41 + a51 + a61;
              // Atualizar o campo somatório
              document.getElementById('matriculadosIAMF').value = SomatorioMatriculadosIAMF;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a11').addEventListener('input', atualizarSomatorioMatriculadosIAMF);
          document.getElementById('a21').addEventListener('input', atualizarSomatorioMatriculadosIAMF);
          document.getElementById('a31').addEventListener('input', atualizarSomatorioMatriculadosIAMF);
          document.getElementById('a41').addEventListener('input', atualizarSomatorioMatriculadosIAMF);
          document.getElementById('a51').addEventListener('input', atualizarSomatorioMatriculadosIAMF);
          document.getElementById('a61').addEventListener('input', atualizarSomatorioMatriculadosIAMF);

          //Matriculados no Inicio do Ano Lectivo Femininos
          function atualizarSomatorioMatriculadosIAF() {
              // Obter os valores dos inputs
              var a12 = parseFloat(document.getElementById('a12').value) || 0;
              var a22 = parseFloat(document.getElementById('a22').value) || 0;
              var a32 = parseFloat(document.getElementById('a32').value) || 0;
              var a42 = parseFloat(document.getElementById('a42').value) || 0;
              var a52 = parseFloat(document.getElementById('a52').value) || 0;
              var a62 = parseFloat(document.getElementById('a62').value) || 0;
              // Calcular o somatório
              var somatorio = a12 + a22 + a32 + a42 + a52 + a62;
              // Atualizar o campo somatório
              document.getElementById('matriculadosIAF').value = somatorio;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a12').addEventListener('input', atualizarSomatorioMatriculadosIAF);
          document.getElementById('a22').addEventListener('input', atualizarSomatorioMatriculadosIAF);
          document.getElementById('a32').addEventListener('input', atualizarSomatorioMatriculadosIAF);
          document.getElementById('a42').addEventListener('input', atualizarSomatorioMatriculadosIAF);
          document.getElementById('a52').addEventListener('input', atualizarSomatorioMatriculadosIAF);
          document.getElementById('a62').addEventListener('input', atualizarSomatorioMatriculadosIAF);


          //Matriculados no Final do Ano Lectivo Femininos
          function atualizarSomatorioMatriculadosFAMF() {
              // Obter os valores dos inputs
              var a13 = parseFloat(document.getElementById('a13').value) || 0;
              var a23 = parseFloat(document.getElementById('a23').value) || 0;
              var a33 = parseFloat(document.getElementById('a33').value) || 0;
              var a43 = parseFloat(document.getElementById('a43').value) || 0;
              var a53 = parseFloat(document.getElementById('a53').value) || 0;
              var a63 = parseFloat(document.getElementById('a63').value) || 0;
              // Calcular o somatório
              var somatorio = a13 + a23 + a33 + a43 + a53 + a63;
              // Atualizar o campo somatório
              document.getElementById('matriculadosFAMF').value = somatorio;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a13').addEventListener('input', atualizarSomatorioMatriculadosFAMF);
          document.getElementById('a23').addEventListener('input', atualizarSomatorioMatriculadosFAMF);
          document.getElementById('a33').addEventListener('input', atualizarSomatorioMatriculadosFAMF);
          document.getElementById('a43').addEventListener('input', atualizarSomatorioMatriculadosFAMF);
          document.getElementById('a53').addEventListener('input', atualizarSomatorioMatriculadosFAMF);
          document.getElementById('a63').addEventListener('input', atualizarSomatorioMatriculadosFAMF);


          //Matriculados no Final do Ano Lectivo Femininos
          function atualizarSomatorioMatriculadosFAF() {
              // Obter os valores dos inputs
              var a14 = parseFloat(document.getElementById('a14').value) || 0;
              var a24 = parseFloat(document.getElementById('a24').value) || 0;
              var a34 = parseFloat(document.getElementById('a34').value) || 0;
              var a44 = parseFloat(document.getElementById('a44').value) || 0;
              var a54 = parseFloat(document.getElementById('a54').value) || 0;
              var a64 = parseFloat(document.getElementById('a64').value) || 0;
              // Calcular o somatório
              var somatorio = a14 + a24 + a34 + a44 + a54 + a64;
              // Atualizar o campo somatório
              document.getElementById('matriculadosFAF').value = somatorio;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a14').addEventListener('input', atualizarSomatorioMatriculadosFAF);
          document.getElementById('a24').addEventListener('input', atualizarSomatorioMatriculadosFAF);
          document.getElementById('a34').addEventListener('input', atualizarSomatorioMatriculadosFAF);
          document.getElementById('a44').addEventListener('input', atualizarSomatorioMatriculadosFAF);
          document.getElementById('a54').addEventListener('input', atualizarSomatorioMatriculadosFAF);
          document.getElementById('a64').addEventListener('input', atualizarSomatorioMatriculadosFAF);
          

          //Aprovados
          function atualizarSomatorioAprovadosMF() {
              // Obter os valores dos inputs
              var a15 = parseFloat(document.getElementById('a15').value) || 0;
              var a25 = parseFloat(document.getElementById('a25').value) || 0;
              var a35 = parseFloat(document.getElementById('a35').value) || 0;
              var a45 = parseFloat(document.getElementById('a45').value) || 0;
              var a55 = parseFloat(document.getElementById('a55').value) || 0;
              var a65 = parseFloat(document.getElementById('a65').value) || 0;
              // Calcular o somatório
              var SomatorioAprovadosMF = a15 + a25 + a35 + a45 + a55 + a65;
              // Atualizar o campo somatório
              document.getElementById('aprovadosMF').value = SomatorioAprovadosMF;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a15').addEventListener('input', atualizarSomatorioAprovadosMF);
          document.getElementById('a25').addEventListener('input', atualizarSomatorioAprovadosMF);
          document.getElementById('a35').addEventListener('input', atualizarSomatorioAprovadosMF);
          document.getElementById('a45').addEventListener('input', atualizarSomatorioAprovadosMF);
          document.getElementById('a55').addEventListener('input', atualizarSomatorioAprovadosMF);
          document.getElementById('a65').addEventListener('input', atualizarSomatorioAprovadosMF);


          //Aprovados F
          function atualizarSomatorioAprovadosF() {
              // Obter os valores dos inputs
              var a16 = parseFloat(document.getElementById('a16').value) || 0;
              var a26 = parseFloat(document.getElementById('a26').value) || 0;
              var a36 = parseFloat(document.getElementById('a36').value) || 0;
              var a46 = parseFloat(document.getElementById('a46').value) || 0;
              var a56 = parseFloat(document.getElementById('a56').value) || 0;
              var a66 = parseFloat(document.getElementById('a66').value) || 0;
              // Calcular o somatório
              var somatorio = a16 + a26 + a36 + a46 + a66 + a66;
              // Atualizar o campo somatório
              document.getElementById('aprovadosF').value = somatorio;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a16').addEventListener('input', atualizarSomatorioAprovadosF);
          document.getElementById('a26').addEventListener('input', atualizarSomatorioAprovadosF);
          document.getElementById('a36').addEventListener('input', atualizarSomatorioAprovadosF);
          document.getElementById('a46').addEventListener('input', atualizarSomatorioAprovadosF);
          document.getElementById('a56').addEventListener('input', atualizarSomatorioAprovadosF);
          document.getElementById('a66').addEventListener('input', atualizarSomatorioAprovadosF);


          //Reprovados MF
          function atualizarSomatorioReprovadosMF() {
              // Obter os valores dos inputs
              var a17 = parseFloat(document.getElementById('a17').value) || 0;
              var a27 = parseFloat(document.getElementById('a27').value) || 0;
              var a37 = parseFloat(document.getElementById('a37').value) || 0;
              var a47 = parseFloat(document.getElementById('a47').value) || 0;
              var a57 = parseFloat(document.getElementById('a57').value) || 0;
              var a67 = parseFloat(document.getElementById('a67').value) || 0;
              // Calcular o somatório
              var SomatorioReprovadosMF = a17 + a27 + a37 + a47 + a57 + a67;
              // Atualizar o campo somatório
              document.getElementById('reprovadosMF').value = SomatorioReprovadosMF;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a17').addEventListener('input', atualizarSomatorioReprovadosMF);
          document.getElementById('a27').addEventListener('input', atualizarSomatorioReprovadosMF);
          document.getElementById('a37').addEventListener('input', atualizarSomatorioReprovadosMF);
          document.getElementById('a47').addEventListener('input', atualizarSomatorioReprovadosMF);
          document.getElementById('a57').addEventListener('input', atualizarSomatorioReprovadosMF);
          document.getElementById('a67').addEventListener('input', atualizarSomatorioReprovadosMF);
          
          //Reprovados MF
          function atualizarSomatorioReprovadosF() {
              // Obter os valores dos inputs
              var a18 = parseFloat(document.getElementById('a18').value) || 0;
              var a28 = parseFloat(document.getElementById('a28').value) || 0;
              var a38 = parseFloat(document.getElementById('a38').value) || 0;
              var a48 = parseFloat(document.getElementById('a48').value) || 0;
              var a58 = parseFloat(document.getElementById('a58').value) || 0;
              var a68 = parseFloat(document.getElementById('a68').value) || 0;
              // Calcular o somatório
              var somatorio = a18 + a28 + a38 + a48 + a58 + a68;
              // Atualizar o campo somatório
              document.getElementById('reprovadosF').value = somatorio;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a18').addEventListener('input', atualizarSomatorioReprovadosF);
          document.getElementById('a28').addEventListener('input', atualizarSomatorioReprovadosF);
          document.getElementById('a38').addEventListener('input', atualizarSomatorioReprovadosF);
          document.getElementById('a48').addEventListener('input', atualizarSomatorioReprovadosF);
          document.getElementById('a58').addEventListener('input', atualizarSomatorioReprovadosF);
          document.getElementById('a68').addEventListener('input', atualizarSomatorioReprovadosF);

          //Transferidos Entrada MF
          function atualizarSomatorioTransferidosEMF() {
              // Obter os valores dos inputs
              var a19 = parseFloat(document.getElementById('a19').value) || 0;
              var a29 = parseFloat(document.getElementById('a29').value) || 0;
              var a39 = parseFloat(document.getElementById('a39').value) || 0;
              var a49 = parseFloat(document.getElementById('a49').value) || 0;
              var a59 = parseFloat(document.getElementById('a59').value) || 0;
              var a69 = parseFloat(document.getElementById('a69').value) || 0;
              // Calcular o somatório
              var SomatorioTransferidosEMF = a19 + a29 + a39 + a49 + a59 + a69;
              // Atualizar o campo somatório
              document.getElementById('transferidosEMF').value = SomatorioTransferidosEMF;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a19').addEventListener('input', atualizarSomatorioTransferidosEMF);
          document.getElementById('a29').addEventListener('input', atualizarSomatorioTransferidosEMF);
          document.getElementById('a39').addEventListener('input', atualizarSomatorioTransferidosEMF);
          document.getElementById('a49').addEventListener('input', atualizarSomatorioTransferidosEMF);
          document.getElementById('a59').addEventListener('input', atualizarSomatorioTransferidosEMF);
          document.getElementById('a69').addEventListener('input', atualizarSomatorioTransferidosEMF);


          //Transferidos Entrada F
          function atualizarSomatorioTransferidosEF() {
              // Obter os valores dos inputs
              var a110 = parseFloat(document.getElementById('a110').value) || 0;
              var a210 = parseFloat(document.getElementById('a210').value) || 0;
              var a310 = parseFloat(document.getElementById('a310').value) || 0;
              var a410 = parseFloat(document.getElementById('a410').value) || 0;
              var a510 = parseFloat(document.getElementById('a510').value) || 0;
              var a610 = parseFloat(document.getElementById('a610').value) || 0;
              // Calcular o somatório
              var somatorio = a110 + a210 + a310 + a410 + a510 + a610;
              // Atualizar o campo somatório
              document.getElementById('transferidosEF').value = somatorio;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a110').addEventListener('input', atualizarSomatorioTransferidosEF);
          document.getElementById('a210').addEventListener('input', atualizarSomatorioTransferidosEF);
          document.getElementById('a310').addEventListener('input', atualizarSomatorioTransferidosEF);
          document.getElementById('a410').addEventListener('input', atualizarSomatorioTransferidosEF);
          document.getElementById('a510').addEventListener('input', atualizarSomatorioTransferidosEF);
          document.getElementById('a610').addEventListener('input', atualizarSomatorioTransferidosEF);


          //Transferidos Saida MF
          function atualizarSomatorioTransferidosSMF() {
              // Obter os valores dos inputs
              var a111 = parseFloat(document.getElementById('a111').value) || 0;
              var a211 = parseFloat(document.getElementById('a211').value) || 0;
              var a311 = parseFloat(document.getElementById('a311').value) || 0;
              var a411 = parseFloat(document.getElementById('a411').value) || 0;
              var a511 = parseFloat(document.getElementById('a511').value) || 0;
              var a611 = parseFloat(document.getElementById('a611').value) || 0;
              // Calcular o somatório
              var SomatorioTransferidosSMF = a111 + a211 + a311 + a411 + a511 + a611;
              // Atualizar o campo somatório
              document.getElementById('transferidosSMF').value = SomatorioTransferidosSMF;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a111').addEventListener('input', atualizarSomatorioTransferidosSMF);
          document.getElementById('a211').addEventListener('input', atualizarSomatorioTransferidosSMF);
          document.getElementById('a311').addEventListener('input', atualizarSomatorioTransferidosSMF);
          document.getElementById('a411').addEventListener('input', atualizarSomatorioTransferidosSMF);
          document.getElementById('a511').addEventListener('input', atualizarSomatorioTransferidosSMF);
          document.getElementById('a611').addEventListener('input', atualizarSomatorioTransferidosSMF);

          //Transferidos Saida F
          function atualizarSomatorioTransferidosSF() {
              // Obter os valores dos inputs
              var a112 = parseFloat(document.getElementById('a112').value) || 0;
              var a212 = parseFloat(document.getElementById('a212').value) || 0;
              var a312 = parseFloat(document.getElementById('a312').value) || 0;
              var a412 = parseFloat(document.getElementById('a412').value) || 0;
              var a512 = parseFloat(document.getElementById('a512').value) || 0;
              var a612 = parseFloat(document.getElementById('a612').value) || 0;
              // Calcular o somatório
              var somatorio = a112 + a212 + a312 + a412 + a512 + a612;
              // Atualizar o campo somatório
              document.getElementById('transferidosSF').value = somatorio;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a112').addEventListener('input', atualizarSomatorioTransferidosSF);
          document.getElementById('a212').addEventListener('input', atualizarSomatorioTransferidosSF);
          document.getElementById('a312').addEventListener('input', atualizarSomatorioTransferidosSF);
          document.getElementById('a412').addEventListener('input', atualizarSomatorioTransferidosSF);
          document.getElementById('a512').addEventListener('input', atualizarSomatorioTransferidosSF);
          document.getElementById('a612').addEventListener('input', atualizarSomatorioTransferidosSF);


          //Desistentes
          function atualizarSomatorioDesistentesMF() {
              // Obter os valores dos inputs
              var a113 = parseFloat(document.getElementById('a113').value) || 0;
              var a213 = parseFloat(document.getElementById('a213').value) || 0;
              var a313 = parseFloat(document.getElementById('a313').value) || 0;
              var a413 = parseFloat(document.getElementById('a413').value) || 0;
              var a513 = parseFloat(document.getElementById('a513').value) || 0;
              var a613 = parseFloat(document.getElementById('a613').value) || 0;
              // Calcular o somatório
              var SomatorioDesistentesMF = a113 + a213 + a313 + a413 + a513 + a613;
              // Atualizar o campo somatório
              document.getElementById('desistentesMF').value = SomatorioDesistentesMF;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a113').addEventListener('input', atualizarSomatorioDesistentesMF);
          document.getElementById('a213').addEventListener('input', atualizarSomatorioDesistentesMF);
          document.getElementById('a313').addEventListener('input', atualizarSomatorioDesistentesMF);
          document.getElementById('a413').addEventListener('input', atualizarSomatorioDesistentesMF);
          document.getElementById('a513').addEventListener('input', atualizarSomatorioDesistentesMF);
          document.getElementById('a613').addEventListener('input', atualizarSomatorioDesistentesMF);


          //Desistentes
          function atualizarSomatorioDesistentesF() {
              // Obter os valores dos inputs
              var a114 = parseFloat(document.getElementById('a114').value) || 0;
              var a214 = parseFloat(document.getElementById('a214').value) || 0;
              var a314 = parseFloat(document.getElementById('a314').value) || 0;
              var a414 = parseFloat(document.getElementById('a414').value) || 0;
              var a514 = parseFloat(document.getElementById('a514').value) || 0;
              var a614 = parseFloat(document.getElementById('a614').value) || 0;
              // Calcular o somatório
              var somatorio = a114 + a214 + a314 + a414 + a514 + a614;
              // Atualizar o campo somatório
              document.getElementById('desistentesF').value = somatorio;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('a114').addEventListener('input', atualizarSomatorioDesistentesF);
          document.getElementById('a214').addEventListener('input', atualizarSomatorioDesistentesF);
          document.getElementById('a314').addEventListener('input', atualizarSomatorioDesistentesF);
          document.getElementById('a414').addEventListener('input', atualizarSomatorioDesistentesF);
          document.getElementById('a514').addEventListener('input', atualizarSomatorioDesistentesF);
          document.getElementById('a614').addEventListener('input', atualizarSomatorioDesistentesF);
      </script>
      <!--Soma dinamica dos dados inseridos no formulário-->


      <!--#######################################################################################################################################-->
      
    @endsection
