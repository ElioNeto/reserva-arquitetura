@extends('layouts.page')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Reserva de Quarto</div>
        <div class="panel-body">

        <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ID_cliente</th>
                    <th scope="col">ID_quarto</th>
                    <th scope="col">Checkin</th>
                    <th scope="col">Checkout</th>
                    <th scope="col">Pagamento</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($reserva as $key => $value)
                  <tr>
                    @if($value->status=='0')
                    <th scope="row"><input type="radio" value="{{$value->id}}" name="quarto"></th>
                    @else
                    <th scope="row"><input type="radio" value="{{$value->id}}" name="id" disabled></th>
                    @endif
                    <td>{{$value->descricao}}</td>
                    <td>{{$value->valor}}</td>
                    @if($value->status=='0')
                      <td>Livre</td>
                    @else
                      <td>Ocupado</td>
                    @endif
                    @if($value->status=='0')
                    <td><button class="btn btn-default" type="submit">Prosseguir!</button></td>
                    @else
                    <td><button class="btn btn-default" type="submit" disabled>Ocupado!</button></td>
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection