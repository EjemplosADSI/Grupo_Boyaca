<?php

namespace App\Http\Controllers;

use App\DataTables\EmpresaDataTable;
use App\DataTables\ProductoDataTable;
use App\Empresa;
use App\Http\Requests\EmpresaStoreRequest;
use App\Http\Requests\ProductoStoreRequest;
use App\Municipio;
use App\Producto;
use App\Traits\ChartConfigController;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use View;

class ProductoController extends Controller
{
    use ChartConfigController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware(['auth', 'verified']);
    }


    /**
     * Display a listing of the resource.
     *
     * @param ProductoDataTable $dataTable
     * @return View
     */
    public function index (ProductoDataTable $dataTable)
    {
        return $dataTable->render('producto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create ()
    {
        $producto = new Producto();
        return view("producto.create", compact('producto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductoStoreRequest $request
     * @return RedirectResponse
     */
    public function store (ProductoStoreRequest $request)
    {
        $validated = $request->validated();
        $producto = new Producto($validated);
        if ($producto->save()) {
            return redirect()->route('producto.show', $producto);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  ProductoDataTable  $dataTable
     * @param  Producto  $producto
     * @return Factory|\Illuminate\View\View
     */
    public function show (ProductoDataTable $dataTable, Producto $producto)
    {
        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Producto  $producto
     * @return Factory|\Illuminate\View\View
     */
    public function edit(Producto $producto)
    {
        return view('producto.edit')->with('producto', $producto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductoStoreRequest $request
     * @param                          $id
     * @return RedirectResponse
     */
    public function update (ProductoStoreRequest $request, $id)
    {
        $validated = collect($request->validated());
        $producto = Producto::findOrFail($id);
        if ($producto->update($validated->toArray())) {
            return redirect()->route('producto.show', $producto);
        }
        return redirect()->route('producto.update', $id);
    }

    /**
     * Display a statics page
     *
     * @return Application|Factory|\Illuminate\View\View
     */

    public function statistics ()
    {
        $chartRegistros = $this->generateRegistersChart("Producto", "Productos");


        return view('producto.statistics')->with(compact('chartRegistros'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Producto  $producto
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy (Empresa $producto)
    {
        $producto->delete();
        return redirect()->route('prodcuto.index');
    }

    /**
     * Guardar por Ajax.
     *
     * @param  Request  $request
     * @param  $id
     * @return JsonResponse
     */
    public function updateDataForAjax (Request $request, $id)
    {
        $input = $request->all();
        $producto = Producto::findOrFail($id);
        $producto->{$input['campo']} = $input['valor'];
        if ($result = $producto->update()) {
            return response()->json(['status' => 200, 'success' => $result]);
        } else {
            return response()->json(['status' => 500, 'error' => $result]);
        }
    }

}
