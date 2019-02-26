@extends('adminlte::page')

@section('title', 'BMVendas | Home')

@section('content_header')
    Vendas 
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	@if($mesa)
		@foreach($mesa as $key => $cil)
           <div class="row col-lg-3 col-md-offset-1">
            <div class="info-box" style="width: 100%">
              <!-- Apply any bg-* class to to the icon to color it -->
              @if($cil->description=="car")
              <span class="info-box-icon bg-red"><i class="fa fa-car" aria-hidden="true"></i></span>
              @else
              <span class="info-box-icon bg-green"><i class="fa fa-coffee" aria-hidden="true"></i></span>
              @endif
              <div class="info-box-content">
                <span class="info-box-number">Mesa: {{$cil->name}}</span>
                <span class="info-box-text"><b>Alterado Por:</b> {{$cil->username}}</span>
                @if($cil->status==0)
                 <button type="submit" data-toggle="modal" data-target="#ticket-edit-mesa-modal" class="droplist btn btn-danger btn-flat" value="{{$cil->id}}" id="droplist">Ocupada </button> <b> Last Update: </b>
                 {{$cil->updated_at->diffForHumans()}}
                @else
                 <button type="submit" data-toggle="modal" data-target="#ticket-edit-mesa-modal" class="droplist  btn btn-primary btn-flat" value="{{$cil->id}}" id="droplist">livre </button>
                @endif
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        @endforeach
    @endif


        <!--modal edite Mesa-->
        <div class="modal fade bd-example-modal-lg" id="ticket-edit-mesa-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-edit-mesa-modal-Label">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" >
                    <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input name="idsolicitacao" type="hidden" id="idsolicitacao" value="">
                        <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}">
                    <div class="modal-header">
                        <h4 class="modal-title" id="ticket-edit-mesa-modal-Label">Detalhes </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        
                    </div> 

                    <div class="modal-body">
                        <div class="w3-container">
                          <h2>Tabs</h2>
                          <p>Tabs are perfect for single page web applications, or for web pages capable of displaying different subjects. Click on the links below.</p>
                        </div>

                        <div class="w3-bar w3-black">
                          <button class="w3-bar-item w3-button" onclick="openCity('London')">London</button>
                          <button class="w3-bar-item w3-button" onclick="openCity('Paris')">Paris</button>
                          <button class="w3-bar-item w3-button" onclick="openCity('Tokyo')">Tokyo</button>
                        </div>

                        <div id="London" class="w3-container city">
                          <h2>London</h2>
                          <p>London is the capital city of England.</p>
                        </div>

                        <div id="Paris" class="w3-container city" style="display:none">
                          <h2>Paris</h2>
                          <p>Paris is the capital of France.</p> 
                        </div>

                        <div id="Tokyo" class="w3-container city" style="display:none">
                          <h2>Tokyo</h2>
                          <p>Tokyo is the capital of Japan.</p>
                        </div>

                    </div>
                          

                            <div class="clearfix"></div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input class="btn btn-primary" type="submit" value="Submit">
                            </div>
                    </form>
                        </div>
                    </div>
        </div>   


            <!-- JavaScript de Popup de List -->
        <script>
            var jqxhr = {abort: function () {}};

           $(document).on('click', 'button[id=droplist]',(function() {//using delegaction to send event on dynamic datatable


                    $value=$(this).val();
                    //alert($value);
                    console.log($value);

                
            }));
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        </script>  

        <script>
        function openCity(cityName) {
          var i;
          var x = document.getElementsByClassName("city");
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
          }
          document.getElementById(cityName).style.display = "block";  
        }
        </script> 
@stop
