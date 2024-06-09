<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , isset($UnidadeOrganica)?'Editar Unidade Orgânica':'Cadastrar Unidade Orgânica' )
        @section('header')
        <!--Style Local-->
        @endsection
        @section('conteudo_principal')
          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>{{isset($UnidadeOrganica)?'Editar Unidade Orgânica':'Cadastrar Unidade Orgânica'}}</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">{{isset($UnidadeOrganica)?'Editar Unidade Orgânica':'Cadastrar Unidade Orgânica'}}</li>
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
                            <h3 class="card-title"> {{isset($UnidadeOrganica)?'Editar Unidade Orgânica':'Cadastrar Unidade Orgânica'}} </h3>  
                        </div>
                        <form id="formularioUnidadeOrganica" action="{{ isset($UnidadeOrganica) ? route('unidadeorganicas.update',[$UnidadeOrganica->id]) : route('unidadeorganicas.store') }}" method="post">
                          @csrf
                          @method('post')
                            <div class="card-body">
                              <div class="form-group">
                                <label for="designacao">Designação da Unidade Ogânica</label>
                                <input type="text" name="designacao" class="form-control" id="designacao" placeholder="Designaca da Unidade Organica" value="{{isset($UnidadeOrganica) ? $UnidadeOrganica->designacao : '' }}" required>
                              </div>
                              <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <input type="text" name="descricao" class="form-control" id="descricao" placeholder="Descricao do Cargo" value="{{isset($UnidadeOrganica) ? $UnidadeOrganica->descricao : '' }}">
                              </div>
                              <div class="form-group">
                                <label for="eqt">EQT</label>
                                <input type="text" name="eqt" class="form-control" id="eqt" placeholder="EQT  da Unidade Orgânica" value="{{isset($UnidadeOrganica) ? $UnidadeOrganica->eqt : '' }}" required>
                              </div>
                              <label for="nivelEnsino[]">Níveis de Ensino</label>
                              <div class="form-group border border-secondary rounded text-secondary" style="padding: 10px;">
                                <span> *. Não Definido </span><input  type="checkbox" id="firstCheckbox" name="nivelEnsino[]" value="Não Definido" checked>
                                <br><span> 1. Ensino Pré Escolar - </span><input  type="checkbox" name="nivelEnsino[]" value="Pré Escolar">
                                <br><span> 2. Ensio Primário - </span><input  type="checkbox" name="nivelEnsino[]" value="Primário">
                                <br><span> 3. I Ciclo do Ensino Secundário- </span><input  type="checkbox" name="nivelEnsino[]" value="I Ciclo">
                                <br><span> 4. II Ciclo do Ensino Secundário - </span><input  type="checkbox" name="nivelEnsino[]" value="II Ciclo">
                                <br>
                              </div>
                              <br>
                              <div class="form-group">
                                <label for="decretoCriacao">Decreto de Criação</label>
                                <input type="text" name="decretoCriacao" class="form-control" id="decretoCriacao" placeholder="Decreto de Criação do da Unidade Orgânica" value="{{isset($UnidadeOrganica) ? $UnidadeOrganica->decretoCriacao : '' }}">
                              </div>
                              <div class="form-group">
                                <label for="localidade">Localidade</label>
                                <input type="text" name="localidade" class="form-control" id="localidade" placeholder="Localidade da Unidade Organica" value="{{isset($UnidadeOrganica) ? $UnidadeOrganica->localidade : '' }}" required>
                              </div>
                              <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="text" name="telefone" class="form-control" id="telefone" placeholder="Telefone da Unidade Orgânica" value="{{isset($UnidadeOrganica) ? $UnidadeOrganica->telefone : '' }}">
                              </div>
                              <div class="form-group">
                                <label for="email">Email da Unidade Orgânica</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Email da Unidade Orgânica" value="{{isset($UnidadeOrganica) ? $UnidadeOrganica->email : '' }}">
                              </div>
                              <div class="card-footer">
                                  <button type="submit" class="btn btn-primary" style="width: 100%;">{{isset($UnidadeOrganica) ? 'Actualizar Unidade Orgánica ':'Cadastrar Unidade Orgánica'}}</button>
                                  <br>
                                  <br>
                              <a href="{{route('unidadeorganicas.index')}}" class="btn btn-primary" style="width: 100%;"> Unidades Organicas / Index </a>
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
          document.querySelectorAll('input[type="checkbox"][name="nivelEnsino[]"]').forEach(function(checkbox) {
              checkbox.addEventListener('click', function() {
                  var firstCheckbox = document.getElementById('firstCheckbox');
                  if (this !== firstCheckbox) {
                      firstCheckbox.checked = false;
                  }
                  if (!this.checked) {
                      var allUnchecked = true;
                      document.querySelectorAll('input[type="checkbox"][name="nivelEnsino[]"]').forEach(function(checkbox) {
                          if (checkbox !== firstCheckbox && checkbox.checked) {
                              allUnchecked = false;
                          }
                      });
                      if (allUnchecked) {
                          firstCheckbox.checked = true;
                      }
                  }
              });
          });
          </script>
 @endsection
