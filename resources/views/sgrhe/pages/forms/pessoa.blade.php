<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , isset($pessoa) ? 'Editar Pessoa' : 'Cadastrar Pessoa' )
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
                    <h3 class="title">Entidade Pessoa</h3>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">{{isset($pessoa)?'Editar Pessoa':'Cadastrar Pessoa'}}</li>
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
                              <h3 class="card-title"> {{isset($pessoa)?'Editar Pessoa':'Cadastrar Pessoa'}}</h3>  
                        </div>
                        <div class="card-body">
                           <!-- form-->
                            <form action="{{ isset($pessoa) ? route('pessoas.update',['id' => $pessoa->id]) : route('pessoas.store') }}" method="post">
                              @csrf
                              @method('post')
                          
                              <label>Identificação</label>
                              <div class="form-group">
                                <label for="nomeCompleto">Nome Completo</label>
                                <input type="text" name="nomeCompleto" class="form-control" id="nomeCompleto" placeholder="Nome Completo" maxlength="250" required value="{{ isset($pessoa) ? $pessoa->nomeCompleto : ''}}">
                                <label for="dataNascimento">Data de Nascimento</label>
                                <input type="date" name="dataNascimento" class="form-control" id="dataNascimento" placeholder="12-12-2000" required value="{{ isset($pessoa) ? $pessoa->dataNascimento : ''}}" >
                              </div>
                              <div class="form-group">
                                <label for="numeroBI">Bilhete de Identidade "BI"</label>
                                <input type="text" name="numeroBI" class="form-control" id="numeroBI" maxlength="14" placeholder="002223421AE042" required value="{{ isset($pessoa) ? $pessoa->numeroBI : ''}}">
                                <label for="validadeBI"> Validade do Bilhete de Identidade "BI"</label>
                                <input type="date" name="validadeBI" class="form-control" id="validadeBI" placeholder="12-12-2000" required value="{{ isset($pessoa) ? $pessoa->validadeBI : ''}}">
                              </div>
                              
                              <label>Naturalidade</label>
                              <div  class="form-group">
                              <label for="provincia">Escolha uma Província:</label>
                                  <select name="provincia" id="provincia" onchange="carregarMunicipios()" class="form-control select2" style="width: 100%;" required>
                                      <option value="{{isset($naturalidade) ? $naturalidade->provincia : ''}}">{{isset($naturalidade) ? $naturalidade->provincia : 'Seleccione Uma Província'}}</option>
                                      <option value="Bengo">Bengo</option>
                                      <option value="Benguela">Benguela</option>
                                      <option value="Bié">Bié</option>
                                      <option value="Cabinda">Cabinda</option>
                                      <option value="Cuando Cubango">Cuando Cubango</option>
                                      <option value="Cuanza Norte">Cuanza Norte</option>
                                      <option value="Cuanza Sul">Cuanza Sul</option>
                                      <option value="Cunene">Cunene</option>
                                      <option value="Huambo">Huambo</option>
                                      <option value="Huíla">Huíla</option>
                                      <option value="Luanda">Luanda</option>
                                      <option value="Lunda Norte">Lunda Norte</option>
                                      <option value="Lunda Sul">Lunda Sul</option>
                                      <option value="Malanje">Malanje</option>
                                      <option value="Moxico">Moxico</option>
                                      <option value="Namibe">Namibe</option>
                                      <option value="Uíge">Uíge</option>
                                      <option value="Zaire">Zaire</option>
                                  
                                      <!-- Adicione mais opções de província aqui -->
                              
                                    </select>
                                  <label for="municipio">Escolha um Município:</label>
                                  <select id="municipio" name="municipio" class="form-control select2" style="width: 100%;" required>
                                      <option value="{{isset($naturalidade) ? $naturalidade->municipio : ''}}">{{isset($naturalidade) ? $naturalidade->municipio : 'Seleccione o Município'}}</option>
                                  </select>
                              </div>


                              <div class="form-group">
                                <label for="genero">Genero</label>
                                  <select name="genero" class="form-control select2" style="width: 100%;" required>
                                      <option selected="{{isset($pessoa) ? $pessoa->genero : ''}}">{{isset($pessoa) ? $pessoa->genero : 'Seleccione o Sexo'}}</option>
                                      <option>Feminino</option>
                                      <option>Masculino</option>
                                  </select>
                              </div>
                          
                              <label>Parentesco:</label>
                              <div class="form-group">
                                <label for="nomePai">Nome do Pai</label>
                                <input type="text" name="nomePai" class="form-control" id="nomePai" maxlength="250" placeholder="Nome Completo do Pai" value="{{ isset($parente) ? $parente->nomePai : ''}}" required>
                                <label for="nomeMae">Nome da Mãe</label>
                                <input type="text" name="nomeMae" class="form-control" id="nomeMae" maxlength="250" placeholder="Nome Completo do Mãe" value="{{ isset($parente) ? $parente->nomeMae : ''}}" required>
                              </div>
                              <div class="form-group">
                                <label for="grupoSanguineo">Grupo Sanguineo</label>
                                  <select name="grupoSanguineo" class="form-control select2" style="width: 100%;" required>
                                      <option value="{{isset($pessoa) ? $pessoa->grupoSanguineo : ''}}"> {{ isset($pessoa) ? $pessoa->grupoSanguineo : 'Seleccione o Grupo Sanguíneo' }} </option>
                                      <option >A+</option>
                                      <option >A-</option>
                                      <option >B+</option>
                                      <option >B-</option>
                                      <option >AB+</option>
                                      <option >AB-</option>
                                      <option >O+</option>
                                      <option >O-</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                <label for="estadoCivil">Estado Civil</label>
                                  <select name="estadoCivil" class="form-control select2" style="width: 100%;" required>
                                      <option value="{{isset($pessoa) ? $pessoa->estadoCivil : ''}}">{{isset($pessoa) ? $pessoa->estadoCivil : 'Seleccione o Estado Cívil'}}</option>
                                      <option>Casados(a)</option>
                                      <option>Solteiro(a)</option>
                                  </select>
                              </div>
                              <button type="submit" class="btn btn-primary" style="width: 100%;">{{ isset($pessoa) ? 'Actualizar Dados da Entidade Pessoa ' : 'Cadastrar Entidade Pessoa'}}</button>
                            </form>
                            <!-- /form-->
                        </div>
                        <div class="card-footer">
                          <a href="{{route('pessoas.index')}}" class="btn btn-primary" style="width: 100%;">Pessoas / Index</a>
                        </div>
                    </div>
                    <!-- /.card -->
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
                          case "Bengo":
                              municipioSelect.innerHTML += "<option value='Bengo'>Ambriz </option>";
                              municipioSelect.innerHTML += "<option value='Bengo'>Bula Atumba </option>";
                              municipioSelect.innerHTML += "<option value='Bengo'>Dande </option>";
                              municipioSelect.innerHTML += "<option value='Bengo'>Nambuangongo </option>";
                              municipioSelect.innerHTML += "<option value='Bengo'>Quibaxe </option>";
                              municipioSelect.innerHTML += "<option value='Caxito </option>";
                              break;
                          case "Benguela":
                              municipioSelect.innerHTML += "<option value='Benguela'>Baia Farta </option>";
                              municipioSelect.innerHTML += "<option value='Benguela'>Balombo </option>";
                              municipioSelect.innerHTML += "<option value='Benguela'>Benguela </option>";
                              municipioSelect.innerHTML += "<option value='Benguela'>Bocoio </option>";
                              municipioSelect.innerHTML += "<option value='Benguela'>Caimbambo </option>";
                              municipioSelect.innerHTML += "<option value='Benguela'>Chongoroi </option>";
                              municipioSelect.innerHTML += "<option value='Benguela'>Cubal </option>";
                              municipioSelect.innerHTML += "<option value='Benguela'>Ganda </option>";
                              municipioSelect.innerHTML += "<option value='Benguela'>Lobito </option>";
                              municipioSelect.innerHTML += "<option value='Benguela'>Vaváu </option>";
                              break;
                          case "Bié":
                              municipioSelect.innerHTML += "<option value='Bié'>Andulo A</option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Camacupa A</option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Catabola A</option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Chinguar A</option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Chitembo A</option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Cuemba A</option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Huambo A</option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Cunhinga A</option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Kuito A</option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Nhârea A</option>";
                            
                              break;
                          case "Cabinda":
                              municipioSelect.innerHTML += "<option value='Bié'>Belize </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Buco-Zau </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Cabinda </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Cangongo </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Dinge </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Lândana </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Luali </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Massabi </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Necuto </option>";
                            
                              break;
                          case "Cuando Cubango":
                              municipioSelect.innerHTML += "<option value='Bié'>Calai </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Cuangar </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Cuchi </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Cuito Cuanavale</option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Dirico </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Longa </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Menongue </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Mavinga </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>NAncova </option>";
                              municipioSelect.innerHTML += "<option value='Bié'>Rivungo </option>";
                            
                              break;
                          case "Cuanza Norte":
                              municipioSelect.innerHTML += "<option value='Cuanza Norte'> Ambaca </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Norte'> Banga </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Norte'> Bolongongo </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Norte'> Cambambe </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Norte'> Golungo Alto </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Norte'> Lucala </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Norte'> Ngonguembo </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Norte'> Quiculungo </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Norte'> Samba Cajú </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Norte'> Santa Isabel </option>";
                            
                              break;
                          case "Cuanza Sul":
                              municipioSelect.innerHTML += "<option value='Cuanza Sul'> Amboim  </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Sul'> Cela  </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Sul'> Conda  </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Sul'> Ebo  </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Sul'> Libolo  </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Sul'> Mussende  </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Sul'> Porto Amboim  </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Sul'> Quibala  </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Sul'> Quilenda  </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Sul'> Seles  </option>";
                              municipioSelect.innerHTML += "<option value='Cuanza Sul'> Sumbe </option>";
                              break;
                          case "Cunene":
                              municipioSelect.innerHTML += "<option value='Cunene'> Cahama </option>";
                              municipioSelect.innerHTML += "<option value='Cunene'> Kuanhama </option>";
                              municipioSelect.innerHTML += "<option value='Cunene'> Kuvelai </option>";
                              municipioSelect.innerHTML += "<option value='Cunene'> Namacunde </option>";
                              municipioSelect.innerHTML += "<option value='Cunene'> Ombadja </option>";
                              municipioSelect.innerHTML += "<option value='Cunene'> Ondjiva </option>";
                          case "Huambo":
                              municipioSelect.innerHTML += "<option value='Huambo'> Bailundo </option>";
                              municipioSelect.innerHTML += "<option value='Huambo'> Ekunha </option>";
                              municipioSelect.innerHTML += "<option value='Huambo'> Huambo </option>";
                              municipioSelect.innerHTML += "<option value='Huambo'> Londuimbali </option>";
                              municipioSelect.innerHTML += "<option value='Huambo'> Longonjo </option>";
                              municipioSelect.innerHTML += "<option value='Huambo'> Mungo </option>";
                              municipioSelect.innerHTML += "<option value='Huambo'> Tchicala Tcholoanga </option>";
                              municipioSelect.innerHTML += "<option value='Huambo'> Ucuma </option>";
                              break;
                          case "Huíla":
                              municipioSelect.innerHTML += "<option value='Huíla'> Caconda </option>";
                              municipioSelect.innerHTML += "<option value='Huíla'> Cacula </option>";
                              municipioSelect.innerHTML += "<option value='Huíla'> Caluquembe </option>";
                              municipioSelect.innerHTML += "<option value='Huíla'> Chicomba </option>";
                              municipioSelect.innerHTML += "<option value='Huíla'> Chibia </option>";
                              municipioSelect.innerHTML += "<option value='Huíla'> Chipindo </option>";
                              municipioSelect.innerHTML += "<option value='Huíla'> Humpata </option>";
                              municipioSelect.innerHTML += "<option value='Huíla'> Lubango </option>";
                              municipioSelect.innerHTML += "<option value='Huíla'> Matala </option>";
                              municipioSelect.innerHTML += "<option value='Huíla'> Quilengues </option>";
                              break;
                          case "Luanda":
                              municipioSelect.innerHTML += "<option value='Luanda'> Belas </option>";
                              municipioSelect.innerHTML += "<option value='Luanda'> Cacuaco </option>";
                              municipioSelect.innerHTML += "<option value='Luanda'> Cazenga </option>";
                              municipioSelect.innerHTML += "<option value='Luanda'> Icolo e Bengo </option>";
                              municipioSelect.innerHTML += "<option value='Luanda'> Luanda </option>";
                              municipioSelect.innerHTML += "<option value='Luanda'> Quiçama </option>";
                              municipioSelect.innerHTML += "<option value='Luanda'> Talatona </option>";
                              municipioSelect.innerHTML += "<option value='Luanda'> Viana </option>";
                              break;
                          case "Lunda Norte":
                              municipioSelect.innerHTML += "<option value='Lunda Norte'> Cambulo </option>";
                              municipioSelect.innerHTML += "<option value='Lunda Norte'> Capenda Camulemba </option>";
                              municipioSelect.innerHTML += "<option value='Lunda Norte'> Caungula </option>";
                              municipioSelect.innerHTML += "<option value='Lunda Norte'> Chitato </option>";
                              municipioSelect.innerHTML += "<option value='Lunda Norte'> Cuango </option>";
                              municipioSelect.innerHTML += "<option value='Lunda Norte'> Lóvua </option>";
                              municipioSelect.innerHTML += "<option value='Lunda Norte'> Lubalo </option>";
                              municipioSelect.innerHTML += "<option value='Lunda Norte'> Lucapa </option>";
                              municipioSelect.innerHTML += "<option value='Lunda Norte'> Xá Muteba </option>";
                              municipioSelect.innerHTML += "<option value='Lunda Norte'> Cuilo </option>";
                              break;
                          case "Lunda Sul":
                              municipioSelect.innerHTML += "<option value='Lunda Sul'> Cacolo </option>";
                              municipioSelect.innerHTML += "<option value='Lunda Sul'> Dala </option>";
                              municipioSelect.innerHTML += "<option value='Lunda Sul'> Muconda </option>";
                              municipioSelect.innerHTML += "<option value='Lunda Sul'> Saurimo </option>";
                              break;
                          case "Malanje":
                              municipioSelect.innerHTML += "<option value='Malanje'> Cahombo </option>";
                              municipioSelect.innerHTML += "<option value='Malanje'> Caculama </option>";
                              municipioSelect.innerHTML += "<option value='Malanje'> Calandula </option>";
                              municipioSelect.innerHTML += "<option value='Malanje'> Cangandala </option>";
                              municipioSelect.innerHTML += "<option value='Malanje'> Kangandala </option>";
                              municipioSelect.innerHTML += "<option value='Malanje'> Kunda dya Baze </option>";
                              municipioSelect.innerHTML += "<option value='Malanje'> Luquembo </option>";
                              municipioSelect.innerHTML += "<option value='Malanje'> Malanje </option>";
                              municipioSelect.innerHTML += "<option value='Malanje'> Marimba </option>";
                              municipioSelect.innerHTML += "<option value='Malanje'> Massango </option>";
                              municipioSelect.innerHTML += "<option value='Malanje'> Mucari </option>";
                              municipioSelect.innerHTML += "<option value='Malanje'> Quela </option>";
                              break;
                          case "Moxico":
                              municipioSelect.innerHTML += "<option value='Moxico'> Alto Zambeze </option>";
                              municipioSelect.innerHTML += "<option value='Moxico'> Bundas </option>";
                              municipioSelect.innerHTML += "<option value='Moxico'> Camanongue </option>";
                              municipioSelect.innerHTML += "<option value='Moxico'> Cameia </option>";
                              municipioSelect.innerHTML += "<option value='Moxico'> Luacano </option>";
                              municipioSelect.innerHTML += "<option value='Moxico'> Luchazes </option>";
                              municipioSelect.innerHTML += "<option value='Moxico'> Luena </option>";
                              municipioSelect.innerHTML += "<option value='Moxico'> Lumeje </option>";
                              municipioSelect.innerHTML += "<option value='Moxico'> Luau </option>";
                              municipioSelect.innerHTML += "<option value='Moxico'> Lutembo </option>";
                              municipioSelect.innerHTML += "<option value='Moxico'> Moxico </option>";
                              break;
                          case "Namibe":
                              municipioSelect.innerHTML += "<option value='Namibe'> Bibala </option>";
                              municipioSelect.innerHTML += "<option value='Namibe'> Camucuio </option>";
                              municipioSelect.innerHTML += "<option value='Namibe'> Moçâmedes </option>";
                              municipioSelect.innerHTML += "<option value='Namibe'> Namibe </option>";
                              break;
                          case "Uíge":
                              municipioSelect.innerHTML += "<option value='Uíge'> Bembe </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Buengas </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Bungo </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Damba </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Maquela do Zombo </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Milunga </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Negage </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Puri </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Quimbele </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Quitexe </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Sanza Pombo </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Songo </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Alto Cauale </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Uíge </option>";
                              break;
                          case "Zaire":
                              municipioSelect.innerHTML += "<option value='Zaire'> Cuimba </option>";
                              municipioSelect.innerHTML += "<option value='Zaire'> M'banza-Kongo </option>";
                              municipioSelect.innerHTML += "<option value='Zaire'> Nóqui </option>";
                              municipioSelect.innerHTML += "<option value='Zaire'> N'zeto </option>";
                              municipioSelect.innerHTML += "<option value='Zaire'> Soyo </option>";
                              break;  
                          // Adicione mais casos para outras províncias aqui
                          default:
                              municipioSelect.innerHTML += "<option value=''>Nenhum município disponível</option>";
                      }
                  }, 1000); // Simulando um atraso de 1 segundo para uma solicitação AJAX
              }
          </script>
    @endsection
