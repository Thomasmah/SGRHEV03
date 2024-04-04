<!--Layout Principal-->
@extends('layouts.app')
  @section('titulo' , 'Enviar Doumento')
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
                  <h1>Enviar Documento</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">{{ 'Enviar Documento' }}</li>
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
                          <h3 class="card-title"> {{'Eviar Documento'}}</h3>  
                      </div>
                      <!--Verifcar a Existencia da Variavel Cargo para determinar se Editar ou Criar um novo Registro-->
                      <form action="{{ route('upload.file') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('POST')
                          <div class="card-body">
                            <div class="form-group">
                              <label for="arquivo">Enviar a Avaliação Homologada</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <label class="custom-file-label" for="arquivo">Escolha um arquivo</label>
                                    <input type="file" class="custom-file-input" name="arquivo">
                                    <input type="text" class="custom-file-input" name="idProcesso" value="{{ $idProcesso }}">
                                    <input type="text" class="custom-file-input" name="categoria" value="AvaliacaoFuncionario">
                                  </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Salvar Arquivo</button>
                            </div>
                          </div>
                          <div class="card-footer">
                            <p class="text-muted">
                            <span class="text-red font-weight-bold">OBS: </span> O Ficheiro ('Avaliacao de Desempenho'-Dinamico)  de ve estar no formato "pdf" em com até 2048MB de tamanho.
                            </p>
                          </div>
                      </form>
                    </div>
                  </div>
              </div>
            </div>
          </section>
        </div> 
       <!-- /.content-wrapper -->
  @endsection
    @section('scripts')
   
    @endsection
