@extends('adminlte::page')

@section('title', 'BM | Cadastro de Produtos')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
@include('inc.messages')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Novo  Produto
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-lg-3">
        <form method="post" action="{{url('storeproduto')}}" autocomplete="Active" accept-charset="UTF-8" >
            {{ csrf_field() }}

            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}" required autofocus>
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required autofocus>
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Codigo do Produto</label>
                        <input type="text" name="codigoproduto" id="codigoproduto" class="form-control" value="{{old('codigoproduto')}}" required autofocus>
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Codigo de Barras</label>
                        <input type="text" name="codigobarra" id="codigobarra" class="form-control" value="{{old('codigobarra')}}"  autofocus>
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control" value="{{old('brand')}}" required autofocus>
                    </div>
            </div>       

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Descrição</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{old('description')}}" required autofocus>
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Tipo de Unidade de Medida</label>
                        <input type="text" name="tipodeunidadedemedida" id="tipodeunidadedemedida" class="form-control" value="{{old('tipodeunidadedemedida')}}" required autofocus>
                    </div>
            </div>  

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Unidade de Medida</label>
                        <input type="number" name="unidadedemedida" id="unidadedemedida" class="form-control" value="{{old('unidadedemedida')}}" >
                    </div>
            </div> 

     
            <div class="row">

                <div class="from-group text-right col-md-12">
                     <label></label>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </div>
            </div>   
                
           
        </form>
        

    </div>
    

    <div class="col-lg-9">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Lista de Produtos
        </h4>
    </div>

    <div class="panel-body">

        
    <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Codigo do Produto</th>
            <th scope="col">Codigo de Barras</th>
            <th scope="col">Brand</th>
            <th scope="col">Descrição</th>
            <th scope="col">Tipo de Unidade de Medida</th>
            <th scope="col">Unidade de Medida</th>
            <th scope="col">Ultima atualização</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($produtos))    
        @foreach($produtos as $cil)
            <tr>
             <td>{{$cil->id}}</td>
             <td>             <a class="btn btn btn-success btn-xs" href="{{action('ProdutoController@show', $cil->id)}}">
                <i class="fa fa-pencil fa-fw"></i> {{$cil->name}}
             </a>
            </td> 
             <td>{{$cil->codigoproduto}}</td>
             <td>{{$cil->codigobarra}}</td>
             <td>{{$cil->brand}}</td>
             <td>{{$cil->description}}</td>
             <td>{{$cil->tipodeunidadedemedida}}</td>
             <td>{{$cil->unidadedemedida}}</td>
             <td>{{$cil->updated_at}}</td>
            </tr>
        @endforeach 
        @endif   
        </tbody>
    </table>
        </div>
    </div>
</div>
</div>

</div>
@stop

@section('css')
               <style>


        input, textarea {
            padding: 10px;
            border: 1px solid #E5E5E5;
            width: 100%;
            color: #999999;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -moz-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
        }

       </style>
@stop
