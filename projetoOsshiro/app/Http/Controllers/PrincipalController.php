<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Manutencao;


class PrincipalController extends Controller
{
    function index() {
      $categorias = Categoria::orderBy('descricao')->get();

      $ultimasManutencaos = Manutencao::orderBy('data', 'desc')->limit(5)->get();

      return view('index', compact('categorias', 'ultimasManutencaos'));
    }

    function manutencao($id) {
      $manutencaoAtual = Manutencao::find($id);
      $categorias = Categoria::orderBy('descricao')->get();
      $manutencaosCategoria = Noticia::where('categoria_id',
        $manutencaoAtual->categoria->id)->orderBy('data', 'desc')->paginate(5);
      return view('manutencao', compact('manutencaoAtual', 'categorias', 'manutencaosCategoria'));
    }

    function categoria($id) {
      $categorias = Categoria::orderBy('descricao')->get();
      $manutencaosCategoria = Manutencao::where('categoria_id',
        $id)->orderBy('data', 'desc')->paginate(5);
      $manutencaoAtual = $manutencaosCategoria
      ->shift();
      return view('manutencao', compact('manutencaoAtual', 'categorias', 'manutencaosCategoria'));
    }
}
