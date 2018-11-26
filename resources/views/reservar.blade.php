@extends('layouts.page')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Reserva de Quarto</div>
        <div class="panel-body">

          <form action="{{url('/Reserva/finalizar')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" value="{{$clientes}}" name="cliente" checked>&nbsp;
            <div class="alert alert-info" role="alert"><label>Cliente Selecionado </label></div>
            <hr>
            <h3>Quartos</h3>
            <br>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($quartos as $key => $value)
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
  
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection