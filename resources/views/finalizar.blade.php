@extends('layouts.page')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Finalizar Reserva</div>
                <div class="panel-body">
                    <form action="{{url('/Reserva/finalizar')}}" method="post"><!--editar-->
                        <div class="input-group">
                            {{csrf_field()}}
                            <input type="radio" value="{{$clientes}}" name="cliente" checked>&nbsp;
                            <label>Cliente Selecionado </label>
                            <hr>
                            <input type="radio" value="{{$quartos}}" name="quarto" checked>&nbsp;
                            <label>Quarto Selecionado</label>
                            <hr>

                            {{ Form::label('checkin', 'Data de Entrada') }}
                            {{ Form::input('text', 'checking', '', ['class' => 'form-control', 'autofocus', 'placeholder' => 'Data de Entrada']) }}
                            
                            {{ Form::label('checkout', 'Data de Saída') }}
                            {{ Form::input('text', 'checkout', '', ['class' => 'form-control', 'autofocus', 'placeholder' => 'Data de Saída']) }}

                            {{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection