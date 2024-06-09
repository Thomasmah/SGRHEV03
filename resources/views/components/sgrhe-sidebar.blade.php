@php
  $permissoes = session()->only(['Cargo'])['Cargo']->permissoes;
@endphp
<div class="sidebar">
      <!-- SidebarSearch Form 
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      -->
      <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library has-treeview -->
              <li class="nav-item  menu-open" id="menu" >
                      <!--Perfil-->
                        
                                <div class="image">
                                      <!--Verificador e renderizador de foto de Perfil-->  
                                      @php
                                        $fotodeperfil = App\Models\Arquivo::where('idFuncionario',$funcionarioLog->id)->where('categoria','FotoPerfil')->first();
                                        //echo($fotodeperfil);
                                      @endphp
                                      @if ($fotodeperfil )            
                                        <!--Se existir (foto de Perfil-->
                                      <img class="profile-user-img img-fluid img-circle"
                                              src="{{ route('Exibir.Imagem', ['imagem' => base64_encode( $fotodeperfil->caminho )]) }}"
                                              alt="User profile picture">
                                      @else
                                      <!--Se Nao existir foto de Perfil-->
                                      
                                      <img class="profile-user-img img-fluid img-circle"
                                      src="{{ route('Avatar.Usuario') }}"
                                              alt="User profile picture">
                                      @endif
                                              
                                </div>
                                <a href="{{ route('perfil.show', ['idFuncionario' => $funcionarioLog->id]) }}" class="d-block">
                                  <div class="text-center ">
                                    <div style="width:100%;" class="info elemento" id="elemento">
                                      <p style="font-weight: bolder;">{{ session()->only(['Cargo'])['Cargo']->designacao }}</p> <!--.' de(a) '.session()->only(['Seccao'])['Seccao']->designacao -->
                                      <p>({{ session()->only(['Seccao'])['Seccao']->codNome }})</p>
                                      <p>Olá {{ explode(" ", $pessoaLog->nomeCompleto)[0] }}!</p>
                                      
                                      <p>Seja bem vindo(a)!</p>
                                    </div>
                                  </div>
                                  <hr style="border: 1px solid grey;">
                                </a>
                                
                               
                                
                          <li class="nav-item">
                                <a href="{{ route('timeline.show', ['idFuncionario' => $funcionarioLog->id]) }}"  class="nav-link {{ request()->routeIs('timeline.show') ? 'active' : ''}}">
                                <i class="bi bi-calendar2-range"></i>  
                                <p class="item-1">
                                    Linha de Tempo
                                  </p>
                                </a>
                          </li>
                          @if ($permissoes === 'Admin' || $permissoes >= 4)
                                    <!--Dashboards-->
                                      <li class="nav-item">
                                          <a href="#" class="nav-link {{ request()->routeIs('inicio') ? 'active' : ''}}">
                                          <i class="bi bi-graph-up-arrow"></i>
                                            <p class="item-1">
                                              Dashboards & Processos
                                              <i class="right fas fa-angle-left"></i>
                                            </p>
                                          </a>
                                          <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                              <a href="{{ route('inicio') }}"  class="nav-link {{ request()->routeIs('inicio') ? 'active' : ''}}">
                                                <p class="item-2">
                                                <i class="bi bi-clipboard-data-fill"></i>
                                                  DashBoard
                                                </p>
                                              </a>
                                            </li>
                                            <li class="nav-item">
                                              <a href="{{ route('processos.seccao', ['seccao' => session()->only(['Seccao'])['Seccao']->codNome ] ) }}" class="nav-link ">
                                                <p class="item-2">
                                                <i class="bi bi-grid"></i>
                                                  Processos da Secção
                                                </p>
                                              </a>
                                            </li>
                                            <li class="nav-item">
                                              <a href="{{ route('mapas.efectividade') }}"  class="nav-link ">
                                                <p class="item-2">
                                                <i class="bi bi-grid"></i>
                                                  Mapas de Efectividade
                                                </p>
                                              </a>
                                            </li>
                                            <li class="nav-item">
                                              <a href="#"  class="nav-link ">
                                                <p class="item-2">
                                                <i class="bi bi-grid"></i>
                                                  Outro
                                                </p>
                                              </a>
                                            </li>
                                          </ul>
                                      </li>
                                    <!--Dashboards-->
                          @endif
                         <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->routeIs('perfil.show') || request()->routeIs('configuracao.perfil') ? 'active' : ''}}">
                              <i class="bi bi-person-lines-fill"></i> 
                              <p class="item-1">
                                  Opções de Perfil
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="{{ route('perfil.show', ['idFuncionario' => $funcionarioLog->id]) }}"  class="nav-link {{ request()->routeIs('perfil.show') ? 'active' : ''}}">
                                  <p class="item-2">
                                   <i class="bi bi-person-vcard-fill"></i>
                                    Perfil
                                  </p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{ route('configuracao.perfil') }}"  class="nav-link {{ request()->routeIs('configuracao.perfil') ? 'active' : ''}} ">
                                  <p class="item-2">
                                  <i class="bi bi-person-gear"></i>
                                    Configurações de Perfil
                                  </p>
                                </a>
                              </li>
                            </ul>
                        </li>
                      <!--Perfil-->
              @if ($permissoes === '3' || $permissoes === '2')
                      <!--Dashboards-->
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->routeIs('dashboard.unidade.organica.how') ? 'active' : ''}}">
                              <i class="bi bi-graph-up-arrow"></i>
                              <p class="item-1">
                                Dashboards
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="{{ route('inicio') }}"  class="nav-link {{ request()->routeIs('dashboard.unidade.organica.how') ? 'active' : ''}}">
                                  <p class="item-2">
                                   <i class="bi bi-clipboard2-pulse-fill"></i>
                                    DashBoard Escola
                                  </p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#"  class="nav-link {{ request()->routeIs('inicio') ? 'active' : ''}}">
                                  <p class="item-2">
                                    <i class="fa fa-th-list nav-icon"></i>
                                    Outro
                                  </p>
                                </a>
                              </li>
                            </ul>
                        </li>
                      <!--Dashboards-->
              @endif
                      <!-- Opcoes do Funcionario-->
                        <li class="nav-item {{ request()->routeIs('fichas.avaliacao.funcionario') ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link {{ request()->routeIs('fichas.avaliacao.funcionario') ? 'active' : '' }}">
                          <i class="bi bi-menu-button-fill"></i>
                            <p class="item-1">
                            Opções do Funcionário
                              <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="{{ route('fichas.avaliacao.funcionario', ['idFuncionario' => $funcionarioLog->id ]) }}"  class="nav-link {{ request()->routeIs('fichas.avaliacao.funcionario') ? 'active' : ''}}">
                                <p class="item-2">
                                <i class="bi bi-calendar2-range"></i>
                                Fichas de Avaliação
                                </p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href=""  class="nav-link ">
                                <p class="item-2">
                                <i class="bi bi-calendar2-range"></i>
                                Outros
                                </p>
                              </a>
                            </li>
                          </ul>
                        </li>
                      <!-- Opcoes do Funcionario-->
                    
        
              @if ($permissoes === 'Admin' || $permissoes >= 4 )
                      <!--Avaliacao de Desempenho-->
                        <li class="nav-item {{ request()->routeIs('avaliacao.nao.homologados') || request()->routeIs('avaliacao.funcionarios.homologados') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('avaliacao.nao.homologados') || request()->routeIs('avaliacao.funcionarios.homologados') ? 'active' : '' }}">
                          <i class="fas fa-building"></i>
                          <p class="item-1">
                          Avaliação de Desempenho
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="{{route('avaliacao.funcionarios.homologados')}}"  class="nav-link {{ request()->routeIs('avaliacao.funcionarios.homologados') ? 'active' : ''}}">
                                <p class="item-2">
                                 <i class="bi bi-view-list"></i>
                                  Mapa Geral de Avaliação / Index 
                                </p>
                              </a>
                            </li>
                            <li class="nav-item {{ ($permissoes >= 6) ? '' : 'd-none' }}">
                              <a href="{{route('avaliacao.nao.homologados')}}" class="nav-link {{ request()->routeIs('avaliacao.nao.homologados') ? 'active' : ''}}">
                                <p class="item-2">
                                 <i class="bi bi-building-fill-add"></i>
                                  Por Homologar
                                </p>
                              </a>
                            </li>
                          </ul>
                        </li>
                      <!--/.UnidadeOrganica-->
              @endif
              @if ($permissoes === 'Admin' || $permissoes >= 4 )
                      <!--Funcionários-->
                        <li class="nav-item {{ request()->routeIs('funcionarios') || request()->routeIs('funcionarios.form') ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link {{ request()->routeIs('funcionarios') || request()->routeIs('funcionarios.form') ? 'active' : ''}}">
                            <i class="fas fa-user-tie "></i>
                            <p class="item-1">
                              Funcionários
                              <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <form action="{{ route('funcionarios') }}" class="nav-link {{ request()->routeIs('funcionarios') ? 'active' : ''}}" >
                                @csrf
                                @method('POST')
                                <p class="item-2">
                                   <i class="bi bi-view-list"></i>
                                    <input type="hidden" name="titulo" value="Funcionários">
                                    <input type="hidden" name="estado" value="Todo">
                                    <input type="submit" value="Funcionários">
                                </p>
                              </form>
                            </li>
                            <li class="nav-item {{ ($permissoes === 'Admin' || $permissoes >= 5 ) ? '' : 'd-none' }}">
                                <a href="{{route('funcionarios.form')}}"  class="nav-link {{ request()->routeIs('funcionarios.form') ? 'active' : ''}}">
                                  <p class="item-2">
                                  <i class="bi bi-person-plus-fill"></i>
                                    Cadastrar Funcionarios
                                  </p>
                                </a>
                            </li>
                          </ul>
                        </li>
                      <!--/.funcionários-->
              @endif
              @if ($permissoes === 'Admin' || $permissoes >= 4 )
                      <!--CategoriaFuncionario-->
                        <li class="nav-item {{ request()->routeIs('categoriafuncionarios.index') || request()->routeIs('categoriafuncionarios.form') ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link {{ request()->routeIs('categoriafuncionarios.index') || request()->routeIs('categoriafuncionarios.form') ? 'active' : '' }}">
                            <i class="fas fa-user-graduate"></i>
                            <p class="item-1">
                            Categoria de Funcionários
                              <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="{{route('categoriafuncionarios.index')}}"  class="nav-link {{ request()->routeIs('categoriafuncionarios.index') ? 'active' : ''}}">
                                <p class="item-2">
                                <i class="bi bi-view-list"></i>
                                  Categoria de Funcionários / Index
                                </p>
                              </a>
                            </li>
                            <li class="nav-item {{ ($permissoes === 'Admin' || $permissoes >= 5) ? '' : 'd-none' }}">
                              <a href="{{route('categoriafuncionarios.form')}}"  class="nav-link {{ request()->routeIs('categoriafuncionarios.form') ? 'active' : ''}}">
                                <p class="item-2">
                                 <i class="bi bi-node-plus-fill"></i>
                                  Cadastarar Categoria de Funcionários
                                </p>
                              </a>
                            </li>
                          </ul>
                        </li>
                      <!--/.CategoriaFuncionario-->
              @endif
              @if ($permissoes === 'Admin' || $permissoes >= 4 )

                      <!--Pessoas-->
                        <li class="nav-item {{ request()->routeIs('pessoas.index') || request()->routeIs('pessoas.form') ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link {{ request()->routeIs('pessoas.index') || request()->routeIs('pessoas.form') ? 'active' : '' }}">
                            <i class="fa fa-user"></i>
                            <p class="item-1">
                              Pessoas
                              <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{route('pessoas.index')}}"  class="nav-link {{ request()->routeIs('pessoas.index') ? 'active' : ''}}">
                                <p class="item-2">
                                 <i class="bi bi-view-list"></i>
                                  Pessoas / Index
                                </p>
                              </a>
                            </li>
                            <li class="nav-item {{ ($permissoes === 'Admin' || $permissoes >= 5) ? '' : 'd-none' }}">
                              <a href="{{route('pessoas.form')}}"  class="nav-link {{ request()->routeIs('pessoas.form') ? 'active' : ''}}">
                                <p class="item-2">
                                <i class="bi bi-person-plus"></i>
                                  Cadastrar Pessoa
                                </p>
                              </a>
                            </li>
                          </ul>
                        </li>
                      <!--/.Pessoas-->
              @endif
              @if ($permissoes === 'Admin' || $permissoes >= 4 )
                      <!--UnidadeOrganica-->
                        <li class="nav-item {{ request()->routeIs('unidades.organicas') || request()->routeIs('unidadeorganicas.form') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('unidades.organicas') || request()->routeIs('unidadeorganicas.form') ? 'active' : '' }}">
                          <i class="fas fa-building"></i>
                          <p class="item-1">
                          Unidade Orgânica
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <form action="{{ route('unidades.organicas') }}" class="nav-link {{ request()->routeIs('unidades.organicas') ? 'active' : ''}}" >
                                @csrf
                                @method('POST')
                                <p class="item-2">
                                   <i class="bi bi-view-list"></i>
                                    <input type="hidden" name="titulo" value="Unidades Orgânicas">
                                    <input type="hidden" name="nivelEnsino" value="Todo">
                                    <input type="submit" value="Unidades Orgânicas">
                                </p>
                              </form>
                            </li>
                            <li class="nav-item {{ ($permissoes === 'Admin' || $permissoes >= 5) ? '' : 'd-none' }}">
                              <a href="{{route('unidadeorganicas.form')}}" class="nav-link {{ request()->routeIs('unidadeorganicas.form') ? 'active' : ''}}">
                                <p class="item-2">
                                 <i class="bi bi-building-fill-add"></i>
                                  Cadastrar Unidade Orgánica
                                </p>
                              </a>
                            </li>
                          </ul>
                        </li>
                      <!--/.UnidadeOrganica-->
              @endif
              @if ($permissoes === 'Admin' || $permissoes >= 4 )
                      <!--Cargos-->
                        <li class="nav-item {{ request()->routeIs('cargos.index') || request()->routeIs('cargos.form') ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link {{ request()->routeIs('cargos.index') || request()->routeIs('cargos.form') ? 'active' : '' }}">
                            <i class="fas fa-briefcase"></i>
                            <p class="item-1">
                              Cargos
                              <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="{{route('cargos.index')}}"  class="nav-link {{ request()->routeIs('cargos.index') ? 'active' : ''}}">
                                <p class="item-2">
                                 <i class="bi bi-view-list"></i>
                                  Cargos / Index 
                                </p>
                              </a>
                            </li>
                            <li class="nav-item  {{ ($permissoes === 'Admin' || $permissoes >= 5) ? '' : 'd-none' }}">
                              <a href="{{route('cargos.form')}}" class="nav-link {{ request()->routeIs('cargos.form') ? 'active' : ''}}">
                                <p class="item-1">
                                <i class="bi bi-node-plus-fill"></i>
                                  Cadastrar Cargos
                                </p>
                              </a>
                            </li>
                          </ul>
                        </li>
                      <!--/.Cargos-->
              @endif
                <!--Serviços-->
                <li class="nav-item {{ request()->routeIs('habilitacaos.index') || request()->routeIs('habilitacaos.form') ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link {{ request()->routeIs('habilitacaos.index') || request()->routeIs('habilitacaos.form') ? 'active' : '' }}">
                           <i class="bi bi-subtract"></i>
                            <p class="item-1">
                               Serviços
                              <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href=""  class="nav-link {{ request()->routeIs('habilitacaos.form') ? 'active' : ''}}">
                                <p class="item-2">
                                <i class="bi bi-calendar2-range"></i>
                                 Solicitar Licença
                                </p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href=""  class="nav-link {{ request()->routeIs('habilitacaos.form') ? 'active' : ''}}">
                                <p class="item-2">
                                <i class="bi bi-calendar2-range"></i>
                                Outros
                                </p>
                              </a>
                            </li>

                          </ul>
                        </li>
                      <!--/.Serviços-->
                    
            </li>
          </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>