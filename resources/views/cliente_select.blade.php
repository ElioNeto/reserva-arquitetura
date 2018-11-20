@extends('layouts.page')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Resultado da busca</div>
        <div class="panel-body">

          <form action="{{url('/Reserva/quarto')}}" method="post">
            <div class="input-group">
            {{csrf_field()}}
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
                    <td><button class="btn btn-default" type="submit">Prosseguir!</button></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div><!-- /input-group -->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection