@extends('layouts.page')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Finalizar Reserva</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="{{url('/Reserva/salvar')}}" method="post"><!--editar-->
                        {{csrf_field()}}
                        <input type="radio" value="{{$clientes}}" name="cliente" checked>&nbsp;
                        <label>Cliente Selecionado </label>
                        <hr>
                        <input type="radio" value="{{$quartos}}" name="quarto" checked>&nbsp;
                        <label>Quarto Selecionado</label>
                        <hr>

                        <div class="form-group">
                            <label for="in" class="col-md-4 control-label">Data de Entrada</label>
                            <div class="col-md-6">
                                <input id="in" type="text" class="form-control" name="checkin">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="out" class="col-md-4 control-label">Data de Saída</label>
                            <div class="col-md-6">
                                <input id="out" type="text" class="form-control" name="checkout">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Finalizar
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