<?php
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\AssinaturaController;
use App\Http\Controllers\AvaliacaoDesempenhoFuncionarioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CategoriaFuncionarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\HabilitacaoController;
use App\Http\Controllers\MapaEfectividadeController;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\ProcessoController;
use App\Http\Controllers\UnidadeOrganicaController;
use App\Http\Controllers\UnidadeOrganicaDadosController;
use App\Models\Arquivo;
use App\Models\AvaliacaoDesempenhoFuncionario;
use App\Models\Cargo;
use App\Models\Habilitacao;
use App\Models\UnidadeOrganica;
use App\Models\UnidadeOrganicaDado;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\Cast\Object_;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will 
| be assigned to the "web" middleware group. Make something great!
|
*/

//Landing Home
Route::get('/', function () {
    return view('welcome');
})->name('landinghome');
//Rota Renderizar a imagem para Logo SGRHE
Route::any('/logo',[ArquivoController::class,'logo'])->name('logo');



//Operacoes com a Entidade/Tabela Habilitacao
Route::get('/formulario-habilitacao-form', function(){
    return view('sgrhe/pages/forms/habilitacao');
})->name('habilitacaos.form');

Route::get('/habilitacao-index', function(){
    return view('sgrhe/pages/forms/habilitacao-index');
})->name('habilitacaos.index');




//Processamento de Codigo QR


//Rotas Protegidas pelo Sanctun
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


// Rotas Protegidas pelo MiddleWar(Sanctum) 
//Dashboard Invoque
Route::get('/dashboard',[DashboardController::class,'index'])->name('inicio');

Route::redirect('/welcome',function(){
    return header('Location/');
})->name('well');


//Perfil
Route::any('/perfil/{idFuncionario}', [PerfilController::class,'show'])->name('perfil.show');
//Time line Show
Route::any('/timeline/{idFuncionario}', [PerfilController::class,'timelineShow'])->name('timeline.show');

Route::any('/perfil-foto-editor/{idFuncionario}',function(){
    return view('sgrhe/perfil-foto-editor');
})->name('perfil-foto-editor');




//##################    Caminhos e Funcionalidades e Componentes          #####################



//###############   Operacoes com a Entidade Pessoa  ################

//Formulario Create e Edite the same form
Route::any('/create-edit-pessoa/{id?}',[PessoaController::class,'formulario'])->name('pessoas.form');//->middleware('AcessoAdmin');
//Mostrar Pessoas
Route::get('/index-pessoa',[PessoaController::class,'index'])->name('pessoas.index');
//Armzenar Registros na Entidade Pessoa 
Route::post('/store-pessoa',[PessoaController::class,'store'])->name('pessoas.store');//->middleware('AcessoAdmin');
//Delectar um Registro da Entidade Pessoa
Route::delete('/delete-pessoa/{id}',[PessoaController::class,'destroy'])->name('pessoas.delete');//->middleware('AcessoAdmin'); //Corrigir Aplicando o verbo DELETE no formulario 

Route::PUT('/pessoas/editar/{id}',[PessoaController::class,'edit'])->name('pessoas.edit');//->middleware('AcessoAdmin'); //Corrigir Aplicando o verbo PUT ou PATCH no formulario 
//Update 
Route::any('/pessoas/update/{id}',[PessoaController::class,'update'])->name('pessoas.update');//->middleware('AcessoAdmin');;

//###############   Operacoes com a Entidade/ Tabela Pessoa  ################

//Formulario Create e Edite the same form
Route::any('/create-edit-endereco/{id?}',[EnderecoController::class,'formulario'])->name('enderecos.form');
//Mostrar enderecos
Route::get('/index-endereco',[EnderecoController::class,'index'])->name('enderecos.index');
//Armzenar Registros na Tabela enderecos 
Route::post('/store-endereco',[EnderecoController::class,'store'])->name('enderecos.store');
//Delectar um Registro da Entidade enderecos
Route::delete('/delete-endereco/{id}',[EnderecoController::class,'destroy'])->name('enderecos.delete'); //Corrigir Aplicando o verbo DELETE no formulario 

Route::PUT('/endereco/editar/{id}',[EnderecoController::class,'edit'])->name('enderecos.edit'); //Corrigir Aplicando o verbo PUT ou PATCH no formulario 
//Update 



//###############   Operacoes com a Entidade Funcionario  ################

//Formulario Create e Edite the same form
Route::any('/create-edit-funcionario/{id?}',[FuncionarioController::class,'formulario'])->name('funcionarios.form');
//Rotas para o controler Verificar Pessoa para cadastrar novo fucnionario 
Route::any('/fucionario-verificarPessoa',[FuncionarioController::class,'verificarPessoa'])->name('funcionarios.verificarPessoa');
Route::any('/fucionario-verificarPessoaFuncionario/{numeroBI}',[FuncionarioController::class,'verificarPessoaFuncionario'])->name('funcionarios.verificarPessoa.funcionario');
//Armzenar Registros na Tabela Unidade Organica 
Route::any('/store-fucionario',[FuncionarioController::class,'store'])->name('funcionarios.store');//->middleware('AcessoAdmin');
//Mostrar Funcionarios
Route::any('/index-funcionarios/inativos',[FuncionarioController::class,'index'])->name('funcionarios.index');//->middleware('AcessoAdmin');funcionarios.index.inativos

//Usando Formulário Selectivo por Tipologias de Funcionários
Route::any('/funcionarios',[FuncionarioController::class,'indexFuncionarios'])->name('funcionarios');

Route::any('/index-funcionarios',[FuncionarioController::class,'indexFuncionariosInativos'])->name('funcionarios.index.inativos');//->middleware('AcessoAdmin');
//Actualizar um Registro da Entidade Funcionario
Route::any('/updade-funcionario{id}',[FuncionarioController::class,'update'])->name('funcionarios.update');//->middleware('AcessoAdmin');
//Delectar um Registro da Entidade Funcionario
Route::delete('/delete-funcionario{id}',[FuncionarioController::class,'destroy'])->name('funcionarios.delete');//->middleware('AcessoAdmin');

//Alterar estado do Funcionario
Route::any('/funcionario/estado/', [FuncionarioController::class, 'estado'])->name('estado.funcionario');  
//Ver Ficha de Fucnionario
Route::any('/funcionario/ficha/', [FuncionarioController::class, 'fichaFuncionario'])->name('ver.ficha.funcionario'); 


//QR Code
Route::any('/Qr_code',[FuncionarioController::class,'qr'])->name('qr.code');

// #############    Operacoes com a Entidade/Tabela Categoria Funcionario ########
//Formulario Create e Edite the same form
Route::any('/create-edit-categoriafuncionario/{id?}',[CategoriaFuncionarioController::class,'formulario'])->name('categoriafuncionarios.form');
//Armzenar Registros na Tabela Categorias Fucionarios
Route::any('/store-categoriafuncionario',[CategoriaFuncionarioController::class,'store'])->name('categoriafuncionarios.store');
//Mostrar Funcionarios
Route::any('/index-categoriafuncionario',[CategoriaFuncionarioController::class,'index'])->name('categoriafuncionarios.index');
//Actualizar um Registro da Entidade Funcionario
Route::any('/updade-categoriafuncionario{id}',[CategoriaFuncionarioController::class,'update'])->name('categoriafuncionarios.update');
//Delectar um Registro da Entidade Funcionario
Route::delete('/delete-categoriafuncionario{id}',[CategoriaFuncionarioController::class,'destroy'])->name('categoriafuncionarios.delete');





//#################    Operacoes com a Tabela Unidade Organica   ###################

//Formulario Create e Edite the same form
Route::any('/create-edit-unidadeorganica/{id?}',[UnidadeOrganicaController::class,'formulario'])->name('unidadeorganicas.form');
//Armzenar Registros na Tabela Unidade Organica 
Route::any('/store-unidadeorganica',[UnidadeOrganicaController::class,'store'])->name('unidadeorganicas.store');//->middleware('AcessoAdmin');
//Exibir Unidade Organicas  
Route::any('/index-unidadeorganica',[UnidadeOrganicaController::class,'index'])->name('unidadeorganicas.index');//->middleware('AcessoAdmin');
//
Route::any('/unidadesorganicas',[UnidadeOrganicaController::class,'indexUnidadesOrganicas'])->name('unidades.organicas');

//Ver unidade Organica unidadeOrganica.show 
Route::any('/sobre/unidadeorganica/{idUnidadeOrganica}',[UnidadeOrganicaController::class,'show'])->name('unidadeOrganica.show');//Definir Permissoes so para os directores
Route::any('/dasboard/unidadeorganica/{idUnidadeOrganica}',[UnidadeOrganicaController::class,'dashboardUnidadeOrganicaShow'])->name('dashboard.unidade.organica.how');//Definir Permissoes so para os directores
Route::any('/formulario/unidadeorganica/',[UnidadeOrganicaController::class,'formularioAproveitamentoUnidadeOrganica'])->name('dashboard.unidade.organica.formulario.aproveitamento');//Definir Permissoes so para os directores
//Actualizar um Registro da Entidade-Tabela Unidade Organica
Route::any('/updade-uniddeorganica/{id}',[UnidadeOrganicaController::class,'update'])->name('unidadeorganicas.update');//->middleware('AcessoAdmin');
//Delectar um Registro da Tabela Unidade Orgaica
Route::delete('/delete-unidadeorganica{id}',[UnidadeOrganicaController::class,'destroy'])->name('unidadeorganicas.delete');//->middleware('AcessoAdmin');
//UO Funcionarios
Route::get('/funcionarios/unidade_organica/index/',[UnidadeOrganicaController::class,'funcionariosUnidadeOrganica'])->name('funcionarios.unidade_organica.index');
//Actualizar Unidade Organica
//Adicionar Foto a Uma unidade Organica
Route::any('/add/fotos/uo/',[UnidadeOrganicaController::class,'AddFotosUO'])->name('add.foto.uo');
//Ver u Listar as Imagens de Uma unidade Organica
Route::any('/ver/fotos/{idUnidadeOrganica}',[UnidadeOrganicaController::class,'galeriaUnidadeOrganica'])->name('galeria.unidade.organica');


//Dados Estatistios de Unidades Organicas
Route::any('formulario/aproveitamento/', [UnidadeOrganicaDadosController::class,'cadastrarFormulario'])->name('cadastrar.formulario'); //So directores de Escola Podem Cadastrar dados com as suas contas


// #######      Operacoes com a Entidade/Tabela Cargo       #########

//Formulario Create e Edite the same form
Route::any('/create-edit-cargo/{id?}',[CargoController::class,'formulario'])->name('cargos.form');
//Armazenar Cargos 
Route::any('/store-cargo',[CargoController::class,'store'])->name('cargos.store');//->middleware('AcessoAdmin');
//Actualizar Cargos 
Route::any('/update-cargo/{id}',[CargoController::class,'update'])->name('cargos.update');//->middleware('AcessoAdmin');
//Mostrar Cargos 
Route::get('/index-cargo',[CargoController::class,'index'])->name('cargos.index');
//Delectar um Registro da Tabela Cargo
Route::delete('/delete-cargo/{id}',[CargoController::class,'destroy'])->name('cargos.delete');//->middleware('AcessoAdmin');


#######      Operacoes com a Entidade/Tabela Arquivo       #########

//Formulario Create e Edite the same form
Route::any('/create-edit-arquivo/{id?}',[ArquivoController::class,'formulario'])->name('arquivos.form');
//Armazenar BI 
Route::post('/store-arquivo/bi/{idFuncionario}/{categoria}/{idPessoa}',[ArquivoController::class,'storeBI'])->name('arquivos.store');
//Armazenar Carta de Municipe 
Route::post('/store-arquivo/cm/{idFuncionario}/{categoria}/{idPessoa}',[ArquivoController::class,'storeCM'])->name('arquivos.store.cm');
//Habilitacoes
Route::post('/store-arquivo/hablitacao/{idFuncionario}/{categoria}',[ArquivoController::class,'storeHabilitacao'])->name('arquivos.store.habilitacao');
//Actualizar arquivos 
Route::any('/update-arquivo/{id}',[ArquivoController::class,'update'])->name('arquivos.update');
//Mostrar arquivos 
Route::get('/index-arquivo',[ArquivoController::class,'index'])->name('arquivos.index');
//Delectar um Registro da Tabela arquivo
Route::delete('/delete-arquivo/{id}',[ArquivoController::class,'destroy'])->name('arquivos.delete');//->middleware('AcessoAdmin');
//Foto de Perfil
//Armazenar foto de Perfil
Route::post('/foto/perfil/actualizar',[ArquivoController::class,'fotoPerfilActualizar'])->name('foto.perfil.actualizar');
//Renderizar IMG
//Rota para renderizar a imagem user Avatar
Route::any('/avatar-usuario',[ArquivoController::class,'avatarUsuario'])->name('Avatar.Usuario');
//Rota para Renderizar qualquer imagem com aenas o caminho Imagem
Route::any('/exibir-imagem/{imagem}',[ArquivoController::class,'exibirImagem'])->name('Exibir.Imagem');
//Exibir Ficheiros

Route::any('/exibir/documento/',[ArquivoController::class,'exibirDocumento'])->name('exibir.documento');

//Rota para Adicionar Documento Baixar Documento
Route::any('/uplod/file', [ArquivoController::class,'uploadFile'])->name('upload.file');
Route::any('/dowload/file', [ArquivoController::class,'dowloadFile'])->name('dowload.file');
//Area De Rotas de Processos 

//Solicitacoes 
Route::any('/solicitar/{idFuncionarioSolicitante}',[ProcessoController::class,'solicitar'])->name('apenso.solicitar'); 
Route::any('/solicitacao/preview/',[ProcessoController::class,'preview'])->name('solicitacao.preview');
Route::any('/solicitacao/ratificar/',[ProcessoController::class,'ratificar'])->name('solicitacao.ratificar');
Route::any('/solicitacao/cancelar/{idProcesso}',[ProcessoController::class,'cancelar'])->name('solicitacao.cancelar');
Route::any('/solicitacao/parecer/',[ProcessoController::class,'darParecer'])->name('solicitacao.parecer');


//Solicitacoes Processo via Request
Route::any('/solicitar',[ProcessoController::class,'solicitar'])->name('solicitar'); 

//Requerer a lista de processos de uma determinada seccao
Route::any('procesos/{seccao}', [ProcessoController::class,'processosSeccao'])->name('processos.seccao');

// Avaliar Desempenho de funcionario
Route::get('/avaliacao/funcionarios/homologados', [AvaliacaoDesempenhoFuncionarioController::class,'avaliacaoDesempenhoFuncionariosHomologados'])->name('avaliacao.funcionarios.homologados');
Route::get('/fichas/avaliacao/funcionarios/', [AvaliacaoDesempenhoFuncionarioController::class,'avaliacaoDesempenhoFuncionariosNaoHomologados'])->name('avaliacao.nao.homologados');
//Avaliacao de um unico funcionario
Route::get('/fichas/{idFuncionario}', [AvaliacaoDesempenhoFuncionarioController::class,'indexAvaliacaoDesempenhoFuncionario'])->name('fichas.avaliacao.funcionario');

Route::any('/formulario/avaliacao/funcionario/', [FuncionarioController::class,'formularioAvaliarDesempenhoFuncionario'])->name('formulario.avaliar.funcionario');
Route::any('/submeter/avaliacao/funcionario/', [AvaliacaoDesempenhoFuncionarioController::class,'avaliarDesempenhoFuncionario'])->name('submeter.avaliar.funcionario');
Route::any('/ver/avaliacao/funcionario/', [AvaliacaoDesempenhoFuncionarioController::class,'verAvaliacao'])->name('ver.avaliacao');
Route::post('/homologar/avaliacao/funcionario/', [AvaliacaoDesempenhoFuncionarioController::class,'homologar'])->name('homologar.avaliacao');


//Solicitar Processos Genericos
//Route::any('/solicitar/processo/',[ProcessoController::class, 'solicitarProcesso'])->name('solicitar.processo'); 

//Assinaturas / ficheiros
Route::any('/assinatura/update', [AssinaturaController::class,'assinaturaUpdate'])->name('assinatura.update');
Route::any('/file/upload', [AssinaturaController::class,'uploadFile'])->name('file.upload');

//Gerar Qualquer documento
Route::any('/gerar/docs/', [ProcessoController::class,'gerarDoc'])->name('gerar.docs');
//Configuaracoes
Route::get('/configuracao/perfil/', function(){
        return view('sgrhe/perfil-config');
})->name('configuracao.perfil');

//Delete Item
Route::any('/objecto/eliminar/', [ObjectController::class, 'eliminar'])->name('eliminar.objecto');

//Operações feitas com tabea Documento
Route::any('/documento/create', [DocumentoController::class, 'inserirDocumento'])->name('inserir.documento');
Route::any('/exibir/documento/{documento}',[DocumentoController::class,'exibirDocumento'])->name('exibir.doc');


//Operacoes com Mapas de Efectividades
Route::any('/index/mapas/efectividades/', [MapaEfectividadeController::class, 'indexMapasEfectividade'])->name('mapas.efectividade');
Route::any('/mapa/efectividade/', [MapaEfectividadeController::class, 'criarMapaEfectividade'])->name('criar.mapa.efectividade');
Route::any('/form/efectividade/{idMapaEfectividade}', [MapaEfectividadeController::class, 'formMapaEfectividade'])->name('form.mapa.efectividade');
Route::any('/add/efectividade/', [MapaEfectividadeController::class, 'addFuncionarioEfectividade'])->name('add.funcionario.efectividade');
Route::any('/faltas/efectividade/', [MapaEfectividadeController::class, 'aplicarFaltas'])->name('aplicar.faltas');
Route::any('/remover/efectividade/', [MapaEfectividadeController::class, 'removerDoMapaEfectividade'])->name('remover.do.mapa.efectividade');
Route::any('/efectivar/mapa/', [MapaEfectividadeController::class, 'efectivarMapaEfectividade'])->name('efectivar.mapa.efectividade');





});
