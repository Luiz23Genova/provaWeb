@extends('templateIndex')

@section('conteudo')
  <main>
    <h1 style="font-size: 3rem;color: blue;display:flex;align-items: center;justify-content:space-between">{{$manutencaoAtual->categoria->descricao}}
      <img style="width: 25%;aspect-ratio: 2;object-fit: cover;" src="/storage/imagens/{{$manutencaoAtual->categoria->imagem}}">
    </h1>
    <h2 style="color: green;margin-top: 2rem;">{{$noticiaAtual->titulo}}</h2>
    <h3 style="font-size: 0.75rem;"><img style="width:50px;height:50px;object-fit:cover;border-radius:50%;" src="/storage/imagens/{{$manutencaoAtual->colaborador->imagem}}">{{$manutencaoAtual->colaborador->nome}} - {{$manutencaoAtual->data->format('d/m/Y')}}</h3>
    <img style="width:100%;height:10rem;object-fit:cover" src="/storage/imagens/{{$manutencaoAtual->imagem}}">
    <p style="margin-top: 2rem;">{{$manutencaoAtual->descricao}}</p>
  </main>
  <div class="">
    @foreach($manutencoesCategoria as $manutencao)
    <div style="display:flex;border-bottom:1px dotted gray; padding: 0.5rem;">
      <img style="width:25%; aspect-ratio: 2;object-fit:cover;" src="/storage/imagens/{{$manutencao->imagem}}">
      <div style="display: flex; flex-direction: column;
      align-items: center;justify-content: center;flex-grow: 1">
        <h1 style="font-size: 1rem;"><a href='{{url("index/manutencao/$manutencao->id")}}'>
          {{$manutencao->titulo}}</a></h1>
        <p style="font-size:0.75rem">{{$manutencao->colaboradors->nome}} - {{$manutencao->data->format('d/m/Y')}} </p>
      </div>
    </div>
    @endforeach
    {{$manutencoesCategoria->links()}}
  </div>
@endsection
