@extends('template')

@section('conteudo')
  <h1>Listagem de Colaboradores</h1>
  <a href="novo" class="btn btn-primary">Novo</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Figura</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th></th>
        <th></th>

      </tr>
    </thead>
    <tbody>
      @foreach($colaboradores as $colaborador)
          <tr>
            <td>{{$colaborador->id}}</td>
            <td>
              @if ($colaborador->imagem != "")

              <img style="width: 50px;" src="/storage/imagens/{{$colaborador->imagem}}">
              @endif            </td>
            <td>{{$colaborador->nome}}</td>
            <td>{{$colaborador->email}}</td>
            <td><a class='btn btn-primary' href='editar/{{$colaborador->id}}'>+</a></td>
            <td><a class='btn btn-danger' href='excluir/{{$colaborador->id}}'>-</a></td>

          </tr>
      @endforeach

   </tbody>
  </table>
@endsection
