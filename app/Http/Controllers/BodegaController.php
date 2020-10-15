<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\DataTables\BodegaDataTable;
use App\Http\Requests\BodegaStoreRequest;
use App\Traits\ChartConfigController;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use View;

class BodegaController extends Controller
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
     * @param BodegaDataTable $dataTable
     * @return View
     */
    public function index (BodegaDataTable $dataTable)
    {
        return $dataTable->render('bodega.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create ()
    {
        $bodega = new Bodega();
        return view("bodega.create", compact('bodega'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BodegaStoreRequest $request
     * @return RedirectResponse
     */
    public function store (BodegaStoreRequest $request)
    {
        $validated = $request->validated();
        $bodega = new Bodega($validated);
        if ($bodega->save()) {
            return redirect()->route('bodega.show', $bodega);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  BodegaDataTable  $dataTable
     * @param  Bodega  $bodega
     * @return Factory|\Illuminate\View\View
     */
    public function show (BodegaDataTable $dataTable, Bodega $bodega)
    {
        return view('bodega.show', compact('bodega'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Bodega  $bodega
     * @return Factory|\Illuminate\View\View
     */
    public function edit(Bodega $bodega)
    {
        return view('bodega.edit')->with('bodega', $bodega);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BodegaStoreRequest $request
     * @param                          $id
     * @return RedirectResponse
     */
    public function update (BodegaStoreRequest $request, $id)
    {
        $validated = collect($request->validated());
        $bodega = Bodega::findOrFail($id);
        if ($bodega->update($validated->toArray())) {
            return redirect()->route('bodega.show', $bodega);
        }
        return redirect()->route('bodega.update', $id);
    }

    /**
     * Display a statics page
     *
     * @return Application|Factory|\Illuminate\View\View
     */
    public function statistics ()
    {
        $chartRegistros = $this->generateRegistersChart("Bodega", "Bodega");
        $chartEstado = $this->generateEnumChart('Bodega', 'estado', "Estado", 'bar');

        return view('bodega.statistics')->with(compact('chartRegistros', 'chartEstado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Bodega  $bodega
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy (Bodega $bodega)
    {
        $bodega->delete();
        return redirect()->route('bodega.index');
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
        $bodega = Bodega::findOrFail($id);
        $bodega->{$input['campo']} = $input['valor'];
        if ($result = $bodega->update()) {
            return response()->json(['status' => 200, 'success' => $result]);
        } else {
            return response()->json(['status' => 500, 'error' => $result]);
        }
    }

}
