<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\FormularioRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContatoEmail;

class SiteController extends Controller
{
    // Página do primeiro formulário
    public function index()
    {
        return view("site.form");
    }

    // Envio do formulário
    public function enviar(FormularioRequest $request)
    {
        $dados = $request->validated();
        $imagem = null;
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $imagem = $request->file('imagem');
        }

        $email = new ContatoEmail($dados, $imagem);

        try {
            Mail::to('testesemail56@gmail.com')->send($email);
            return redirect()->back()->with("sucesso", "A mensagem foi enviada com sucesso!");
        } catch (\Exception $e) {
            Log::error('Erro ao enviar e-mail de contato: ' . $e->getMessage());

            return redirect()->back()->with("erro", "Não foi possível enviar a mensagem. Tente novamente mais tarde.");
        }
    }

    // Página do formulário via AJAX
    public function indexAjax()
    {
        return view("site.form-ajax");
    }

    // Envio do formulário via AJAX
    public function enviarAjax(FormularioRequest $request)
    {
        try {
            $dados = $request->validated();
            $imagem = null;
            if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
                $imagem = $request->file('imagem');
            }
            $email = new ContatoEmail($dados, $imagem);

            Mail::to('testesemail56@gmail.com')->send($email);

            return response()->json(['mensagem' => 'Mensagem enviada com sucesso!']);
        } catch (\Exception $e) {
            Log::error('Erro ao enviar e-mail de contato: ' . $e->getMessage());

            return response()->json([
                'mensagem' => 'Não foi possível enviar a mensagem. Tente novamente mais tarde.'
            ], 500);
        }
    }
}
