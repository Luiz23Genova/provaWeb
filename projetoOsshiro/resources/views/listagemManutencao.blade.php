@extends('template')

@section('conteudo')
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif



  <h1>Listagem de Manutenções</h1>
  <a href="novo" class="btn btn-primary">Novo</a>
  <a href="relatorio" class="btn btn-primary">Relatório</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Figura</th>
        <th>Titulo</th>
        <th>descricao</th>
        <th>Colaborador</th>
        <th>Data</th>
        <th>Categoria</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>

      @foreach($manutencaos as $manutencao)

          <tr>
            <td>{{$manutencao->id}}</td>
            <td>
              @if ($manutencao->imagem != "")
                <img style="width: 50px;" src="/storage/imagens/{{$manutencao->imagem}}">
              @endif            </td>
            <td>{{$manutencao->titulo}}</td>
            <td>{{$manutencao->descricao}}</td>
            <td>{{$manutencao->colaborador->nome}}</td>
            <td>{{$manutencao->data}}</td>
            <td>{{$manutencao->categoria->descricao}}</td>
            <td><a class='btn btn-primary' href='editar/{{$manutencao->id}}'>+</a></td>
            <td><a class='btn btn-danger' href='excluir/{{$manutencao->id}}'>-</a></td>
          </tr>
      @endforeach

   </tbody>
  </table>
  {{ $manutencaos->links() }}
@endsection
