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
Route::post('/formulario-habilitacao',[HabilitacaoController::class,'store'])->name('habilitacao.store');


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
Route::any('/create-edit-pessoa/{id?}',[PessoaController::class,'formulario'])->name('pessoas.form')->middleware('AcessoAdmin');
//Mostrar Pessoas
Route::get('/index-pessoa',[PessoaController::class,'index'])->name('pessoas.index');
//Armzenar Registros na Entidade Pessoa 
Route::post('/store-pessoa',[PessoaController::class,'store'])->name('pessoas.store')->middleware('AcessoAdmin');
//Delectar um Registro da Entidade Pessoa
Route::delete('/delete-pessoa/{id}',[PessoaController::class,'destroy'])->name('pessoas.delete')->middleware('AcessoAdmin'); //Corrigir Aplicando o verbo DELETE no formulario 

Route::PUT('/pessoas/editar/{id}',[PessoaController::class,'edit'])->name('pessoas.edit')->middleware('AcessoAdmin'); //Corrigir Aplicando o verbo PUT ou PATCH no formulario 
//Update 
Route::any('/pessoas/update/{id}',[PessoaController::class,'update'])->name('pessoas.update')->middleware('AcessoAdmin');;

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
//Rota para o controler Verificar Pessoa para cadastrar novo fucnionario 
Route::any('/fucionario-verificarPessoa',[FuncionarioController::class,'verificarPessoa'])->name('funcionarios.verificarPessoa');
//Armzenar Registros na Tabela Unidade Organica 
Route::any('/store-fucionario',[FuncionarioController::class,'store'])->name('funcionarios.store')->middleware('AcessoAdmin');
//Mostrar Funcionarios
Route::any('/index-funcionarios',[FuncionarioController::class,'index'])->name('funcionarios.index')->middleware('AcessoAdmin');
//Actualizar um Registro da Entidade Funcionario
Route::any('/updade-funcionario{id}',[FuncionarioController::class,'update'])->name('funcionarios.update')->middleware('AcessoAdmin');
//Delectar um Registro da Entidade Funcionario
Route::delete('/delete-funcionario{id}',[FuncionarioController::class,'destroy'])->name('funcionarios.delete')->middleware('AcessoAdmin');

//




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
Route::any('/store-unidadeorganica',[UnidadeOrganicaController::class,'store'])->name('unidadeorganicas.store')->middleware('AcessoAdmin');
//Exibir Unidade Organicas
Route::any('/index-unidadeorganica',[UnidadeOrganicaController::class,'index'])->name('unidadeorganicas.index')->middleware('AcessoAdmin');
//Ver unidade Organica unidadeOrganica.show 
Route::any('/sobre-unidadeorganica/{idUnidadeOrganica}/',[UnidadeOrganicaController::class,'show'])->name('unidadeOrganica.show');//Definir Permissoes so para os directores
Route::any('/dasboard-unidadeorganica/{idUnidadeOrganica}/',[UnidadeOrganicaController::class,'dashboardUnidadeOrganicaShow'])->name('dashboard.unidade.organica.how');//Definir Permissoes so para os directores
Route::any('/formulario/unidadeorganica/{idUnidadeOrganica}/',[UnidadeOrganicaController::class,'formularioAproveitamentoUnidadeOrganica'])->name('dashboard.unidade.organica.formulario.aproveitamento');//Definir Permissoes so para os directores
//Actualizar um Registro da Entidade-Tabela Unidade Organica
Route::any('/updade-uniddeorganica{id}',[UnidadeOrganicaController::class,'update'])->name('unidadeorganicas.update')->middleware('AcessoAdmin');
//Delectar um Registro da Tabela Unidade Orgaica
Route::delete('/delete-unidadeorganica{id}',[UnidadeOrganicaController::class,'destroy'])->name('unidadeorganicas.delete')->middleware('AcessoAdmin');
//UO Funcionarios
Route::get('/funcionarios/unidade_organica/index/',[UnidadeOrganicaController::class,'funcionariosUnidadeOrganica'])->name('funcionarios.unidade_organica.index');

//Dados Estatistios de Unidades Organicas
Route::any('formulario/aproveitamento/', [UnidadeOrganicaDadosController::class,'cadastrarFormulario'])->name('cadastrar.formulario'); //So directores de Escola Podem Cadastrar dados com as suas contas


// #######      Operacoes com a Entidade/Tabela Cargo       #########

//Formulario Create e Edite the same form
Route::any('/create-edit-cargo/{id?}',[CargoController::class,'formulario'])->name('cargos.form');
//Armazenar Cargos 
Route::any('/store-cargo',[CargoController::class,'store'])->name('cargos.store')->middleware('AcessoAdmin');
//Actualizar Cargos 
Route::any('/update-cargo/{id}',[CargoController::class,'update'])->name('cargos.update')->middleware('AcessoAdmin');
//Mostrar Cargos 
Route::get('/index-cargo',[CargoController::class,'index'])->name('cargos.index');
//Delectar um Registro da Tabela Cargo
Route::delete('/delete-cargo/{id}',[CargoController::class,'destroy'])->name('cargos.delete')->middleware('AcessoAdmin');


#######      Operacoes com a Entidade/Tabela Arquivo       #########

//Formulario Create e Edite the same form
Route::any('/create-edit-arquivo/{id?}',[ArquivoController::class,'formulario'])->name('arquivos.form');
//Armazenar arquivos 
Route::post('/store-arquivo/BI/{idFuncionario}/{categoria}/{idPessoa}',[ArquivoController::class,'storeBI'])->name('arquivos.store');
//Habilitacoes
Route::post('/store-arquivo/hablitacao/{idFuncionario}/{categoria}',[ArquivoController::class,'storeHabilitacao'])->name('arquivos.store.habilitacao');
//Actualizar arquivos 
Route::any('/update-arquivo/{id}',[ArquivoController::class,'update'])->name('arquivos.update');
//Mostrar arquivos 
Route::get('/index-arquivo',[ArquivoController::class,'index'])->name('arquivos.index');
//Delectar um Registro da Tabela arquivo
Route::delete('/delete-arquivo/{id}',[ArquivoController::class,'destroy'])->name('arquivos.delete')->middleware('AcessoAdmin');
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
Route::any('/solicitacao/parecer/',[ProcessoController::class,'parecer'])->name('solicitacao.parecer');


//Solicitacoes Processo via Request
Route::any('/solicitar',[ProcessoController::class,'solicitarProcesso'])->name('solicitar'); 

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


//Solicitar autorizacao de gozo de Férias
Route::any('/gozo-ferias/solicitar/{idFuncionarioSolicitante}',[ProcessoController::class,'gozoFeriasSolicitar'])->name('gozo.ferias.solicitar'); 
Route::any('/gozo-ferias/solicitacao/preview/',[ProcessoController::class,'gozoFeriasPreview'])->name('gozo.ferias.preview');
Route::any('/gozo-ferias/solicitacao/ratificar/',[ProcessoController::class,'gozoFeriasRatificar'])->name('gozo.ferias.ratificar');//Os os chefes Direitos tem acesso a essa rota

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

});
