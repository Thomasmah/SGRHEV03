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
                                <label for="nomeCompleto"><span class="text-danger">*</span>Nome Completo</label>
                                <input type="text" name="nomeCompleto" class="form-control" id="nomeCompleto" placeholder="Nome Completo" maxlength="250" required value="{{ isset($pessoa) ? $pessoa->nomeCompleto : ''}}">
                                <label for="dataNascimento"><span class="text-danger">*</span>Data de Nascimento</label>
                                <input type="date" name="dataNascimento" class="form-control" id="dataNascimento" placeholder="12-12-2000" required value="{{ isset($pessoa) ? $pessoa->dataNascimento : ''}}" >
                              </div>
                              <div class="form-group">
                                <label for="numeroBI"> <span class="text-danger">*</span> Bilhete de Identidade "BI"</label>
                                <input type="text" name="numeroBI" class="form-control" id="numeroBI" maxlength="14" placeholder="002223421AE042" required value="{{ isset($pessoa) ? $pessoa->numeroBI : ''}}">
                                <label for="validadeBI"><span class="text-danger">*</span> Validade do Bilhete de Identidade "BI"</label>
                                <input type="date" name="validadeBI" class="form-control" id="validadeBI" placeholder="12-12-2000" required value="{{ isset($pessoa) ? $pessoa->validadeBI : ''}}">
                              </div>
                              
                              <label>Naturalidade</label>
                              <div  class="form-group">
                              <label for="provincia"><span class="text-danger">*</span>Escolha uma Província:</label>
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
                                  <label for="municipio"><span class="text-danger">*</span>Escolha um Município:</label>
                                  <select id="municipio" name="municipio" class="form-control select2" style="width: 100%;" required>
                                      <option value="{{isset($naturalidade) ? $naturalidade->municipio : ''}}">{{isset($naturalidade) ? $naturalidade->municipio : 'Seleccione o Município'}}</option>
                                  </select>
                              </div>


                              <div class="form-group">
                                <label for="genero"><span class="text-danger">*</span>Genero</label>
                                  <select name="genero" class="form-control select2" style="width: 100%;" required>
                                      <option selected="{{isset($pessoa) ? $pessoa->genero : ''}}">{{isset($pessoa) ? $pessoa->genero : 'Seleccione o Sexo'}}</option>
                                      <option>Feminino</option>
                                      <option>Masculino</option>
                                  </select>
                              </div>
                          
                              <label>Parentesco:</label>
                              <div class="form-group">
                                <label for="nomePai"><span class="text-danger">*</span>Nome do Pai</label>
                                <input type="text" name="nomePai" class="form-control" id="nomePai" maxlength="250" placeholder="Nome Completo do Pai" value="{{ isset($parente) ? $parente->nomePai : ''}}" required>
                                <label for="nomeMae"><span class="text-danger">*</span>Nome da Mãe</label>
                                <input type="text" name="nomeMae" class="form-control" id="nomeMae" maxlength="250" placeholder="Nome Completo do Mãe" value="{{ isset($parente) ? $parente->nomeMae : ''}}" required>
                              </div>
                              <div class="form-group">
                                <label for="grupoSanguineo">Grupo Sanguineo</label>
                                  <select name="grupoSanguineo" class="form-control select2" style="width: 100%;">
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
                                <label for="estadoCivil"><span class="text-danger">*</span>Estado Civil</label>
                                  <select name="estadoCivil" class="form-control select2" style="width: 100%;" >
                                      <option value="{{isset($pessoa) ? $pessoa->estadoCivil : ''}}">{{isset($pessoa) ? $pessoa->estadoCivil : 'Seleccione o Estado Cívil'}}</option>
                                      <option>Casados(a)</option>
                                      <option>Solteiro(a)</option>
                                  </select>
                              </div>
                              <div  class="form-group {{ isset($pessoa) ? 'd-none' : '' }}">
                              <label>Endereço</label>
                              <br>
                              <label for="provinciaEndereco">Escolha uma Província:</label>
                                  <select name="provinciaEndereco" id="provinciaEndereco" onchange="carregarMunicipiosEndereco()" class="form-control select2" style="width: 100%;" >
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
                                  <label for="municipioEndereco">Escolha um Município:</label>
                                  <select id="municipioEndereco" name="municipioEndereco" class="form-control select2" style="width: 100%;" >
                                      <option value="{{isset($naturalidade) ? $naturalidade->municipio : ''}}">{{isset($naturalidade) ? $naturalidade->municipio : 'Seleccione o Município'}}</option>
                                  </select>
                                  <label for="bairro">Bairro</label>
                                  <input type="text" name="bairro" class="form-control"  placeholder="Bairro Popular nº 2" maxlength="250"  value="{{ isset($pessoa) ? $pessoa->nomeCompleto : ''}}">
                                  <label for="zona">Zona</label>
                                  <input type="text" name="zona" class="form-control"  placeholder="Bairro Popular nº 2" maxlength="250"  value="{{ isset($pessoa) ? $pessoa->nomeCompleto : ''}}">
                                  <label for="quarteirao">Quarteirão</label>
                                  <input type="text" name="quarteirao" class="form-control"  placeholder="Quarteirão nº 2" maxlength="250"  value="{{ isset($pessoa) ? $pessoa->nomeCompleto : ''}}">
                                  <label for="rua">Rua</label>
                                  <input type="text" name="rua" class="form-control"  placeholder="Rua F " maxlength="100"  value="{{ isset($pessoa) ? $pessoa->nomeCompleto : ''}}">
                                  <label for="casa">Casa</label>
                                  <input type="text" name="casa" class="form-control"  placeholder="30" maxlength="10"  value="{{ isset($pessoa) ? $pessoa->nomeCompleto : ''}}">
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
                              municipioSelect.innerHTML += "<option value='Ambriz'>Ambriz </option>";
                              municipioSelect.innerHTML += "<option value='Bula Atumba'>Bula Atumba </option>";
                              municipioSelect.innerHTML += "<option value='Dande'>Dande </option>";
                              municipioSelect.innerHTML += "<option value='Nambuangongo'>Nambuangongo </option>";
                              municipioSelect.innerHTML += "<option value='Quibaxe'>Quibaxe </option>";
                              municipioSelect.innerHTML += "<option value='Caxito'> Caxito </option>";
                              break;
                          case "Benguela":
                              municipioSelect.innerHTML += "<option value='Baia Farta'>Baia Farta </option>";
                              municipioSelect.innerHTML += "<option value='Balombo'>Balombo </option>";
                              municipioSelect.innerHTML += "<option value='Benguela'>Benguela </option>";
                              municipioSelect.innerHTML += "<option value='Bocoio'>Bocoio </option>";
                              municipioSelect.innerHTML += "<option value='Caimbambo'>Caimbambo </option>";
                              municipioSelect.innerHTML += "<option value='Chongoroi'>Chongoroi </option>";
                              municipioSelect.innerHTML += "<option value='Cubal'>Cubal </option>";
                              municipioSelect.innerHTML += "<option value='Ganda'>Ganda </option>";
                              municipioSelect.innerHTML += "<option value='Lobito'>Lobito </option>";
                              municipioSelect.innerHTML += "<option value='Vaváu'>Vaváu </option>";
                              break;
                          case "Bié":
                              municipioSelect.innerHTML += "<option value='Andulo'>Andulo</option>";
                              municipioSelect.innerHTML += "<option value='Camacupa'>Camacupa</option>";
                              municipioSelect.innerHTML += "<option value='Catabola'>Catabola</option>";
                              municipioSelect.innerHTML += "<option value='Chinguar'>Chinguar</option>";
                              municipioSelect.innerHTML += "<option value='Chitembo'>Chitembo</option>";
                              municipioSelect.innerHTML += "<option value='Cuemba'>Cuemba</option>";
                              municipioSelect.innerHTML += "<option value='Huambo'>Huambo</option>";
                              municipioSelect.innerHTML += "<option value='Cunhinga'>Cunhinga</option>";
                              municipioSelect.innerHTML += "<option value='Kuito'>Kuito</option>";
                              municipioSelect.innerHTML += "<option value='Nhârea'>Nhârea</option>";
                            
                              break;
                          case "Cabinda":
                              municipioSelect.innerHTML += "<option value='Belize'>Belize </option>";
                              municipioSelect.innerHTML += "<option value='Buco-Zau'>Buco-Zau </option>";
                              municipioSelect.innerHTML += "<option value='Cabinda'>Cabinda </option>";
                              municipioSelect.innerHTML += "<option value='Cangongo'>Cangongo </option>";
                              municipioSelect.innerHTML += "<option value='Dinge'>Dinge </option>";
                              municipioSelect.innerHTML += "<option value='Lândana'>Lândana </option>";
                              municipioSelect.innerHTML += "<option value='Luali'>Luali </option>";
                              municipioSelect.innerHTML += "<option value='Massabi'>Massabi </option>";
                              municipioSelect.innerHTML += "<option value='Necuto'>Necuto </option>";
                            
                              break;
                          case "Cuando Cubango":
                              municipioSelect.innerHTML += "<option value='Calai'>Calai </option>";
                              municipioSelect.innerHTML += "<option value='Cuangar'>Cuangar </option>";
                              municipioSelect.innerHTML += "<option value='Cuchi'>Cuchi </option>";
                              municipioSelect.innerHTML += "<option value='Cuito'>Cuito Cuanavale</option>";
                              municipioSelect.innerHTML += "<option value='Dirico'>Dirico </option>";
                              municipioSelect.innerHTML += "<option value='Longa'>Longa </option>";
                              municipioSelect.innerHTML += "<option value='Menongue'>Menongue </option>";
                              municipioSelect.innerHTML += "<option value='Mavinga'>Mavinga </option>";
                              municipioSelect.innerHTML += "<option value='NAncova'>NAncova </option>";
                              municipioSelect.innerHTML += "<option value='Rivungo'>Rivungo </option>";
                            
                              break;
                          case "Cuanza Norte":
                              municipioSelect.innerHTML += "<option value='Ambaca'> Ambaca </option>";
                              municipioSelect.innerHTML += "<option value='Banga'> Banga </option>";
                              municipioSelect.innerHTML += "<option value='Bolongongo'> Bolongongo </option>";
                              municipioSelect.innerHTML += "<option value='Cambambe'> Cambambe </option>";
                              municipioSelect.innerHTML += "<option value='Golungo'> Golungo Alto </option>";
                              municipioSelect.innerHTML += "<option value='Lucala'> Lucala </option>";
                              municipioSelect.innerHTML += "<option value='Ngonguembo'> Ngonguembo </option>";
                              municipioSelect.innerHTML += "<option value='Quiculungo'> Quiculungo </option>";
                              municipioSelect.innerHTML += "<option value='Samba Cajú'> Samba Cajú </option>";
                              municipioSelect.innerHTML += "<option value='Santa Isabel'> Santa Isabel </option>";
                            
                              break;
                          case "Cuanza Sul":
                              municipioSelect.innerHTML += "<option value='Amboim'> Amboim  </option>";
                              municipioSelect.innerHTML += "<option value='Cela'> Cela  </option>";
                              municipioSelect.innerHTML += "<option value='Conda'> Conda  </option>";
                              municipioSelect.innerHTML += "<option value='Ebo'> Ebo  </option>";
                              municipioSelect.innerHTML += "<option value='Libolo'> Libolo  </option>";
                              municipioSelect.innerHTML += "<option value='Mussende'> Mussende  </option>";
                              municipioSelect.innerHTML += "<option value='Porto Amboim'> Porto Amboim  </option>";
                              municipioSelect.innerHTML += "<option value='Quibala'> Quibala  </option>";
                              municipioSelect.innerHTML += "<option value='Quilenda'> Quilenda  </option>";
                              municipioSelect.innerHTML += "<option value='Seles'> Seles  </option>";
                              municipioSelect.innerHTML += "<option value='Sumbe'> Sumbe </option>";
                              break;
                          case "Cunene":
                              municipioSelect.innerHTML += "<option value='Cahama'> Cahama </option>";
                              municipioSelect.innerHTML += "<option value='Kuanhama'> Kuanhama </option>";
                              municipioSelect.innerHTML += "<option value='Kuvelai'> Kuvelai </option>";
                              municipioSelect.innerHTML += "<option value='Namacunde'> Namacunde </option>";
                              municipioSelect.innerHTML += "<option value='Ombadja'> Ombadja </option>";
                              municipioSelect.innerHTML += "<option value='Ondjiva'> Ondjiva </option>";
                          case "Huambo":
                              municipioSelect.innerHTML += "<option value='Bailundo'> Bailundo </option>";
                              municipioSelect.innerHTML += "<option value='Ekunha'> Ekunha </option>";
                              municipioSelect.innerHTML += "<option value='Huambo'> Huambo </option>";
                              municipioSelect.innerHTML += "<option value='Londuimbali'> Londuimbali </option>";
                              municipioSelect.innerHTML += "<option value='Longonjo'> Longonjo </option>";
                              municipioSelect.innerHTML += "<option value='Mungo'> Mungo </option>";
                              municipioSelect.innerHTML += "<option value='Tchicala'> Tchicala Tcholoanga </option>";
                              municipioSelect.innerHTML += "<option value='Ucuma'> Ucuma </option>";
                              break;
                          case "Huíla":
                              municipioSelect.innerHTML += "<option value='Caconda'> Caconda </option>";
                              municipioSelect.innerHTML += "<option value='Cacula'> Cacula </option>";
                              municipioSelect.innerHTML += "<option value='Caluquembe'> Caluquembe </option>";
                              municipioSelect.innerHTML += "<option value='Chicomba'> Chicomba </option>";
                              municipioSelect.innerHTML += "<option value='Chibia'> Chibia </option>";
                              municipioSelect.innerHTML += "<option value='Chipindo'> Chipindo </option>";
                              municipioSelect.innerHTML += "<option value='Humpata'> Humpata </option>";
                              municipioSelect.innerHTML += "<option value='Lubango'> Lubango </option>";
                              municipioSelect.innerHTML += "<option value='Matala'> Matala </option>";
                              municipioSelect.innerHTML += "<option value='Quilengues'> Quilengues </option>";
                              break;
                          case "Luanda":
                              municipioSelect.innerHTML += "<option value='Belas'> Belas </option>";
                              municipioSelect.innerHTML += "<option value='Cacuaco'> Cacuaco </option>";
                              municipioSelect.innerHTML += "<option value='Cazenga'> Cazenga </option>";
                              municipioSelect.innerHTML += "<option value='Icolo e Bengo'> Icolo e Bengo </option>";
                              municipioSelect.innerHTML += "<option value='Luanda'> Luanda </option>";
                              municipioSelect.innerHTML += "<option value='Quiçama'> Quiçama </option>";
                              municipioSelect.innerHTML += "<option value='Talatona'> Talatona </option>";
                              municipioSelect.innerHTML += "<option value='Viana'> Viana </option>";
                              break;
                          case "Lunda Norte":
                              municipioSelect.innerHTML += "<option value='Cambulo'> Cambulo </option>";
                              municipioSelect.innerHTML += "<option value='Capenda'> Capenda Camulemba </option>";
                              municipioSelect.innerHTML += "<option value='Caungula'> Caungula </option>";
                              municipioSelect.innerHTML += "<option value='Chitato'> Chitato </option>";
                              municipioSelect.innerHTML += "<option value='Cuango'> Cuango </option>";
                              municipioSelect.innerHTML += "<option value='Lóvua'> Lóvua </option>";
                              municipioSelect.innerHTML += "<option value='Lubalo'> Lubalo </option>";
                              municipioSelect.innerHTML += "<option value='Lucapa'> Lucapa </option>";
                              municipioSelect.innerHTML += "<option value='Xá Muteba'> Xá Muteba </option>";
                              municipioSelect.innerHTML += "<option value='Cuilo'> Cuilo </option>";
                              break;
                          case "Lunda Sul":
                              municipioSelect.innerHTML += "<option value='Cacolo'> Cacolo </option>";
                              municipioSelect.innerHTML += "<option value='Dala'> Dala </option>";
                              municipioSelect.innerHTML += "<option value='Muconda'> Muconda </option>";
                              municipioSelect.innerHTML += "<option value='Saurimo'> Saurimo </option>";
                              break;
                          case "Malanje":
                              municipioSelect.innerHTML += "<option value='Cahombo'> Cahombo </option>";
                              municipioSelect.innerHTML += "<option value='Caculama'> Caculama </option>";
                              municipioSelect.innerHTML += "<option value='Calandula'> Calandula </option>";
                              municipioSelect.innerHTML += "<option value='Cangandala'> Cangandala </option>";
                              municipioSelect.innerHTML += "<option value='Kangandala'> Kangandala </option>";
                              municipioSelect.innerHTML += "<option value='Kunda'> Kunda dya Baze </option>";
                              municipioSelect.innerHTML += "<option value='Luquembo'> Luquembo </option>";
                              municipioSelect.innerHTML += "<option value='Malanje'> Malanje </option>";
                              municipioSelect.innerHTML += "<option value='Marimba'> Marimba </option>";
                              municipioSelect.innerHTML += "<option value='Massango'> Massango </option>";
                              municipioSelect.innerHTML += "<option value='Mucari'> Mucari </option>";
                              municipioSelect.innerHTML += "<option value='Quela'> Quela </option>";
                              break;
                          case "Moxico":
                              municipioSelect.innerHTML += "<option value='Alto Zambeze'> Alto Zambeze </option>";
                              municipioSelect.innerHTML += "<option value='Bundas'> Bundas </option>";
                              municipioSelect.innerHTML += "<option value='Camanongue'> Camanongue </option>";
                              municipioSelect.innerHTML += "<option value='Cameia'> Cameia </option>";
                              municipioSelect.innerHTML += "<option value='Luacano'> Luacano </option>";
                              municipioSelect.innerHTML += "<option value='Luchazes'> Luchazes </option>";
                              municipioSelect.innerHTML += "<option value='Luena'> Luena </option>";
                              municipioSelect.innerHTML += "<option value='Lumeje'> Lumeje </option>";
                              municipioSelect.innerHTML += "<option value='Luau'> Luau </option>";
                              municipioSelect.innerHTML += "<option value='Lutembo'> Lutembo </option>";
                              municipioSelect.innerHTML += "<option value='Moxico'> Moxico </option>";
                              break;
                          case "Namibe":
                              municipioSelect.innerHTML += "<option value='Bibala'> Bibala </option>";
                              municipioSelect.innerHTML += "<option value='Camucuio'> Camucuio </option>";
                              municipioSelect.innerHTML += "<option value='Moçâmedes'> Moçâmedes </option>";
                              municipioSelect.innerHTML += "<option value='Namibe'> Namibe </option>";
                              break;
                          case "Uíge":
                              municipioSelect.innerHTML += "<option value='Bembe'> Bembe </option>";
                              municipioSelect.innerHTML += "<option value='Buengas'> Buengas </option>";
                              municipioSelect.innerHTML += "<option value='Bungo'> Bungo </option>";
                              municipioSelect.innerHTML += "<option value='Damba'> Damba </option>";
                              municipioSelect.innerHTML += "<option value='Maquela do Zombo'> Maquela do Zombo </option>";
                              municipioSelect.innerHTML += "<option value='Milunga'> Milunga </option>";
                              municipioSelect.innerHTML += "<option value='Negage'> Negage </option>";
                              municipioSelect.innerHTML += "<option value='Puri'> Puri </option>";
                              municipioSelect.innerHTML += "<option value='Quimbele'> Quimbele </option>";
                              municipioSelect.innerHTML += "<option value='Quitexe'> Quitexe </option>";
                              municipioSelect.innerHTML += "<option value='Sanza Pombo'> Sanza Pombo </option>";
                              municipioSelect.innerHTML += "<option value='Songo'> Songo </option>";
                              municipioSelect.innerHTML += "<option value='Alto Cauale'> Alto Cauale </option>";
                              municipioSelect.innerHTML += "<option value='Uíge'> Uíge </option>";
                              break;
                          case "Zaire":
                              municipioSelect.innerHTML += "<option value='Cuimba'> Cuimba </option>";
                              municipioSelect.innerHTML += "<option value='M'banza-Kongo'> M'banza-Kongo </option>";
                              municipioSelect.innerHTML += "<option value='Nóqui'> Nóqui </option>";
                              municipioSelect.innerHTML += "<option value='N'zeto'> N'zeto </option>";
                              municipioSelect.innerHTML += "<option value='Soyo'> Soyo </option>";
                              break;  
                          // Adicione mais casos para outras províncias aqui
                          default:
                              municipioSelect.innerHTML += "<option value=''>Nenhum município disponível</option>";
                      }
                  }, 1000); // Simulando um atraso de 1 segundo para uma solicitação AJAX
              }
          </script>
              <!--Sscripts para Popular o SelectOption das Procincias de Forma Dinamica-->
              <script>
              function carregarMunicipiosEndereco() {
                  const provincia = document.getElementById("provinciaEndereco").value;
                  const municipioSelectEndereco = document.getElementById("municipioEndereco");

                  // Limpe os municípios anteriores
                  municipioSelectEndereco.innerHTML = "<option value=''>Carregando...</option>";

                  // Simule uma solicitação AJAX para obter municípios com base na província selecionada
                  setTimeout(() => {
                      municipioSelectEndereco.innerHTML = "<option value=''>Selecione um município</option>";
                      switch (provincia) {
                          case "Bengo":
                              municipioSelectEndereco.innerHTML += "<option value='Ambriz'>Ambriz </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Bula Atumba'>Bula Atumba </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Dande'>Dande </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Nambuangongo'>Nambuangongo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Quibaxe'>Quibaxe </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Caxito'> Caxito </option>";
                              break;
                          case "Benguela":
                              municipioSelectEndereco.innerHTML += "<option value='Baia Farta'>Baia Farta </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Balombo'>Balombo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Benguela'>Benguela </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Bocoio'>Bocoio </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Caimbambo'>Caimbambo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Chongoroi'>Chongoroi </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cubal'>Cubal </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Ganda'>Ganda </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Lobito'>Lobito </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Vaváu'>Vaváu </option>";
                              break;
                          case "Bié":
                              municipioSelectEndereco.innerHTML += "<option value='Andulo'>Andulo</option>";
                              municipioSelectEndereco.innerHTML += "<option value='Camacupa'>Camacupa</option>";
                              municipioSelectEndereco.innerHTML += "<option value='Catabola'>Catabola</option>";
                              municipioSelectEndereco.innerHTML += "<option value='Chinguar'>Chinguar</option>";
                              municipioSelectEndereco.innerHTML += "<option value='Chitembo'>Chitembo</option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cuemba'>Cuemba</option>";
                              municipioSelectEndereco.innerHTML += "<option value='Huambo'>Huambo</option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cunhinga'>Cunhinga</option>";
                              municipioSelectEndereco.innerHTML += "<option value='Kuito'>Kuito</option>";
                              municipioSelectEndereco.innerHTML += "<option value='Nhârea'>Nhârea</option>";
                            
                              break;
                          case "Cabinda":
                              municipioSelectEndereco.innerHTML += "<option value='Belize'>Belize </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Buco-Zau'>Buco-Zau </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cabinda'>Cabinda </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cangongo'>Cangongo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Dinge'>Dinge </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Lândana'>Lândana </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Luali'>Luali </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Massabi'>Massabi </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Necuto'>Necuto </option>";
                            
                              break;
                          case "Cuando Cubango":
                              municipioSelectEndereco.innerHTML += "<option value='Calai'>Calai </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cuangar'>Cuangar </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cuchi'>Cuchi </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cuito'>Cuito Cuanavale</option>";
                              municipioSelectEndereco.innerHTML += "<option value='Dirico'>Dirico </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Longa'>Longa </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Menongue'>Menongue </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Mavinga'>Mavinga </option>";
                              municipioSelectEndereco.innerHTML += "<option value='NAncova'>NAncova </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Rivungo'>Rivungo </option>";
                            
                              break;
                          case "Cuanza Norte":
                              municipioSelectEndereco.innerHTML += "<option value='Ambaca'> Ambaca </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Banga'> Banga </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Bolongongo'> Bolongongo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cambambe'> Cambambe </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Golungo'> Golungo Alto </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Lucala'> Lucala </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Ngonguembo'> Ngonguembo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Quiculungo'> Quiculungo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Samba Cajú'> Samba Cajú </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Santa Isabel'> Santa Isabel </option>";
                            
                              break;
                          case "Cuanza Sul":
                              municipioSelectEndereco.innerHTML += "<option value='Amboim'> Amboim  </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cela'> Cela  </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Conda'> Conda  </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Ebo'> Ebo  </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Libolo'> Libolo  </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Mussende'> Mussende  </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Porto Amboim'> Porto Amboim  </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Quibala'> Quibala  </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Quilenda'> Quilenda  </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Seles'> Seles  </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Sumbe'> Sumbe </option>";
                              break;
                          case "Cunene":
                              municipioSelectEndereco.innerHTML += "<option value='Cahama'> Cahama </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Kuanhama'> Kuanhama </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Kuvelai'> Kuvelai </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Namacunde'> Namacunde </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Ombadja'> Ombadja </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Ondjiva'> Ondjiva </option>";
                          case "Huambo":
                              municipioSelectEndereco.innerHTML += "<option value='Bailundo'> Bailundo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Ekunha'> Ekunha </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Huambo'> Huambo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Londuimbali'> Londuimbali </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Longonjo'> Longonjo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Mungo'> Mungo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Tchicala'> Tchicala Tcholoanga </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Ucuma'> Ucuma </option>";
                              break;
                          case "Huíla":
                              municipioSelectEndereco.innerHTML += "<option value='Caconda'> Caconda </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cacula'> Cacula </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Caluquembe'> Caluquembe </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Chicomba'> Chicomba </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Chibia'> Chibia </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Chipindo'> Chipindo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Humpata'> Humpata </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Lubango'> Lubango </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Matala'> Matala </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Quilengues'> Quilengues </option>";
                              break;
                          case "Luanda":
                              municipioSelectEndereco.innerHTML += "<option value='Belas'> Belas </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cacuaco'> Cacuaco </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cazenga'> Cazenga </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Icolo e Bengo'> Icolo e Bengo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Luanda'> Luanda </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Quiçama'> Quiçama </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Talatona'> Talatona </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Viana'> Viana </option>";
                              break;
                          case "Lunda Norte":
                              municipioSelectEndereco.innerHTML += "<option value='Cambulo'> Cambulo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Capenda'> Capenda Camulemba </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Caungula'> Caungula </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Chitato'> Chitato </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cuango'> Cuango </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Lóvua'> Lóvua </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Lubalo'> Lubalo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Lucapa'> Lucapa </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Xá Muteba'> Xá Muteba </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cuilo'> Cuilo </option>";
                              break;
                          case "Lunda Sul":
                              municipioSelectEndereco.innerHTML += "<option value='Cacolo'> Cacolo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Dala'> Dala </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Muconda'> Muconda </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Saurimo'> Saurimo </option>";
                              break;
                          case "Malanje":
                              municipioSelectEndereco.innerHTML += "<option value='Cahombo'> Cahombo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Caculama'> Caculama </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Calandula'> Calandula </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cangandala'> Cangandala </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Kangandala'> Kangandala </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Kunda'> Kunda dya Baze </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Luquembo'> Luquembo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Malanje'> Malanje </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Marimba'> Marimba </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Massango'> Massango </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Mucari'> Mucari </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Quela'> Quela </option>";
                              break;
                          case "Moxico":
                              municipioSelectEndereco.innerHTML += "<option value='Alto Zambeze'> Alto Zambeze </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Bundas'> Bundas </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Camanongue'> Camanongue </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Cameia'> Cameia </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Luacano'> Luacano </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Luchazes'> Luchazes </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Luena'> Luena </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Lumeje'> Lumeje </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Luau'> Luau </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Lutembo'> Lutembo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Moxico'> Moxico </option>";
                              break;
                          case "Namibe":
                              municipioSelectEndereco.innerHTML += "<option value='Bibala'> Bibala </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Camucuio'> Camucuio </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Moçâmedes'> Moçâmedes </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Namibe'> Namibe </option>";
                              break;
                          case "Uíge":
                              municipioSelectEndereco.innerHTML += "<option value='Bembe'> Bembe </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Buengas'> Buengas </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Bungo'> Bungo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Damba'> Damba </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Maquela do Zombo'> Maquela do Zombo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Milunga'> Milunga </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Negage'> Negage </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Puri'> Puri </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Quimbele'> Quimbele </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Quitexe'> Quitexe </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Sanza Pombo'> Sanza Pombo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Songo'> Songo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Alto Cauale'> Alto Cauale </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Uíge'> Uíge </option>";
                              break;
                          case "Zaire":
                              municipioSelectEndereco.innerHTML += "<option value='Cuimba'> Cuimba </option>";
                              municipioSelectEndereco.innerHTML += "<option value='M'banza-Kongo'> M'banza-Kongo </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Nóqui'> Nóqui </option>";
                              municipioSelectEndereco.innerHTML += "<option value='N'zeto'> N'zeto </option>";
                              municipioSelectEndereco.innerHTML += "<option value='Soyo'> Soyo </option>";
                              break;  
                          // Adicione mais casos para outras províncias aqui
                          default:
                              municipioSelectEndereco.innerHTML += "<option value=''>Nenhum município disponível</option>";
                      }
                  }, 1000); // Simulando um atraso de 1 segundo para uma solicitação AJAX
              }
          </script>
    @endsection
