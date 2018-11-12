@extends('layouts.page')

@section('content')
    <form action="{{url('/Cliente/test')}}" method="post">
        <div class="input-group">
        {{csrf_field()}}
            <div class="col-lg-6">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Enviar!</button>
            </span></div>
       
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
      <th scope="row"><input type="radio" value="{{$value->id}}" name="id"></th>
      <td>{{$value->nome}}</td>
      <td>{{$value->cpf}}</td>
      <td>{{$value->debito}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div><!-- /input-group -->
</form>

@endsection