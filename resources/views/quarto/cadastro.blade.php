@extends('layouts.page')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro de quartos <a class="pull-right" href="{{url('Quarto')}}">Voltar</a></div>
                

                <div class="panel-body">
                    {{ Form::open(['url' => '/Quarto/salvar']) }}

                        {{ Form::label('descricao', 'Descrição') }}
                        {{ Form::input('text', 'descricao', '', ['class' => 'form-control', 'autofocus', 'placeholder' => 'Descrição do Quarto']) }}
                        
                        {{ Form::label('valor', 'Valor da Diária') }}
                        {{ Form::input('number', 'valor', '', ['class' => 'form-control', 'autofocus', 'placeholder' => 'R$ 0,00', 'step' => '0.01']) }}

                        {{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
