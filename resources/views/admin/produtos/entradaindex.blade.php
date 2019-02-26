@extends('adminlte::page')

@section('title', 'BM | Cadastro de Nova entrada de Produtos')

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
        <h4>Nova entrada de Produto
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-lg-3">
        <form method="post" action="{{{url('store_produto_entrada')}}}" autocomplete="Active" accept-charset="UTF-8" >
            {{ csrf_field() }}

            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}" required autofocus>
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Produto</label>
                        <select name="produto_id" id="produto_id" class="form-control" value="{{old('produto')}}" required autofocus>
                            @if(isset($produtos))
                            @foreach($produtos as $cil)
                            <option value="{{$cil->id}}">{{$cil->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Quantidade</label>
                        <input type="number" name="quantidade" id="quantidade" class="form-control" value="{{old('quantidade')}}" required autofocus>
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Preço de Compra</label>
                        <input type="number" name="precodecompra" id="precodecompra" class="form-control" value="{{old('precodecompra')}}"  autofocus>
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Margem (%)</label>
                        <input type="number" name="margem_per" id="margem_per" class="form-control" value="{{old('margem_per')}}" required autofocus>
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
        <h4>Lista de Entradas
        </h4>
    </div>

    <div class="panel-body">

        
    <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
        <tr>
            <th scope="col">#</th>
            <th scope="col">Produto</th>
            <th scope="col">Lot</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Preço da compra</th>
            <th scope="col">Margem (%)</th>
            <th scope="col">Quantidade Unitaria</th>
            <th scope="col">Custo unitario</th>
            <th scope="col">Margem</th>
            <th scope="col">Preco Final</th>
            <th scope="col">Criado em</th>
            <th scope="col">atualizado em</th>
            <th scope="col">Estado</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($entradas))    
        @foreach($entradas as $cil)
            <tr>
             <td>{{$cil->id}}</td>
             <td>             <a class="btn btn btn-success btn-xs" href="{{action('ProdutoController@show', $cil->produto_id)}}">
                <i class="fa fa-pencil fa-fw"></i> {{$cil->name}}
             </a>
            </td>
            <td>             <a class="btn btn btn-success btn-xs" href="{{action('ProdutoController@lotshow', $cil->id)}}">
                <i class="fa fa-pencil fa-fw"></i> {{$cil->lot}}
             </a>
            </td>  
             <td>{{$cil->quantidade}}</td>
             <td>{{$cil->precodecompra}} Mt</td>
             <td>{{$cil->margem_per}} %</td>
             <td>{{$cil->quantidade_unitaria}}</td>
             <td>{{$cil->custo_unitario}} Mt</td>
             <td>{{$cil->margem}} Mt</td>
             <td>{{$cil->preco_final}} Mt</td>
             <td>{{$cil->created_at}}</td>
             <td>{{$cil->updated_at}}</td>
             @if ($cil->status==0)
             <td>Desativado</td>
             @else
             <td>Ativo</td>
             @endif
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
