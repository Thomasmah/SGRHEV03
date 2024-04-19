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
      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
            <section class="content-header ">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>Perfil</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Página Inicial</a></li>
                      <li class="breadcrumb-item active">Perfil </li>
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
                              <p><b>Naturalidade (Município):</b> {{ $naturalidade->municipio }} </p> 
                              <p><b>Categoria:</b> {{ $categoriaFuncionario->categoria }} </p>                        
                              <p><b>Grau:</b> {{ $categoriaFuncionario->grau }} </p>                            
                              <p><b>Cargo:</b> {{ $cargo->designacao }} </p>                            
                              <p><b>Unidade Orgânica:</b> {{ $unidadeOrganica->designacao }} </p>
                              <p><b>Telefone:</b> {{ $funcionario->numeroTelefone }} </p>
                            </li>
                            <li class="list-group-item" style="text-align: center;">
                              <img src="#" alt="">
                              <small class="text-muted">Assinatura Digital</small>
                            </li>
                            <li class="list-group-item">
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
                          </ul>
                          <a href="#" class="btn btn-primary btn-block"><b>Enviar Mensagem</b></a>
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
                                                            <p class="atrubutos-intem-funcionario">Data de Emissão: <span class="text-muted">{{ $documento['dataEmissao'] }} </span></p>
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
                                                            <p class="atrubutos-intem-funcionario">Data de Criação: <span class="text-muted">{{ $documento['dataCriacao'] }} </span></p>                                                          
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
                                                            <p class="atrubutos-intem-funcionario">Data de Criação: <span class="text-muted">{{ $documento['dataCriacao'] }} </span></p>                                                          
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
 @endsection