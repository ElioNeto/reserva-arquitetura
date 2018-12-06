@extends('layouts.page')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Confirmar dados da reserva</div>
                <div class="panel-body">
                
                    <form class="form-horizontal" role="form" action="{{url('/apiCliente/pagseguro')}}" method="post"><!--editar-->
                        {{csrf_field()}}
                        <input type="hidden" value="FA5AD922C90243D3B03FAC6602798DC3" name="token" checked>
                        <input type="hidden" value="netoo.elio@hotmail.com" name="email" checked>
                        <input type="hidden" value="BRL" name="currency" checked>
                        <input type="hidden" value="{{$reserva->id}}" name="itemid" checked>
                        <input type="hidden" value="{{$cliente->id}}" name="id" checked>

                        <input type="hidden" value="{{$cliente->nome}}" name="cliente" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Cliente Selecionado: {{$cliente->nome}} </label></div>

                        <input type="hidden" value="{{$quarto->descricao}}" name="descricao" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Quarto Selecionado: {{$quarto->descricao}} </label></div>
                        
                        <input type="hidden" value="{{$dias}}" name="qtd" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Dias reservados: {{$dias}}</label></div>

                        <input type="hidden" value="{{$quarto->valor}}" name="valor" checked>&nbsp;
                        <div class="alert alert-info" role="alert"><label>Diária: {{$quarto->valor}}</label></div>

                                <?php   
                                    $unit = $quarto->valor;
                                    $total = $dias * $unit; 
                                ?>

                        <input type="hidden" value="{{$total}}" name="total" checked>&nbsp;
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