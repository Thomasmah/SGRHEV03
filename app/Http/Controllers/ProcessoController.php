<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use App\Models\Cargo;
use App\Models\categoriaFuncionario;
use App\Models\Funcionario;
use App\Models\Pessoa;
use App\Models\Processo;
use App\Models\UnidadeOrganica;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class ProcessoController extends Controller
{

    public function darParecer(Request $request)
    {
       // dd($request->all());
        if ($request->parecer === 'Favoravel') {
            $D = $request->Request;
            //Converetr o Request String Em Request Array
            parse_str($D, $Request);
            //dd($Request);
            $Documento = $request->file('arquivo');
            //Nomear o Nome do Novo ficheiro PDF
            $fileName = date('dmYHis').'file.pdf';
            $caminho = 'sgrhe/funcionarios/'.$Request['idFuncionarioSolicitante'].'/'.$Request['categoria'].'/'.$fileName;
            //dd($Documento);
            // Armazenar o arquivo no subdiretório dentro da pasta 'local Especifico'
            $save = Storage::disk('local')->put($caminho, file_get_contents($Documento));
            DB::beginTransaction();
            $Arquivo = Arquivo::create([
                'titulo' => md5($fileName),
                'categoria' => $Request['categoria'],
                'descricao' => http_build_query($Request),
                'arquivo' => $fileName,
                'caminho' => $caminho,
                'idFuncionario' => $Request['idFuncionarioSolicitante'],
            ]);
            if ($Arquivo) {
                $idArquivo = Arquivo::where('idFuncionario', $Request['idFuncionarioSolicitante'])->where('categoria', $Request['categoria'] )->latest()->first()->id;

                $Processo = Processo::where('id', $request['idProcesso'])->first();
                //dd($Processo);
                if ($save) {
                    $estado = $request->input('parecer');
                    if ($request->input('parecer') == 'Favoravel') {
                        $estado = 'Aprovado';
                    } 
                    $Processo->update([
                        'idArquivo' => $idArquivo,
                        'ratificador' => session()->only(['funcionario'])['funcionario']->id,
                        'estado' => $estado,
                        'deferimento' => $request->input('parecer'),
                        
                    ]);
                    DB::commit();
                    return redirect()->back()->with('success', 'Ratificado com sucesso!');
                }
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao Salvar o registro!');
            }
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao Ratificar!');

            }else{
                DB::commit();
                $Processo = Processo::where('id', $request['idProcesso'])->first();
                //dd($Processo);
                if ($Processo) {
                    $estado = $request->input('parecer');
                    if ($request->input('parecer') == 'Desfavoralvel') {
                        $estado = 'Não Aprovado';
                    }else {
                        $Processo->update([
                            'ratificador' => session()->only(['funcionario'])['funcionario']->id,
                            'estado' => $estado,
                            'deferimento' => $request->input('parecer'),
                            
                        ]);
                        DB::commit();
                        return redirect()->back()->with('success', 'Parecer aplicado com sucesso!');
                    }
                   
                }
                return redirect()->back()->with('success', 'Parecer aplicado com sucesso!');
            }
        
        
        
       
    }

    public function parecer(Request $request)
    {
      // dd($request->all());
        //Compilando o Documento Ratificado
        //Reconversao do Submit do formularo armazenado no banco de dados
        $D = $request->Request;
        //Converetr o Request String Em Request Array
        parse_str($D, $Request);
        //dd($Request['seccao']);
        $funcionario = Funcionario::where('id', $Request['idFuncionarioSolicitante'])->first();
        $pessoa = Pessoa::where('id', $funcionario->idPessoa)->first();
        $cargo =  Cargo::where('id', $funcionario->idCargo)->first();
        $categoriaFuncionario = categoriaFuncionario::where('id', $funcionario->idCategoriaFuncionario)->first();
        $unidadeOrganica = UnidadeOrganica::where('id', $funcionario->idUnidadeOrganica)->first();
        $idProcesso = $request['idProcesso'];
        $categoria = $Request['categoria'];
       // dd($categoria);
        //Carregar a View
        //Definir Ratificador
        $idRatificador = session()->only(['funcionario'])['funcionario']->id;
        $Documento = PDF::loadView("sgrhe/modelos/$categoria",compact('Request','pessoa','funcionario','cargo','categoriaFuncionario','idRatificador','unidadeOrganica','idProcesso'));      
        //Renderizar a View
        $Documento->render();
        //Nomear o Nome do Novo ficheiro PDF
        $fileName = date('dmYHis').'file.pdf';
        //Retornar o Domunento Gerado 
       // return response($Documento->output(), 200, ['Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline; filename="'.$fileName.'"']);
        //return $Documento->download('file.pdf');
        //Armazenar o Conteudo PDF em uma Variavel
        $pdfContent = $Documento->output();
        $caminho = 'sgrhe/funcionarios/'.$funcionario->idPessoa.'/'.$categoria.'/'.$fileName;
        // Armazenar o arquivo no subdiretório dentro da pasta 'local Especifico'
        $save = Storage::disk('local')->put($caminho, $pdfContent);
        $Arquivo = Arquivo::create([
            'titulo' => md5($fileName),
            'categoria' => $categoria,
            'descricao' => http_build_query($request->all()),
            'arquivo' => $fileName,
            'caminho' => $caminho,
            'idFuncionario' => $funcionario->id,
        ]);
        if ($Arquivo) {
            $idArquivo = Arquivo::where('idFuncionario', $funcionario->id)->where('categoria', $categoria)->latest()->first()->id;
            $Processo = Processo::where('id', $request['idProcesso'])->first();
            //dd($Processo);
            if ($save) {
                $estado = $request->input('parecer');
                if ($request->input('parecer') == 'Favoravel') {
                    $estado = 'Aprovado';
                } 
                DB::beginTransaction();
                $Processo->update([
                    'idArquivo' => $idArquivo,
                    'ratificador' => session()->only(['funcionario'])['funcionario']->id,
                    'estado' => $estado,
                    'deferimento' => $request->input('parecer'),
                    
                ]);
                DB::commit();
                return redirect()->back()->with('success', 'Ratificado com sucesso!');
            }
           DB::rollBack();
           return redirect()->back()->with('error', 'Erro ao Salvar o registro!');
        }
        DB::rollBack();
        return redirect()->back()->with('error', 'Erro ao Ratificar!');
    
        //Registro o Processo no Bango de dados e Salvamento do Arquivo Gerado no Banco de Dados 
    }



    /**
     * Display a listing of the resource.
     */
    public function ratificar(Request $request)
    {
        //Compilando o Documento Ratificado
        //Reconversao do Submit do ormularo armazenado no banco de dados
        $D = $request->Request;
        //Converetr o Request String Em Request Array
        parse_str($D, $Request);
        //dd($Request['seccao']);
        $funcionario = Funcionario::where('id', $Request['idFuncionarioSolicitante'])->first();
        $pessoa = Pessoa::where('id', $funcionario->idPessoa)->first();
        $cargo =  Cargo::where('id', $funcionario->idCargo)->first();
        $categoriaFuncionario = categoriaFuncionario::where('id', $funcionario->idCategoriaFuncionario)->first();
        $idProcesso = $request['idProcesso'];
        $categoria = $Request['categoria'];
        //Carregar a View
        //Definir Ratificador
        $idRatificador = session()->only(['funcionario'])['funcionario']->id;
        $Documento = PDF::loadView("sgrhe/modelos/$categoria",compact('Request','pessoa','funcionario','cargo','categoriaFuncionario','idRatificador','idProcesso'));      
        //Renderizar a View
        $Documento->render();
        //Nomear o Nome do Novo ficheiro PDF
        $fileName = date('dmYHis').'file.pdf';
        //Retornar o Domunento Gerado 
       // return response($Documento->output(), 200, ['Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline; filename="'.$fileName.'"']);
        //return $Documento->download('file.pdf');
        //Armazenar o Conteudo PDF em uma Variavel
        $pdfContent = $Documento->output();
        $caminho = 'sgrhe/funcionarios/'.$funcionario->idPessoa.'/'.$categoria.'/'.$fileName;
        // Armazenar o arquivo no subdiretório dentro da pasta 'local Especifico'
        $save = Storage::disk('local')->put($caminho, $pdfContent);
        $Arquivo = Arquivo::create([
            'titulo' => md5($fileName.now()),
            'categoria' => $categoria,
            'descricao' => http_build_query($request->all()),
            'arquivo' => $fileName,
            'caminho' => $caminho,
            'idFuncionario' => $funcionario->id,
        ]);
        if ($Arquivo) {
            $idArquivo = Arquivo::where('idFuncionario', $funcionario->id)->where('categoria', $categoria)->latest()->first()->id;
            $Processo = Processo::where('id', $request['idProcesso'])->first();
            if ($save) {

                DB::beginTransaction();
                $Processo->update([
                    'idArquivo' => $idArquivo,
                    'ratificador' => session()->only(['funcionario'])['funcionario']->id,
                    'estado' => "Aprovado",
                    'deferimento' => "Favoravel",
                    
                ]);
                DB::commit();
                return redirect()->back()->with('success', 'Ratificado com sucesso!');
            }
           DB::rollBack();
           return redirect()->back()->with('error', 'Erro ao Salvar o registro!');
        }
        DB::rollBack();
        return redirect()->back()->with('error', 'Erro ao Ratificar!');
    
        //Registro o Processo no Bango de dados e Salvamento do Arquivo Gerado no Banco de Dados 
    }



    /* Previsualizar um documento antes da Ratificação
     */

    public function preview(Request $request)
    {
    
        //Reconversao do Submit do ormularo armazenado no banco de dados
        $D = $request->Request;
        parse_str($D, $Request);
        //dd($Request['seccao']);
        $categoria = $Request['categoria'];
        //Verificar se nao [e uma requisicao para imprimir um documento como guia de colocacao de marcha ou um outro documanto solicitado via requerimento
        if (isset($request->imprimir)) {
            $categoria = $request->imprimir;
        }
        $funcionario = Funcionario::where('id', $Request['idFuncionarioSolicitante'])->first();
        $pessoa = Pessoa::where('id', $funcionario->idPessoa)->first();
        $cargo =  Cargo::where('id', $funcionario->idCargo)->first();
        $categoriaFuncionario = categoriaFuncionario::where('id', $funcionario->idCategoriaFuncionario)->first();
        $unidadeOrganica = UnidadeOrganica::where('id', $funcionario->idUnidadeOrganica)->first();
      
        $idProcesso = $request['idProcesso'];
        //Carregar a View
        $Documento = PDF::loadView("sgrhe/modelos/$categoria",compact('Request','pessoa','funcionario','cargo','categoriaFuncionario','unidadeOrganica','idProcesso'));      
        //Renderizar a View
        $Documento->render();
        //Nomear o Nome do Novo ficheiro PDF
        $fileName = 'file.pdf';
        //Retornar o Domunento Gerado 
       // return view("sgrhe/modelos/$categoria",compact('Request','pessoa','funcionario','cargo','categoriaFuncionario'));
        return response($Documento->output(), 200, ['Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline; filename="'.$fileName.'"']);

        //return $pdf->download('file.pdf');
       //$pdf->render();

       
        //Registro o Processo no Bango de dados e Salvamento do Arquivo Gerado no Banco de Dados 

       

    }




//Solicitar Processos Genericos 
    public function solicitar(Request $request)
    { 
        
        if (($request->categoria=="GozoFerias") && (isset($request->dataInicio))) {
            $request->validate([
                'dataInicio' => ['required', 'date', 'after_or_equal:today'],
            ],[
                //Menssagem personalizada 
                'dataInicio.after_or_equal' => 'Não é possivel solicitar férias antes do dia de Hoje',
    
            ]);
        }
        //dd('Solicitar');
        $request->validate([
            'categoria' => [
                Rule::unique('processos')->where( function($query) use ($request){
                    return $query->where('categoria', $request->categoria)
                    ->where('idFuncionarioSolicitante', $request->idFuncionarioSolicitante)
                    ->where('estado', 'Submetido');
                }), 
            ],
        ],[
            //Menssagem personalizada 
            'categoria' => 'Já tens uma solicitação da mesma natureza pendente, Cancele para submisão de uma nova ou aguarde o deferimento!',

        ]);
        $processo = Processo::create([
            // Recupera o id do funcionario logado pela sessao 
            'idFuncionario' => session()->only(['funcionario'])['funcionario']->id,
            'idFuncionarioSolicitante' => $request->input('idFuncionarioSolicitante'),
            'seccao' =>  $request->input('seccao'),
            'categoria' => $request->input('categoria'),
            'natureza' => $request->input('natureza'),
            'estado' => 'Submetido',
            //'deferimento' => $request->input('deferimento'),
            //Dados do Request Arasenados em string no campo Request
            'Request' => http_build_query($request->all()) //implode(', ', $request->all()),
            //Anexos, Dependencias Tipo Documentos e Outras Imformacoes para se efectivar um determinado processo 
         ]);
         DB::beginTransaction();
         if ($processo) {
            DB::commit();
            return redirect()->back()->with('success', 'Solicitacao aplicada com Sucesso!');     
         }
         DB::rollBack();
         return redirect()->back()->with('error', 'Erro de aplicação');   
    }




    public function gerarDocumento(Request $request, string $idFuncionarioSolicitante)
    {
        $funcionario = Funcionario::where('id', $idFuncionarioSolicitante)->first();
        $pessoa = Pessoa::where('id', $funcionario->idPessoa)->first();
        $cargo =  Cargo::where('id', $funcionario->idCargo)->first();
        $categoriaFuncionario = categoriaFuncionario::where('id', $funcionario->idCategoriaFuncionario)->first();
        $Request = $request->all();
        //dd($dados);
        $pdf = PDF::loadView("sgrhe/modelos/$request->categoria",compact('Request','pessoa','funcionario','cargo','categoriaFuncionario'));      
        //return $pdf->download('apenso.pdf');
        return view("sgrhe/modelos/$request->categoria",compact('Request','pessoa','funcionario','cargo','categoriaFuncionario'));
        //Registro o Processo no Bango de dados e Salvamento do Arquivo Gerado no Banco de Dados 
    }

    //Funcao geradora de Documento Universal via Request
    public function gerarDocFormRequest(Request $request)
    {
        
        $Request = $request->all();
        //dd($dados);
        $pdf = PDF::loadView("sgrhe/modelos/$request->categoria",compact('Request'));      
        //return $pdf->download('apenso.pdf');
        return view("sgrhe/modelos/$request->categoria",compact('Request','pessoa','funcionario','cargo','categoriaFuncionario'));
        //Registro o Processo no Bango de dados e Salvamento do Arquivo Gerado no Banco de Dados 
    }
        //Funcao geradora de Documento Universal via Request
    public function gerarDoc(string $Request)
    {
        dd($Request);
        //$pdf = PDF::loadView("sgrhe/modelos/$request->categoria",compact('Request'));      
        //return $pdf->download('apenso.pdf');
      //  return view("sgrhe/modelos/$request->categoria",compact('Request','pessoa','funcionario','cargo','categoriaFuncionario'));
        //Registro o Processo no Bango de dados e Salvamento do Arquivo Gerado no Banco de Dados 
    }





    public function cancelar(string $idProcesso)
    {
         $Pross = Processo::where('id', $idProcesso)->first();
         DB::beginTransaction();
         $Pross->estado = 'Cancelado';
         if ($Pross->save()) {
            DB::commit();
            return redirect()->back()->with('success', 'Solicitacao cancelada com Sucesso!');  
         }

    }

    //Listar os Processo de uma determinada Secao
    public function processosSeccao(string $seccao)
    {
        $idFuncionario = session()->only(['idFuncionario']);
        $processos = Processo::orderBy('created_at', 'desc')->where('seccao', $seccao)->get();
        $funcionario = Funcionario::where('id',$idFuncionario)->first();
        $pessoa = Pessoa::where('id',$funcionario->idPessoa)->first();
        $cargo = Cargo::where('id',$funcionario->idCargo)->first();
        $unidadeOrganica = UnidadeOrganica::where('id',$funcionario->idUnidadeOrganica)->first();
        $categoriaFuncionario = CategoriaFuncionario::where('id',$funcionario->idCategoriaFuncionario)->first();
        $arquivos = Arquivo::where('idFuncionario',$funcionario->id);
       // dd($processo);;
        return view('sgrhe/processos-seccao',compact('funcionario','pessoa','cargo','unidadeOrganica','categoriaFuncionario','arquivos','processos'));
 
    }
    
    
}
