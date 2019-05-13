<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bmdevendas|Vendas</title>



        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
          <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
          <link rel="stylesheet" type="text/css" href="{{asset('src/bootstrap-duallistbox.css')}}">
          <script src="https://code.jquery.com/jquery-3.2.1.min.js"  ></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
          <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
          <script src="{{ asset('src/jquery.bootstrap-duallistbox.js') }}"></script>
          <!--sweetalert-->
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

          <!--jquery para autocomplet--> 

        <!--jquery para autocomplet-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>        
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" /> 
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>‌​
        <!--and js-->



        <!--Ajax-->  


        <!-- Styles -->
        <style>
            html, body {
                background-color: #000000;
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
        


   <div class="row" style="margin-left: 34%;margin-top: 10%">
        
            <div class="col-md-5">
                <form id="savecredito" action="savecredito" method="POST">
                    {{ csrf_field() }}
                        <div class="panel-body">
                            {{$value}}
                            <label style="color: red">Cliente</label>
                            <input type="text" class="form-control"  id="loanidshow"  name="loanidshow" style="width: 100%; " placeholder="Pesquisar Nome, contact" required autofocus>
                            <input type="hidden" id="inputs" name="inputs" value="" />
                        </div>    
                
                <br>
                <div class="">
                <button type="submit" class="btn btn-primary btn-block ">Creditar o cliente</button>
                </div>
              </form>  
           
        

    </div>


            <script>

                $(document).ready(function() {
                $('#loanidshow').autocomplete({
                    

                    delay: 500,// this is in milliseconds

                    minLength: 2,

                    source: function(request, response) {

                        $.getJSON("{{url('searchcliente')}}", {
                            search: request.term,
                        }, function(data) {
                            response(data);
                        });


                    },
                    focus: function(event, ui) {
                        // prevent autocomplete from updating the textbox
                        event.preventDefault();
                    },
                    select: function(event, ui) {
                        // prevent autocomplete from updating the textbox
                        event.preventDefault();
         
                        $('input[name="loanidshow"]').val(ui.item.label);
                        $('input[name="inputs"]').val(ui.item.id);
                        //console.log( ui.item.LoanID ); 
                    }
                });
                })
            </script>
        
    </body>
</html>
