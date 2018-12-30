@extends('adminlte::page')

@section('title', 'BMVendas')

@section('content_header')
    
@stop

@section('content')
	@if($mesa)
		@foreach($mesa as $key => $cil)
           <div class="row col-lg-3 col-lg-offset-1">
            <div class="info-box" style="width: 100%">
              <!-- Apply any bg-* class to to the icon to color it -->
              <span class="info-box-icon bg-green"><i class="fa fa-table" aria-hidden="true"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">Mesa: {{$cil->name}}</span>
                <span class="info-box-text">Estado da Mesa</span>
                @if($cil->status==0)
                <a href="#" class="btn btn-danger btn-flat">Ocupada</a>
                @else
                <a href="#" class="btn btn-primary btn-flat">Livre</a>
                @endif
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        @endforeach
    @endif    
@stop