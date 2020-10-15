<?php

namespace App\Http\Controllers;

use App\Venta;
use Illuminate\Http\Request;
use App\DataTables\VentaDataTable;
use App\Http\Requests\VentaStoreRequest;
use App\Traits\ChartConfigController;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use View;

class VentaController extends Controller
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
     * @param VentaDataTable $dataTable
     * @return View
     */
    public function index (VentaDataTable $dataTable)
    {
        return $dataTable->render('venta.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create ()
    {
        $empresa = new Venta();
        return view("venta.create", compact('venta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VentaStoreRequest $request
     * @return RedirectResponse
     */
    public function store (VentaStoreRequest $request)
    {
        $validated = $request->validated();
        $venta = new Venta($validated);
        if ($venta->save()) {
            return redirect()->route('venta.show', $venta);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  VentaDataTable  $dataTable
     * @param  Venta  $venta
     * @return Factory|\Illuminate\View\View
     */
    public function show (VentaDataTable $dataTable, Venta $venta)
    {
        return view('venta.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Venta  $venta
     * @return Factory|\Illuminate\View\View
     */
    public function edit(Venta $venta)
    {
        return view('venta.edit')->with('venta', $venta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VentaStoreRequest $request
     * @param                          $id
     * @return RedirectResponse
     */
    public function update (VentaStoreRequest $request, $id)
    {
        $validated = collect($request->validated());
        $venta = Venta::findOrFail($id);
        if ($venta->update($validated->toArray())) {
            return redirect()->route('empresa.show', $venta);
        }
        return redirect()->route('venta.update', $id);
    }

    /**
     * Display a statics page
     *
     * @return Application|Factory|\Illuminate\View\View
     */
    public function statistics ()
    {
        $chartRegistros = $this->generateRegistersChart("Venta", "Ventas");
        $chartEstado = $this->generateEnumChart('Venta', 'estado', "Estado", 'bar');
        $chartFormaPago = $this->generateEnumChart('Venta', 'forma_pago', "FormaPago", 'bar');

        return view('venta.statistics')->with(compact('chartRegistros', 'chartFormaPago', 'chartEstado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Venta  $venta
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy (Venta $venta)
    {
        $venta->delete();
        return redirect()->route('venta.index');
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
        $venta = Venta::findOrFail($id);
        $venta->{$input['campo']} = $input['valor'];
        if ($result = $venta->update()) {
            return response()->json(['status' => 200, 'success' => $result]);
        } else {
            return response()->json(['status' => 500, 'error' => $result]);
        }
    }
}
