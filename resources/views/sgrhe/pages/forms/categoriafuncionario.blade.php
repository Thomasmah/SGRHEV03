<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , isset($categoriafuncionario) ? 'Editar Categoria Fucnionário' : 'Cadastrar Categoria Funcionário' )
        @section('header')
      
        @endsection
  @section('conteudo_principal')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Categoria de Funcionários</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">{{isset($categoriafuncionario)?'Editar Categoria Fucionário':'Cadastrar Categoria Funcionário'}}</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-8 offset-md-2">
              <!-- jquery validation -->
              <div class="card card-primary">
                <div class="card-header">
                      <h3 class="card-title">{{isset($categoriafuncionario)?'Editar Categoria Fucionário':'Cadastrar Categoria Funcionário'}}</h3>  
                  </div>
                  <!--Verifcar a Existencia da Variavel Cargo para determinar se Editar ou Criar um novo Registro-->
                  <form action="{{ isset($categoriafuncionario) ? route('categoriafuncionarios.update',['id' => $categoriafuncionario->id]) : route('categoriafuncionarios.store') }}" method="post">
                    @csrf
                    @method('post')
                      <div class="card-body">
                        <div class="form-group">
                          <label for="categoria">Escolha uma Categoria de Funcionário:</label>
                              <select name="categoria" id="provincia" onchange="carregarMunicipios()" class="form-control select1" style="width: 100%;">
                                  <option value="{{isset($categoriafuncionario) ? $categoriafuncionario->categoria : 'Selecione uma Categoria de Funcionário'}}">{{isset($categoriafuncionario) ? $categoriafuncionario->categoria : 'Selecione uma Categoria de Funcionário'}}</option>
                                  <option value="Professor do Primeiro Ciclo do Ensino Primário e Secundário">Professor do Primeiro Ciclo do Ensino Primário e Secundário</option>
                                  <option value="Bacharel">Bacharel</option>
                                  <option value="Professor do Segundo Ciclo">Professor do Segundo Ciclo</option>
                              </select>
                        </div>
                        <div class="form-group">
                          <label for="municipio">Escolha o grau:</label>
                          <select id="municipio" name="municipio" class="form-control select2" style="width: 100%;">
                            <option value="{{isset($categoriafuncionario) ? $categoriafuncionario->grau : ''}}">{{isset($categoriafuncionario) ? $categoriafuncionario->grau : 'Selecione uma Categoria Primeiro'}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="salariobase">Salário Base</label>
                                  <input type="text" name="salariobase" class="form-control" id="salariobase" placeholder="Salário Base" value="{{isset($categoriafuncionario) ? $categoriafuncionario->salariobase : ''}}">
                          </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" style="width: 100%;">{{ isset($categoriafuncionario)? 'Actualizar Natureza Categoria de Funcionário' : 'Criar Natureza de Categoria de Funcionário' }}</button>
                            <br>
                            <br>
                            <a href="{{route('categoriafuncionarios.index')}}" class="btn btn-primary" style="width: 100%;"> Cargos / Index  </a>
                        </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  @endsection
  @section('scripts')
    <!--Sscripts para Popular o SelectOption das Procincias de Forma Dinamica-->
    <script>
            function carregarMunicipios() {
                const provincia = document.getElementById("provincia").value;
                const municipioSelect = document.getElementById("municipio");

                // Limpe os municípios anteriores
                municipioSelect.innerHTML = "<option value=''>Carregando...</option>";

                // Simule uma solicitação AJAX para obter municípios com base na província selecionada
                setTimeout(() => {
                    municipioSelect.innerHTML = "<option value=''>Selecione um município</option>";
                    switch (provincia) {
                        case "Luanda":
                            municipioSelect.innerHTML += "<option value='LuandaA'>Luanda A</option>";
                            municipioSelect.innerHTML += "<option value='LuandaB'>Luanda B</option>";
                            break;
                        case "Benguela":
                            municipioSelect.innerHTML += "<option value='BenguelaA'>Benguela A</option>";
                            municipioSelect.innerHTML += "<option value='BenguelaB'>Benguela B</option>";
                            break;
                        case "Huambo":
                            municipioSelect.innerHTML += "<option value='HuamboA'>Huambo A</option>";
                            municipioSelect.innerHTML += "<option value='HuamboB'>Huambo B</option>";
                            break;
                        // Adicione mais casos para outras províncias aqui
                        default:
                            municipioSelect.innerHTML += "<option value=''>Nenhum município disponível</option>";
                    }
                }, 1000); // Simulando um atraso de 1 segundo para uma solicitação AJAX
            }
          </script>
          <script>
            function carregarMunicipios() {
                const provincia = document.getElementById("provincia").value;
                const municipioSelect = document.getElementById("municipio");

                // Limpe os municípios anteriores
                municipioSelect.innerHTML = "<option value=''>Carregando...</option>";

                // Simule uma solicitação AJAX para obter municípios com base na província selecionada
                setTimeout(() => {
                    municipioSelect.innerHTML = "<option value=''>Selecione um Grau</option>";
                    switch (provincia) {
                        case "Professor do Primeiro Ciclo do Ensino Primário e Secundário":
                            municipioSelect.innerHTML += "<option value='13º Grau'>13º Grau</option>";
                            municipioSelect.innerHTML += "<option value='12º Grau'>12º Grau</option>";
                            municipioSelect.innerHTML += "<option value='11º Grau'>11º Grau</option>";
                            municipioSelect.innerHTML += "<option value='10º Grau'>10º Grau</option>";
                            break;
                        case "Bacharel":
                            municipioSelect.innerHTML += "<option value='9º Grau'>9º Grau</option>";
                            municipioSelect.innerHTML += "<option value='8º Grau'>8º Grau</option>";
                            municipioSelect.innerHTML += "<option value='7º Grau'>7º Grau</option>";
                            break;
                        case "Professor do Segundo Ciclo":
                            municipioSelect.innerHTML += "<option value='7º Grau'>6º Grau</option>";
                            municipioSelect.innerHTML += "<option value='5º Grau'>5º Grau</option>";
                            municipioSelect.innerHTML += "<option value='4º Grau'>4º Grau</option>";
                            break;
                        default:
                            municipioSelect.innerHTML += "<option value=''>Nenhum município disponível</option>";
                    }
                }, 1000); // Simulando um atraso de 1 segundo para uma solicitação AJAX
            }
          </script>
   @endsection
