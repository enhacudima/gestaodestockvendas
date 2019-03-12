<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
    </head>
    <body>
        <div class="content">



            <div class="col-md-12">
                <div class="col-md-2">
                <div class="pull-left" style="margin-left: 14px">
                   <div class="row">
                    <a class="btn btn-primary col-md-4" href="{{ url()->previous() }}" style="width: 100%; margin-top: 10px"> Voltar</a>
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

            <div class="col-md-6" style="margin-top: 55px">
                <h3>Carrinho</h3>
                <label style="margin-right: 13px; width: 71%">Descrição do Produto</label><label style="width: 67px">Preço.(Mtn)</label><label style="width: 80px">Qua.t</label><label style="width: 75px">Total.(Mtn)</label>
                <form id="carrinhoform" action="#" method="POST">
                    {{ csrf_field() }}
                <div class="increment">
                    @if ($data_mesa)
                        <?php foreach ($data_mesa as $key => $value): ?>
                             <input type="" name="mesa_id" value="{{$mesa_id}}" hidden="true"><input type="text" id="idbulk" name="idbulk" hidden="true" value="{{$value->identificador_de_bulk}}"><input type="number" id="id[]" name="id[]" hidden="true" value="{{$value->id}}"><input type="text" name="produt" id="produt" style="margin-right: 13px; width: 70%" disabled="" value="{{$value->name}}"> <input  type="number" name="preco_final[]" id="preco_final[]" style="width: 60px; margin-right: 13px" disabled="true" value="{{$value->preco_final}}"><input  type="number" name="quantidade[]" id="quantidade[]" style="width: 67px;margin-right: 13px" value="{{$value->quantidade}}"><input  type="number" name="total[]" id="total[]" style="width: 75px; margin-right: 13px" disabled="" value="{{$value->quantidade * $value->preco_final}}">
                        <?php endforeach ?>
                        <div class="" style="margin-top: 10px">
                         <label style="margin-left: 83%;margin-right: 9px; width: 40px">Total:</label><input  type="number" name="sum" id="sum" style="width: 75px; margin-right: 13px" disabled="true" value="">
                        </div>
                    @endif
               
                </div>
                @if ($data_mesa)
                <button type="submit" class="btn btn-primary btn-block " style="margin-top: 10px; width:70% ">Atualizar</button>
                @endif
                </form>
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
                    $("#sum").val(_total);
                 });

               

            </script>



        
    </body>
</html>
