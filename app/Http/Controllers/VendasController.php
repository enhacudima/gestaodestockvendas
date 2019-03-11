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
          		->select('produtos.name','vendas_temp_mesa.quantidade','produtos_entradas.preco_final','vendas_temp_mesa.id')
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


         
          	foreach ($data['dados'] as $key => $value) {
          		$user_id = (!Auth::guest()) ? Auth::user()->id : null ;//user_id	          	
	      		$produtos=new VendasTempMesa();
	      		$produtos->user_id=$user_id;
	      		$produtos->produto_id=$value;
	      		$produtos->quantidade=1;
	      		$produtos->mesa_id=$data['mesa_id'];
	      		$produtos->save();
          	}

          	$output="";
          	$data_mesa=VendasTempMesa::where('mesa_id',$data['mesa_id'])
          		->join('produtos_entradas','vendas_temp_mesa.produto_id','produtos_entradas.id')
          		->join('produtos','produtos_entradas.produto_id','produtos.id')
          		->select('produtos.name','vendas_temp_mesa.quantidade','produtos_entradas.preco_final','vendas_temp_mesa.id')
          		->orderBy('vendas_temp_mesa.created_at')
          		->get();
          	foreach ($data_mesa as $key => $value) {
          		$output.='<input type="number" name="id[]" hidden="true" value="'.$value->id.'">'.'<input type="text" name="produt" id="produt" style="margin-right: 13px; width: 70%" disabled="" value=" '.$value->name."-".$value->preco_final." Mtn".'">'.'<input  type="number" name="quantidade[]" id="quantidade[]" style="width: 60px" value="'.$value->quantidade.'">';
          	}
          	

          

          return response($output);
        }
    }


}
