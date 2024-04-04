
<button class="btn btn-primary btn-modal-doc-view" data-toggle="modal" data-target="#ver-documento" data-filelink="{{ route('Exibir.Imagem', ['imagem' => base64_encode($fotodeperfil->first()->caminho)]) }}">
 <i class="far fa-file-alt mr-1"></i> Ver Arquivo
</button>


<!-- Modal File View-->
<div class="modal fade" id="ver-documento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Visualizar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="file-container">
                        <!-- Aqui, um iframe será usado para renderizar o conteúdo do arquivo -->
                        <iframe id="file-iframe" style="width: 100%; height: 500px; border: none;"></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="download-button">Download</button>
                    <button type="button" class="btn btn-success" id="print-button">Imprimir</button>
                </div>
            </div>
        </div>
    </div>
<!-- /Modal File View-->

<!--Script para Visualizacao Download e Impressao de Documentos -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script>
    // Função para processar o clique do botão
    function handleButtonClick(fileLink) {
        var fileframe = 'file-iframe';
        var download = 'download-button';
        var print_button = 'print-button';

        // Atualize o atributo src do iframe com o link do arquivo
        document.getElementById(fileframe).src = fileLink;

        // Botão de download
        document.getElementById(download).addEventListener('click', function() {
            // Adicione a lógica para download aqui, por exemplo, abrir em uma nova guia
            window.open(fileLink, '_blank');
        });

        // Botão de impressão
        document.getElementById(print_button).addEventListener('click', function() {
            // Adicione a lógica para impressão aqui, por exemplo, abrir em uma nova guia
            event.preventDefault();
            window.open(fileLink + '?print=1', '_blank');
        });
      }

    // Selecione todos os botões com a classe btn-primary
    var buttons = document.querySelectorAll('.btn-modal-doc-view');

      // Adicione um evento de clique a cada botão
      buttons.forEach(function(button) {
          button.addEventListener('click', function() {
              // Atualize as variáveis com base no link do arquivo do botão clicado
              var fileLink = button.getAttribute('data-filelink');
              
              // Chame a função para processar o clique do botão
              handleButtonClick(fileLink);
          });
      });
  </script>
<!--Script para Visualizacao Download e Impressao de Documentos -->