<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Arquivo;
use App\Models\AvaliacaoDesempenhoFuncionario;
use App\Models\BI;
use App\Models\Cargo;
use App\Models\categoriaFuncionario;
use App\Models\Funcionario;
use App\Models\Habilitacao;
use App\Models\Pessoa;
use App\Models\Processo;
use App\Models\UnidadeOrganica;
use Barryvdh\DomPDF\Facade\Pdf;
use Faker\Core\File;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Validate;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Component\Mailer\Transport\Dsn;

//Biblioteca para Manipular imagens 

class ArquivoController extends Controller
{

    public function homologar(Request $request)
    {
        dd($request->all());
        $idFuncionario = $request['idFuncionario'];
        $categoria = $request['categoria'];
        $arquivo = $request->file('arquivo');
        $nomeArquivo = 'arquivoHabilitacao.'.$arquivo->extension();
        $caminho = 'sgrhe/funcionarios/'.$idFuncionario.'/'.$categoria.'/'.$nomeArquivo;
        // Armazenar o arquivo no subdiretório dentro da pasta 'local Especifico'
        //Procurar um outro metodo para o put que guarada com nme personalizado
        Storage::disk('local')->put($caminho, file_get_contents($arquivo));
        $arquivo = Arquivo::where('idFuncionario',$idFuncionario)->where('categoria',$categoria);
        $habilitacao  = Habilitacao::where('idFuncionario',$idFuncionario);
        if ($arquivo->doesntExist()) {
      // dd($arquivo->first());
        Arquivo::create([
            'titulo' => md5($nomeArquivo.date('d-m-y')),
            'categoria' => $categoria,
            'descricao' => 'N/D',
            'arquivo' => $nomeArquivo,
            'caminho' => $caminho,
            'idFuncionario' => $idFuncionario,
        ]);
        $idArquivo = Arquivo::where('idFuncionario',$idFuncionario)->where('categoria',$categoria)->first();
        //dd($idArquivo);
        Habilitacao::create([
            'nivel' => $request->input('nivel'),
            'curso' => $request->input('curso'),
            'instituicao' => $request->input('instituicao'),
            'notaFinal'=> $request->input('notaFinal'),
            'anoConclusao' => $request->input('anoConclusao'),
            'status' => $request->input('status'),
            'idFuncionario' => $idFuncionario,
            'idArquivo' => $idArquivo->id 
        ]);
        return redirect()->back()->with('success', 'Actualizado com sucesso!');
      }
        // Atualizar simbolicamente o conteudo da coluna 'caminho'
        $arquivo->update([
            'titulo' => md5($nomeArquivo.date('d-m-y')),
            'categoria' => $categoria,
            'descricao' => 'N/D',
            'arquivo' => $nomeArquivo,
            'caminho' => $caminho,
            'idFuncionario' => $idFuncionario,
        ]);
        $habilitacao->update([
            'nivel' => $request->input('nivel'),
            'curso' => $request->input('curso'),
            'instituicao' => $request->input('instituicao'),
            'notaFinal'=> $request->input('notaFinal'),
            'anoConclusao' => $request->input('anoConclusao'),
            'status' => $request->input('status'),
            'idFuncionario' => $idFuncionario,
        ]);
        return redirect()->back()->with('success', 'Actualizado com sucesso!');
  
    return redirect()->back()->with('error', 'Erros ao Actualizar!');//Aplicar Rediret with erro end success  
    }
  


  
  public function fotoPerfilActualizar(Request $request)
    {  
//Não precisa de validacao pois já foi tratado previamente pelo js no Coped IMG
      $imageData = $request->input('croppedImage');
      //Converter do formato base64 para o formato binario se for imagem
      if ($imageData) {
          $binaryImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
          $fileName = 'user.png';
          $caminho = 'sgrhe/funcionarios/'.$request->input('idFuncionario').'/'.$request->input('categoria').'/'.$fileName;
          // Armazenar o arquivo no subdiretório dentro da pasta 'local Especifico'
          Storage::disk('local')->put($caminho, $binaryImage);
          $fotodeperfil = Arquivo::where('idFuncionario',$request->input('idFuncionario'))->where('categoria','FotoPerfil');
          if ($fotodeperfil->doesntExist()) {
          $arquivo = Arquivo::create([
              'titulo' => md5($fileName.date('d-m-y')),
              'categoria' => $request->input('categoria'),
              'descricao' => 'Data'.date('d-m-y').'Categoria:'.$request->input('categoria').'-'.'Arquivo:'.$fileName.'-'.'Usuario:'.''.''.'',
              'arquivo' => $fileName,
              'caminho' => $caminho,
              'idFuncionario' => $request->input('idFuncionario'),
          ]);
          DB::beginTransaction();
          if ($arquivo) {
            DB::commit();
            return redirect()->back()->with('success', 'Parabens, foto perfil actuaizado com sucesso!');
          }else {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao actualizar foto de perfil!');
          }
        }
          // Atualizar simbolicamente o conteudo da coluna 'caminho'
          $fotodeperfil->update(['caminho' => $caminho]);
          return redirect()->back()->with('success', 'Foto de perfil actuaizado com sucesso!');
      }   
      return redirect()->back()->with('error', 'Erro ao actualizar foto de perfil!');//Aplicar Rediret with erro end success  
  }
  





         /* Remove the specified resource from storage.
     */
    public function storeBI(Request $request, string $idFuncionario, string $categoria, string $idPessoa)
    {
           // dd($request->all());
            $verificar = $request->validate([
                'numeroBI' => 'required','unique:funcionarios,numeroBI,except,$dFuncionario',
                'validadeBI' => 'required',
                'arquivo' => 'required|file|mimes:png,jpg,pdf|max:2048',
                'confirmar' => 'required|accepted',
            ]);

            $arquivo = $request->file('arquivo');
            $nomeArquivo = 'arquivoBI.'.$arquivo->extension();
            $caminho = 'sgrhe/funcionarios/'.$idFuncionario.'/'.$categoria.'/'.$nomeArquivo;
            // Armazenar o arquivo no subdiretório dentro da pasta 'local Especifico'
            //Procurar um outro metodo para o put que guarada com nme personalizado
            Storage::disk('local')->put($caminho, file_get_contents($arquivo));
            $arquivo = Arquivo::where('idFuncionario',$idFuncionario)->where('categoria',$categoria);
            $b_i_s  = BI::where('idFuncionario',$idFuncionario);
            if ($arquivo->doesntExist()) {
            DB::beginTransaction();
            $arquivoToSave = Arquivo::create([
                'titulo' => md5($nomeArquivo.date('d-m-y')),
                'categoria' => $categoria,
                'descricao' => 'Número de BI: '.request('numeroBI').'Valido até :'.request('validadeBI'),
                'arquivo' => $nomeArquivo,
                'caminho' => $caminho,
                'idFuncionario' => $idFuncionario,
            ]);
            if ($arquivoToSave) {
            $idArquivo = Arquivo::where('idFuncionario',$idFuncionario)->where('categoria',$categoria)->first();
            $biToSave = BI::create([
                'numeroBI' => $request->input('numeroBI'),
                'dataValidade' =>  $request->input('validadeBI'),
                'idArquivo' => $idArquivo->id,
                'idFuncionario' => $idFuncionario,
            ]);
            if ($biToSave) {
                //Actualizar numero do Bilhete na Entidade Pessoa
                $Pessoa = Pessoa::where('id', $idPessoa)->first();
                $Pessoa->numeroBI = $request->numeroBI;
                $Pessoa->save();
                DB::commit();
                return redirect()->back()->with('success', 'BI Actualizado com sucesso!');
            }else {
               DB::rollBack();
               return redirect()->back()->with('error', 'Erro ao actualizar BI!')->withErrors($verificar);
            }
        }else {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao actualizar o BI!')->withErrors($verificar);
        }
           
          }
             //Actualizar numero do Bilhete na Entidade Pessoa
             $Pessoa = Pessoa::where('id', $idPessoa)->first();
             $Pessoa->numeroBI = $request->numeroBI;
             $Pessoa->save();
            // Atualizar simbolicamente o conteudo da coluna 'caminho'
            $arquivo->update([
                'titulo' => md5($nomeArquivo.date('d-m-y')),
                'categoria' => $categoria,
                'descricao' => 'Número de BI: '.request('numeroBI').'Valido até :'.request('validadeBI'),
                'arquivo' => $nomeArquivo,
                'caminho' => $caminho,
                'idFuncionario' => $idFuncionario,
            ]);
            $b_i_s->update([
                'numeroBI' => $request->input('numeroBI'),
                'dataValidade' =>  $request->input('validadeBI'),
                'idFuncionario' => $idFuncionario,
            ]);

            return redirect()->back()->with('success', 'BI Actualizado com sucesso!');
      
            return redirect()->back()->withErrors($verificar);//Aplicar Rediret with erro end success  
    }





    //Store Halilitacao




    public function storehabilitacao(Request $request, string $idFuncionario, string $categoria)
    {
       // dd(request('numeroBI'));
            // Define the validation rules
            $verificar = $request->validate([
                'nivel' => 'required',
                'curso' => 'required',
                'instituicao' => 'required',
                'notaFinal' => 'nullable',
                'anoConclusao' => 'nullable',
                'status' => 'required',
                'idFuncionario' => 'nullable',
                'arquivo' => 'required|file|mimes:pdf|max:2048',
            ]);

            $arquivo = $request->file('arquivo');
            $nomeArquivo = 'arquivoHabilitacao.'.$arquivo->extension();
            $caminho = 'sgrhe/funcionarios/'.$idFuncionario.'/'.$categoria.'/'.$nomeArquivo;
            // Armazenar o arquivo no subdiretório dentro da pasta 'local Especifico'
            //Procurar um outro metodo para o put que guarada com nme personalizado
            Storage::disk('local')->put($caminho, file_get_contents($arquivo));
            $arquivo = Arquivo::where('idFuncionario',$idFuncionario)->where('categoria',$categoria);
            $habilitacao  = Habilitacao::where('idFuncionario',$idFuncionario);
            if ($arquivo->doesntExist()) {
          // dd($arquivo->first());
            Arquivo::create([
                'titulo' => md5($nomeArquivo.date('d-m-y')),
                'categoria' => $categoria,
                'descricao' => 'N/D',
                'arquivo' => $nomeArquivo,
                'caminho' => $caminho,
                'idFuncionario' => $idFuncionario,
            ]);
            $idArquivo = Arquivo::where('idFuncionario',$idFuncionario)->where('categoria',$categoria)->first();
            //dd($idArquivo);
            Habilitacao::create([
                'nivel' => $request->input('nivel'),
                'curso' => $request->input('curso'),
                'instituicao' => $request->input('instituicao'),
                'notaFinal'=> $request->input('notaFinal'),
                'anoConclusao' => $request->input('anoConclusao'),
                'status' => $request->input('status'),
                'idFuncionario' => $idFuncionario,
                'idArquivo' => $idArquivo->id 
            ]);
            return redirect()->back()->with('success', 'Actualizado com sucesso!');
          }
            // Atualizar simbolicamente o conteudo da coluna 'caminho'
            $arquivo->update([
                'titulo' => md5($nomeArquivo.date('d-m-y')),
                'categoria' => $categoria,
                'descricao' => 'N/D',
                'arquivo' => $nomeArquivo,
                'caminho' => $caminho,
                'idFuncionario' => $idFuncionario,
            ]);
            $habilitacao->update([
                'nivel' => $request->input('nivel'),
                'curso' => $request->input('curso'),
                'instituicao' => $request->input('instituicao'),
                'notaFinal'=> $request->input('notaFinal'),
                'anoConclusao' => $request->input('anoConclusao'),
                'status' => $request->input('status'),
                'idFuncionario' => $idFuncionario,
            ]);
            return redirect()->back()->with('success', 'Actualizado com sucesso!');
      
        return redirect()->back()->withErrors($verificar);//Aplicar Rediret with erro end success  
    }






     /* Exibir e Renderizar Qualquer Umagem
     */
    public function exibirImagem($imagem)
    { 
        $arquivo = Storage::disk('local')->get(base64_decode($imagem));
        $mimetype =Storage::mimeType($imagem);
        return response()->make($arquivo,200,['Content-Type' => $mimetype]);   
    }

    /*  Exibir e Renderizar e baixar Qualquer Documento pdf, jpg e npg pelo id do Documento
     */
    public function exibirDocumento(Request $request)
    { 
        $documento = Arquivo::find($request->id)->caminho;
        $arquivo = Storage::disk('local')->get($documento);
        $mimetype =Storage::mimeType($documento);
        return response()->make($arquivo,200,['Content-Type' => $mimetype]);
    }

         /*  Exibir e Renderizar Qualquer Documento pdf, jpg e npg
     */
    public function exibirArquivo($imagem)
    { 
        $arquivo = Storage::disk('local')->get(base64_decode($imagem));
        $mimetype =Storage::mimeType($imagem);
        return response()->make($arquivo,200,['Content-Type' => $mimetype]);   
    }

         //Logo SGRHE
    public function logo()
    {
        $imagem ="img/logo.png";
        $arquivo = Storage::disk('public')->get($imagem);
        $mimetype = Storage::mimeType($imagem);
        return response()->make($arquivo,200,['Content-Type' => $mimetype]); 
      
    }

           //User Avatar SGRHE
    public function avatarUsuario()
    {
        $imagem ="img/avatar.png";
        $arquivo = Storage::disk('public')->get($imagem);
        $mimetype = Storage::mimeType($imagem);
        return response()->make($arquivo,200,['Content-Type' => $mimetype]); 
    }


    public function uploadFile( Request $request)
    {
        $processo = AvaliacaoDesempenhoFuncionario::find($request->idProcesso);
        //dd($processo);
        $arquivo = $request->file('arquivo');
        $nome = '-Documento';
        $categoria = $request->categoria;
        $idFuncionario = $processo->idFuncionario;
        $nomeArquivo = date('dmYHis').$nome.'.'.$arquivo->extension();
        $caminho = 'sgrhe/funcionarios/'.$idFuncionario.'/'.$categoria.'/'.$nomeArquivo;
       // dd($caminho);
        // Armazenar o arquivo no subdiretório dentro da pasta 'local Especifico'
        //Procurar um outro metodo para o put que guarada com nme personalizado
        Storage::disk('local')->put($caminho, file_get_contents($arquivo));
        if ($request->idArquivo==null) {
            $arquivo = Arquivo::find($request->idArquivo);
            DB::beginTransaction();
            $Arquivo = Arquivo::create([
                'titulo' =>$nomeArquivo,
                'categoria' => $categoria,
                'descricao' => $processo->Request,
                'arquivo' => $nomeArquivo,
                'caminho' => $caminho,
                'idFuncionario' => $idFuncionario,
            ]);
        if ($Arquivo) {
            //Alterando o Estado da Origem da avaliacao e o e identificador do ficheiro da Avaliacao do Funcionario
            $processo->estado = 'Homologado';
            $processo->idArquivo = $Arquivo->id; //Inserindo o id do Registro arquivo recem criado
            $processo->save();
            DB::commit();
            return redirect()->route('index.avaliacao.funcionario')->with('success', 'O ficheiro foi salvo com sucesso!');
        }else{
            DB::rollBack();
            return redirect()->route('index.avaliacao.funcionario')->with('error', 'Erro ao salvar o documento');
        }
    }
    return redirect()->route('index.avaliacao.funcionario')->with('error', 'O documento já existe');
}



public function dowloadFile( Request $request)
{  
    $caminho = Arquivo::find($request->id);
    $arquivo = Storage::disk('local')->get(base64_decode($caminho));
    $mimetype =Storage::mimeType($caminho);
    return response()->make($arquivo,200,['Content-Type' => $mimetype]);
}
    
}