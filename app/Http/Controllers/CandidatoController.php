<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\User;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{

    public static function verificacao(Request $request)
    {
        $cpf = $request->cpf;
        $dt_nasc = $request->dt_nasc;
        $candidato = Candidato::where([
            ['nu_cpf_inscrito', '=', $cpf],
            ['dt_nascimento', '=', $dt_nasc]]
        )->first();

        if ($candidato == null){
            return redirect('primeiroAcesso')
                ->withErrors( 'Dados Incorretos')
                ->withInput();
        }
        else{
            $user = User::where('id','=',$candidato->user_id)->first();
            if ($user->primeiro_acesso == true){
                return  view('candidato.acesso_edit', ['user' => $user]);
            }
            else{
                return redirect('primeiroAcesso')
                    ->withErrors( 'Login já cadastrado')
                    ->withInput();
            }

        }

    }

    public static function prepararAdicionar()
    {
        return view('candidato.verificacao');
    }

    public static function editarAcesso(User $user){

        return view('candidato.acesso_edit', ['user' => $user]);
    }
}