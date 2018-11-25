@extends('layouts.page')

@section('content')
<div class="col-lg-6">
    <form action="{{url('/Cliente/busca')}}" method="post">
        <div class="input-group">
{{csrf_field()}}
            <input type="text" class="form-control" name="nome" placeholder="Busca de Cliente">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Buscar!</button>
            </span>
        </div><!-- /input-group -->
    </form>
</div><!-- /.col-lg-6 -->
<br>
@if(session()->has('msg'))
<div
  id="st"
  class="alert alert-sucess">
  <p>{{session('msg')}}</p>
</div>
@endif
@endsection