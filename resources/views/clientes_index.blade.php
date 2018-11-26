@extends('layouts.page')

@section('content')

@if(session()->has('msg'))
<div class="alert alert-success" role="alert">
  <p><b>CODE: D102 </b> - Dados dos clientes atualizados com sucesso.</p>
</div>
<hr>
@endif


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
      <td>{{$value->debito}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$clientes->links()}}

@endsection