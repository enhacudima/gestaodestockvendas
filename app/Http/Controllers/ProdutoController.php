<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;
use App\Entradas;
use App\Ajustes;
use DB;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $produtos=Produtos::get();
        return view('admin.produtos.index',compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();

        Produtos::create($data);

        return back()->with('success','Successfully Added to List');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produtos=Produtos::find($id);
        return view ('admin.produtos.show',compact('produtos'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $produtos=request()->except(['_token']);


        Produtos::where('id',$id)
                ->update($produtos);

        return $this->index()->with('success','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function entradaindex(){
        $produtos=Produtos::all();
        $entradas=Entradas::join('produtos','produtos_entradas.produto_id','produtos.id')
                            ->select('produtos_entradas.*','produtos.name')
                            ->get();
        return view('admin.produtos.entradaindex', compact('produtos','entradas'));
    }

    public function entradastore(Request $request)
    {
        $produto=Produtos::find($request->produto_id);
        $entrada= new Entradas;
        $entrada->produto_id=$request->produto_id;
        $entrada->lot="Produt-Lot-".time();
        $entrada->quantidade=$request->quantidade;
        $entrada->precodecompra=$request->precodecompra;
        $entrada->margem_per=$request->margem_per;
        $entrada->idusuario=$request->idusuario;
        $entrada->quantidade_unitaria=$request->quantidade*$produto->unidadedemedida;
        $entrada->custo_unitario=($request->precodecompra/$request->quantidade/$produto->unidadedemedida);
        $entrada->margem=$entrada->custo_unitario*($request->margem_per/100);
        $entrada->preco_final=$entrada->custo_unitario+$entrada->margem;

       // dd($entrada);
        $entrada->save();

        return back()->with('success','Successfully Added');
    }

    public function ajustindex()
    {
      $produtos=Produtos::all();
      $lot=Entradas::distinct('lot')->get();
      $ajustes=Ajustes::join('produtos','produtos_ajustes.produto_id','produtos.id')
                      ->join('produtos_entradas','produtos_ajustes.lot_id','produtos_entradas.id')
                      ->select('produtos_ajustes.*','produtos_entradas.lot','produtos.name')
                      ->get();
      
      return view('admin.produtos.ajustindex',compact('produtos','lot','ajustes'));  
    }
    public function ajustestore(Request $request)
    {   $data=$request->all();

        Ajustes::create($data);

        return back()->with('success','Successfully Added');
    }
    public function report()
    {   
        $movimentos=Produtos::leftjoin('produtos_entradas_view','produtos.id','produtos_entradas_view.id')
                              ->leftjoin('produtos_ajustes_view','produtos.id','produtos_ajustes_view.id')
                              ->select('produtos.id','produtos.name',DB::raw('Sum(produtos_ajustes_view.total_ajuste) as total_ajuste '),
                                    DB::raw('Sum(produtos_entradas_view.total_entrada) as total_entrada'))
                                ->groupby('produtos.name','produtos.id')
                                ->get();
                     
                            
        return view('admin.Produtos.report',compact('movimentos'));
    }

    public function lotshow($id)
    {   
        $produtos=Entradas::join('produtos','produtos_entradas.produto_id','produtos.id')
                            ->where('produtos_entradas.id',$id)
                            ->select('produtos_entradas.*','produtos.name')
                            ->get();
       
        return view('admin.Produtos.entradashow',compact('produtos'));
    }

    public function loteupdate (Request $request)
    {   
        $produto=Produtos::find($request->produto_id);
        $entrada= new Entradas;
        $quantidade=$entrada->quantidade=$request->quantidade;
        $precodecompra=$entrada->precodecompra=$request->precodecompra;
        $margem_per=$entrada->margem_per=$request->margem_per;
        $idusuario=$entrada->idusuario=$request->idusuario;
        $quantidade_unitaria=$entrada->quantidade_unitaria=$request->quantidade*$produto->unidadedemedida;
        $custo_unitario=$entrada->custo_unitario=($request->precodecompra/$request->quantidade/$produto->unidadedemedida);
        $margem=$entrada->margem=$entrada->custo_unitario*($request->margem_per/100);
        $preco_final=$entrada->preco_final=$entrada->custo_unitario+$entrada->margem;

       


        Entradas::where('id',$request->id)
                ->update(['quantidade'=>$quantidade,
                        'precodecompra'=>$precodecompra,
                        'margem_per'=>$margem_per,
                        'idusuario'=>$idusuario,
                        'quantidade_unitaria'=>$quantidade_unitaria,
                        'custo_unitario'=>$custo_unitario,
                        'margem'=>$margem,
                        'preco_final'=>$preco_final,
                    ]);

        return $this->entradaindex()->with('success','Successfully update');
    }
}
