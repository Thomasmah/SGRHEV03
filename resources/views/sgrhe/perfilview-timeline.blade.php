<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'Linha de Tempo - '.$pessoa->nomeCompleto )
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

                </style>    
              <!-- Scripts -->
        @endsection
        @section('conteudo_principal')
      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>Linha de Tempo</h1>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Págna Inicial</a></li>
                      <li class="breadcrumb-item active">Linha de Tempo </li>
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
                      <div class="col-md-12">
                          <div class="card">
                            <div class="card-header p-2">
                              <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a></li>
                                <li class="nav-item"><a class="nav-link" href="#Solicitar" data-toggle="tab">Solicitar</a></li>
                                <li class="nav-item"><a class="nav-link" href="#Processos" data-toggle="tab">Processos</a></li>
                              </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                              <div class="tab-content">
                                  <!--tab-pane-->
                                     <div class="tab-pane active tab-pane" id="timeline">
                                        <!-- The timeline -->
                                        <div class="timeline timeline-inverse">
                                          <!-- timeline item -->
                                          <div>
                                            <i class="fas fa-user bg-info"></i>

                                            <div class="timeline-item">
                                              <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>
                                              <h3 class="timeline-header border-0"><a href="#">{{$pessoa->nomeCompleto}}</a>, Seja bem Vindo a Sua Linha de Tempo
                                              </h3>
                                            </div>
                                          </div>
                                          <!-- END timeline item -->
                                          <!-- timeline item -->
                                           @foreach ($processosMy as $processom)
                                                    @php
                                                      $documento = App\Models\Arquivo::where('id', $processom->idArquivo);
                                                      $funcionarioSolicitante = App\Models\Funcionario::where('id', $processom->idFuncionarioSolicitante)->first();
                                                      $pessoaSolicitante = App\Models\Pessoa::where('id', $funcionarioSolicitante->idPessoa)->first();
                                                      // echo($documento->first()->caminho);    
                                                    @endphp 
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                              <span class="bg-danger">
                                                {{ $processom->created_at->format('d F Y')}}
                                              </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <div>         
                                              <i class="fas fa-envelope bg-primary"></i>
                                              <div class="timeline-item">
                                              <span class="time">
                                                  <i class="far fa-clock"></i> a 4 Meses</span>
                                                <h3 class="timeline-header"> 
                                                  Estado: <span  class=" font-weight-bold {{ ($processom->estado == 'Submetido' || $processom->estado == 'Aprovado') ? 'text-success' : 'text-danger'}}"> {{ $processom->estado }} </span>
                                                </h3>

                                                <div class="timeline-body">
                                                  <p> Nome: {{ $pessoaSolicitante->nomeCompleto }} </p>
                                                  <p>Natureza: {{ $processom->natureza }}</p>
                                                  <p>Categoria de Documento:  {{ $processom->categoria }}</p>
                                                  <form class="{{ ($processom->estado == 'Submetido') ? 'd-inline' : 'd-none'}}"  action="{{ route('solicitacao.preview')}}" method="POST" >
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="Request" value="{{$processom->Request}}">
                                                    <input type="hidden" name="idProcesso" value="{{$processom->id}}">
                                                    <button type="submit" class="btn btn-info">Ver Documento</button>
                                                  </form>
                                                </div>
                                                <div class="timeline-footer">  

                                                  <form class="{{ ($processom->estado == 'Submetido') ? 'd-inline' : 'd-none'}}" action="{{ route('solicitacao.cancelar', ['idProcesso' => $processom->id ]) }}" method="POST" id="deleteForm{{ $processom->id }}">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="Request"  value="{{$processom->Request}}">
                                                    <button type="submit" class="btn btn-danger" onclick="confirmAndSubmit(event, 'Confirmar cancelar a solicitação?', 'Sim, Confirmar!', 'Não, Cancelar!')" >Cancelar Solictacao</button>
                                                  </form>
                                                 
                                                  
                                                  @if ($documento->exists()) 
                                                    <a href="{{ route('Exibir.Imagem', ['imagem' => base64_encode( $documento->first()->caminho )]) }}" class="btn btn-secondary {{ ($processom->estado == 'Aprovado' || $processom->estado == 'Desfavoravel' || $processom->estado == 'Favoravel') ? 'd-inline' : 'd-none'}} ">Baixar Documento</a>
                                                  @endif
                                                </div>
                                              </div>
                                            </div>
                                            <!--MODAIS-->
                                           
             
                                            @endforeach
                                            
                                          <!-- END timeline item -->

                                          <!-- timeline time label -->
                                            <div class="time-label">
                                              <span class="bg-success">
                                                3 Jan. 2014
                                              </span>
                                            </div>
                                          <!-- /.timeline-label -->
                                          <!-- timeline item -->
                                            <div>
                                              <i class="fas fa-comments bg-warning"></i>

                                              <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                                <h3 class="timeline-header"><a href="#"></a> Item de Linha de Tempo</h3>

                                                <div class="timeline-body">
                                                 Seja bem vindo. Corpo do post em sua linha de Tempo
                                                </div>
                                                <div class="timeline-footer">
                                                  <a href="#" class="btn btn-warning btn-flat btn-sm">Ver mais...</a>
                                                </div>
                                              </div>
                                            </div>
                                          <!-- END timeline item -->
                                          <div>
                                            <i class="far fa-clock bg-gray"></i>
                                          </div>
                                        </div>
                                    </div>
                                  <!-- /tab-pane -->
                                  <!--tab-pane-->
                                  <div class="tab-pane" id="Solicitar">
                                        <!-- CardContet -->
                                            <!--Solicitar Item-->
                                              <div class="col-8 offset-md-2">
                                                  <div class="card">
                                                    <div class="card-body" style="position: relative; z-index:2; padding:100px;">
                                                     <i class="ion ion-person-add" style="position: absolute; font-size:125px; z-index:1; opacity:0.5; color:green; right:20%;"></i>
                                                      <h5 class="card-title"> Solicitar Licença</h5>
                                                      <br>
                                                        <p class="card'text">Explicacao do que serve essa solicitacao</p>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#licenca-dsciplinar">
                                                          Solicitar Licença
                                                        </button>
                                                    </div>
                                                </div>
                                              </div>
                                              <!-- Modal Solicitar Licenca -->
                                                <div class="modal fade" id="licenca-dsciplinar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Licença de {{ $pessoa->nomeCompleto}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <!-- Formulário -->
                                                        <form action="{{ isset($idFuncionario) ? route('apenso.solicitar', ['idFuncionarioSolicitante' => idFuncionario])  : route('apenso.solicitar', ['idFuncionarioSolicitante' => $funcionario->id])  }}" method="POST" id="fo">                                             @csrf
                                                          @method('POST')
                                                          <div class="form-group">
                                                            <input type="hidden" class="form-control" name="categoria" value="Licenca">
                                                            <input type="hidden" class="form-control" name="natureza" value="N/D">
                                                            <input type="hidden" class="form-control" name="seccao" value="secretaria">     
                                                            <input type="hidden" class="form-control" name="idFuncionarioSolicitante" value="{{ isset($idFuncionario) ? $idFuncionario  : $funcionario->id }}">    
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="dataInicio">Data de Início:</label>
                                                              <input type="date" class="form-control" id="dataInicio" name="dataInicio" required>
                                                              <label for="dataFim">Data de Término:</label>
                                                              <input type="date" class="form-control" id="dataFim" name="dataFim" required>
                                                              <div class="error-message" id="dateError" style="display: none;"></div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label for="motivo">Motivo</label>
                                                            <textarea class="form-control" name="motivo" id="texto" placeholder="Descreva um motivo... Começando 'Por motivos de ...' por Exemplo" required></textarea>
                                                            <small class="text-muted"id="contadorCaracteres" > </small>
                                                          </div>
                                                          <button type="submit" class="btn btn-primary">Submeter</button>
                                                        </form>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <small id="" class="form-text text-muted">Consulte o Deferimento do Seu pedido na sua Time Line</small>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              <!-- Modal Solicitar Licenca -->
                                            <!--Solicitar Item-->


                                            <!--Solicitar Item-->

                                              <div class="col-8 offset-md-2">
                                                  <div class="card">
                                                    <div class="card-body" style="position: relative; z-index:2; padding:100px;">
                                                     <i class="ion ion-person-add" style="position: absolute; font-size:125px; z-index:1; opacity:0.5; color:green; right:20%;"></i>
                                                      <h5 class="card-title"> Solicitar Declaração de Efectividade</h5>
                                                      <br>
                                                        <p class="card'text">Explicação do que serve essa Solicitar Declaração de Efectividade </p>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#DeclaracaoEfectividade">
                                                          Solicitar Declaração de Efectividade
                                                        </button>
                                                    </div>
                                                </div>
                                              </div>
                                              <!-- Modal Solicitar Licenca -->
                                                <div class="modal fade" id="DeclaracaoEfectividade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Solicitar Declaração de Efectividade de {{ $pessoa->nomeCompleto}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <!-- Formulário -->
                                                        <form action="{{ route('solicitar')  }}" method="POST" id="">
                                                          @csrf
                                                          @method('POST')
                                                          <div class="form-group">
                                                            <input type="hidden" class="form-control" name="idFuncionario" value="{{ isset($idFuncionario) ? $idFuncionario :  $funcionario->id }}">
                                                            <input type="hidden" class="form-control" name="categoria" value="Requerimento">
                                                            <input type="hidden" class="form-control" name="natureza" value="Solicitacao">
                                                            <input type="hidden" class="form-control" name="seccao" value="Secretaria">
                                                            <input type="hidden" class="form-control" name="deferimento" value="N/D">    
                                                            <input type="hidden" class="form-control" name="idFuncionarioSolicitante" value="{{ isset($idFuncionario) ? $idFuncionario  : $funcionario->id }}">    
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="dataInicio">Para Fim de :</label>
                                                              <textarea name="finalidade" id="" cols="30" rows="10"></textarea>
                                                              <div class="error-message" id="dateError" style="display: none;"></div>
                                                          </div>
                                                          <button type="submit" class="btn btn-primary">Submeter</button>
                                                        </form>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <small id="" class="form-text text-muted">Consulte o Parecer do Deferimento do Seu pedido na sua Time Line</small>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              <!-- Modal Solicitar Licenca -->
                                            <!--Solicitar Item-->

                                             <!--Solicitar Item-->
                                             <div class="col-8 offset-md-2">
                                                  <div class="card">
                                                    <div class="card-body" style="position: relative; z-index:2; padding:100px;">
                                                     <i class="ion ion-person-add" style="position: absolute; font-size:125px; z-index:1; opacity:0.5; color:green; right:20%;"></i>
                                                      <h5 class="card-title"> Solicitar Autorização de Gozo de Férias</h5>
                                                      <br>
                                                        <p class="card'text">Explicação do que serve essa solicitacao de Goso de Férias </p>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#autorizacaoGozoFerias">
                                                          Solicitar Gozo de Férias
                                                        </button>
                                                    </div>
                                                </div>
                                              </div>
                                              <!-- Modal Solicitar Licenca -->
                                                <div class="modal fade" id="autorizacaoGozoFerias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Autorização de Gozo de férias de {{ $pessoa->nomeCompleto}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <!-- Formulário -->
                                                        <form action="{{ isset($idFuncionario) ? route('gozo.ferias.solicitar', ['idFuncionarioSolicitante' => $idFuncionario])  : route('gozo.ferias.solicitar', ['idFuncionarioSolicitante' => $funcionario->id])  }}" method="POST" id="fo"   >                                                       @csrf
                                                          @method('POST')
                                                          <div class="form-group">
                                                            <input type="hidden" class="form-control" name="categoria" value="GozoFerias">
                                                            <input type="hidden" class="form-control" name="natureza" value="Requerimento">
                                                            <input type="hidden" class="form-control" name="seccao" value="Secretaria">
                                                            <input type="hidden" class="form-control" name="deferimento" value="N/D">    
                                                            <input type="hidden" class="form-control" name="idFuncionarioSolicitante" value="{{ isset($idFuncionario) ? $idFuncionario  : $funcionario->id }}">    
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="dataInicio">Data de Início:</label>
                                                              <input type="date" class="form-control" id="dataInicio" name="dataInicio" required>
                                                              <div class="error-message" id="dateError" style="display: none;"></div>
                                                          </div>
                                                          <button type="submit" class="btn btn-primary">Submeter</button>
                                                        </form>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <small id="" class="form-text text-muted">Consulte o Deferimento do Seu pedido na sua Time Line</small>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              <!-- Modal Solicitar Licenca -->
                                            <!--Solicitar Item-->



                                        <!-- /.CardContet -->
                                     </div>
                                  <!--/tab-pane-->
                                  <!--tab-pane-->
                                    <div class="tab-pane tab-pane" id="Processos">
                                        <!-- The timeline -->
                                        <div class="timeline timeline-inverse">
                                          <!-- timeline item -->
                                          <div>
                                            <i class="fas fa-user bg-info"></i>

                                            <div class="timeline-item">
                                              <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                              <h3 class="timeline-header border-0"><a href="#">{{$pessoa->nomeCompleto}}</a>, Seja bem Vindo a Sua Linha de Tempo
                                              </h3>
                                            </div>
                                          </div>
                                          <!-- END timeline item -->
                                          <!-- timeline item -->
                                           @foreach ($processos as $processo)
                                                    @php
                                                      $documento = App\Models\Arquivo::where('id', $processom->idArquivo);
                                                      $funcionarioSolicitante = App\Models\Funcionario::where('id', $processom->idFuncionarioSolicitante)->first();
                                                      $pessoaSolicitante = App\Models\Pessoa::where('id', $funcionarioSolicitante->idPessoa)->first();
                                                      // echo($documento->first()->caminho);    
                                                    @endphp 
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                              <span class="bg-danger">
                                                {{ $processo->created_at->format('d F Y')}}
                                              </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <div>         
                                              <i class="fas fa-envelope bg-primary"></i>
                                              <div class="timeline-item">
                                                <span class="time">
                                                  <i class="far fa-clock"></i> a 4 Meses</span>
                                                <h3 class="timeline-header"> 
                                                  Estado: <span  class=" font-weight-bold {{ ($processo->estado == 'Submetido' || $processo->estado == 'Aprovado') ? 'text-success' : 'text-danger'}}"> {{ $processo->estado }} </span>
                                                </h3>
                                                
                                                <div class="timeline-body"> 
                                                  <p> Nome: {{ $pessoaSolicitante->nomeCompleto }} </p>
                                                  <p>Natureza: {{ $processom->natureza }}</p>
                                                  <p>Categoria de Documento:  {{ $processom->categoria }}</p>
                                                <form class="{{ ($processo->estado == 'Submetido') ? 'd-inline' : 'd-none'}}"  action="{{ route('solicitacao.preview')}}" method="POST" >
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="Request" value="{{$processo->Request}}">
                                                    <input type="hidden" name="idProcesso" value="{{$processo->id}}">
                                                    <button type="submit" class="btn btn-info">Ver Documento</button>
                                                  </form>
                                                </div>
                                                <div class="timeline-footer">  
                                                  <form  class="{{ ($processo->estado == 'Submetido' && $processo->natureza == 'N/D' ) ? 'd-inline' : 'd-none'}}" action="{{ route('solicitacao.ratificar')}}" method="POST" id="deleteForm{{ $processo->id }}">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="Request"  value="{{$processo->Request}}">
                                                    <input type="hidden" name="idProcesso" value="{{$processo->id}}">
                                                    <button type="submit" class="btn btn-warning" onclick="confirmAndSubmit(event, 'Aprovar a  solicitacao de Licença?', 'Sim, Aprovar!', 'Não, Cancelar Aprovação!')">Aprovar Solicitação</button>
                                                  </form>
                                                  <button type="button" class="btn btn-primary {{ ($processo->parecer == 'Favoravel' || $processo->parecer == 'Desfavoravel' || $processo->estado == 'Cancelado' || $processo->estado == 'Aprovado' || $processo->estado == 'Desfavoravel') ? 'd-none' : ' '}} {{ ( $processo->natureza == 'Requerimento') ? ' ' : 'd-none'}}" data-toggle="modal" data-target="#parecer{{ $processo->id}}">
                                                         Parecer
                                                  </button>

                                                  <div class="modal fade" id="parecer{{ $processo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Requerimento de {{ $pessoa->nomeCompleto}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <!-- Formulário -->
                                                        <form action="{{ isset($idFuncionario) ? route('solicitacao.parecer')  : route('solicitacao.parecer')  }}" method="POST" id="fo"                                                          @csrf
                                                          @method('POST')
                                                          <div class="form-group">
                                                          
                                                            <input type="hidden" name="Request"  value="{{$processo->Request}}">
                                                            <input type="hidden" name="idProcesso"  value="{{$processo->id}}">
                                                            <!--<label for="motivo">Motivo </label>
                                                            <textarea class="form-control" name="motivo" id="texto" placeholder="Descreva um motivo..." required></textarea>
                                                              -->
                                                              <label for="parecer"></label>
                                                              <select name="parecer" class="form-control" style="width: 100%;" required>
                                                                <option class="text-secondary font-weight-bold" value="">Escolha um Parecer</option>
                                                                <option class="text-success font-weight-bold" value="Favoravel">Parecer Favorável</option>
                                                                <option class="text-danger font-weight-bold" value="Desfavoravel">Parecer Desfavorálvel</option>
                                                              </select>
                                                          </div>
                                                          <button type="submit" class="btn btn-primary">Submeter</button>
                                                        </form>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <small id="" class="form-text text-muted">Consulte o Deferimento do Seu pedido na sua Time Line</small>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                  @php
                                                    $documento = App\Models\Arquivo::where('id', $processo->idArquivo);
                                                    // echo($documento->first()->caminho);    
                                                    @endphp 
                                                  @if ($documento->exists()) 
                                                    <a href="{{ route('Exibir.Imagem', ['imagem' => base64_encode( $documento->first()->caminho )]) }}" class="btn btn-secondary {{ ($processo->estado == 'Aprovado' || $processo->estado == 'Desfavoravel' || $processo->estado == 'Favoravel') ? 'd-inline' : 'd-none'}} ">Baixar Documento</a>
                                                  @endif
                                                </div>
                                              </div>
                                            </div>
                                            <!--MODAIS-->
                                           
             
                                            @endforeach
                                            
                                          <!-- END timeline item -->




                                          <!-- timeline time label -->
                                            <div class="time-label">
                                              <span class="bg-success">
                                                3 Jan. 2014
                                              </span>
                                            </div>
                                          <!-- /.timeline-label -->
                                          <div>
                                            <i class="far fa-clock bg-gray"></i>
                                          </div>
                                        </div>
                                    </div>
                                  <!-- /tab-pane -->
                             
                              </div>
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
    document.getElementById("fo"ddEventListener("submit", function(event) {
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