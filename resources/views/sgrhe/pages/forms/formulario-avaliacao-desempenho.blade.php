<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , isset($pessoa) ? 'Editar Pessoa' : 'Avaliar Funcionário' )
        @section('header')
        <!--Style Local-->
        <style>
          .slider {
              -webkit-appearance: none;
              width: 100%;
              height: 25px;
              background: #d3d3d3;
              outline: none;
              opacity: 0.7;
              -webkit-transition: .2s;
              transition: opacity .2s;
              border-radius: 20px;
            }

            .slider:hover {
              opacity: 1;
            }

            .slider::-webkit-slider-thumb {
              -webkit-appearance: none;
              appearance: none;
              width: 25px;
              height: 25px;
              background: red;
              cursor: pointer;
              border-radius: 30px;
            }

            .slider::-moz-range-thumb {
              width: 25px;
              height: 25px;
              background: #4CAF50;
              cursor: pointer;
            }

            .options {
              display: flex;
              justify-content: space-between;
              margin-top: 10px;
            }

            .options label {
              font-size: 14px;
              color: #666;
            }

        </style>
        @endsection
        @section('conteudo_principal')
          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>Avaliação de Desempenho de </h1>
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
                  <div class="col-md-10 offset-md-1">
                    <div class="card card-primary">
                      <div class="card-header">
                            <h3 class="card-title"> Formulário de Avaliação de Desempenho </h3>  
                      </div>
                        <form action="{{ route('submeter.avaliar.funcionario') }}" method="post">
                          @csrf
                          @method('post')
                          <div class="card-body">
                              <div class="form-group">
                                <label for="nomeCompleto">Nome Completo: </label>
                                <input type="text" name="nomeCompleto" class="form-control" id="nomeCompleto" value="{{ $pessoaCandidato->nomeCompleto }}" readonly required>
                                <label for="numeroAgente">Número de Agente: </label>
                                <input type="text" name="numeroAgente" class="form-control" id="numeroAgente" value="{{ $funcionarioCandidato->numeroAgente }}" readonly required>
                                <label for="idCargo">Cargo:</label>
                                <input type="text" name="cargo" class="form-control" value="{{ $cargoCandidato->designacao}}" readonly required>
                                <input type="hidden" name="idCargo" id="idCargo" value="{{ $cargoCandidato->id}}" required>
                                <label for="idUnidadeOrganica">Unidade Orgânica:</label>
                                <input type="text" name="unidadeOrganica" class="form-control" value="{{ $unidadeOrganicaCandidato->designacao}}" readonly required>
                                <input type="hidden" name="idUnidadeOrganica" id="idUnidadeOrganica" value="{{ $unidadeOrganicaCandidato->id}}" required>
                                <label for="idCategoria">Categoria:</label>
                                <input type="text" name="categoria" class="form-control" value="{{ $categoriaFuncionarioCandidato->categoria.' do '.$categoriaFuncionarioCandidato->grau }}" readonly required>
                                <input type="hidden" name="idCategoria" id="idCategoria" value="{{ $categoriaFuncionarioCandidato->id }}" required>
                                <input type="hidden" name="idFuncionario" class="form-control" id="idFuncionario" value="{{ $funcionarioCandidato->id}}" readonly required>
                              </div>
                          </div>
                          <div class="card-header">
                                      <p class="card-title">
                                       <span class="text-danger font-weight-bold">* </span> <label for="periodoAvaliacao">Periódo de avaliação do mês de Fevereiro à Dezembro de</label> <input name="periodoAvaliacao" class="form-control d-inline-block" style="width: 100px;" type="number" min="2020" max="2099" step="1" value="" placeholder="2020" required/>
                                      </p>
                                      <br>
                          </div>
                          <br>
                          <div class="card-body">                           
                            <div class="col-m-6">
                              <div class="">
                                   

                                    <div class="card-body">
                                      <table id="" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                          <th class="text-center" >Item</th>
                                          <th>Características</th>
                                          <th class="text-center">Pontuação</th>
                                        </tr>
                                        </thead>
                                        <tr>
                                          <th class="text-center" scope="row">1</th><td>Competência Profissional</td><td class="text-center"><input class="form-control text-center" type="number" min="10" max="60" name="um"  id="um" oninvalid="this.setCustomValidity('Por favor, insira um valor entre 10 e 60')" oninput="this.setCustomValidity"></td>
                                        </tr>
                                        <tr>
                                          <th class="text-center" scope="row">2</th><td>Cumprimento de Tarefas</td><td class="text-center"><input class="form-control text-center" type="number" min="10" max="60" name="dois"  id="dois" oninvalid="this.setCustomValidity('Por favor, insira um valor entre 10 e 60')" oninput="this.setCustomValidity"></td>
                                        </tr>
                                        <tr>
                                          <th class="text-center" scope="row">3</th><td>Adaptação Profissional</td><td class="text-center"><input class="form-control text-center" type="number" min="10" max="60" name="tres"  id="tres" oninvalid="this.setCustomValidity('Por favor, insira um valor entre 10 e 60')" oninput="this.setCustomValidity"></td>
                                        </tr>
                                        <tr>
                                          <th class="text-center" scope="row">4</th><td>Racionalização do uso e Manutenção dos Meiosa</td><td class="text-center"><input class="form-control text-center" type="number" min="10" max="60" name="quatro"  id="quatro" oninvalid="this.setCustomValidity('Por favor, insira um valor entre 10 e 60')" oninput="this.setCustomValidity"></td>
                                        </tr>
                                        <tr>
                                          <th class="text-center" scope="row">5</th><td>Relações Humanas no Trabalho</td><td class="text-center"><input class=" form-control text-center" type="number" min="10" max="60" name="cinco"  id="cinco" oninvalid="this.setCustomValidity('Por favor, insira um valor entre 10 e 60')" oninput="this.setCustomValidity"></td>
                                        </tr>
                                        <tr>
                                          <th class="text-center" scope="row">6</th><td>Capacidade Para Dirigir</td><td class="text-center"><input class=" form-control text-center" type="number" min="10" max="60" name="seis"  id="seis" oninvalid="this.setCustomValidity('Por favor, insira um valor entre 10 e 60')" oninput="this.setCustomValidity"></td>
                                        </tr>
                                        <tr>
                                          <th class="text-center" scope="row">7</th><td>Pontuação Obtida</td><td class="text-center">  <input class="text-center" type="numeric" name="total"  id="total" ></td>
                                        </tr>
                                      </table>
                                    </div>     
                              </div>
                            </div>
                          </div>
                          <!--Dados Submetidos de Forma Oculta-->
                          <div class="card-body">
                          <input type="hidden" name="classificacao" value="10">
                            <button type="submit" class="btn btn-primary w-100">Submeter Avaiação dos Funcionário</button>
                          </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
        @endsection
    @section('scripts')
    <script>
        function actualizarAvaliacao() {
              // Obter os valores dos inputs
              var um = parseFloat(document.getElementById('um').value) || 0;
              var dois = parseFloat(document.getElementById('dois').value) || 0;
              var tres = parseFloat(document.getElementById('tres').value) || 0;
              var quatro = parseFloat(document.getElementById('quatro').value) || 0;
              var cinco = parseFloat(document.getElementById('cinco').value) || 0;
              var seis = parseFloat(document.getElementById('seis').value) || 0;
              // Calcular o somatório
              var classificacao = um + dois + tres + quatro + cinco + seis;
              // Atualizar o campo somatório
              document.getElementById('total').value = classificacao;
          }
          
          // Adicionar eventos de input aos campos a21, a22, a23, a24, a25, a26
          document.getElementById('um').addEventListener('input', actualizarAvaliacao);
          document.getElementById('dois').addEventListener('input', actualizarAvaliacao);
          document.getElementById('tres').addEventListener('input', actualizarAvaliacao);
          document.getElementById('quatro').addEventListener('input', actualizarAvaliacao);
          document.getElementById('cinco').addEventListener('input', actualizarAvaliacao);
          document.getElementById('seis').addEventListener('input', actualizarAvaliacao);

    </script>
    <script>

    </script>
    @endsection
