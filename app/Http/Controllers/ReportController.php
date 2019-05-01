<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;
use App\Entradas;
use App\Ajustes;
use DB;
use Carbon\Carbon;
use App\VendasTroco;
use App\User;

class ReportController extends Controller
{
    


        public function reportMovimento()
    {   
        $movimentos=DB::table('produtos_entradas_view')
                            ->join('produtos','produtos_entradas_view.id','produtos.id')
                            ->leftjoin('produtos_ajustes_view','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot')
                            ->select('produtos.id','produtos.name','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot','produtos_entradas_view.entrada_preco',DB::raw('Sum(produtos_ajustes_view.total_ajuste) as total_ajuste '),
                                    DB::raw('Sum(produtos_entradas_view.total_entrada) as total_entrada'))
                            ->groupby('produtos_ajustes_view.lot','produtos.name','produtos.id','produtos_entradas_view.entrada_lot','entrada_preco')
                            ->get();
                     
                            
        return view('report.movimentos.report',compact('movimentos'));
    }

    public function reportMovimentoFilter(Request $request)
    {
    	$data=$request->all();
    	$this->validate($request, [
            'radio'=>'required',
            'inicio'=>'required',
            'fim'=>'required',
            ]);
	  $inicio=Carbon::parse($request->inicio);
      $fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);
      $radio=$request->radio;


    	if ($radio=="movimento") {

    		        $movimentos=DB::table('produtos_entradas_view')
    		        		->whereBetween('produtos_entradas_view.created_at',[$inicio,$fim])
                            ->join('produtos','produtos_entradas_view.id','produtos.id')
                            ->leftjoin('produtos_ajustes_view','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot')
                            ->select('produtos.id','produtos.name','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot','produtos_entradas_view.entrada_preco',DB::raw('Sum(produtos_ajustes_view.total_ajuste) as total_ajuste '),
                                    DB::raw('Sum(produtos_entradas_view.total_entrada) as total_entrada'))
                            ->groupby('produtos_ajustes_view.lot','produtos.name','produtos.id','produtos_entradas_view.entrada_lot','entrada_preco')
                            ->get();
                     
                            
        return view('report.movimentos.report',compact('movimentos'));
    		
    	}elseif ($radio=="ajuste") {
    		    	$movimentos=DB::table('produtos_entradas_view')
    		        		->whereBetween('produtos_ajustes_view.created_at',[$inicio,$fim])
                            ->join('produtos','produtos_entradas_view.id','produtos.id')
                            ->leftjoin('produtos_ajustes_view','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot')
                            ->select('produtos.id','produtos.name','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot','produtos_entradas_view.entrada_preco',DB::raw('Sum(produtos_ajustes_view.total_ajuste) as total_ajuste '),
                                    DB::raw('Sum(produtos_entradas_view.total_entrada) as total_entrada'))
                            ->groupby('produtos_ajustes_view.lot','produtos.name','produtos.id','produtos_entradas_view.entrada_lot','entrada_preco')
                            ->get();
                     
                            
        return view('report.movimentos.report',compact('movimentos'));
    	}

    }



    public function reportInflow()
    {
    	        $movimentos=VendasTroco::join('mesa','venda_troco.mesa_id','mesa.id')
    	        			->join('users','venda_troco.user_id','users.id')
                            ->select('mesa.name as mesa','users.name as username',
                            		DB::raw('Sum(venda_troco.total_venda) as total_venda'),
                                    DB::raw('Sum(venda_troco.total_pago) as total_pago'),
                            		DB::raw('Sum(venda_troco.total_porpagar) as total_porpagar'),
                            		DB::raw('Sum(venda_troco.total_troco) as total_troco'))
                            ->groupby('mesa.name','users.name')
                            ->get();
                     
                         
        return view('report.vendas.inflow',compact('movimentos'));
    }

    public function reportInflowFilter(Request $request)
    {
    	$data=$request->all();
    	$this->validate($request, [
            'inicio'=>'required',
            'fim'=>'required',
            ]);
		  $inicio=Carbon::parse($request->inicio);
	      $fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);



    	        $movimentos=VendasTroco::whereBetween('venda_troco.created_at',[$inicio,$fim])
    	        			->join('mesa','venda_troco.mesa_id','mesa.id')
    	        			->join('users','venda_troco.user_id','users.id')
                            ->select('mesa.name as mesa','users.name as username',
                            		DB::raw('Sum(venda_troco.total_venda) as total_venda'),
                                    DB::raw('Sum(venda_troco.total_pago) as total_pago'),
                            		DB::raw('Sum(venda_troco.total_porpagar) as total_porpagar'),
                            		DB::raw('Sum(venda_troco.total_troco) as total_troco'))
                            ->groupby('mesa.name','users.name')
                            ->get();
                     
                         
        return view('report.vendas.inflow',compact('movimentos'));
    }

        public function reportProdutoVenda()
    {
    	        $movimentos=Ajustes::join('produtos','produtos_ajustes.produto_id','produtos.id')
                            ->select('produtos.name as name','produtos_ajustes.preco_uni as preco',
                            		DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade'))
                            ->groupby('produtos.name','produtos_ajustes.preco_uni')
                            ->get();
                     
                  
        return view('report.vendas.produtos',compact('movimentos'));
    }        


    	public function reportProdutoVendaFilter(Request $request)

    {	
    	$data=$request->all();
    	$this->validate($request, [
            'inicio'=>'required',
            'fim'=>'required',
            'radio' => 'required',
            ]);
		  	$inicio=Carbon::parse($request->inicio);
	      	$fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);
	       	$radio=$request->radio;

	       	if ($radio=="criacao") {
    	        $movimentos=Ajustes::whereBetween('produtos_ajustes.created_at',[$inicio,$fim])
    	        			->join('produtos','produtos_ajustes.produto_id','produtos.id')
                            ->select('produtos.name as name','produtos_ajustes.preco_uni as preco',
                            		DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade'))
                            ->groupby('produtos.name','produtos_ajustes.preco_uni')
                            ->get();
                return view('report.vendas.produtos',compact('movimentos'));            
	       		
	       	}elseif ($radio=="atualizacao") {
	       		$movimentos=Ajustes::whereBetween('produtos_ajustes.updated_at',[$inicio,$fim])
    	        			->join('produtos','produtos_ajustes.produto_id','produtos.id')
                            ->select('produtos.name as name','produtos_ajustes.preco_uni as preco',
                            		DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade'))
                            ->groupby('produtos.name','produtos_ajustes.preco_uni')
                            ->get();

                return view('report.vendas.produtos',compact('movimentos'));
	       	}

                     
                  

    }
            public function reportAuditar()
    {
    			$user=User::get();

    	        $movimentos=Ajustes::join('produtos','produtos_ajustes.produto_id','produtos.id')
                            ->select('produtos.name as name','produtos_ajustes.preco_uni as preco',
                            		DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade'))
                            ->groupby('produtos.name','produtos_ajustes.preco_uni')
                            ->get();
                     
                  
        return view('report.vendas.auditar',compact('movimentos','user'));
    }   


        	public function reportAuditarFilter(Request $request)

    {	
    	$data=$request->all();
    	$this->validate($request, [
            'inicio'=>'required',
            'fim'=>'required',
            'radio' => 'required',
            'agent'=> 'required',
            ]);
		  	$inicio=Carbon::parse($request->inicio);
	      	$fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);
	       	$radio=$request->radio;
	       	$agent=$request->agent;
	       	$user=User::get(); 



	       	if ($radio=="criacao") {
    	        $movimentos=Ajustes::whereBetween('produtos_ajustes.created_at',[$inicio,$fim])
    	        			->where('produtos_ajustes.idusuario',$agent)
    	        			->join('produtos','produtos_ajustes.produto_id','produtos.id')
                            ->select('produtos.name as name','produtos_ajustes.preco_uni as preco',
                            		DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade'))
                            ->groupby('produtos.name','produtos_ajustes.preco_uni')
                            ->get();
                          
                  
	       		return view('report.vendas.auditar',compact('movimentos','user'));
	       	}elseif ($radio=="atualizacao") {
	       		$movimentos=Ajustes::whereBetween('produtos_ajustes.updated_at',[$inicio,$fim])
	       					->where('produtos_ajustes.idusuario',$agent)
    	        			->join('produtos','produtos_ajustes.produto_id','produtos.id')
                            ->select('produtos.name as name','produtos_ajustes.preco_uni as preco',
                            		DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade'))
                            ->groupby('produtos.name','produtos_ajustes.preco_uni')
                            ->get();
                return view('report.vendas.auditar',compact('movimentos','user'));            

               
	       	}

                  
                  
	       	 
    }
}
