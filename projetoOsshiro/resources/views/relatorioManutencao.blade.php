<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title></title>
    <style>
      * {
        font-family: arial, sans-serif;
      }
      h1 {
        font-size: 3rem;
        text-align: center;
      }
      table {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
      }
      th, td {
        border: solid 1px gray;
        padding: 0.5rem;
        font-size: 1.5rem;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <h1>Relatório de Manutenções</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Descrição</th>
          <th>Imagem</th>
        </tr>
      </thead>
      <tbody>
        @foreach($manutencaos as $manutencao)
          <tr>
            <td>{{$manutencao->id}}</td>
            <td>{{$manutencao->descricao}}</td>
            <td>
              @if ($manutencao->imagem != "")
                <img style="width: 50px;" src="/storage/imagens/{{$manutencao->imagem}}">
              @endif            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
