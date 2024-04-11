<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use App\Models\Documento;
use App\Models\Funcionario;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /*
    Criador de registro de Documentos Universal
     
     */
    public function inserirDocumento(Request $request)
    {
       // dd($request->all());
        $idFuncionario = $request->idFuncionario;
        $nome = Pessoa::find(Funcionario::find($idFuncionario)->idPessoa)->first()->nomeCompleto;
        $categoria = $request->categoria;
        $verificar = $request->validate([
            //Form Request Pesquisar e implementar
        ]);

        $arquivo = $request->file('arquivo');
        $nomeArquivo = $categoria.'-'.$nome.'.'.$arquivo->extension();
        $caminho = 'sgrhe/funcionarios/'.$idFuncionario.'/'.$categoria.'/'.$nomeArquivo;
        // Armazenar o arquivo no subdiretório dentro da pasta 'local Especifico'
        //Procurar um outro metodo para o put que guarada com nme personalizado
        Storage::disk('local')->put($caminho, file_get_contents($arquivo));
        $arquivo = Arquivo::where('idFuncionario',$idFuncionario)->where('categoria',$categoria);
        $documento  = Documento::where('idFuncionario',$idFuncionario)->where('categoria',$categoria);
        if ($arquivo->doesntExist()) {
        DB::beginTransaction();
        // dd($arquivo->first());
        $Arquivo = Arquivo::create([
            'titulo' => md5($nomeArquivo.date('d-m-y')),
            'categoria' => $categoria,
            'descricao' => 'N/D',
            'arquivo' => $nomeArquivo,
            'caminho' => $caminho,
            'idFuncionario' => $idFuncionario,
        ]);
        if ($Arquivo) {
            $idArquivo = Arquivo::where('idFuncionario',$idFuncionario)->where('categoria',$categoria)->first()->id;
            //dd($idArquivo);
            $Documento = Documento::create([
                'idFuncionario' => $request->idFuncionario,
                'funcionario' => $request->funcionario,
                'Request' => http_build_query($request->all()),
                'idArquivo' => $idArquivo,
                'funcionario' => session('idFuncionario'),
                'categoria' => $categoria,
                
            ]);
            if ($Documento) {
                DB::commit();
                return redirect()->back()->with('success', 'Actualizado com sucesso!');
            }else {
                DB::rollBack();
                return redirect()->back()->with('error', 'Erro na Actualização!');
            }
        }else {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro na Actualização!');
        }  
        }else {
                // Atualizar simbolicamente o conteudo da coluna 'caminho'
                $arquivo->update([
                    'titulo' => md5($nomeArquivo.date('d-m-y')),
                    'categoria' => $categoria,
                    'descricao' => 'N/D',
                    'arquivo' => $nomeArquivo,
                    'caminho' => $caminho,
                    'idFuncionario' => $idFuncionario,
                ]);
                $documento->update([
                    'idFuncionario' => $request->idFuncionario,
                    'funcionario' => $request->funcionario,
                    'Request' => http_build_query($request->all()),
                    'funcionario' => session('idFuncionario'),
                    'categoria' => $categoria,
                
                ]);
                return redirect()->back()->with('success', 'Actualizado com sucesso!');
        
            return redirect()->back()->withErrors($verificar);//Aplicar Rediret with erro end success  
            }
      
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function exibirDocumento($documento)
    { 
        $arquivo = Storage::disk('local')->get(base64_decode($documento));
        $mimetype =Storage::mimeType($documento);
        return response()->make($arquivo,200,['Content-Type' => $mimetype]);   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
