@extends('layouts.page')

@section('content')
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
  @foreach($clientes as $key => $value)
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