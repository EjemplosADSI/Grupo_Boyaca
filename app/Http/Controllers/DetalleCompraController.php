<?php

namespace App\Http\Controllers;

use App\DataTables\DetalleCompraDataTable;
use App\DataTables\EmpresaDataTable;
use App\DetalleCompra;
use App\Empresa;
use App\Http\Requests\DetalleCompraStoreRequest;
use App\Http\Requests\EmpresaStoreRequest;
use App\Municipio;
use App\Traits\ChartConfigController;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use View;

class DetalleCompraController extends Controller
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
     * @param DetalleCompraDataTable $dataTable
     * @return View
     */
    public function index (DetalleCompraDataTable $dataTable)
    {
        return $dataTable->render('detalle_compra.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create ()
    {
        $detalle_compra = new DetalleCompra();
        return view("detalle_compra.create", compact('detalle_compra'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DetalleCompraStoreRequest $request
     * @return RedirectResponse
     */
    public function store (DetalleCompraStoreRequest $request)
    {
        $validated = $request->validated();
        $detalle_compra = new DetalleCompra($validated);
        if ($detalle_compra->save()) {
            return redirect()->route('detalle_compra.show', $detalle_compra);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  DetalleCompraDataTable  $dataTable
     * @param  DetalleCompra  $detalle_compra
     * @return Factory|\Illuminate\View\View
     */
    public function show (DetalleCompraDataTable $dataTable, DetalleCompra $detalle_compra)
    {
        return view('detalle_compra.show', compact('detalle_compra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  DetalleCompra  $detalle_compra
     * @return Factory|\Illuminate\View\View
     */
    public function edit(DetalleCompra $detalle_compra)
    {
        return view('detalle_compra.edit')->with('detalle_compra', $detalle_compra);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DetalleCompraStoreRequest $request
     * @param                          $id
     * @return RedirectResponse
     */
    public function update (DetalleCompraStoreRequest $request, $id)
    {
        $validated = collect($request->validated());
        $detalle_compra = DetalleCompra::findOrFail($id);
        if ($detalle_compra->update($validated->toArray())) {
            return redirect()->route('detalle_compra.show', $detalle_compra);
        }
        return redirect()->route('detalle_compra.update', $id);
    }

    /**
     * Display a statics page
     *
     * @return Application|Factory|\Illuminate\View\View
     */
    public function statistics ()
    {
        $chartRegistros = $this->generateRegistersChart("DetalleCompra", "DetalleCompras");
        $chartEstado = $this->generateEnumChart('DetalleCompra', 'estado', "Estado", 'bar');

        return view('$detalle_compra.statistics')->with(compact('chartRegistros', 'chartEstado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DetalleCompra  $detalle_compra
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy (DetalleCompra $detalle_compra)
    {
        $detalle_compra->delete();
        return redirect()->route('detalle_compra.index');
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
        $detalle_compra = DetalleCompra::findOrFail($id);
        $detalle_compra->{$input['campo']} = $input['valor'];
        if ($result = $detalle_compra->update()) {
            return response()->json(['status' => 200, 'success' => $result]);
        } else {
            return response()->json(['status' => 500, 'error' => $result]);
        }
    }

}
