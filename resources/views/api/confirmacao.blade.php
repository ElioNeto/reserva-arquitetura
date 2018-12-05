@extends('layouts.page')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Confirmar dados da reserva</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="{{url('/Reserva/salvar')}}" method="post"><!--editar-->
                        {{csrf_field()}}
                        <input type="hidden" value="{{$cliente->nome}}" name="cliente" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Cliente Selecionado: {{$cliente->nome}} </label></div>
                        
                        <input type="hidden" value="{{$dias}}" name="dias" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Dias reservados: {{$dias}}</label></div>

                        <input type="hidden" value="{{$quarto->valor}}" name="diaria" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Diária: {{$quarto->valor}}</label></div>
                            <?php   $unit = $quarto->valor;
                                    $total = $dias * $unit; ?>
                        <input type="hidden" value="{{$total}}" name="dias" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Total: {{$total}}</label></div>

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