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
      <td>{{$value->debito}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$clientes->links()}}
<br>
@if(session()->has('msg'))
<div
  id="st"
  class="alert alert-sucess">
  <p>{{session('msg')}}</p>
</div>
@endif
@endsection