<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entradas;
use App\VendasTempMesa;
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
        $data_mesa=VendasTempMesa::where('mesa_id',$mesa_id)
          		->join('produtos_entradas','vendas_temp_mesa.produto_id','produtos_entradas.id')
          		->join('produtos','produtos_entradas.produto_id','produtos.id')
          		->select('produtos.name','vendas_temp_mesa.quantidade','produtos_entradas.preco_final','vendas_temp_mesa.id','vendas_temp_mesa.identificador_de_bulk')
          		->orderBy('vendas_temp_mesa.created_at')
          		->get();            

         return view('vendas.index', compact('produtos','mesa_id','data_mesa'));           
    }

    public function  saveselection(Request $request)
    {
    	if($request->ajax())
        {
        	$request->except('_token');	
        	$data=$request->all();
        	$identificador_de_bulk='mesa'.'_'.time();


         
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
          	$data_mesa=VendasTempMesa::where('mesa_id',$data['mesa_id'])
          		->join('produtos_entradas','vendas_temp_mesa.produto_id','produtos_entradas.id')
          		->join('produtos','produtos_entradas.produto_id','produtos.id')
          		->select('produtos.name','vendas_temp_mesa.quantidade','produtos_entradas.preco_final','vendas_temp_mesa.id','vendas_temp_mesa.identificador_de_bulk')
          		->orderBy('vendas_temp_mesa.created_at')
          		->get();
          	foreach ($data_mesa as $key => $value) {
          		$output.=
          			'<div class="row"><input type="text" id="idbulk" name="idbulk" hidden="true" value="'.$value->identificador_de_bulk.'"><input type="number" id="id[]" name="id[]" hidden="true" value="'.$value->id.'"><input type="text" name="produt" id="produt" style="margin-right: 13px;  width: 40%; max-width: 60%" disabled="" value="'.$value->name.'"> <input  type="number" name="preco_final[]" id="preco_final[]" style="width: 60px; margin-right: 13px" disabled="true" value="'.$value->preco_final.'"><input  type="number" name="quantidade[]" id="quantidade[]" style="width: 67px;margin-right: 13px" value="'.$value->quantidade.'"><input  type="number" name="total[]" id="total[]" style="width: 75px; margin-right: 13px"  disabled="true"  value="'.$value->quantidade * $value->preco_final.'"></div>';	
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
          	$data_mesa=VendasTempMesa::where('mesa_id',$data['mesa_id'])
          		->join('produtos_entradas','vendas_temp_mesa.produto_id','produtos_entradas.id')
          		->join('produtos','produtos_entradas.produto_id','produtos.id')
          		->select('produtos.name','vendas_temp_mesa.quantidade','produtos_entradas.preco_final','vendas_temp_mesa.id','vendas_temp_mesa.identificador_de_bulk')
          		->orderBy('vendas_temp_mesa.created_at')
          		->get();

          	foreach ($data_mesa as $key => $value) {
          		$output.=
          			'<div class="row"><input type="text" id="idbulk" name="idbulk" hidden="true" value="'.$value->identificador_de_bulk.'"><input type="number" id="id[]" name="id[]" hidden="true" value="'.$value->id.'"><input type="text" name="produt" id="produt" style="margin-right: 13px;  width: 40%; max-width: 60%" disabled="" value="'.$value->name.'"> <input  type="number" name="preco_final[]" id="preco_final[]" style="width: 60px; margin-right: 13px" disabled="true" value="'.$value->preco_final.'"><input  type="number" name="quantidade[]" id="quantidade[]" style="width: 67px;margin-right: 13px" value="'.$value->quantidade.'"><input  type="number" name="total[]" id="total[]" style="width: 75px; margin-right: 13px"  disabled="true"  value="'.$value->quantidade * $value->preco_final.'"></div>';
          	}

          	 return response($output);
    	}
    }


}
