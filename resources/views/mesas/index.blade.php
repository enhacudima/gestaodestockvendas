@extends('layouts-temp.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4">
      {{--  Abrir formulário --}}
      {!! Form::open(['url' => 'foo/bar', 'method' => 'POST']) !!} 
       
       <div class="form-group">
         {!! Form::label('name', 'Nome', array('class' => 'control-label' )) !!} 
         {!! Form::text('name', null, ['class' => 'form-control']) !!}
       </div>  

       <div class="form-group">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
      </div>

      <div class="form-group">
        {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
      </div>
    {!! Form::close() !!} 
    {{-- Fechar formulário --}}
  </div>

  <div class="col-md-8">
      <div class="panel panel-default">
	    <div class="panel-heading">
	        <h5>Lista de Mesas
	        </h5>
	    </div>

    <div class="panel-body">

   <table id="reclatodas" class="table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
        <tr>
            
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
            <th scope="col">Last update</th>
        </tr>
        </thead>
        <tbody>
    
        </tbody>
    </table>
  </div>
 </div>
</div>
</div>
@endsection