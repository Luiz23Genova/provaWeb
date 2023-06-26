<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manutencao;
use App\Models\Categoria;
use App\Models\Colaborador;
use App\Http\Requests\ManutencaoRequest;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ManutencaoController extends Controller
{
  function listar() {
    $manutencaos = Manutencao::orderByRaw('data, id')->paginate(5);
    return view('listagemManutencao',
                compact('manutencaos'));
   }

   function novo() {
     $manutencao = new Manutencao();
     $manutencao->id = 0;
     $manutencao->data = now();
     $categorias = Categoria::orderBy('descricao')->get();
     $colaboradores = Colaborador::orderBy('nome')->get();
     return view('frmManutencao', compact('manutencao', 'categorias', 'colaboradores'));
   }

   function salvar(ManutencaoRequest $request) {

     if ($request->input('id') == 0) {
       $manutencao = new Manutencao();
     } else {
       $manutencao = Manutencao::find($request->input('id'));
     }
     if ($request->hasFile('arquivo')) {
         $file = $request->file('arquivo');
         $upload = $file->store('public/imagens');
         $upload = explode("/", $upload);
         $tamanho = sizeof($upload);
         if ($manutencao->imagem != "") {
           Storage::delete("public/imagens/".$manutencao->imagem);
         }
         $manutencao->imagem = $upload[$tamanho-1];
     }

     $manutencao->titulo = $request->input('titulo');
     $manutencao->descricao = $request->input('descricao');
     $manutencao->colaborador_id = $request->input('colaborador_id');
     $manutencao->data = $request->input('data');
     $manutencao->categoria_id = $request->input('categoria_id');
     $manutencao->save();
     return redirect('manutencao/listar')
     ->with(['msg' => "Registro '$manutencao->titulo' foi salvo"]);
   }



   function salvarOld(Request $request) {
     $validated = $request->validate([
             'titulo' => 'required',
             'texto' => 'required',
             'data' => 'required',
             'colaborador_id' => 'required|exists:colaborador,id',
             'categoria_id' => 'required|exists:categoria,id'
         ]);

     if ($request->input('id') == 0) {
       $manutencao = new Manutencao();
     } else {
       $manutencao = Manutencao::find($request->input('id'));
     }
     $manutencao->titulo = $request->input('titulo');
     $manutencao->descricao = $request->input('descricao');
     $manutencao->colaborador_id = $request->input('colaborador_id');
     $manutencao->data = $request->input('data');
     $manutencao->categoria_id = $request->input('categoria_id');
     $manutencao->save();
     return redirect('manutencao/listar');
   }

   function editar($id) {
     $manutencao = Manutencao::find($id);
     $categorias = Categoria::orderBy('descricao')->get();
     $colaboradores = Colaborador::orderBy('nome')->get();
     return view('frmManutencao', compact('manutencao', 'categorias', 'colaboradores'));
   }

   function excluir($id) {
     $manutencao = Manutencao::find($id);
     $titulo = $manutencao->titulo;
     if ($manutencao->imagem != "") {
       Storage::delete("public/imagens/".$manutencao->imagem);
     }

     $manutencao->delete();

     return redirect('manutencao/listar')
        ->with(['msg' => "Registro $titulo foi excluído"]);
   }
   function relatorio() {
     $manutencaos = Manutencao::orderBy('titulo')->get();
     $pdf = Pdf::loadView('relatorioManutencao', compact('manutencaos'));
     return $pdf->download('manutencaos.pdf');
   }


}
