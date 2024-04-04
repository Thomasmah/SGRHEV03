
<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , '{{ config('app.name', 'Laravel') }} |  {{isset($endereco) ? 'Editar Endereço' : 'Cadastrar Endereços' }}')
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
                    <h1>Endereço</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">{{isset($endereco)?'Editar Endereço':'Cadastrar Endereço'}}</li>
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
                  <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title"> {{isset($pessoa)?'Editar Endereço':'Cadastrar Endereço'}}</h3>  
                    </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                    <form action="{{ isset($endereco) ? route('enderecos.update',['id' => $endereco->id]) : route('enderecos.store') }}" method="post">
                      @csrf
                      @method('post')
                    <!--Area de Mensagens e erros-->
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
                        <div class="card-body">
                          <div  class="form-group">
                          <label for="provincia">Escolha uma Província:</label>
                              <select name="provincia" id="provincia" onchange="carregarMunicipios()" class="form-control select2" style="width: 100%;">
                                  <option value="{{isset($naturalidade) ? $naturalidade->provincia : ''}}">{{isset($naturalidade) ? $naturalidade->provincia : 'Seleccione Uma Província'}}</option>
                                  <option value="Luanda">Luanda</option>
                                  <option value="Benguela">Benguela</option>
                                  <option value="Huambo">Huambo</option>
                                  <!-- Adicione mais opções de província aqui -->
                          
                                </select>
                              <label for="municipio">Escolha um Município:</label>
                              <select id="municipio" name="municipio" class="form-control select2" style="width: 100%;">
                                  <option value="{{isset($naturalidade) ? $naturalidade->municipio : ''}}">{{isset($naturalidade) ? $naturalidade->municipio : 'Seleccione o Município'}}</option>
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" name="bairro" class="form-control" id="bairro" placeholder="Bairro" value="{{ isset($endereco) ? $endereco->bairro : ''}}">
                            <label for="zona">Zona</label>
                            <input type="text" name="zona" class="form-control" id="zona" placeholder="Zona" value="{{ isset($endereco) ? $endereco->zona : ''}}">
                            <label for="quarteirao">Quarteirão</label>
                            <input type="text" name="quarteirao" class="form-control" id="quarteirao" placeholder="Quarteirão" value="{{ isset($endereco) ? $endereco->quarteirao : ''}}">
                            <label for="rua">Rua</label>
                            <input type="text" name="rua" class="form-control" id="rua" placeholder="Rua" value="{{ isset($endereco) ? $endereco->rua : ''}}">
                            <label for="casa">Número da Casa</label>
                            <input type="text" name="casa" class="form-control" id="casa" placeholder="Casa" value="{{ isset($endereco) ? $endereco->casa : ''}}">
                          </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary" style="width: 100%;">{{ isset($endereco) ? 'Actualizar Endereço' : 'Cadastrar Endereços'}}</button>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('enderecos.index')}}" class="btn btn-primary" style="width: 100%;">Endereços / Index</a>
                        </div>
                      </form>
                    </div>
                    <!-- /.card -->
                    </div>
                  <!--/.col (left) -->
                  <!-- right column -->
                  <div class="col-md-6">

                  </div>
                  <!--/.col (right) -->
                </div>
                <!-- /.row -->
              </div><!-- /.container-fluid -->
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
@endsection
