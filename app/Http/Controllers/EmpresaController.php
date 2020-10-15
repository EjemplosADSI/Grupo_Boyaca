<?php

namespace App\Http\Controllers;

use App\DataTables\EmpresaDataTable;
use App\Empresa;
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

class EmpresaController extends Controller
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
     * @param EmpresaDataTable $dataTable
     * @return View
     */
    public function index (EmpresaDataTable $dataTable)
    {
        return $dataTable->render('empresa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create ()
    {
        $empresa = new Empresa();
        return view("empresa.create", compact('empresa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmpresaStoreRequest $request
     * @return RedirectResponse
     */
    public function store (EmpresaStoreRequest $request)
    {
        $validated = $request->validated();
        $empresa = new Empresa($validated);
        if ($empresa->save()) {
            return redirect()->route('empresa.show', $empresa);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  EmpresaDataTable  $dataTable
     * @param  Empresa  $empresa
     * @return Factory|\Illuminate\View\View
     */
    public function show (EmpresaDataTable $dataTable, Empresa $empresa)
    {
        return view('empresa.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Empresa  $empresa
     * @return Factory|\Illuminate\View\View
     */
    public function edit(Empresa $empresa)
    {
        return view('empresa.edit')->with('empresa', $empresa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartamentoStoreRequest $request
     * @param                          $id
     * @return RedirectResponse
     */
    public function update (EmpresaStoreRequest $request, $id)
    {
        $validated = collect($request->validated());
        $empresa = Empresa::findOrFail($id);
        if ($empresa->update($validated->toArray())) {
            return redirect()->route('empresa.show', $empresa);
        }
        return redirect()->route('empresa.update', $id);
    }

    /**
     * Display a statics page
     *
     * @return Application|Factory|\Illuminate\View\View
     */
    public function statistics ()
    {
        $chartRegistros = $this->generateRegistersChart("Empresa", "Empresas");
        $chartEstado = $this->generateEnumChart('Empresa', 'estado', "Estado", 'bar');

        return view('empresa.statistics')->with(compact('chartRegistros', 'chartRegion', 'chartEstado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Empresa  $empresa
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy (Empresa $empresa)
    {
        $empresa->delete();
        return redirect()->route('empresa.index');
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
        $empresa = Empresa::findOrFail($id);
        $empresa->{$input['campo']} = $input['valor'];
        if ($result = $empresa->update()) {
            return response()->json(['status' => 200, 'success' => $result]);
        } else {
            return response()->json(['status' => 500, 'error' => $result]);
        }
    }

}
