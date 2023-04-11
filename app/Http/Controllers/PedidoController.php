<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;

/**
 * Class PedidoController
 * @package App\Http\Controllers
 */
class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::paginate();

        return view('pedido.index', compact('pedidos'))
            ->with('i', (request()->input('page', 1) - 1) * $pedidos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pedido = new Pedido();

        $productos= Producto::pluck('nombre','id');
        $productos_precios= Producto::pluck('precio','id');
        return view('pedido.create', compact('pedido','productos','productos_precios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        request()->validate(Pedido::$rules);

        $pedido = Pedido::create($request->all());
         

        $stock = new Pedido();
        $stock -> idproducto = $request -> input('idproducto');
        $stock -> cantidad = $request -> input('cantidad');
        $stock -> precio_unitario = $request -> input('precio_unitario');
        $stock -> precio_total = $request -> input('precio_total');
        $stock -> estatus = $request -> input('estatus');

        $producto_val = Producto::where('id', $stock->idproducto)->first();
        $producto_val->cantidad -= $request->input('cantidad');
        $producto_val->save();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = Pedido::find($id);

        return view('pedido.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Pedido::find($id);
        $productos= Producto::pluck('nombre','id');
        $productos_precios= Producto::pluck('precio','id');

        return view('pedido.edit', compact('pedido','productos','productos_precios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pedido $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        request()->validate(Pedido::$rules);

        
         
        $stock = new Pedido();
        $stock -> idproducto = $request -> input('idproducto');
        $stock -> cantidad = $request -> input('cantidad');
        $stock -> precio_unitario = $request -> input('precio_unitario');
        $stock -> precio_total = $request -> input('precio_total');
        $stock -> estatus = $request -> input('estatus');

        $producto_val = Producto::where('id', $stock->idproducto)->first();
        $producto_val->cantidad += $pedido->cantidad;
        $producto_val->cantidad -= $request->input('cantidad');
        $producto_val->save();
        
        $pedido->update($request->all());

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pedido = Pedido::find($id)->delete();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido deleted successfully');
    }
}