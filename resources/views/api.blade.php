@extends('layouts.page')

@section('content')
<h1>Dados importados</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">CPF</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  @foreach($api as $key => $value)
    <tr>
      <th scope="row">{{$value->id}}</th>
      <td>{{$value->nome}}</td>
      <td>{{$value->cpf}}</td>
      <td>{{$value->endereco}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection