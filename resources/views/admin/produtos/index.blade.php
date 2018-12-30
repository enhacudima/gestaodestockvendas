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
        h2 {
            margin-bottom: 20px;
            color: #474E69;
        }

        /* ===========================
           ====== Contact Form =======
           =========================== */

        input, textarea {
            padding: 10px;
            border: 1px solid #E5E5E5;
            width: 100%;
            color: #999999;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -moz-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
        }

        textarea {
            width: 100%;
            height: 400px;
            max-width: 400px;
            line-height: 18px;
        }

        input:hover, textarea:hover,
        input:focus, textarea:focus {
            border-color: 1px solid #C9C9C9;
            box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
            -moz-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
        }

        .form label {
            margin-left: 10px;
            color: #999999;
        }

        #formulario{
            margin-left: 37px;
            margin-right:37px;
        }

        /* ===========================
           ====== Submit Button ======
           =========================== */

        .submit input {
            width: 100px;
            height: 40px;
            background-color: #474E69;
            color: #FFF;
            border-radius: 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
        }

    </style>

    <!-- Style da janela de Popup -->
    <style>



        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-bottom: 100px;
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 40%;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }

        @keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }

        /* The Close Button */
        .close1 {
            color: #ff5f2c;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close1:hover,
        .close1:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        /* The Close Button2 */
        .close2 {
            color: #ff5f2c;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close2:hover,
        .close2:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        /* The Close Button 3*/
        .close3 {
            color: #ff5f2c;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close3:hover,
        .close3:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        /* The Close Button 4*/
        .close4 {
            color: #ff5f2c;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close4:hover,
        .close4:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding: 2px 16px;
            background-color: #474E69;
            color: white;
        }

        .modal2-header {
            padding: 2px 16px;
            background-color: #474E69;
            color: white;

        }

        .modal-body {padding: 2px 16px;}

        .modal-footer {
            padding: 2px 16px;
            background-color: #474E69;
            color: white;
        }
    </style>

    <style>
        .pendente{
            color: #adae26;
        }
        .rejeitado{
            color: #ef1908;
        }

        .enviado{
            color: #0f20b3;
        }

        .aprovado{
            color: #25b347;
        }
        .emanalise{
            color: #fe6bdd;
        }
    </style>

<!--tipo chat-->
    <style>

        .container1 {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            margin-left:37px;
            margin-right:37px;
        }


        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        .container1::after {
            content: "";
            clear: both;
            display: table;
        }

        .container1 img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        .container1 img.right {
            float: right;
            margin-left: 20px;
            margin-right:0;
        }

        .time-right {
            float: right;
            color: #aaa;
        }

        .time-left {
            float: left;
            color: #999;
        }
</style>


    <!--Out radius bottons-->
    <style type="text/css">

    /*Global*/

        .bord0 {
        border-radius: 0;
        }

        
    </style>
@stop
