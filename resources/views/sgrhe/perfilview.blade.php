<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'Perfil - '.$pessoa->nomeCompleto )
        @section('header')
        
             <!--Estilizacao do Previw foto de Perfil-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
               <!--Configuracao do Input da Foto de Perfil-->
                <style>
                  #inputFotoPerfil::before{
                    content: 'Actualizar Foto de Perfil'; /* Display the custom text */
              
                  }
                  .info-toggle {
                    display: none; 
                    transition: display 0.5s ease;
                  }

                  .info-toggle.visible {
                    display: block; 
                    transition: display 0.5s ease;
                    
                  }
                  .btn-toggle {
                    text-align: left;
                  }
                  .atrubutos-intem-funcionario{
                  /*  border: .5px dotted grey;*/
                    margin:10px;
                  }
                  .intem-funcionario{
                    border-radius: 10px;
                    background-color:rgba(0, 0, 0, 0.05);
                    margin: 10px;
                    padding: 10px;
                  }

                </style>    
              <!-- Scripts -->
        @endsection
        @section('conteudo_principal')
                                                                                      @php
                                                                                         $idEndereco = App\Models\Endereco::where('idPessoa',  $pessoa->id)->first();
                                                                                         //echo($biArquivo->first()->caminho);
                                                                                      @endphp
      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
            <section class="content-header ">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>Perfil do Funcionário</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Página Inicial</a></li>
                      <li class="breadcrumb-item active">Perfil do Funcionário </li>
                    </ol>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <!--col -->
                    <div class="col-md-4">       
                      <!-- Profile Image -->
                      <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                          <div class="text-center">
                            <!--Verificador e renderizador de foto de Perfil-->  
                               <!--Verificador e renderizador de foto de Perfil-->  
                              @php
                              $fotodeperfil = App\Models\Arquivo::where('idFuncionario',$funcionario->id )->where('categoria','FotoPerfil');
                              // echo($fotodeperfil->first()->caminho);
                                  
                              @endphp 
                              @if ($fotodeperfil->exists())            
                                <!--Se existir (foto de Perfil-->
                              <img class="profile-user-img img-fluid img-circle"
                                      src="{{ route('Exibir.Imagem', ['imagem' => base64_encode($fotodeperfil->first()->caminho)]) }}"
                                      alt="User profile picture">
                              @else
                              <!--Se Nao existir foto de Perfil-->
                            
                              <img class="profile-user-img img-fluid img-circle"
                              src="{{ route('Avatar.Usuario') }}"
                                      alt="User profile picture">
                              @endif
                                      
                              <!--Edicao e Corte de imagen -->
                                <div class="container">
                                    <p>Foto de Perfil</p>
                                    <form id="uploadForm" method="POST" action="{{ route('foto.perfil.actualizar') }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="custom-file">
                                          <input type="file" class="image custom-file-input" id="inputFotoPerfil">
                                          <input type="hidden" name="categoria" value="FotoPerfil">
                                          <input type="hidden" name="idFuncionario" value="{{ isset($idFuncionario) ?  $idFuncionario  : $funcionario->id }}">
                                          <label class="custom-file-label" for="inputFotoPerfil">Escolha uma Foto de Perfil</label>
                                        </div>
                                        <input type="file" class="custom-file-input">
                                        <input type="hidden" class="d-none"  name="croppedImage" id="croppedImage" value="">
                                        <button id="btn-Actualizar" class="btn btn-primary d-none" type="submit">Actualizar foto do Perfil</button>
                                    </form>
                                </div>

                                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-lg" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="modalLabel">Foto do Perfil</h5>
                                                  <button type="button" class=" close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">x</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  <div class="img-container">
                                                      <div class="row">
                                                          <div class="col-md-8">
                                                              <img id="image">
                                                          </div>
                                                          <div class="col-md-4">
                                                              <div class="preview"></div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                  <button type="button" class="btn btn-primary" id="crop">Recortar</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              <!--Edicao e Corte de imagen /-->
                          </div>

                          <h5 class="profile-username text-center">{{ $pessoa->nomeCompleto}}</h5>
                          <p class="text-muted text-center">Agente: {{ $funcionario->numeroAgente }}</p>
                          <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                              <p><b>Nome do Pai:</b> {{ $parente->nomePai }} </p> 
                              <p><b>Nome da Mãe:</b> {{ $parente->nomeMae }} </p>
                              <p><b>Naturalidade (Província):</b> {{ $naturalidade->provincia }} </p> 
                              <p><b>Naturalidade (Município):</b> {{ $naturalidade->municipio }} </p> 
                              <p><b>Categoria:</b> {{ $categoriaFuncionario->categoria }} </p>
                              <p><b>Data de Admissão:</b> {{ \Carbon\Carbon::parse($funcionario->dataAdmissao)->format('d/m/Y') }} </p>          
                              <p><b>Unidade Orgânica:</b> {{ $unidadeOrganica->designacao }} </p>
                              <p><b>Grau:</b> {{ $categoriaFuncionario->grau }} </p>    
                              <p><b>Secção:</b> {{ $seccao->designacao }} </p>                            
                              <p><b>Cargo:</b> {{ $cargo->designacao }} </p>    
                              <p><b>Telefone:</b> {{ $funcionario->numeroTelefone }} </p>
                            </li>
                            <li class="list-group-item d-none" style="text-align: center;">
                              <img src="#" alt="">
                              <small class="text-muted">Assinatura Digital</small>
                            </li>
                            <li class="list-group-item d-none">
                              <form  method="POST" action="{{ route('assinatura.update') }}" enctype="multipart/form-data" >
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                  <small class="texte-muted">O ficheiro de assinatura deve ter 500X500 px de tamanho, e com conteud centalizado!"</small>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="hidden" name="idFuncionario" id="idFuncionario" value="{{ $funcionario->id }}">
                                      <input type="hidden" name="categoria" value="Assinatura">
                                      <label class="custom-file-label" for="arquivo">Escolha um arquivo</label>
                                      <input type="file" class="custom-file-input" name="arquivo">
                                    </div>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-secondary  btn-block">Actualizar Ass.</button>
                              </form>
                            </li>
                            <li>
                              <form action="{{ route('ver.ficha.funcionario') }}" method="POST" >
                                @csrf
                                @method('POST')
                                <input type="hidden" name="categoria" value="FichaFuncionario">
                                <input type="hidden" name="idFuncionario" value="{{$funcionario->id}}">
                                <input type="submit" class="btn btn-primary w-100" value="Ficha do Funcionário">
                              </form>
                            </li>
                          </ul>
                          <a href="#" class="btn btn-primary d-none"><b>Enviar Mensagem</b></a>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                  <!--/col -->
                  <!--col -->
                      <div class="col-md-8">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">Documentos / Sobre o Funcionário</h3>
                            </div>
                            <div class="card-body">               
                                                    <!--Item Funcionario Bilhete de Identidade-->
                                                      <div class="intem-funcionario"> 
                                                       <h6 class="card-header"><strong><i class="far fa-file-alt mr-1"></i> Bilhete de Identidade</strong></h6>
                                                            <!--Solicitando a existencia do registro do arquivo no banco de dados-->
                                                              @php
                                                              use Carbon\Carbon;
                                                                $biArquivo = App\Models\Arquivo::where('idFuncionario',  $funcionario->id  )->where('categoria','BI');
                                                                //echo($biArquivo->first()->caminho);
                                                              @endphp 
                                                              @if ($biArquivo->exists()) 
                                                              @php
                                                                $bi = App\Models\BI::where('idFuncionario',$funcionario->id);
                                                                $validade = Carbon::now()->greaterThan($bi->first()->dataValidade);
                                                              @endphp
                                                            <div class="btn btn-toggle " data-target="item-bi" style="text-align: left;">
                                                            <p class="atrubutos-intem-funcionario">Número de Bilhete de Identidade: <span class="text-muted">{{ $bi->first()->numeroBI}}</span></p>
                                                            <p class="atrubutos-intem-funcionario">Data de Validade: <span class="text-muted">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $bi->first()->dataValidade)->format('d-m-Y') }}</span></p>
                                  
                                                                  
                                                                 
                                                                  @isset($validade)
                                                                    @if ($validade)
                                                                      <p class="atrubutos-intem-funcionario">Estado de Validação: <span class="text-danger"> BI Expirado !</span></p>
                                                                    @else
                                                                    <p class="atrubutos-intem-funcionario">Estado de Validação: <span class="text-success"> BI Válido </span></p>
                                                                    @endif
                                                                  @endisset
                                                 
                                                          </div>
                                                          <div id="item-bi" class="info-toggle">
                                                            @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                              <!--BTN Modal de Add Arquivo -->
                                                                <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addBI" data-form-action="{{ route('arquivos.store',['idFuncionario' => $funcionario->id, 'categoria' => 'BI', 'idPessoa' => $funcionario->idPessoa ]) }}">
                                                                  <i class="fa fa-plus"></i>  Actualizar Bilhete De Identidade
                                                                </button>
                                                              <!--/BTN Modal de Add Arquivo -->
                                                            @endif
                                                            <!--BTN  de ver Arquivo -->
                                                              <a class="btn btn-primary" href="{{ route('Exibir.Imagem', ['imagem' => base64_encode($biArquivo->first()->caminho)]) }}" target="_blank">
                                                                <i class="far fa-file-alt mr-1"></i> Ver Arquivo
                                                              </a>
                                                            <!--/BTN de ver Arquivo -->
                                                          
                                                          </div>
                                                                @else
                                                          <div class="btn btn-toggle " data-target="item-bi" style="text-align: left;">
                                                          <p class="text-danger">Não Actualizado</p>                                                         
                                                          </div>
                                                          <div id="item-bi" class="info-toggle">
                                                          @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                            <!--BTN Modal de Add Arquivo -->
                                                              <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addBI" data-form-action="{{ route('arquivos.store',['idFuncionario' => $funcionario->id, 'categoria' => 'BI',  'idPessoa' => $funcionario->idPessoa ]) }}">
                                                                  <i class="fa fa-plus "></i> Adicionar Bilhete De Identidade
                                                              </button>
                                                            <!--/BTN Modal de Add Arquivo -->
                                                          @endif
                                                        
                                                          </div>
                                                                @endif
                                                              <!--Modal de Add Arquivo -->
                                                                <div class="modal fade" id="addBI" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                                  <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h6 class="modal-title" id="exampleModalLabel">Bilhete de Identidade</h6>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <!-- Formulário dentro da modal -->
                                                                                <form method="POST" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                
                                                                                    <div class="form-group">
                                                                                        <label for="numeroBI">Número de BI</label>
                                                                                        <input type="text" class="form-control" id="numeroBI" name="numeroBI" placeholder="Introduza o Número de BI">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="validadeBI" >Data de Validade / Válido até</label>
                                                                                        <input type="date" class="form-control" id="validadeBI" name="validadeBI" placeholder="Password">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="arquivo">O BI deve estar no formato "pdf, png e jpg"</label>
                                                                                        <div class="input-group">
                                                                                            <div class="custom-file">
                                                                                                <input type="file" class="custom-file-input" name="arquivo">
                                                                                                <label class="custom-file-label" for="arquivo">Escolha um arquivo</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input type="checkbox" name="confirmar" class="form-check-input">
                                                                                        <label class="form-check-label" for="confirmar">Clique para Confirmar</label>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                                          <button type="submit" class="btn btn-primary">Actualizar Bilhete de Identidade</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                  </div>
                                                                </div>
                                                              <!--/Modal de Add Arquivo -->
                                                      </div>
                                                      <hr>
                                                    <!--/Item Funcionario Bilhete de Identidade-->                         
                                                    
                                                    <!--Item Funcionario Cartão de Munícipe-->
                                                      <div class="intem-funcionario"> 
                                                       <h6 class="card-header"><strong><i class="far fa-file-alt mr-1"></i>Cartão de Munícipe</strong></h6>
                                                            <!--Solicitando a existencia do registro do arquivo no banco de dados-->
                                                              @php
                                                            
                                                                $biArquivo = App\Models\Arquivo::where('idFuncionario',  $funcionario->id  )->where('categoria','CM');
                                                                //echo($biArquivo->first()->caminho);
                                                              @endphp 
                                                              @if ($biArquivo->exists()) 
                                                              @php
                                                                $cartaoMunicipe = App\Models\CartaoMunicipe::where('idEndereco',$idEndereco->id);
                                                                $validade = Carbon::now()->greaterThan($cartaoMunicipe->first()->validadeCM);
                                                              @endphp
                                                            <div class="btn btn-toggle " data-target="item-CM" style="text-align: left;">
                                                            <p class="atrubutos-intem-funcionario"> Província: <span class="text-muted"> {{ $idEndereco->provincia}}</span></p>
                                                            <p class="atrubutos-intem-funcionario"> Município: <span class="text-muted"> {{$idEndereco->municipio }}</span></p>
                                                            <p class="atrubutos-intem-funcionario"> Zona: <span class="text-muted"> {{$idEndereco->zona }}</span></p>
                                                            <p class="atrubutos-intem-funcionario"> Quarteirão: <span class="text-muted"> {{$idEndereco->quarteirao }}</span></p>
                                                            <p class="atrubutos-intem-funcionario"> Rua: <span class="text-muted"> {{$idEndereco->rua }}</span></p>
                                                            <p class="atrubutos-intem-funcionario"> Casa: <span class="text-muted"> {{$idEndereco->casa }}</span></p>

                                                            <p class="atrubutos-intem-funcionario">Data de Validade: <span class="text-muted"> {{ $cartaoMunicipe->first()->validadeCM }}</span></p>
                                  
                                                                  @isset($validade)
                                                                    @if ($validade)
                                                                      <p class="atrubutos-intem-funcionario">Estado de Validação: <span class="text-danger"> Cartão de Munícipe Expirado !</span></p>
                                                                    @else
                                                                    <p class="atrubutos-intem-funcionario">Estado de Validação: <span class="text-success">Cartão de Munícipe Válido </span></p>
                                                                    @endif
                                                                  @endisset
                                                 
                                                          </div>
                                                          <div id="item-CM" class="info-toggle">
                                                            @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                              <!--BTN Modal de Add Arquivo -->
                                                                <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addCM" data-form-action="{{ route('arquivos.store',['idFuncionario' => $funcionario->id, 'categoria' => 'BI', 'idPessoa' => $funcionario->idPessoa ]) }}">
                                                                  <i class="fa fa-plus"></i>  Actualizar Cartão de Munícipe
                                                                </button>
                                                              <!--/BTN Modal de Add Arquivo -->
                                                            @endif
                                                            <!--BTN  de ver Arquivo -->
                                                              <a class="btn btn-primary" href="{{ route('Exibir.Imagem', ['imagem' => base64_encode($biArquivo->first()->caminho)]) }}" target="_blank">
                                                                <i class="far fa-file-alt mr-1"></i> Ver Arquivo
                                                              </a>
                                                            <!--/BTN de ver Arquivo -->
                                                          
                                                          </div>
                                                                @else
                                                          <div class="btn btn-toggle " data-target="item-CM" style="text-align: left;">
                                                          <p class="text-danger">Não Actualizado</p>                                                         
                                                          </div>
                                                          <div id="item-CM" class="info-toggle">
                                                          @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                            <!--BTN Modal de Add Arquivo -->
                                                              <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addCM" data-form-action="{{ route('arquivos.store.cm',['idFuncionario' => $funcionario->id, 'categoria' => 'CM',  'idPessoa' => $funcionario->idPessoa ]) }}">
                                                                  <i class="fa fa-plus "></i> Adicionar Cartão de Munícipe
                                                              </button>
                                                            <!--/BTN Modal de Add Arquivo -->
                                                          @endif
                                                        
                                                          </div>
                                                                @endif
                                                              <!--Modal de Add Arquivo -->
                                                                <div class="modal fade" id="addCM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                                  <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h6 class="modal-title" id="exampleModalLabel">Cartão de Munícipe</h6>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <!-- Formulário dentro da modal -->
                                                                                <form method="POST" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div  class="form-group">
                                                                                      <input type="hidden" name="idEndereco" value="{{ $idEndereco->id }}">
                                                                                      <label>Endereço</label>
                                                                                      <label for="provinciaEndereco">Escolha uma Província:</label>
                                                                                          <select name="provinciaEndereco" id="provinciaEndereco" onchange="carregarMunicipiosEndereco()" class="form-control select2" style="width: 100%;" >
                                                                                              <option value="{{isset($naturalidade) ? $naturalidade->provincia : ''}}">{{isset($idEndereco) ? $idEndereco->provincia : 'Seleccione Uma Província'}}</option>
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
                                                                                              <option value="{{isset($naturalidade) ? $naturalidade->municipio : ''}}">{{isset($idEndereco) ? $idEndereco->municipio : 'Seleccione o Município'}}</option>
                                                                                          </select>
                                                                                          <label for="bairro">Bairro</label>
                                                                                          <input type="text" name="bairro" class="form-control"  placeholder="Bairro Popular nº 2" maxlength="250"  value="{{ isset($idEndereco) ? $idEndereco->bairro : ''}}">
                                                                                          <label for="zona">Zona</label>
                                                                                          <input type="text" name="zona" class="form-control"  placeholder="Zona nº 2" maxlength="20"  value="{{ isset($idEndereco) ? $idEndereco->zona : ''}}">
                                                                                          <label for="quarteirao">Quarteirão</label>
                                                                                          <input type="text" name="quarteirao" class="form-control"  placeholder="Quarteirão nº 2" maxlength="250"  value="{{ isset($idEndereco) ? $idEndereco->quarteirao : ''}}">
                                                                                          <label for="rua">Rua</label>
                                                                                          <input type="text" name="rua" class="form-control"  placeholder="Rua F " maxlength="100"  value="{{ isset($idEndereco) ? $idEndereco->rua : ''}}">
                                                                                          <label for="casa">Casa</label>
                                                                                          <input type="text" name="casa" class="form-control"  placeholder="30" maxlength="10"  value="{{ isset($idEndereco) ? $idEndereco->casa : ''}}">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="Área de Residência">Área de Residência</label>
                                                                                        <input type="text" class="form-control" id="areaResidencia" name="areaResidencia" placeholder=" N3P-53JK-KJ">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="validadeCM" >Data de Validade / Válido até</label>
                                                                                        <input type="date" class="form-control" id="validadeCM" name="validadeCM" placeholder="Password">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="arquivo">O Cartão de Munícipe deve estar no formato "pdf"</label>
                                                                                        <div class="input-group">
                                                                                            <div class="custom-file">
                                                                                                <input type="file" class="custom-file-input" name="arquivo">
                                                                                                <label class="custom-file-label" for="arquivo">Escolha um arquivo</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div class="form-check">
                                                                                        <input type="checkbox" name="confirmar" class="form-check-input">
                                                                                        <label class="form-check-label" for="confirmar">Clique para Confirmar</label>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                                          <button type="submit" class="btn btn-primary">Actualizar Cartão de Munícipe</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                  </div>
                                                                </div>
                                                              <!--/Modal de Add Arquivo -->
                                                      </div>
                                                      <hr>
                                                    <!--/Item Funcionario Cartão de Munícipe-->                         
                                                    
                                                    
                                                    <!--Item Funcionario Habilitações -->
                                                      <div class="intem-funcionario"> 
                                                        <h6 class="card-header"><strong><i class="far fa-file-alt mr-1"></i> Habilitações Literais</strong></h6>
                                                            <!--Solicitando a existencia do registro do arquivo no banco de dados-->
                                                            @php
                                                              $arquivo = App\Models\Arquivo::where('idFuncionario',$funcionario->id)->where('categoria','Habilitacoes');
                                                              $dados = App\Models\Documento::where('idFuncionario',$funcionario->id)->where('categoria','Habilitacoes')->first();
                                                              parse_str($dados , $documento);
                                                             
                                                            @endphp
                                                             
                                                              @if ($arquivo->exists())
                                                          <div class="btn btn-toggle " data-target="item-Habilitacoes" style="text-align: left;">
                                                            <p class="atrubutos-intem-funcionario">Nivel: <span class="text-muted">{{ $documento['nivel'] }} </span></p>
                                                            
                                                            <p class="atrubutos-intem-funcionario">Instituição: <span class="text-muted">{{ $documento['instituicao'] }} </span></p>
                                                            
                                                            <p class="atrubutos-intem-funcionario">Curso: <span class="text-muted">{{ $documento['curso'] }} </span></p>
                                                            
                                                            <p class="atrubutos-intem-funcionario">Estado: <span class="text-muted">{{ $documento['status'] }} </span></p>
                                                            
                                                            <p class="atrubutos-intem-funcionario">Ano de Conclusão: <span class="text-muted">{{ $documento['anoConclusao'] }} </span></p>
                                                            
                                                            <p class="atrubutos-intem-funcionario">Nota Final <span class="text-muted">{{ $documento['notaFinal'] }} </span></p>                                                         
                                                          </div>
                                                          <div id="item-Habilitacoes" class="info-toggle">
                                                            @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                            <!--BTN Modal de Add Arquivo -->
                                                              <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addHabilitacoes" data-form-action="{{ route('inserir.documento') }} " >
                                                              <i class="fa fa-plus"></i>Actualizar Habilitações
                                                              </button>
                                                            <!--/BTN Modal de Add Arquivo -->
                                                            @endif
                                                            <!--BTN  de ver Arquivo -->
                                                              <a class="btn btn-primary" href="{{ route('exibir.doc', ['documento' => base64_encode($arquivo->first()->caminho)]) }}" target="_blank">
                                                                <i class="far fa-file-alt mr-1"></i> Ver Arquivo
                                                              </a>
                                                            <!--/BTN de ver Arquivo -->
                                                          </div>
                                                                @else
                                                          <div class="btn btn-toggle " data-target="item-Habilitacoes" style="text-align: left;">
                                                            <p class="text-danger">Não Actualizado</p>
                                                          </div>
                                                          <div id="item-Habilitacoes" class="info-toggle">
                                                          @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                            <!--BTN Modal de Add Arquivo -->
                                                              <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addHabilitacoes" data-form-action="{{ route('inserir.documento') }}">
                                                                  <i class="fa fa-plus"></i> Actualizar Habilitações Literais
                                                              </button>
                                                            <!--/BTN Modal de Add Arquivo -->
                                                          @endif
                                                          </div>
                                                                @endif
                                                            <!--Modal de Add Arquivo -->
                                                               <div class="modal fade" id="addHabilitacoes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h6 class="modal-title" id="exampleModalLabel">Actualização da Habilitações</h6>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <!-- Formulário dentro da modal -->
                                                                                <form method="POST" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('POST')
                                                                                    <div class="form-group">
                                                                                        <label for="instituicao">Nome da Instituição</label>
                                                                                        <input type="text" class="form-control" id="instituicao" name="instituicao" placeholder="Digite o nome da Instituição do cerificado!">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                      <label for="nivel">Nivel de Formação</label>
                                                                                        <select name="nivel" class="form-control select2" style="width: 100%;">
                                                                                            <option selected="">Escolha o nível de Formação</option>
                                                                                            <option>Base</option>
                                                                                            <option>Médio</option>
                                                                                            <option>Superior</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="curso">Curso Especialidade</label>
                                                                                        <input type="text" class="form-control" id="curso" name="curso" placeholder="Digite a especialidade tal como está no certificado!">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                      <label for="status">Status</label>
                                                                                        <select name="status" class="form-control select2" style="width: 100%;">
                                                                                            <option selected="">Estado</option>
                                                                                            <option>Em Andamento</option>
                                                                                            <option>Concluido</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="anoConclusao">Ano Conclusão</label>
                                                                                        <input type="number" class="form-control" id="anoConclusao" name="anoConclusao" min="1950" max="{{ date('Y') }}" step="1" value="{{ date('Y') }}">

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="notaFinal">Nota Final</label>
                                                                                        <input type="number" class="form-control" id="notaFinal" name="notaFinal" min="0" max="20" step="1" value="">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="arquivo">OBS: As Habilitações deve estar no formato "pdf"!</label>
                                                                                        <div class="input-group">
                                                                                            <div class="custom-file">
                                                                                                <input type="file" class="custom-file-input" name="arquivo">
                                                                                                <label class="custom-file-label" for="arquivo">Escolha um arquivo</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input type="checkbox" class="form-check-input" required>
                                                                                        <label class="form-check-label" for="confirmar">Clique para Confirmar</label>
                                                                                    </div>
                                                                                    <div class="d-none">
                                                                                        <input type="text" name="categoria" value="Habilitacoes">
                                                                                        <input type="text" name="idFuncionario" value="{{ $funcionario->id }}">                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                                          <button type="submit" class="btn btn-primary">Actualizar Habilitações</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                               </div>
                                                            <!--/Modal de Add Arquivo -->
                                                        </div>
                                                        <hr>
                                                    <!--/Item Funcionario Habilitações--> 

                                                    <!--Item Funcionario Termo de Início de Funcões -->
                                                      <div class="intem-funcionario"> 
                                                        <h6 class="card-header"><strong><i class="far fa-file-alt mr-1"></i> Termo de Início de Funcões</strong></h6>
                                                            <!--Solicitando a existencia do registro do arquivo no banco de dados-->
                                                            @php
                                                              $arquivo = App\Models\Arquivo::where('idFuncionario',$funcionario->id)->where('categoria','TermoInicioFuncoes');
                                                              $dados = App\Models\Documento::where('idFuncionario',$funcionario->id)->where('categoria','TermoInicioFuncoes')->first();
                                                              parse_str($dados , $documento);
          

                                                              //echo($documento[]);
                                                              //dd($documento)
                                                            @endphp
                                                             
                                                              @if ($arquivo->exists()) 
                                                          <div class="btn btn-toggle " data-target="item-TermoInicioFuncoes" style="text-align: left;">
                                                            <p class="atrubutos-intem-funcionario">Data de Início de Funções: <span class="text-muted">{{ $documento['dataInicioFuncoes'] }} </span></p>                                                          
                                                          </div>
                                                          <div id="item-TermoInicioFuncoes" class="info-toggle">
                                                          @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                            <!--BTN Modal de Add Arquivo -->
                                                              <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addTermoInicioFuncoes" data-form-action="{{ route('inserir.documento') }} " >
                                                               <i class="fa fa-plus"></i>  Actualizar Termo de Início de Funcões
                                                              </button>
                                                            <!--/BTN Modal de Add Arquivo -->
                                                          @endif
                                                            <!--BTN  de ver Arquivo -->
                                                              <a class="btn btn-primary" href="{{ route('exibir.doc', ['documento' => base64_encode($arquivo->first()->caminho)]) }}" target="_blank">
                                                                <i class="far fa-file-alt mr-1"></i> Ver Arquivo
                                                              </a>
                                                            <!--/BTN de ver Arquivo -->
                                                          </div>
                                                                @else
                                                          <div class="btn btn-toggle " data-target="item-TermoInicioFuncoes" style="text-align: left;">
                                                            <p class="text-danger">Não Actualizado</p>
                                                          </div>
                                                          <div id="item-TermoInicioFuncoes" class="info-toggle">
                                                          @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                            <!--BTN Modal de Add Arquivo -->
                                                              <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addTermoInicioFuncoes" data-form-action="{{ route('inserir.documento') }}">
                                                                  <i class="fa fa-plus"></i> Actualizar Termo de Início de Funcões
                                                              </button>
                                                            <!--/BTN Modal de Add Arquivo -->
                                                          @endif
                                                          </div>
                                                                @endif
                                                            <!--Modal de Add Arquivo -->
                                                               <div class="modal fade" id="addTermoInicioFuncoes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h6 class="modal-title" id="exampleModalLabel">Actualização do Termo de Início de Funcões</h6>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <!-- Formulário dentro da modal -->
                                                                                <form method="POST" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="form-group">
                                                                                        <label for="dataInicioFuncoes">Data de Inicio de Funções</label>
                                                                                        <input type="date" class="form-control"name="dataInicioFuncoes">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="arquivo">OBS: O Termo de Início de Funcões deve estar no formato "pdf"!</label>
                                                                                        <div class="input-group">
                                                                                            <div class="custom-file">
                                                                                                <input type="file" class="custom-file-input" name="arquivo">
                                                                                                <label class="custom-file-label" for="arquivo">Escolha um arquivo</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input type="checkbox" class="form-check-input" required>
                                                                                        <label class="form-check-label" for="confirmar">Clique para Confirmar</label>
                                                                                    </div>
                                                                                    <div class="d-none">
                                                                                        <input type="text" name="categoria" value="TermoInicioFuncoes">
                                                                                        <input type="text" name="idFuncionario" value="{{ $funcionario->id }}">                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                                          <button type="submit" class="btn btn-primary">Actualizar Termo de Início de Funcões</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                               </div>
                                                            <!--/Modal de Add Arquivo -->
                                                        </div>
                                                        <hr>
                                                    <!--/Item Funcionario Termo de Início de Funcões-->  


                                                    <!--Item Funcionario Guia de Colocação -->
                                                       <div class="intem-funcionario"> 
                                                        <h6 class="card-header"><strong><i class="far fa-file-alt mr-1"></i> Guia de Colocação</strong></h6>
                                                            <!--Solicitando a existencia do registro do arquivo no banco de dados-->
                                                            @php
                                                              $arquivo = App\Models\Arquivo::where('idFuncionario',$funcionario->id)->where('categoria','GuiaColocacao');
                                                              $dados = App\Models\Documento::where('idFuncionario',$funcionario->id)->where('categoria','GuiaColocacao')->first();
                                                              parse_str($dados , $documento);
                                                             
                                                            @endphp
                                                             
                                                              @if ($arquivo->exists()) 
                                                              @php
                                                                $unidadeOrganica = App\Models\UnidadeOrganica::find($documento['idUnidadeOrganica']);
                                                              @endphp
                                                          <div class="btn btn-toggle " data-target="item-GuiaColocacao" style="text-align: left;">
                                                            <p class="atrubutos-intem-funcionario">Data de Emissão: <span class="text-muted">{{  \Carbon\Carbon::parse($documento['dataEmissao'])->format('d/m/Y') }} </span></p>
                                                            <p class="atrubutos-intem-funcionario">Para Unidade Orgânica: <span class="text-muted">{{ $unidadeOrganica['designacao'] }} </span></p>                                                         
                                                          </div>
                                                          <div id="item-GuiaColocacao" class="info-toggle">
                                                          @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                            <!--BTN Modal de Add Arquivo -->
                                                              <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addGuiaColoaccao" data-form-action="{{ route('inserir.documento') }} " >
                                                              <i class="fa fa-plus"></i>  Actualizar Guia de Colocação
                                                              </button>
                                                            <!--/BTN Modal de Add Arquivo -->
                                                          @endif
                                                            <!--BTN  de ver Arquivo -->
                                                              <a class="btn btn-primary" href="{{ route('exibir.doc', ['documento' => base64_encode($arquivo->first()->caminho)]) }}" target="_blank">
                                                                <i class="far fa-file-alt mr-1"></i> Ver Arquivo
                                                              </a>
                                                            <!--/BTN de ver Arquivo -->
                                                          </div>
                                                                @else
                                                          <div class="btn btn-toggle " data-target="item-GuiaColocacao" style="text-align: left;">
                                                            <p class="text-danger">Não Actualizado</p>
                                                          </div>
                                                          <div id="item-GuiaColocacao" class="info-toggle">
                                                          @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                            <!--BTN Modal de Add Arquivo -->
                                                              <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addGuiaColoaccao" data-form-action="{{ route('inserir.documento') }}">
                                                                  <i class="fa fa-plus"></i> Actualizar Guia de Colocação
                                                              </button>
                                                            <!--/BTN Modal de Add Arquivo -->
                                                          @endif
                                                          </div>
                                                                @endif
                                                            <!--Modal de Add Arquivo -->
                                                               <div class="modal fade" id="addGuiaColoaccao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h6 class="modal-title" id="exampleModalLabel">Actualização da Guia de Colocação</h6>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <!-- Formulário dentro da modal -->
                                                                                <form method="POST" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="form-group">
                                                                                        <label for="anoConclusao">Data Emissão</label>
                                                                                        <input type="date" class="form-control" id="dataEmissao" name="dataEmissao">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                      <label for="idUnidadeOrganica">O funcionário vai Para Unidade Orgânica!</label>
                                                                                        <select name="idUnidadeOrganica" class="form-control select2">
                                                                                          <option selected="selected" value="{{ isset($opcoesUnidadeOrganica) ? $opcoesUnidadeOrganica->id : '' }}">{{ isset($opcoesUnidadeOrganica) ? $opcoesUnidadeOrganica->designacao : 'Escolha uma Unidade Orgânica' }}</option>
                                                                                          @php
                                                                                            $opcoesUnidadeOrganicas = App\Models\UnidadeOrganica::all();
                                                                                          @endphp
                                                                                          @foreach ($opcoesUnidadeOrganicas as $UnidadeOrganica)
                                                                                          <option value="{{ old('id',$UnidadeOrganica->id ?? 'id') }}">{{ old('designacao',$UnidadeOrganica->designacao ?? 'designacao') }}</option>
                                                                                          @endforeach 
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="arquivo">OBS: a Guia de Colocação deve estar no formato "pdf"!</label>
                                                                                        <div class="input-group">
                                                                                            <div class="custom-file">
                                                                                                <input type="file" class="custom-file-input" name="arquivo">
                                                                                                <label class="custom-file-label" for="arquivo">Escolha um arquivo</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input type="checkbox" class="form-check-input" required>
                                                                                        <label class="form-check-label" for="confirmar">Clique para Confirmar</label>
                                                                                    </div>
                                                                                    <div class="d-none">
                                                                                        <input type="text" name="categoria" value="GuiaColocacao">
                                                                                        <input type="text" name="idFuncionario" value="{{ $funcionario->id }}">                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                                          <button type="submit" class="btn btn-primary">Actualizar Guia de Colocaão</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                               </div>
                                                            <!--/Modal de Add Arquivo -->
                                                        </div>
                                                        <hr>
                                                    <!--/Item Funcionario Guia de Colocação-->  


                                                    <!--Item Funcionario Autobiografia-->
                                                      <div class="intem-funcionario"> 
                                                        <h6 class="card-header"><strong><i class="far fa-file-alt mr-1"></i> Autobiografia</strong></h6>
                                                            <!--Solicitando a existencia do registro do arquivo no banco de dados-->
                                                            @php
                                                              $arquivo = App\Models\Arquivo::where('idFuncionario',$funcionario->id)->where('categoria','Autobiografia');
                                                              $dados = App\Models\Documento::where('idFuncionario',$funcionario->id)->where('categoria','Autobiografia')->first();
                                                              parse_str($dados , $documento);
          

                                                              //echo($documento[]);
                                                              //dd($documento)
                                                            @endphp
                                                             
                                                              @if ($arquivo->exists()) 
                                                          <div class="btn btn-toggle " data-target="item-Autobiografia" style="text-align: left;">
                                                            <p class="atrubutos-intem-funcionario">Data de Criação: <span class="text-muted">{{ \Carbon\Carbon::parse($documento['dataCriacao'])->format('d/m/Y')  }} </span></p>                                                          
                                                          </div>
                                                          <div id="item-Autobiografia" class="info-toggle">
                                                          @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                            <!--BTN Modal de Add Arquivo -->
                                                              <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addAutobiografia" data-form-action="{{ route('inserir.documento') }} " >
                                                              <i class="fa fa-plus"></i> Actualizar Autobiografia
                                                              </button>
                                                            <!--/BTN Modal de Add Arquivo -->
                                                          @endif
                                                            <!--BTN  de ver Arquivo -->
                                                              <a class="btn btn-primary" href="{{ route('exibir.doc', ['documento' => base64_encode($arquivo->first()->caminho)]) }}" target="_blank">
                                                                <i class="far fa-file-alt mr-1"></i> Ver Arquivo
                                                              </a>
                                                            <!--/BTN de ver Arquivo -->
                                                          </div>
                                                                @else
                                                          <div class="btn btn-toggle " data-target="item-Autobiografia" style="text-align: left;">
                                                            <p class="text-danger">Não Actualizado</p>
                                                          </div>
                                                          <div id="item-Autobiografia" class="info-toggle">
                                                          @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                            <!--BTN Modal de Add Arquivo -->
                                                              <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addAutobiografia" data-form-action="{{ route('inserir.documento') }}">
                                                                  <i class="fa fa-plus"></i> Actualizar Autobiografia
                                                              </button>
                                                            <!--/BTN Modal de Add Arquivo -->
                                                          @endif
                                                          </div>
                                                                @endif
                                                            <!--Modal de Add Arquivo -->
                                                               <div class="modal fade" id="addAutobiografia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h6 class="modal-title" id="exampleModalLabel">Actualização da Autobiografia</h6>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <!-- Formulário dentro da modal -->
                                                                                <form method="POST" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="form-group">
                                                                                        <label for="dataCriacao">Data de Criação</label>
                                                                                        <input type="date" class="form-control" name="dataCriacao">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="arquivo">OBS: A Autobiografia deve estar no formato "pdf"!</label>
                                                                                        <div class="input-group">
                                                                                            <div class="custom-file">
                                                                                                <input type="file" class="custom-file-input" name="arquivo">
                                                                                                <label class="custom-file-label" for="arquivo">Escolha um arquivo</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input type="checkbox" class="form-check-input" required>
                                                                                        <label class="form-check-label" for="confirmar">Clique para Confirmar</label>
                                                                                    </div>
                                                                                    <div class="d-none">
                                                                                        <input type="text" name="categoria" value="Autobiografia">
                                                                                        <input type="text" name="idFuncionario" value="{{ $funcionario->id }}">                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                                          <button type="submit" class="btn btn-primary">Actualizar Autobiografia</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                               </div>
                                                            <!--/Modal de Add Arquivo -->
                                                        </div>
                                                        <hr>
                                                    <!--/Item Funcionario Autobiografia-->  


                                                    <!--Item Funcionario CurriculumVitae -->
                                                      <div class="intem-funcionario"> 
                                                        <h6 class="card-header"><strong><i class="far fa-file-alt mr-1"></i> CurriculumVitae</strong></h6>
                                                            <!--Solicitando a existencia do registro do arquivo no banco de dados-->
                                                            @php
                                                              $arquivo = App\Models\Arquivo::where('idFuncionario',$funcionario->id)->where('categoria','CurriculumVitae');
                                                              $dados = App\Models\Documento::where('idFuncionario',$funcionario->id)->where('categoria','CurriculumVitae')->first();
                                                              parse_str($dados , $documento);
          

                                                              //echo($documento[]);
                                                              //dd($documento)
                                                            @endphp
                                                             
                                                              @if ($arquivo->exists()) 
                                                          <div class="btn btn-toggle " data-target="item-CurriculumVitae" style="text-align: left;">
                                                            <p class="atrubutos-intem-funcionario">Data de Criação: <span class="text-muted">{{  \Carbon\Carbon::parse($documento['dataCriacao'])->format('d/m/Y') }} </span></p>                                                          
                                                          </div>
                                                          <div id="item-CurriculumVitae" class="info-toggle">
                                                          @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                            <!--BTN Modal de Add Arquivo -->
                                                              <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addCurriculumVitae" data-form-action="{{ route('inserir.documento') }} " >
                                                                <i class="fa fa-plus"></i>  Actualizar CurriculumVitae
                                                              </button>
                                                            <!--/BTN Modal de Add Arquivo -->
                                                          @endif
                                                            <!--BTN  de ver Arquivo -->
                                                              <a class="btn btn-primary" href="{{ route('exibir.doc', ['documento' => base64_encode($arquivo->first()->caminho)]) }}" target="_blank">
                                                                <i class="far fa-file-alt mr-1"></i> Ver Arquivo
                                                              </a>
                                                            <!--/BTN de ver Arquivo -->
                                                          </div>
                                                                @else
                                                          <div class="btn btn-toggle " data-target="item-CurriculumVitae" style="text-align: left;">
                                                            <p class="text-danger">Não Actualizado</p>
                                                          </div>
                                                          <div id="item-CurriculumVitae" class="info-toggle">
                                                          @if ( session()->only(['Cargo'])['Cargo']->permissoes === 'Admin' || session()->only(['Seccao'])['Seccao']->codNome === 'RHPE' )
                                                            <!--BTN Modal de Add Arquivo -->
                                                              <button class="btn btn-primary btn-modal-doc-edit" data-toggle="modal" data-target="#addCurriculumVitae" data-form-action="{{ route('inserir.documento') }}">
                                                                  <i class="fa fa-plus"></i> Actualizar CurriculumVitae
                                                              </button>
                                                            <!--/BTN Modal de Add Arquivo -->
                                                          @endif
                                                          </div>
                                                                @endif
                                                            <!--Modal de Add Arquivo -->
                                                               <div class="modal fade" id="addCurriculumVitae" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h6 class="modal-title" id="exampleModalLabel">Actualização da CurriculumVitae</h6>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <!-- Formulário dentro da modal -->
                                                                                <form method="POST" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="form-group">
                                                                                        <label for="dataCriacao">Data Emissaoo</label>
                                                                                        <input type="date" class="form-control"name="dataCriacao">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="arquivo">OBS: a CurriculumVitae deve estar no formato "pdf"!</label>
                                                                                        <div class="input-group">
                                                                                            <div class="custom-file">
                                                                                                <input type="file" class="custom-file-input" name="arquivo">
                                                                                                <label class="custom-file-label" for="arquivo">Escolha um arquivo</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-check">
                                                                                        <input type="checkbox" class="form-check-input" required>
                                                                                        <label class="form-check-label" for="confirmar">Clique para Confirmar</label>
                                                                                    </div>
                                                                                    <div class="d-none">
                                                                                        <input type="text" name="categoria" value="CurriculumVitae">
                                                                                        <input type="text" name="idFuncionario" value="{{ $funcionario->id }}">                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                                                          <button type="submit" class="btn btn-primary">Actualizar Guia de Colocaão</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                               </div>
                                                            <!--/Modal de Add Arquivo -->
                                                        </div>
                                                        <hr>
                                                    <!--/Item Funcionario CurriculumVitae-->  


                                

                                                   

                                                    
                                                    

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
              <!--Modal Solicitar-->
               <x-sgrhe-modal-solicitar />
              <!--/Modal Solicitar-->
        @endsection
  @section('scripts')

      <!--Edicao de Corte de imagen -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
          <!--Algoritmo interactivo no processo de delectar Objectos em SweetAlert 2-->
          <script src="{{ asset('plugins/sweetalert2/alerta-deletar.js')}}"></script>
          <script>
              var bs_modal = $('#modal');
              var image = document.getElementById('image');
              const btn_Actualizar = document.getElementById("btn-Actualizar");
              //const label_inputFotoPerfil = document.querySelector('label[for="inputFotoPerfil"]');
              var cropper, reader, file;

              $("body").on("change", ".image", function (e) {
                  var files = e.target.files;
                  var done = function (url) {
                      image.src = url;
                      bs_modal.modal('show');
                  };

                  if (files && files.length > 0) {
                      file = files[0];

                      if (URL) {
                          done(URL.createObjectURL(file));
                      } else if (FileReader) {
                          reader = new FileReader();
                          reader.onload = function (e) {
                              done(reader.result);
                          };
                          reader.readAsDataURL(file);
                      }
                  }
              });

              bs_modal.on('shown.bs.modal', function () {
                  cropper = new Cropper(image, {
                      aspectRatio: 1,
                      viewMode: 3,
                      preview: '.preview'
                  });
              }).on('hidden.bs.modal', function () {
                  cropper.destroy();
                  cropper = null;
              });

              $("#crop").click(function () {
                  canvas = cropper.getCroppedCanvas({
                      width: 160,
                      height: 160,
                  });
                  canvas.toBlob(function (blob) {
                      url = URL.createObjectURL(blob);
                      var reader = new FileReader();
                      reader.readAsDataURL(blob);
                      reader.onloadend = function () {
                          var base64data = reader.result;
                          // Exibir a imagem recortada no formulário (opcional)
                          $('#croppedImage').val(base64data);
                          bs_modal.modal('hide');
                          //Mostrar o Botao Actualizar Foto de Perfil
                          btn_Actualizar.classList.remove("d-none");
                          // Change the label text
                        //  label_inputFotoPerfil.textContent = 'Voçe escolheu a foto de perfil!';
                      };
                  });
              });
          </script>
      <!--Edicao de Corte de imagen para foto de perfil-->

      <!--Scripts para o modal de Addicionar documentos Do Funcionario-->
        <!-- Adicione script para lidar com a dinamicidade do formulário -->
        <script>
            $('.btn-modal-doc-edit').click(function() {
                var formAction = $(this).data('form-action');
                var modalId = $(this).data('target');
                
                $(modalId).find('form').attr('action', formAction);
            });
        </script>
      <!--/Scripts para o modal de Addicionar documentos Do Funcionario-->

      <!--Evento para Mudar a Menssagem do Ipntut pos escolha do cheiro-->
        <!-- Adicione script para lidar com a dinamicidade do formulário -->
        <script>
                $(document).ready(function(){
                  $(".custom-file-input").on("change", function() {
                      var fileName = $(this).val().split("\\").pop();
                      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                  });
              });
        </script>
      <!--/Evento para Mudar a Menssagem do Ipntut pos escolha do cheiro-->

      <script>
        function toggleInfo() {
          const btnToggles = document.querySelectorAll('.btn-toggle');

          btnToggles.forEach((btnToggle) => {
            btnToggle.addEventListener('click', () => {
              const targetId = btnToggle.dataset.target;
              const infoToggle = document.getElementById(targetId);

              infoToggle.classList.toggle('visible');
            });
          });
        }

        toggleInfo();
      </script>


<script>
    // Captura o botão de abrir a modal
    var abrirModalBtn = document.querySelector('.abrir-modal');

    // Captura a modal
    var modal = document.getElementById('myModal');

    // Ação ao clicar no botão de abrir a modal
    abrirModalBtn.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    // Captura o botão de fechar a modal
    var fecharModalBtn = document.querySelector('.fechar-modal');

    // Ação ao clicar no botão de fechar a modal
    fecharModalBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });
</script>

<!--Limitar a Data por 7 dias no Maximo no Formulario Modal Pedido de Licensa-->
  <script>
    document.getElementById("formLicenca").addEventListener("submit", function(event) {
      event.preventDefault(); // Impede o envio do formulário
      
      // Obtém as datas de início e término
      var startDate = new Date(document.getElementById("dataInicio").value);
      var endDate = new Date(document.getElementById("dataFim").value);
      
      // Calcula a diferença em milissegundos entre as duas datas
      var difference = endDate.getTime() - startDate.getTime();
      
      // Converte a diferença de milissegundos para dias
      var numberOfDays = difference / (1000 * 3600 * 24);
      
      // Define o limite máximo de dias permitido
      var maxDays = 7; // Altere conforme necessário
      
      // Verifica se a data final é anterior à data inicial
      if (endDate < startDate) {
        document.getElementById("dateError").innerText = "A data de término não pode ser anterior à data de início!";
        document.getElementById("dateError").style.display = "block"; // Exibe a mensagem de erro
      } else if (numberOfDays > maxDays) {
        document.getElementById("dateError").innerText = "Os dis de licença não podem exceder " + maxDays + " dias. artigo ...!";
        document.getElementById("dateError").style.display = "block"; // Exibe a mensagem de erro
      } else {
        document.getElementById("dateError").style.display = "none"; // Oculta a mensagem de erro
        this.submit(); // Envio do formulário se estiver tudo correto
      }
    });
  </script>
<!--Limitar a Data por 7 dias no Maximo no Formulario Modal Pedido de Licensa-->
<!--Scripts de controolo de caracter da classe Texo-->
  <script>
        // Seleciona o input de texto e o contador de caracteres
      const textoInput = document.getElementById('texto');
      const contadorCaracteres = document.getElementById('contadorCaracteres');

      // Define o limite de caracteres
      const limiteCaracteres = 100;

      // Adiciona um evento de input ao input de texto
      textoInput.addEventListener('input', function() {
          // Obtém o número de caracteres digitados
          const numCaracteres = textoInput.value.length;
          
          // Atualiza o contador de caracteres
          contadorCaracteres.textContent = numCaracteres + '/' + limiteCaracteres;
          
          // Verifica se o número de caracteres excede o limite
          if (numCaracteres > limiteCaracteres) {
              // Trunca o texto para o limite de caracteres
              textoInput.value = textoInput.value.substring(0, limiteCaracteres);
          }
      });
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