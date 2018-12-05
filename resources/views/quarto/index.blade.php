@extends('layouts.page')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Quartos 
                @if(session()->has('message'))
                    &nbsp;&nbsp;&nbsp;&nbsp;====><b>Mensagem do Sistema: </b>{{session('message')}}<====
                    @endif
                    <a class="pull-right" href="{{url('Quarto')}}">Voltar</a>
                </div>

                <div class="panel-body">
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
                        <th scope="row">{{$value->id}}</th>
                        <td>{{$value->descricao}}</td>
                        <td>{{$value->valor}}</td>
                        @if($value->status=='0')
                            <td>Livre</td>
                         @else<td>Ocupado</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    </table>
                    {{$quartos->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection