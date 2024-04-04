<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use App\Models\Assinatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;




class AssinaturaController extends Controller
{


    public function assinaturaUpdate(Request $request)
    {
         // Definir Validacoes de tamanho e formato da imagem da assinatura ...
         $verificar = $request->validate([
           
        ]);
        $arquivo = $request->file('arquivo');
        //Converter em Bin
        $arquivoBin = base64_encode(file_get_contents(($arquivo->getRealPath())));
        DB::beginTransaction();
        //Verificar se já existe uma assinatura
        $dados  = Assinatura::where('idFuncionario',$request->idFuncionario);    
        if ($dados->doesntExist()) {
            if($request->hasFile('arquivo')){
                $salvar = Assinatura::create([
                    'assinaturaDigital' => 'Assinatura codificada ou Chave Publica/Privada',
                    'assinatura' => $arquivoBin,
                    'idFuncionario' => $request->idFuncionario,
                ]);
                if ($salvar) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Actualizado com sucesso!');
                }else {
                DB::rollBack();
                return redirect()->back()->with('error', 'Erro ao actualizar!')->withErrors($verificar);
                }
            }else {
            DB::rollBack();
            return redirect()->back()->with('error', 'O ficheiro nao é compativel!')->withErrors($verificar);
        }
            return redirect()->back()->with('error', 'O ficheiro nao é compativel!')->withErrors($verificar);
    }
     //Se o Ficheiro ja existe;
     $dados->update([
        'assinaturaDigital' => 'Assinatura codificada ou Chave Publica/Privada',
        'assinatura' => $arquivoBin,
    ]);
    if($dados){
        DB::commit();
        return redirect()->back()->with('success', 'Actualizado com sucesso!');
    }
    DB::rollBack();
    return redirect()->back()->withErrors($verificar);//Aplicar Rediret with erro end success    
}




    public function uploadFile(Request $request)
    {
         // dd(request('numeroBI'));
         $verificar = $request->validate([
           
        ]);
        $arquivo = $request->file('arquivo');
        $nomeArquivo = 'file.'.$arquivo->extension();
        $caminho = 'sgrhe/funcionarios/'.$request->idFuncionario.'/'.$request->categoria.'/'.$nomeArquivo;
        // Armazenar o arquivo no subdiretório dentro da pasta 'local Especifico'
        //Procurar um outro metodo para o put que guarada com nme personalizado
        Storage::disk('local')->put($caminho, file_get_contents($arquivo));
        //Verificar a Existencia de um arquivo ja Registrado
        $arquivo = Arquivo::where('idFuncionario', $request->idFuncionario)->where('categoria', $request->categoria);
        $dados  = Assinatura::where('idFuncionario',$request->idFuncionario);        
        if ($arquivo->doesntExist()) {
        DB::beginTransaction();
        $arquivoToSave = Arquivo::create([
            'titulo' => md5($nomeArquivo.date('d-m-y')),
            'categoria' => $request->categoria,
            'descricao' => http_build_query($request->all()),
            'arquivo' => $nomeArquivo,
            'caminho' => $caminho,
            'idFuncionario' => $request->idFuncionario,
        ]);
        if ($arquivoToSave) {
        $idArquivo = Arquivo::where('idFuncionario',$request->idFuncionario)->where('categoria',$request->categoria)->first();
        //Salvar no Banco de Dados Especifico
        
        $salvar = Assinatura::create([
            'assinaturaDigital' => 'Assinatura codificada ou Chave Publica/Privada',
            'idArquivo' => $idArquivo->id,
            'idFuncionario' => $request->idFuncionario,
        ]);
        if ($salvar) {
            DB::commit();
            return redirect()->back()->with('success', 'Actualizado com sucesso!');
        }else {
           DB::rollBack();
           return redirect()->back()->with('error', 'Erro ao actualizar!')->withErrors($verificar);
        }
    }else {
        DB::rollBack();
        return redirect()->back()->with('error', 'Erro ao actualizar!')->withErrors($verificar);
    }
       
      }
        // Atualizar simbolicamente o conteudo da coluna 'caminho'
        $arquivo->update([
            'titulo' => md5($nomeArquivo.date('d-m-y')),
            'categoria' => $request->categoria,
            'descricao' => http_build_query($request->all()),
            'arquivo' => $nomeArquivo,
            'caminho' => $caminho,
            'idFuncionario' => $request->idFuncionario,
        ]);
        $dados->update([
            'assinaturaDigital' => 'Assinatura codificada ou Chave Publica/Privada',
            'idFuncionario' => $request->idFuncionario,
        ]);

        return redirect()->back()->with('success', 'Actualizado com sucesso!');
  
        return redirect()->back()->withErrors($verificar);//Aplicar Rediret with erro end success  
  }


    /**
     * Display a listing of the resource.
     */
    public function homologar()
    {
        //
        dd('Cheguei ate aqui');
    }
}
