<?php

namespace App\Http\Controllers;

use App\Models\FormularioAproveitamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnidadeOrganicaDadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cadastrarFormulario(Request $request)
    {          // dd($request->all());
                // Regras de validação
                $request->validate([
                        'a11' => ['required'], 'a12' => ['required'],
                        'a21' => ['required'], 'a22' => ['required'],
                        'a31' => ['required'], 'a32' => ['required'],
                        'a41' => ['required'], 'a42' => ['required'],
                        'a51' => ['required'], 'a52' => ['required'],
                        'a61' => ['required'], 'a62' => ['required'],
                    ],[
                        'a11.required' => 'O Campos número de alunos MF para a 1ª classe é obrigatório!', 'a12.required' => 'O Campos número de alunos F para a 1ª classe é obrigatório!',
                        'a21.required' => 'O Campos número de alunos MF para a 2ª classe é obrigatório!', 'a22.required' => 'O Campos número de alunos F para a 2ª classe é obrigatório!',
                        'a31.required' => 'O Campos número de alunos MF para a 3ª classe é obrigatório!', 'a32.required' => 'O Campos número de alunos F para a 3ª classe é obrigatório!',
                        'a41.required' => 'O Campos número de alunos MF para a 4ª classe é obrigatório!', 'a42.required' => 'O Campos número de alunos F para a 4ª classe é obrigatório!',
                        'a51.required' => 'O Campos número de alunos MF para a 5ª classe é obrigatório!', 'a52.required' => 'O Campos número de alunos F para a 5ª classe é obrigatório!',
                        'a61.required' => 'O Campos número de alunos MF para a 6ª classe é obrigatório!', 'a62.required' => 'O Campos número de alunos F para a 6ª classe é obrigatório!',  
                    ] 
                );
                //Verificar se Já Foi Submetido um formulário Referente ao so Trimestre e anoLectivo
                $aproveitamento = FormularioAproveitamento::where('idUnidadeOrganica', $request->input('idUnidadeOrganica'))->where('anoLectivo', $request->input('anoLectivo'))->where('trimestre', $request->input('trimestre'))->first();
                if (!$aproveitamento) {
                   
                        $matriculadosIAMF = $request->input('a11') + $request->input('a21') + $request->input('a31') + $request->input('a41') + $request->input('a51') + $request->input('a61');
                        $matriculadosFAMF = $request->input('a13') + $request->input('a23') + $request->input('a33') + $request->input('a43') + $request->input('a53') + $request->input('a63');
                        $aprovadosMF = $request->input('a15') + $request->input('a25') + $request->input('a35') + $request->input('a45') + $request->input('a55') + $request->input('a65');
                        $reprovadosMF = $request->input('a17') + $request->input('a27') + $request->input('a37') + $request->input('a47') + $request->input('a57') + $request->input('a67');
                        $transferidosEMF = $request->input('a19') + $request->input('a29') + $request->input('a39') + $request->input('a49') + $request->input('a59') + $request->input('a69');
                        $transferidosSMF = $request->input('a111') + $request->input('a211') + $request->input('a311') + $request->input('a411') + $request->input('a511') + $request->input('a611');
                        $desistentesMF = $request->input('a113') + $request->input('a213') + $request->input('a313') + $request->input('a413') + $request->input('a513') + $request->input('a613');
                        $verificar = ($matriculadosIAMF + $transferidosEMF) - $aprovadosMF - $reprovadosMF - ($transferidosSMF + $desistentesMF);
                        if ($verificar === 0) {
                            $funcionario = FormularioAproveitamento::create([
                                'a11' => $request->input('a11'),    'a12' => $request->input('a12'),    'a13' => $request->input('a13'),    'a14' => $request->input('a14'),    'a15' => $request->input('a15'),    'a16' => $request->input('a16'),    'a17' => $request->input('a17'),    'a18' => $request->input('a18'),    'a19' => $request->input('a19'),    'a110' => $request->input('a110'),    'a111' => $request->input('a111'),    'a112' => $request->input('a112'),    'a113' => $request->input('a113'),    'a114' => $request->input('a114'),
                                'a21' => $request->input('a21'),    'a22' => $request->input('a22'),    'a23' => $request->input('a23'),    'a24' => $request->input('a24'),    'a25' => $request->input('a25'),    'a26' => $request->input('a26'),    'a27' => $request->input('a27'),    'a28' => $request->input('a28'),    'a29' => $request->input('a29'),    'a210' => $request->input('a210'),    'a211' => $request->input('a211'),    'a212' => $request->input('a212'),    'a213' => $request->input('a213'),    'a214' => $request->input('a214'),
                                'a31' => $request->input('a31'),    'a32' => $request->input('a32'),    'a33' => $request->input('a33'),    'a34' => $request->input('a34'),    'a35' => $request->input('a35'),    'a36' => $request->input('a36'),    'a37' => $request->input('a37'),    'a38' => $request->input('a38'),    'a39' => $request->input('a39'),    'a310' => $request->input('a310'),    'a311' => $request->input('a311'),    'a312' => $request->input('a312'),    'a313' => $request->input('a313'),    'a314' => $request->input('a314'),
                                'a41' => $request->input('a41'),    'a42' => $request->input('a42'),    'a43' => $request->input('a43'),    'a44' => $request->input('a44'),    'a45' => $request->input('a45'),    'a46' => $request->input('a46'),    'a47' => $request->input('a47'),    'a48' => $request->input('a48'),    'a49' => $request->input('a49'),    'a410' => $request->input('a410'),    'a411' => $request->input('a411'),    'a412' => $request->input('a412'),    'a413' => $request->input('a413'),    'a414' => $request->input('a414'),
                                'a51' => $request->input('a51'),    'a52' => $request->input('a52'),    'a53' => $request->input('a53'),    'a54' => $request->input('a54'),    'a55' => $request->input('a55'),    'a56' => $request->input('a56'),    'a57' => $request->input('a57'),    'a58' => $request->input('a58'),    'a59' => $request->input('a59'),    'a510' => $request->input('a510'),    'a511' => $request->input('a511'),    'a512' => $request->input('a512'),    'a513' => $request->input('a513'),    'a514' => $request->input('a514'),
                                'a61' => $request->input('a61'),    'a62' => $request->input('a62'),    'a63' => $request->input('a63'),    'a64' => $request->input('a64'),    'a65' => $request->input('a65'),    'a66' => $request->input('a66'),    'a67' => $request->input('a67'),    'a68' => $request->input('a68'),    'a69' => $request->input('a69'),    'a610' => $request->input('a610'),    'a611' => $request->input('a611'),    'a612' => $request->input('a612'),    'a613' => $request->input('a613'),    'a614' => $request->input('a614'),
                                'matriculadosIAMF' => $request->input('a11') + $request->input('a21') + $request->input('a31') + $request->input('a41') + $request->input('a51') + $request->input('a61'),
                                'matriculadosIAF' => $request->input('a12') + $request->input('a22') + $request->input('a32') + $request->input('a42') + $request->input('a52') + $request->input('a62'),
                                'matriculadosFAMF' => $request->input('a13') + $request->input('a23') + $request->input('a33') + $request->input('a43') + $request->input('a53') + $request->input('a63'),
                                'matriculadosFAF' => $request->input('a14') + $request->input('a24') + $request->input('a34') + $request->input('a44') + $request->input('a54') + $request->input('a64'),
                                'aprovadosMF' => $request->input('a15') + $request->input('a25') + $request->input('a35') + $request->input('a45') + $request->input('a55') + $request->input('a65'),
                                'aprovadosF' => $request->input('a16') + $request->input('a26') + $request->input('a36') + $request->input('a46') + $request->input('a56') + $request->input('a66'),
                                'reprovadosMF' => $request->input('a17') + $request->input('a27') + $request->input('a37') + $request->input('a47') + $request->input('a57') + $request->input('a67'),
                                'reprovadosF' => $request->input('a18') + $request->input('a28') + $request->input('a38') + $request->input('a48') + $request->input('a58') + $request->input('a68'),
                                'transferidosEMF' => $request->input('a19') + $request->input('a29') + $request->input('a39') + $request->input('a49') + $request->input('a59') + $request->input('a69'),
                                'transferidosEF' => $request->input('a110') + $request->input('a210') + $request->input('a310') + $request->input('a410') + $request->input('a510') + $request->input('a610'),
                                'transferidosSMF' => $request->input('a111') + $request->input('a211') + $request->input('a311') + $request->input('a411') + $request->input('a511') + $request->input('a611'),
                                'transferidosSF' => $request->input('a112') + $request->input('a212') + $request->input('a312') + $request->input('a412') + $request->input('a512') + $request->input('a612'),
                                'desistentesMF' => $request->input('a113') + $request->input('a213') + $request->input('a313') + $request->input('a413') + $request->input('a513') + $request->input('a613'),
                                'desistentesF' => $request->input('a114') + $request->input('a214') + $request->input('a314') + $request->input('a414') + $request->input('a514') + $request->input('a614'),
                                'idDirector' => $request->input('idDirector'),
                                'idUnidadeOrganica' => $request->input('idUnidadeOrganica'),
                                'anoLectivo' => $request->input('anoLectivo'),
                                'trimestre' => $request->input('trimestre'), 
                            ]);
                          //  dd($request->all());
                            DB::beginTransaction();
                            if ($funcionario) {
                                DB::commit();
                                return redirect()->route('dashboard.unidade.organica.how', ['idUnidadeOrganica' => $request->input('idUnidadeOrganica')])->with('success', 'Formulário de aproveitamento do '.$request->input('trimestre').' trimenstre do ano lectivo '.$request->input('anoLectivo').' submetido com sucesso!');
                            }else{
                                DB::rollBack();
                                return back()->with('error', 'Inconsitência nos dados !')->withInput();
                            }
                        }else{
                            DB::rollBack();
                            return back()->with('error', 'Inconsitência nos dados !')->withInput();
                        }
                    }   
                    return back()->with('error', ' Formulário de Aproveitamento já foi submetido!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
