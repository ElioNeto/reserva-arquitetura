@extends('layouts.page')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Busca de cliente por nome</div>

                <div class="panel-body">
                    <form action="{{url('/apiCliente/select')}}" method="post">
                        <div class="input-group">
                            {{csrf_field()}}
                            <input type="text" class="form-control" name="nome" placeholder="Busca de Cliente">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Buscar!</button>
                            </span>
                        </div><!-- /input-group -->
                    </form>
                <br>

                @if(session()->has('Er404'))
                <div class="alert alert-danger" role="alert">
                <b>CODE: {{session('Er404')}}</b>
                Cliente não encontrado!
                </div>
                @endif

                @if(session()->has('Er400'))
                <div class="alert alert-danger" role="alert">
                <b>CODE: {{session('Er400')}}</b>
                Cliente desatualizado!
                </div>
                @endif

                @if(session()->has('Er101'))
                <div class="alert alert-danger" role="alert">
                <b>CODE: {{session('Er101')}}</b>
                Endereço não preenchido!
                </div>
                @endif

                @if(session()->has('Er201'))
                <div class="alert alert-danger" role="alert">
                <b>CODE: {{session('Er201')}}</b>
                Datas indisponíveis para o quarto!
                </div>
                @endif
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection