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
                    @if($value->debito=='0')
                    <th scope="row"><input type="radio" value="{{$value->id}}" name="id"></th>
                    @else
                    <th scope="row"><input type="radio" value="{{$value->id}}" name="id" disabled></th>
                    @endif
                    <td>{{$value->nome}}</td>
                    <td>{{$value->cpf}}</td>
                    @if($value->debito == '0')
                    <td>Cliente Liberado</td>
                    @else
                    <td>Cliente com Pendências</td>
                    @endif
                    @if($value->debito=='0')
                    <td><button class="btn btn-default" type="submit">Prosseguir!</button></td>
                    @else
                    <td><b>Indisponível para reserva</b></td>
                    @endif
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