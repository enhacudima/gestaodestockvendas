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
        <h4>Novo Ajuste de Produto
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-lg-7">
        <form method="post" action="{{{url('store_produto_ajuste')}}}" autocomplete="Active" accept-charset="UTF-8" >
            {{ csrf_field() }}

            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}" required autofocus>
            <input   name="tipo" type="hidden" id="tipo" value="ajuste" required autofocus>
            <div class="row">
                    <div class="from-group col-lg-5">
                        <label>Produto</label>
                        <select name="produto_id" id="produto_id" class="form-control" value="{{old('produto')}}" required autofocus>
                            <option disabled selected ></option>
                            @if(isset($produtos))
                            @foreach($produtos as $cil)
                            <option value="{{$cil->id}}">{{$cil->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="from-group col-lg-3">
                        <label>lot</label>
                        <select name="lot_id" id="lot_id" class="form-control" value="{{old('lot_id')}}" required autofocus>
                        </select>
                    </div>
                    <div class="from-group col-lg-2">
                        <label>Quantidade unit</label>
                        <input type="number" name="quantidade_unidade" id="quantidade_unidade" class="form-control" value="{{old('quantidade_unidade')}}" required autofocus>
                    </div>
                    <div class="from-group col-lg-2">
                        <label>Descrição</label>
                        <textarea type="textarea" name="decricao" id="decricao" class="form-control" value="{{old('decricao')}}"  autofocus></textarea>
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
    

    <div class="col-lg-5">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Lista de ajustes
        </h4>
    </div>

    <div class="panel-body">

        
    <table id="movimentos" class="table table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
        <tr>
            <th scope="col">#</th>
            <th scope="col">Produto</th>
            <th scope="col">Lot</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Descricão</th>
            <th scope="col">Criado em</th>
            <th scope="col">atualizado em</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($ajustes))    
        @foreach($ajustes as $cil)
            <tr>
             <td>{{$cil->id}}</td>
             <td>             <a class="btn btn btn-success btn-xs" href="{{action('ProdutoController@show', $cil->produto_id)}}">
                <i class="fa fa-pencil fa-fw"></i> {{$cil->name}}
             </a>
            </td> 
             <td>{{$cil->lot}}</td>
             <td>{{$cil->quantidade_unidade}}</td>
             <td>{{$cil->decricao}}</td>
             <td>{{$cil->created_at}}</td>
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

@section('js')

<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

    <script type="text/javascript">

        $('#produto_id').change (function(){


            $value=$(this).val();
            //alert($value);
            $.ajax({
            type : 'get',

            url : '{{URL::to('findlotid')}}',

            data:{'search':$value},

            success:function(data){
            //alert(data)
            $('select[name="lot_id"]').html(data);


                }


        })



        });
    </script>







   

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
@stop
