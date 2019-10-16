<!DOCTYPE html>
<html lang="en">
<head>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>registros</title>
    <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
          border: 1px solid black;
        }
        
        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 2px;
          font-size: 15px;
          text-align: center;
        }

        p{
          font-family: arial;
          margin: 0;
        }

        #imgs{
          margin-left: 18%;
          justify-content: center;

        }

        .img1{
          width: 70px;
          height: auto;
        }

        #teste{
          background-color: #dddddd;
        }

        #titulo{
          text-align: center;
          margin-top: 2%;
          margin-bottom: 2%;
          font-weight: bold;
        }

        #texto{
          text-align: center;
          margin-top: 2%;
          margin-bottom: 2%;
          font-size: 15px;
          color: grey;
        }

        #tipoRelatorio{
          text-align: center;
          margin-top: 2%;
          margin-bottom: 2%;
          font-size: 15px;
        }
    </style>
</head>
<body>
<div id="imagens">
  <img src="{{ asset('img/logoifce.png') }}" style="width: 170px; height: auto;" id="imgs">
  <img src="{{ asset('img/brasão-1024x1011.jpg') }}" class="img1" id="imgs">
  <img src="{{ asset('img/20anos.png') }}" class="img1" id="imgs">
</div>
<div id="titulo">
  <p>MINISTÉRIO DE EDUACAÇÃO</p>
  <p>SECRETARIA DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA</p>
  <p>INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO CEARÁ</p>
  <p>IFCE CAMPUS MARACANAÚ</p>
</div>
<div id="texto">
  <p>Av. Contorno Norte, 10, Distrito Industrial - Maracanaú/CE - CEP: 61.925-315</p>
  <p>Fone: (85) 3878-6300 / (85) 3878-6314</p>
</div>
<div id="tipoRelatorio">
  <p style="margin-bottom: 0.5%;font-weight: bold;">RELATÓRIO DE TRÂSITO</p>
  <p>PERÍODO CONSULTADO: 00/00/2019 até 00/00/2019, ENTRE AS 00:00:00 E 16:00:00</p>
</div>
<table>
  <tr id="teste">
    <th>Condutor</th>
    <th>Identificação</th>
    <th>Veículo</th>
    <th>Placa</th>
    <th>Entrada/Saída</th>
    <th>Data de Trânsito</th>
  </tr>
  @forelse ($registro as $item)
  <tr>
    <td>{{$item->transitosTipo}}</td>
    {{-- <td>{{$item->identificacao}}</td>
    <td>{{$item->modelo}} {{$item->ano}}</td>
    <td>{{$item->placa}}</td>
    <td>{{$item->transitosTipo}}</td>
    <td>{{$item->transitosData}}</td> --}}
  </tr>
  @empty
    <td>Nenhum registro encontrado</td>
  @endforelse
</table>
</body>
</html>
