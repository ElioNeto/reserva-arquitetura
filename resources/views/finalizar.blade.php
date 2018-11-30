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
                        <input type="hidden" value="{{$clientes}}" name="cliente" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Cliente Selecionado </label></div>
                        <input type="hidden" value="{{$quartos}}" name="quarto" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Quarto Selecionado</label></div>
                        <input type="hidden" value="{{$checkin}}" name="checkin" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Checkin: {{$checkin}}</label></div>
                        <input type="hidden" value="{{$checkout}}" name="checkout" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Checkout: {{$checkout}}</label></div>
                        <input type="hidden" value="{{$dias}}" name="dias" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Dias reservados: {{$dias}}</label></div>

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