<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <a href="{{ route('perfil.show', ['idFuncionario' => $funcionario->id ]) }}" class="d-block">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
              <!--Verificador e renderizador de foto de Perfil-->  
              @php
              $fotodeperfil = App\Models\Arquivo::where('idFuncionario', $funcionario->id )->where('categoria','FotoPerfil');
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
                      
        </div>
        <div class="info">
          {{ $pessoa->nomeCompleto }}
        </div>
      </div>
      </a>

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
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{ request()->routeIs('inicio') ? 'active' : ''}}">
              <i class="fas fa-tachometer-alt"></i>
              <p>
                Dashboards
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('inicio')}}"  class="nav-link {{ request()->routeIs('inicio') ? 'active' : ''}}">
                  <i class="fas fa-home nav-icon"></i>
                  <p>Início</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('inicio')}}"  class="nav-link ">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Timeline</p>
                </a>
              </li>
            </ul>

           <!--Funcionários-->
           <li class="nav-item {{ request()->routeIs('funcionarios.index') || request()->routeIs('funcionarios.form') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('funcionarios.index') || request()->routeIs('funcionarios.form') ? 'active' : ''}}">
              <i class="fas fa-user-tie "></i>
              <p>
                Funcionário
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{route('funcionarios.index')}}"  class="nav-link {{ request()->routeIs('funcionarios.index') ? 'active' : ''}}">
                    <i class="fas fa-th-list nav-icon"></i>
                    <p>Funcionarios / Index </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{route('funcionarios.form')}}"  class="nav-link {{ request()->routeIs('funcionarios.form') ? 'active' : ''}}">
                    <i class="fas fa-user-plus nav-icon"></i>
                    <p>Cadastrar Funcionarios</p>
                  </a>
              </li>
            </ul>
           </li>
           <!--/.funcionários-->

           <!--UnidadeOrganica-->
           <li class="nav-item {{ request()->routeIs('unidadeorganicas.index') || request()->routeIs('unidadeorganicas.form') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('unidadeorganicas.index') || request()->routeIs('unidadeorganicas.form') ? 'active' : '' }}">
              <i class="fas fa-building"></i>
              <p>
              Unidade Orgânica
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('unidadeorganicas.index')}}"  class="nav-link {{ request()->routeIs('unidadeorganicas.index') ? 'active' : ''}}">
                  <i class="fas fa-th-list nav-icon"></i>
                  <p>Unidade Orgánica / Index </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('unidadeorganicas.form')}}" class="nav-link {{ request()->routeIs('unidadeorganicas.form') ? 'active' : ''}}">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Cadastrar Unidade Orgánica</p>
                </a>
              </li>
             </ul>
            </li>
           <!--/.UnidadeOrganica-->

           <!--Pessoas-->
           <li class="nav-item {{ request()->routeIs('pessoas.index') || request()->routeIs('pessoas.form') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('pessoas.index') || request()->routeIs('pessoas.form') ? 'active' : '' }}">
              <i class="fa fa-user"></i>
              <p>
                Pessoas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('pessoas.index')}}"  class="nav-link {{ request()->routeIs('pessoas.index') ? 'active' : ''}}">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Pessoas / Index</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('pessoas.form')}}"  class="nav-link {{ request()->routeIs('pessoas.form') ? 'active' : ''}}">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Cadastrar Pessoa</p>
                </a>
              </li>
            </ul>
           </li>
           <!--/.Pessoas-->

           <!--Cargos-->
           <li class="nav-item {{ request()->routeIs('cargos.index') || request()->routeIs('cargos.form') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('cargos.index') || request()->routeIs('cargos.form') ? 'active' : '' }}">
              <i class="fas fa-briefcase"></i>
              <p>
                Cargos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('cargos.index')}}"  class="nav-link {{ request()->routeIs('cargos.index') ? 'active' : ''}}">
                  <i class="fas fa-th-list nav-icon"></i>
                  <p>Cargos / Index </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('cargos.form')}}" class="nav-link {{ request()->routeIs('cargos.form') ? 'active' : ''}}">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Cadastrar Cargos</p>
                </a>
              </li>
            </ul>
           </li>
           <!--/.Cargos-->


           <!--CategoriaFuncionario-->
           <li class="nav-item {{ request()->routeIs('categoriafuncionarios.index') || request()->routeIs('categoriafuncionarios.form') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('categoriafuncionarios.index') || request()->routeIs('categoriafuncionarios.form') ? 'active' : '' }}">
              <i class="fas fa-user-graduate"></i>
              <p>
              Categoria de Funcionários
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('categoriafuncionarios.index')}}"  class="nav-link {{ request()->routeIs('categoriafuncionarios.index') ? 'active' : ''}}">
                  <i class="fas fa-th-list nav-icon"></i>
                  <p>Categoria de Funcionários / Index</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('categoriafuncionarios.form')}}"  class="nav-link {{ request()->routeIs('categoriafuncionarios.form') ? 'active' : ''}}">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Cadastarar Categoria de Funcionários</p>
                </a>
              </li>
            </ul>
           </li>
           <!--/.CategoriaFuncionario-->


                    <!--Ouros-->
                    <li class="nav-item {{ request()->routeIs('habilitacaos.index') || request()->routeIs('habilitacaos.form') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('habilitacaos.index') || request()->routeIs('habilitacaos.form') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                          Outros
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="{{route('habilitacaos.form')}}"  class="nav-link {{ request()->routeIs('habilitacaos.form') ? 'active' : ''}}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Habilitacao / Index </p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{route('habilitacaos.form')}}"  class="nav-link {{ request()->routeIs('habilitacaos.form') ? 'active' : ''}}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Cadastarar Habilitacao do Funcionario</p>
                            </a>
                          </li>  
                          <li class="nav-item">
                            <a href="{{route('enderecos.form')}}"  class="nav-link {{ request()->routeIs('enderecos.form') ? 'active' : ''}}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Endereços</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                    <!--/.Outros-->



                    <!-- Funcionalidades -->
                      <li class="nav-header">SOLICITAR DOCUMENTOS</li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-circle"></i>
                          <p>
                            Apensos
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Para Tratar Mudar a Conta Salarial</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>
                              Para Tratar Declaração de Serviços
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Credito Bancário</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Outros Motivos</p>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Level 2</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-circle"></i>
                          <p>
                            Licenças
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Level 2</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>
                                Level 2
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Level 3</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Level 3</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Level 3</p>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Level 2</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-circle"></i>
                          <p>
                            Declarações
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Level 2</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>
                                Level 2
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Level 3</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Level 3</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Level 3</p>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Level 2</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>Solicitar Pedido de Gozo de Férias</p>
                        </a>
                      </li>
                    <!-- /.Funcionalidades -->
                    <li class="nav-item">
                          <a href="#" class="nav-link">
                            <i class="nav-icon far fa-plus-square"></i>
                            <p>
                              Extras
                              <i class="fas fa-angle-left right"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                          <li class="nav-item">
                          <a href="pages/calendar.html" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                              Calendar
                              <span class="badge badge-info right">2</span>
                            </p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="pages/gallery.html" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                              Gallery
                            </p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>
                              Mailbox
                              <i class="fas fa-angle-left right"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="pages/mailbox/mailbox.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="pages/mailbox/compose.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compose</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="pages/mailbox/read-mail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Read</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="pages/examples/contacts.html" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Contactos</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="pages/examples/faq.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Faq</p>
                              </a>
                            </li>

                          </ul>
                        </li>
                      </li>
            </li>
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>