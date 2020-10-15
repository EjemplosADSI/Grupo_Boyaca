<?php

namespace App\Http\Controllers;

use App\DetalleVenta;
use App\Http\Requests\DetalleVentaStoreRequest;
use Illuminate\Http\Request;
use App\DataTables\DetalleVentaDataTable;
use App\Http\Requests\VentaStoreRequest;
use App\Traits\ChartConfigController;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use View;

class DetalleVentaController extends Controller
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
     * @param DetalleVentaDataTable $dataTable
     * @return View
     */
    public function index (DetalleVentaDataTable $dataTable)
    {
        return $dataTable->render('detalle_venta.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create ()
    {
        $empresa = new DetalleVenta();
        return view("detalle_venta.create", compact('detalle_venta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DetalleVentaStoreRequest $request
     * @return RedirectResponse
     */
    public function store (DetalleVentaStoreRequest $request)
    {
        $validated = $request->validated();
        $detalle_venta = new DetalleVenta($validated);
        if ($detalle_venta->save()) {
            return redirect()->route('detalle_venta.show', $detalle_venta);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  DetalleVentaDataTable  $dataTable
     * @param  DetalleVenta  $detalle_venta
     * @return Factory|\Illuminate\View\View
     */
    public function show (DetalleVentaDataTable $dataTable, DetalleVenta $detalle_venta)
    {
        return view('detalle_venta.show', compact('detalle_venta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  DetalleVenta  $detalle_venta
     * @return Factory|\Illuminate\View\View
     */
    public function edit(DetalleVenta $detalle_venta)
    {
        return view('detalle_venta.edit')->with('detalle_venta', $detalle_venta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DetalleVentaStoreRequest $request
     * @param                          $id
     * @return RedirectResponse
     */
    public function update (DetalleVentaStoreRequest $request, $id)
    {
        $validated = collect($request->validated());
        $detalle_venta = DetalleVenta::findOrFail($id);
        if ($detalle_venta->update($validated->toArray())) {
            return redirect()->route('detalle_venta.show', $detalle_venta);
        }
        return redirect()->route('detalle_venta.update', $id);
    }

    /**
     * Display a statics page
     *
     * @return Application|Factory|\Illuminate\View\View
     */
    public function statistics ()
    {
        $chartRegistros = $this->generateRegistersChart("DetalleVenta", "DetalleVentas");
        $chartEstado = $this->generateEnumChart('DetalleVenta', 'estado', "Estado", 'bar');

        return view('detalle_venta.statistics')->with(compact('chartRegistros', 'chartEstado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DetalleVenta  $detalle_venta
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy (DetalleVenta $detalle_venta)
    {
        $detalle_venta->delete();
        return redirect()->route('detalle_venta.index');
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
        $detalle_venta = DetalleVenta::findOrFail($id);
        $detalle_venta->{$input['campo']} = $input['valor'];
        if ($result = $detalle_venta->update()) {
            return response()->json(['status' => 200, 'success' => $result]);
        } else {
            return response()->json(['status' => 500, 'error' => $result]);
        }
    }
}
