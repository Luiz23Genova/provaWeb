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

  <h1>Cadastro de Manutenções</h1>
  @if ($manutencao->imagem != "")
    <img style="width: 200px;height:200px;object-fit:cover" src="/storage/imagens/{{$manutencao->imagem}}">
  @endif


  <form action="{{url('manutencao/salvar')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="id" class="form-label">ID</label>
      <input readonly class="form-control" readonly type="text" name="id" value="{{$manutencao->id}}">
    </div>
    <div class="mb-3">
      <label for="id" class="form-label">Título</label>
      <input class="form-control @error('titulo') is-invalid @enderror" type="text" name="titulo" value="{{old('titulo', $manutencao->titulo)}}">
      @error('titulo')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="descricao" class="form-label">Descrição</label>
      <input class="form-control @error('descricao') is-invalid @enderror" type="text" name="descricao" value="{{old('descricao', $manutencao->descricao)}}">
      @error('descricao')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

    </div>
    <div class="mb-3">
      <label for="data" class="form-label">Data</label>
      <input class="form-control @error('data') is-invalid @enderror" type="date" name="data" value="{{old('data', $manutencao->data->format('Y-m-d'))}}">
      @error('data')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

    </div>
    <div class="mb-3">
      <label for="colaborador" class="form-label">colaborador</label>
      <select class="form-select @error('colaborador_id') is-invalid @enderror" name="colaborador_id">
        @foreach($colaboradores as $colaborador)
          <option {{ $colaborador->id == old('colaborador_id', $manutencao->colaborador_id) ?'selected': ''}} value="{{$colaborador->id}} ">{{$colaborador->nome}}</option>
        @endforeach
      </select>
      @error('colaborador_id')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

    </div>
    <div class="mb-3">
      <label for="categoria_id" class="form-label">Categoria</label>
      <select class="form-select @error('categoria_id') is-invalid @enderror" name="categoria_id">
        @foreach($categorias as $categoria)
          <option {{ $categoria->id == old('categoria_id', $manutencao->categoria_id) ?'selected': ''}} value="{{$categoria->id}} ">{{$categoria->descricao}}</option>
        @endforeach
      </select>
      @error('categoria_id')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

    </div>
    <div class="mb-3">
      <label for="arquivo" class="form-label">Figura</label>
      <input class="form-control" type="file" name="arquivo" accept="image/*">
    </div>

    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
  </form>
@endsection
