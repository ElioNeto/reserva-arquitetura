@extends('layouts.page')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Resultado da busca</div>
        <div class="panel-body">

        @if(session()->has('Er202'))
        <div class="alert alert-danger" role="alert">
        <b>CODE: {{session('Er202')}}</b>
        Reserva não encontrada!
        </div>
        @endif

          <form action="{{url('/apiCliente/checkout')}}" method="post">
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
                    @if($value->debito == '0')
                    <td>Cliente Liberado</td>
                    @else
                    <td>Cliente com Pendências</td>
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div><!-- /input-group -->

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-user"></i> Prosseguir
                </button>
              </div>
            </div> 
          </form>
        </div>
      </div> 
    </div>
  </div>
</div>

@endsection