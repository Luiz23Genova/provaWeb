<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colaborador;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ColaboradorMensagem;

class ColaboradorController extends Controller
{
  function listar() {
    $colaboradores = Colaborador::orderBy('nome')->get();
    return view('listagemColaborador',
                  compact('colaboradores'));
  }

  function novo() {
    $colaborador = new Colaborador();
    $colaborador->id = 0;
    return view('frmColaborador', compact('colaborador'));
  }

  function salvar(Request $request) {
    if ($request->input('id') == 0) {
      $colaborador = new Colaborador();
    } else {
      $colaborador = Colaborador::find($request->input('id'));
    }
    if ($request->hasFile('arquivo')) {
        $file = $request->file('arquivo');
        $upload = $file->store('public/imagens');
        $upload = explode("/", $upload);
        $tamanho = sizeof($upload);
        if ($colaborador->imagem != "") {
          Storage::delete("public/imagens/".$colaborador->imagem);
        }
        $colaborador->imagem = $upload[$tamanho-1];
    }


    $colaborador->nome = $request->input('nome');
    $colaborador->email = $request->input('email');
    $colaborador->save();
    return redirect('colaborador/listar');
  }

  function editar($id) {
    $colaborador = Colaborador::find($id);
    return view('frmColaborador', compact('colaborador'));
  }

  function excluir($id) {
    $colaborador = Colaborador::find($id);
    if ($colaborador->imagem != "") {
      Storage::delete("public/imagens/".$colaborador->imagem);
    }
    $colaborador->delete();
    return redirect('colaborador/listar');
  }

  function mensagem($id) {
    $colaborador = Colaborador::find($id) ;
    return view('frmMensagem', compact('colaborador'));

  }

  function enviarMensagem(Request $request) {
    $id = $request->input('id');
    $mensagem = $request->input('mensagem');
    $colaborador = Colaborador::find($id) ;
    Mail::to($colaborador->email)->send(new ColaboradorMensagem($colaborador, $mensagem));
    return redirect('colaborador/listar');
  }


}
