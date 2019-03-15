<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bmdevendas|Vendas</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
          <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
          <link rel="stylesheet" type="text/css" href="{{asset('src/bootstrap-duallistbox.css')}}">
          <script src="https://code.jquery.com/jquery-3.2.1.min.js"  ></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
          <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
          <script src="{{ asset('src/jquery.bootstrap-duallistbox.js') }}"></script>


        <!--Ajax-->  


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            
        </style>

        <style type="text/css">
            .center-block {
            padding:10px;
            color:#ec8007
            }
        </style>
    </head>
    <body>
        <div class="content">
            <div class="">
                <div class="center-block"><h2>Mesa: {{$mesa->name}}; Operador: {{ Auth::user()->name }}</h2> </div>
            </div>

           


            <div class="col-md-12">
                <div class="col-md-2">
                <div class="pull-left" style="margin-left: 14px">
                   <div class="row">
                    <a class="btn btn-primary col-md-4" href="{{ url()->previous() }}" style="width: 100%; margin-top: 10px; margin-right: 10px"> Voltar</a> 
                    <a class="btn btn-danger col-md-4" href="#ticket-edit-mesa-modal" data-toggle="modal" data-target="#ticket-edit-mesa-modal" style="width: 100%; margin-top: 10px"> Finalizar<i class="fa fa-arrow-circle-right"></i></a>
                   </div> 
                </div>
                </div> 
            <div class="row">
            <div class="col-md-4" style="margin-top: 30px;margin-right: 40px">    

              <form id="demoform" action="#" method="post">
                 {{ csrf_field() }}
                 <input type="" name="mesa_id" value="{{$mesa_id}}" hidden="true">
                <select multiple="multiple" size="10" name="duallistbox_demo1[]" title="duallistbox_demo1[]">
                  @foreach($produtos as $key => $cil)
                  <option value="{{$cil->id}}">{{$cil->name}} - {{$cil->preco_final}} Mtn</option>
                  @endforeach
                </select>
                <br>
                <button type="submit" class="btn btn-primary btn-block ">Adicionar no carrinho</button>
              </form>
            </div>

            <div class="col-md-4" style="margin-top: 55px">
                <h3>Carrinho</h3>
                <div class="row">
                    <label style="margin-right: 13px; width: 40%; max-width: 60%">Descrição do Produto</label><label style="width: 67px">Preço.(Mtn)</label><label style="width: 80px">Qua.t</label><label style="width: 75px">Total.(Mtn)</label>
                </div>
                <form id="carrinhoform" action="#" method="POST">
                    {{ csrf_field() }}
                <div class="">
                    <div class="increment">
                        @if ($data_mesa)
                            <?php foreach ($data_mesa as $key => $value): ?>
                             
                                <div class="row">
                                 <input type="" name="mesa_id" value="{{$mesa_id}}" hidden="true"><input type="text" id="idbulk" name="idbulk" hidden="true" value="{{$value->identificador_de_bulk}}"><input type="number" id="id[]" name="id[]" hidden="true" value="{{$value->id}}"><input class="form-control" type="text" name="produt" id="produt" style="margin-right: 13px; width: 40%; max-width: 60%; margin-bottom: 5px" disabled="" value="{{$value->name}}"> <input class="form-control" type="number" name="preco_final[]" id="preco_final[]" style="width: 60px; margin-right: 13px; margin-bottom: 5px" disabled="true" value="{{$value->preco_final}}"><input class="form-control"  type="number" name="quantidade[]" id="quantidade[]" style="width: 67px;margin-right: 13px; margin-bottom: 5px" value="{{$value->quantidade}}"><input  class="form-control" type="number" name="total[]" id="total[]" style="width: 75px; margin-right: 13px; margin-bottom: 5px" disabled="" value="{{$value->quantidade * $value->preco_final}}">
                                </div>
                                 
                            <?php endforeach ?>

                        @endif
                    </div>
                        <div style="margin-top: 10px">
                            <label  style="margin-right: 9px;margin-left:58.5% ; width: 40px">Total:</label><input class="total" type="number" name="sum" id="sum" style="width: 75px; margin-right: 13px" disabled="true" value="">
                        </div>
                </div>
                @if ($data_mesa)
                <button type="submit" class="row btn btn-primary btn-block " style="margin-top: 10px; width: 40%; max-width: 60%;margin-bottom: 10px">Atualizar</button>
                @endif
                </form>
            </div>
            </div>

            </div>

            <!--modal edite Mesa-->
        <div class="modal fade bd-example-modal-lg" id="ticket-edit-mesa-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-edit-mesa-modal-Label">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" >
                    <form method="POST" action="#" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="formfvenda">
                        {{ csrf_field() }}
                    <div class="modal-header">
                        <h4 class="modal-title" id="ticket-edit-mesa-modal-Label">Finalização da Venda </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        
                    </div> 

                    <div class="modal-body">

                        <div class="row">
                            <div class="center-block"> 
                                <h3> 
                                Total a Pagar:
                                <input class="form-control total"   type="number" name="porpagar" id="porpagar" style="width: auto;" disabled="true" value="">
                                </h3>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Forma de Pagamento</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Detalhes</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Referência</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Valor</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control "  type="text" name="fpagamento[]" value="Cash" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input  class="form-control " type="text" name="detalhes[]" value="Dinheiro" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0" disabled="" >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor"  type="number" name="valor[]" value="0" required="">
                                    </div>
                                </div>

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control "  type="text" name="fpagamento[]" value="Cartão" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <select class="form-control " value="" name="detalhes[]" autofocus required="" >
                                            <option disabled="" value="nan" selected>
                                                Seleciona..
                                            </option>
                                             
                                            <option value="Milennium BIM">
                                                Milennium BIM
                                            </option>    
                                            <option value="BancABC">
                                                BancABC
                                            </option>    
                                            <option value="Barclays">
                                                Barclays
                                            </option>    
                                            <option value="BCI">
                                                BCI
                                            </option>    
                                            <option value="Nosso Banco">
                                                Nosso Banco
                                            </option>    
                                            <option value="BNI">
                                                BNI
                                            </option>    
                                            <option value="Ecobank">
                                                Ecobank
                                            </option>    
                                            <option value="BancABC">
                                                BancABC
                                            </option>    
                                            <option value="CEP">
                                                CEP
                                            </option>    
                                            <option value="Unico">
                                                Unico
                                            </option>    
                                            <option value="Gapi">
                                                Gapi
                                            </option>    
                                            <option value="FNB">
                                                FNB
                                            </option>    
                                            <option value="CapitalBanck">
                                                CapitalBanck
                                            </option>    
                                            <option value="Moza Banco">
                                                Moza Banco
                                            </option>    
                                            <option value="Standard Bank">
                                                Standard Bank
                                            </option>    
                                            <option value="Societe Generale Moçambique">
                                                Societe Generale Moçambique
                                            </option> 

                                             
                                             
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0"  >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor" type="number" name="valor[]" value="0" required="">
                                    </div>
                                </div>

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="fpagamento[]" value="M-PESA" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="detalhes[]" value="Vodacom" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0" >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor" type="number" name="valor[]" value="0" required="">
                                    </div>
                                </div>

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="fpagamento[]" value="Conta Movel" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="detalhes[]" value="BCI" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0"  >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor" type="number" name="valor[]" value="0" required="">
                                    </div>
                                </div>                  

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="fpagamento[]" value="Outro" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="detalhes[]" value="Outro" >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0"  >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor" type="number" name="valor[]" value="0" required="">
                                    </div>
                                </div>
                                <hr>                 

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Total Pago:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="number" name="pago" id="pago" value="0" required="" disabled="">
                                    </div>
                                </div>           

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Total Por pagar:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control total" type="number" name="ppago" id="ppago" value="0" required="" disabled="">
                                    </div>
                                </div>           

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Troco:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control" type="number" name="troco" id="troco" value="0" required="" disabled="">
                                    </div>
                                </div>
                              <!-- Custom Tabs -->


                              <!-- nav-tabs-custom -->
                            </div>
                            <!-- /.col -->

                    </div>
                          

                            <div class="clearfix"></div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <input class="btn btn-primary" type="submit" value="Efectuar pagamento da conta">
                                </div>
                    </form>
                        </div>
                    </div>
        </div> 
    </div>
    

            <script>

              var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox();
              $("#demoform").submit(function(e) {
                e.preventDefault();

                console.log($('[name="duallistbox_demo1[]"]').val());
                $dados=($('[name="duallistbox_demo1[]"]').val());
                $mesa_id=($('[name="mesa_id"]').val());

                $.ajax({
                  url: "{{URL('saveselection')}}",
                  type:'POST',
                  data: {dados:$dados,mesa_id:$mesa_id},
                  success: function(data) {
                        $('.increment') .html(data);
                             var total=$('[name="total[]"]')
                             var __total=[];
                             var sum=0;
                             var _total=0;

                             for (var i=0;i<total.length;i++){
                                __total=$(total).eq(i).val();
                                _total=parseFloat(__total)+parseFloat(_total);
                             }
                            //alert(parseFloat(_total))
                                $(".total").val(_total);


                        


                    //alert(data);


                  }});
                return false;
              });
            </script>
            <script type="text/javascript">
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
            </script>

            <script type="text/javascript">
                //atualizando os dados na tabela temporaria 
                $("#carrinhoform").submit(function(e){
                    e.preventDefault();

                    var id = $('[name="id[]"]');
                    var quantidade = $('[name="quantidade[]"]');
                    $idbulk=($('[name="idbulk"]').val());
                    $mesa_id=($('[name="mesa_id"]').val());
                    var _id = [];
                    var _quantidade=[];


                    for (var i = 0; i < id.length; i++) {
                        _id.push($(id).eq(i).val());
                        _quantidade.push($(quantidade).eq(i).val())
                        
                    }
                    //alert(JSON.stringify(p));//or alert(p)
                    //alert(_id+''+_quantidade+''+idbulk);   

                $.ajax({
                  url: "{{URL('atualizarvendatemp')}}",
                  type:'POST',
                  data: {idbulk:$idbulk,mesa_id:$mesa_id,id:_id,quantidade:_quantidade},

                  success: function(data) {
                        $('.increment') .html(data);

                            //retornando total
                             var total=$('[name="total[]"]')
                             var __total=[];
                             var sum=0;
                             var _total=0;

                             for (var i=0;i<total.length;i++){
                                __total=$(total).eq(i).val();
                                _total=parseFloat(__total)+parseFloat(_total);
                             }
                            //alert(parseFloat(_total))
                                $(".total").val(_total);

                        


                    //alert(data);


                }});


                });
            </script>

            <script type="text/javascript">
                //Atualizando o preço final do carrinho
                $(window).on('load', function() {
                 // code here

                 var total=$('[name="total[]"]')
                 var __total=[];
                 var sum=0;
                 var _total=0;

                 for (var i=0;i<total.length;i++){
                    __total=$(total).eq(i).val();
                    _total=parseFloat(__total)+parseFloat(_total);
                 }
                //alert(parseFloat(_total))
                    $(".total").val(_total);
                 });

               

            </script>

            <script type="text/javascript">
                
            $(document).ready(function(){

                $('.valor').change(function(){

                     var total=$('[name="valor[]"]')
                     var __total=[];
                     var sum=0;
                     var _total=0;

                     for (var i=0;i<total.length;i++){
                        __total=$(total).eq(i).val();
                        _total=parseFloat(__total)+parseFloat(_total);
                     }
                    //alert(parseFloat(_total))
                    $("#pago").val(_total);

                    var porpagar=$('[name="porpagar"]').val();
                    var realporpagar=parseFloat(porpagar)-parseFloat(_total);
                    if (realporpagar<=0) {
                        var troco=realporpagar;
                        var realporpagar=0;
                        $("#troco").val(troco);

                    }


                        $("#ppago").val(realporpagar);

                    });
            });
            </script>

            <script type="text/javascript">
                //add venda
                $("#formfvenda").submit(function(e){
                    e.preventDefault();

                    var fpagamento = $('[name="fpagamento[]"]');
                    var detalhes = $('[name="detalhes[]"]');
                    var referencia = $('[name="referencia[]"]');
                    var valor = $('[name="valor[]"]');
                    $mesa_id=($('[name="mesa_id"]').val());
                    $porpagar=($('[name="porpagar"]').val());
                    $pago=($('[name="pago"]').val());
                    $ppago=($('[name="ppago"]').val());
                    $troco=($('[name="troco"]').val());
                  

                    var _fpagamento = [];
                    var _detalhes=[];
                    var _referencia = [];
                    var _valor=[];


                    for (var i = 0; i < fpagamento.length; i++) {
                        _fpagamento.push($(fpagamento).eq(i).val());
                        _detalhes.push($(detalhes).eq(i).val())
                        _referencia.push($(referencia).eq(i).val());
                        _valor.push($(valor).eq(i).val())
                        
                    }
                
                $.ajax({
                  url: "{{URL('efectuarpagamento')}}",
                  type:'POST',
                  data: {fpagamento:_fpagamento,detalhes:_detalhes,referencia:_referencia,valor:_valor,mesa_id:$mesa_id,porpagar:$porpagar,pago:$pago,ppago:$ppago,_troco:$troco},

                  success: function(data) {
                        $('.increment') .html(data);


                            //retornando total
                             var total=$('[name="total[]"]')
                             var __total=[];
                             var sum=0;
                             var _total=0;

                             for (var i=0;i<total.length;i++){
                                __total=$(total).eq(i).val();
                                _total=parseFloat(__total)+parseFloat(_total);
                             }
                            //alert(parseFloat(_total))
                                $(".total").val(_total);

                        


                    //alert(data);


                },

                error: function(data){
                    alert();
                }
                });


                });
            </script>





        
    </body>
</html>
