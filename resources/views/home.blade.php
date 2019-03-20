@extends('adminlte::page')

@section('title', 'BMVendas | Home')

@section('content_header')
     
@stop

@section('content')
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	@if($mesa)
		@foreach($mesa as $key => $cil)

           <div class="row col-lg-3 col-md-offset-1">
                  <!-- Small boxes (Stat box) -->

            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                @if($cil->status==0)
                <h3 style="" ><a  href="{{url('vendasindex',$cil->id)}}" style="color: red">{{$cil->name}}</a></h3>
                @else
                <h3><a  href="{{url('vendasindex',$cil->id)}}" style="color: #FFFFFF">{{$cil->name}}</a></h3>
                @endif
                <p>{{$cil->username}}</p>
                <p>{{$cil->updated_at->diffForHumans()}}</p>
              </div>
              <div class="icon">
                @if($cil->description=="car")
                <i class="fa fa-car"></i>
                @else
                <i class="fa fa-shopping-cart"></i>
                @endif
              </div>

              <a href="#ticket-edit-mesa-modal" type="submit"  class=" small-box-footer" data-toggle="modal" data-target="#ticket-edit-mesa-modal"  data-value="{{$cil->id}}" id="droplist">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
        
            </div>
            <!-- ./col -->
            <!-- /.info-box -->
        </div>
        @endforeach
    @endif


        <!--modal edite Mesa-->
        <div class="modal fade bd-example-modal-lg" id="ticket-edit-mesa-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-edit-mesa-modal-Label">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="ticket-edit-mesa-modal-Label">Detalhes </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        
                    </div> 

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                              <!-- Custom Tabs -->
                              <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                  <li class="active"><a href="#tab_1" data-toggle="tab">Lista de Pedidos</a></li>
                                  <li><a href="#tab_2" data-toggle="tab">Contas a Pagar</a></li>
                                  <li><a href="#tab_3" data-toggle="tab">Contas Pagas</a></li>
                                  <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                      Dropdown <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                                      <li role="presentation" class="divider"></li>
                                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                                    </ul>
                                  </li>
                                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                </ul>
                                <div class="tab-content">
                                  <div class="tab-pane active" id="tab_1">

                                  <div class="">
                                  <table id="example" class="display nowrap" style="width:100%">
                                      <thead>
                                          <tr>
                                              <th>Produto</th>
                                              <th>Preço (Unit)</th>
                                              <th>Quantidade</th>
                                              <th>Preço final</th>
                                          </tr>
                                      </thead>
                                      <tbody>
 
                                      </tbody>
                                    </table>
     
                                  </div>
                                  <div style="margin-top: 10px">
                                      <label  style="margin-right: 9px;margin-left:58.5% ; width: 40px">Total:</label><input class="total" type="number" name="sum" id="sum" style="width: 75px; margin-right: 13px" disabled="true" value="">
                                  </div>

                                  </div>
                                  <!-- /.tab-pane -->
                                  <div class="tab-pane" id="tab_2">
                                  </div>
                                  <!-- /.tab-pane -->
                                  <div class="tab-pane" id="tab_3">
                                  </div>
                                  <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                              </div>
                              <!-- nav-tabs-custom -->
                            </div>
                            <!-- /.col -->

                    </div>
                          

                            <div class="clearfix"></div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                               
                            </div>
                        </div>
                    </div>
        </div>
        </div>   

          


            <!-- JavaScript de Popup de List -->
        <script>
            var jqxhr = {abort: function () {}};

           $(document).on('click', '#droplist',(function() {//using delegaction to send event on dynamic datatable


                    $value=$(this).data("value");
                    //alert($value);
                    console.log($value);
                  $.ajax({
                  url: "{{URL('listapedidos')}}",
                  type:'get',
                  data: {mesa_id:$value},

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
                                $("#example>tbody").val(_total);

                        


                    //alert(data);


                }});

                
            }));
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        </script> 






@stop
