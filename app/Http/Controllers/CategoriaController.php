<?php

namespace App\Http\Controllers;


use App\DataTables\CategoriaDataTable;
use App\Categoria;
use App\Http\Requests\CategoriaStoreRequest;

use App\Traits\ChartConfigController;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use View;


class CategoriaController extends Controller
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
     * @param CategoriaDataTable $dataTable
     * @return View
     */
    public function index (CategoriaDataTable $dataTable)
    {
        return $dataTable->render('categoria.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create ()
    {
        $categoria = new Categoria();
        return view("categoria.create", compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoriaStoreRequest $request
     * @return RedirectResponse
     */
    public function store (CategoriaStoreRequest $request)
    {
        $validated = $request->validated();
        $categoria = new Categoria($validated);
        if ($categoria->save()) {
            return redirect()->route('categoria.show', $categoria);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  CategoriaDataTable  $dataTable
     * @param  Categoria  $categoria
     * @return Factory|\Illuminate\View\View
     */
    public function show (CategoriaDataTable $dataTable, Categoria $categoria)
    {
        return view('categoria.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Categoria  $categoria
     * @return Factory|\Illuminate\View\View
     */
    public function edit(Categoria $categoria)
    {
        return view('categoria.edit')->with('categoria', $categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoriaStoreRequest $request
     * @param                          $id
     * @return RedirectResponse
     */
    public function update (CategoriaStoreRequest $request, $id)
    {
        $validated = collect($request->validated());
        $categoria = Categoria::findOrFail($id);
        if ($categoria->update($validated->toArray())) {
            return redirect()->route('categoria.show', $categoria);
        }
        return redirect()->route('categoria.update', $id);
    }

    /**
     * Display a statics page
     *
     * @return Application|Factory|\Illuminate\View\View
     */
    public function statistics ()
    {
        $chartRegistros = $this->generateRegistersChart("Categoria", "Categorias");
        $chartEstado = $this->generateEnumChart('Categoria', 'estado', "Estado", 'bar');

        return view('categoria.statistics')->with(compact('chartRegistros', 'chartRegion', 'chartEstado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Categoria  $categoria
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy (Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categoria.index');
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
        $categoria = Categoria::findOrFail($id);
        $categoria->{$input['campo']} = $input['valor'];
        if ($result = $categoria->update()) {
            return response()->json(['status' => 200, 'success' => $result]);
        } else {
            return response()->json(['status' => 500, 'error' => $result]);
        }
    }

}
