<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entradas;
use App\VendasTempMesa;
use App\Mesa;
use App\Vendas;
use App\VendasTroco;
use App\Ajustes;
use Auth;


class VendasController extends Controller
{
    public function index($id)
    {
    	$mesa_id=$id;
        $produtos=Entradas::join('produtos','produtos_entradas.produto_id','produtos.id')
                    ->select('produtos_entradas.*','produtos.name')
                    ->where('produtos_entradas.status','!=','0')
                    ->get();
        $data_mesa=VendasTempMesa::where('mesa_id',$mesa_id)->whereNull('codigo_venda')
          		->join('produtos_entradas','vendas_temp_mesa.produto_id','produtos_entradas.id')
          		->join('produtos','produtos_entradas.produto_id','produtos.id')
          		->select('produtos.name','vendas_temp_mesa.quantidade','produtos_entradas.preco_final','vendas_temp_mesa.id','vendas_temp_mesa.identificador_de_bulk')
          		->orderBy('vendas_temp_mesa.created_at')
          		->get(); 
        $mesa=Mesa::find($mesa_id);  		           

         return view('vendas.index', compact('produtos','mesa_id','data_mesa','mesa'));           
    }

    public function  saveselection(Request $request)
    {
    	if($request->ajax())
        {
        	$request->except('_token');	
        	$data=$request->all();
        	$identificador_de_bulk='mesa'.'_'.time();
        	$mesa_id=$data['mesa_id'];

        	$mesa=Mesa::find($mesa_id);
        	$mesa->status=0;
        	$mesa->save();


         
          	foreach ($data['dados'] as $key => $value) {
          		$user_id = (!Auth::guest()) ? Auth::user()->id : null ;//user_id	          	
	      		$produtos=new VendasTempMesa();
	      		$produtos->user_id=$user_id;
	      		$produtos->produto_id=$value;
	      		$produtos->quantidade=1;
	      		$produtos->identificador_de_bulk=$identificador_de_bulk;
	      		$produtos->mesa_id=$data['mesa_id'];
	      		$produtos->save();
          	}

          	$output="";
          	$data_mesa=VendasTempMesa::where('mesa_id',$data['mesa_id'])->whereNull('codigo_venda')
          		->join('produtos_entradas','vendas_temp_mesa.produto_id','produtos_entradas.id')
          		->join('produtos','produtos_entradas.produto_id','produtos.id')
          		->select('produtos.name','vendas_temp_mesa.quantidade','produtos_entradas.preco_final','vendas_temp_mesa.id','vendas_temp_mesa.identificador_de_bulk')
          		->orderBy('vendas_temp_mesa.created_at')
          		->get();

          	foreach ($data_mesa as $key => $value) {
          		$output.=
          			'<div class="row"><input type="text" id="idbulk" name="idbulk" hidden="true" value="'.$value->identificador_de_bulk.'"><input type="number" id="id[]" name="id[]" hidden="true" value="'.$value->id.'"><input class="form-control" type="text" name="produt" id="produt" style="margin-right: 13px; margin-bottom: 5px;  width: 40%; max-width: 60%" disabled="" value="'.$value->name.'"> <input class="form-control" type="number" name="preco_final[]" id="preco_final[]" style="width: 60px; margin-right: 13px; margin-bottom: 5px" disabled="true" value="'.$value->preco_final.'"><input class="form-control" type="number" name="quantidade[]" id="quantidade[]" style="width: 67px;margin-right: 13px; margin-bottom: 5px" value="'.$value->quantidade.'"><input class="form-control" type="number" name="total[]" id="total[]" style="width: 75px; margin-right: 13px; margin-bottom: 5px"  disabled="true"  value="'.$value->quantidade * $value->preco_final.'"></div>';	
          	}
          	

          

          return response($output);
        }
    }

    public function atualizarvendatemp(Request $request)
    {
    	if($request->ajax())
    	{
    		$request->except('_token');	
        	$data=$request->all();
        	$idbulk=$data['mesa_id'];
        	$quantidade = $data['quantidade'];

        	foreach ($data['id'] as $key => $value) {
          		$user_id = (!Auth::guest()) ? Auth::user()->id : null ;//user_id	          	
	      		$produtos=VendasTempMesa::find($value);
	      		$produtos->user_id=$user_id;
	      		$produtos->quantidade=$quantidade[$key];
	      		$produtos->save();
          	}



        	$output="";
          	$data_mesa=VendasTempMesa::where('mesa_id',$data['mesa_id'])->whereNull('codigo_venda')
          		->join('produtos_entradas','vendas_temp_mesa.produto_id','produtos_entradas.id')
          		->join('produtos','produtos_entradas.produto_id','produtos.id')
          		->select('produtos.name','vendas_temp_mesa.quantidade','produtos_entradas.preco_final','vendas_temp_mesa.id','vendas_temp_mesa.identificador_de_bulk')
          		->orderBy('vendas_temp_mesa.created_at')
          		->get();

          	foreach ($data_mesa as $key => $value) {
          		$output.=
          			'<div class="row"><input type="text" id="idbulk" name="idbulk" hidden="true" value="'.$value->identificador_de_bulk.'"><input type="number" id="id[]" name="id[]" hidden="true" value="'.$value->id.'"><input class="form-control" type="text" name="produt" id="produt" style="margin-right: 13px; margin-bottom: 5px;  width: 40%; max-width: 60%" disabled="" value="'.$value->name.'"> <input class="form-control" type="number" name="preco_final[]" id="preco_final[]" style="width: 60px; margin-right: 13px; margin-bottom: 5px" disabled="true" value="'.$value->preco_final.'"><input class="form-control" type="number" name="quantidade[]" id="quantidade[]" style="width: 67px;margin-right: 13px; margin-bottom: 5px" value="'.$value->quantidade.'"><input class="form-control" type="number" name="total[]" id="total[]" style="width: 75px; margin-right: 13px; margin-bottom: 5px"  disabled="true"  value="'.$value->quantidade * $value->preco_final.'"></div>';
          	}

          	 return response($output);
    	}
    }

    public function listapedidos(Request $request)
    {
      if($request->ajax())
      {
        $request->except('_token'); 
          $data=$request->all();

          $output="";
            $data_mesa=VendasTempMesa::where('mesa_id',$data['mesa_id'])->whereNull('codigo_venda')
              ->join('produtos_entradas','vendas_temp_mesa.produto_id','produtos_entradas.id')
              ->join('produtos','produtos_entradas.produto_id','produtos.id')
              ->select('produtos.name','vendas_temp_mesa.quantidade','produtos_entradas.preco_final','vendas_temp_mesa.id','vendas_temp_mesa.identificador_de_bulk')
              ->orderBy('vendas_temp_mesa.created_at')
              ->get();

            foreach ($data_mesa as $key => $value) {
              $output.=
                       '<tr>
                            <td>'.$value->name.'</td>
                            <td>'.$value->preco_final.'</td>
                            <td>'.$value->quantidade.'</td>
                            <td>'.$value->quantidade * $value->preco_final.'</td>
                        </tr>';
            }

             return response($output);
      }
    }


    public function efectuarpagamento(Request $request)
    {
    	if ($request->ajax()) 
    	{
    		$request->except('_token');	
        	$data=$request->all();
        	$detalhes=$data['detalhes'];
        	$referencia=$data['referencia'];
        	$valor=$data['valor'];
        	$identificador_bulck='pagamento'.'_'.time();
        	$mesa_id=$data['mesa_id'];
        	$porpagar=$data['porpagar'];
        	$pago=$data['pago'];
        	$ppago=$data['ppago'];
        	$_troco=$data['_troco'];

        	foreach ($data['fpagamento'] as $key => $value) {
          		$user_id = (!Auth::guest()) ? Auth::user()->id : null ;//user_id	          	
	      		$vendas= new Vendas();
	      		$vendas->user_id=$user_id;
	      		$vendas->mesa_id=$mesa_id;
	      		$vendas->fpagamento=$value;
	      		$vendas->detalhes=$detalhes[$key];
	      		$vendas->referencia=$referencia[$key];
	      		$vendas->valor=$valor[$key];
	      		$vendas->identificador_bulck=$identificador_bulck;
	      		$vendas->save();




	      		VendasTempMesa::where('mesa_id',$mesa_id)->whereNull('codigo_venda')->update(['codigo_venda'=>$identificador_bulck]);

          	}

          		$troco=new VendasTroco();
          		$troco->user_id=$user_id;
          		$troco->codigo_venda=$identificador_bulck;
          		$troco->mesa_id=$mesa_id;
          		$troco->total_venda=$porpagar;
          		$troco->total_pago=$pago;
          		$troco->total_porpagar=$ppago;
          		$troco->total_troco=$_troco;
          		$troco->save();


          		$data_mesa=VendasTempMesa::where('mesa_id',$data['mesa_id'])->where('codigo_venda',$identificador_bulck)
          		->join('produtos_entradas','vendas_temp_mesa.produto_id','produtos_entradas.id')
          		->join('produtos','produtos_entradas.produto_id','produtos.id')
          		->select('produtos.name','vendas_temp_mesa.quantidade as quantidade_unidade','produtos_entradas.produto_id','produtos_entradas.id as lot_id','produtos_entradas.preco_final as preco_uni','vendas_temp_mesa.id','vendas_temp_mesa.identificador_de_bulk')
          		->orderBy('vendas_temp_mesa.created_at')
          		->get();

          		foreach ($data_mesa as $key => $value) {

	          		$ajuste=new Ajustes;
	          		$ajuste->produto_id=$value->produto_id;
	          		$ajuste->lot_id=$value->lot_id;
	          		$ajuste->quantidade_unidade=$value->quantidade_unidade;
	          		$ajuste->tipo="venda";
	          		$ajuste->idusuario=$user_id;
	          		$ajuste->decricao=$identificador_bulck;
	          		$ajuste->preco_uni=$value->preco_uni;
	          		$ajuste->save();
          		}

              $mesa=Mesa::find($mesa_id);
              $mesa->status=1;
              $mesa->save();





    		
    	}
    }

}
