<?php

namespace App\Http\Controllers;

use App\Compra;
use App\DataTables\CompraDataTable;
use App\Http\Requests\CompraStoreRequest;
use App\Traits\ChartConfigController;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use View;

class CompraController extends Controller
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
     * @param CompraDataTable $dataTable
     * @return View
     */
    public function index (CompraDataTable $dataTable)
    {
        return $dataTable->render('compra.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create ()
    {
        $compra = new Compra();
        return view("compra.create", compact('compra'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompraStoreRequest $request
     * @return RedirectResponse
     */
    public function store (CompraStoreRequest $request)
    {
        $validated = $request->validated();
        $compra = new Compra($validated);
        if ($compra->save()) {
            return redirect()->route('compra.show', $compra);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  CompraDataTable  $dataTable
     * @param  Compra  $compra
     * @return Factory|\Illuminate\View\View
     */
    public function show (CompraDataTable $dataTable, Compra $compra)
    {
        return $dataTable->render('compra.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Compra  $departamento
     * @return Factory|\Illuminate\View\View
     */
    public function edit (Departamento $departamento)
    {
        return view('departamento.edit')->with('departamento', $departamento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartamentoStoreRequest $request
     * @param                          $id
     * @return RedirectResponse
     */
    public function update (DepartamentoStoreRequest $request, $id)
    {
        $validated = collect($request->validated());
        $departamento = Departamento::findOrFail($id);
        if ($departamento->update($validated->toArray())) {
            return redirect()->route('departamento.show', $departamento);
        }
        return redirect()->route('departamento.update', $id);
    }

    /**
     * Display a statics page
     *
     * @return Application|Factory|\Illuminate\View\View
     */
    public function statistics ()
    {
        $chartRegistros = $this->generateRegistersChart("Departamento", "Departamentos");
        $chartRegion = $this->generateEnumChart('Departamento', 'region', "Region", 'polarArea');
        $chartEstado = $this->generateEnumChart('Departamento', 'estado', "Estado", 'bar');

        return view('departamento.statistics')->with(compact('chartRegistros', 'chartRegion', 'chartEstado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Departamento  $departamento
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy (Departamento $departamento)
    {
        $departamento->delete();
        return redirect()->route('departamento.index');
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
        $departamento = Departamento::findOrFail($id);
        $departamento->{$input['campo']} = $input['valor'];
        if ($result = $departamento->update()) {
            return response()->json(['status' => 200, 'success' => $result]);
        } else {
            return response()->json(['status' => 500, 'error' => $result]);
        }
    }

}
