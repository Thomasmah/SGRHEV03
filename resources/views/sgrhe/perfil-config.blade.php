<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'Perfil - '.$pessoaLog->nomeCompleto )
        @section('header')
        
             <!--Estilizacao do Previw foto de Perfil-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
            <meta name="csrf-token" content="{{ csrf_token() }}">
        @endsection
        @section('conteudo_principal')
      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h5>Opções da Conta / Perfil</h5>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Opções </li>
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
                                <li class="nav-item"><a class="nav-link active" href="#informacoes" data-toggle="tab">Informações de Perfil</a></li>
                                <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Actualizar Password</a></li>
                                <li class="nav-item"><a class="nav-link" href="#doisfactores" data-toggle="tab">Autenticação de dois fatores</a></li>
                                <li class="nav-item"><a class="nav-link" href="#sessoes" data-toggle="tab">Seccões em Browsers</a></li>
                                <!--Essa Funcao é por enquanto Escluxiva do Admin para finc de Controle-->
                                <li class="nav-item"><a class="nav-link" href="#delete" data-toggle="tab">Deletar a Conta</a></li>
                              </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                              <div class="tab-content">
                                  <!--tab-pane-->
                                    <div class="active tab-pane" id="informacoes">
                                                  <div class="card-body">
                                                  @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                                  @livewire('profile.update-profile-information-form')
                                                  @endif                     
                                                  </div>
                                    </div>
                                  <!--/tab-pane-->
                                  <!--tab-pane-->
                                     <div class="tab-pane" id="password">
                                                  <div class="card-body">
                                                  @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                                  <div class="mt-10 sm:mt-0">
                                                  @livewire('profile.update-password-form')
                                                  </div>
                                                  @endif                     
                                                  </div>
                                     </div>
                                  <!--/tab-pane-->
                                  <!--tab-pane-->
                                    <div class="tab-pane" id="doisfactores">
                                                  <div class="card-body">
                                                  @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                                                  <div class="mt-10 sm:mt-0">
                                                  @livewire('profile.two-factor-authentication-form')
                                                  </div>
                                                  @endif                         
                                                  </div>
                                    </div>
                                  <!-- /tab-pane -->
                                  <!--tab-pane-->
                                    <div class="tab-pane" id="sessoes">
                                                  <div class="card-body">
                                                  <div class="mt-10 sm:mt-0">
                                                  @livewire('profile.logout-other-browser-sessions-form')
                                                  </div>                         
                                                  </div>       
                                    </div>                             
                                  <!-- /tab-pane -->
                                   <!--tab-pane-->
                                   <div class="tab-pane" id="delete">
                                                  <div class="card-body">
                                                  @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                                                  <div class="mt-10 sm:mt-0">
                                                  @livewire('profile.delete-user-form')
                                                  </div>
                                                  @endif  
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



<script>
        $(window).on('load',function() {
       //    $('.alertas').modal('show');
        });
</script>




 @endsection