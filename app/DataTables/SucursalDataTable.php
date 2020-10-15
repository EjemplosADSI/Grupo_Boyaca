<?php

namespace App\DataTables;

use App\Empresa;
use App\Municipio;
use App\Sucursal;
use App\Traits\GeneralConfigExcelDataTables;
use App\Traits\GeneralValuesDataTables;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

//use Maatwebsite\Excel\Facades\Excel;
//use Maatwebsite\Excel\Facades\Excel;

class SucursalDataTable extends DataTable implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    use GeneralValuesDataTables;
    use GeneralConfigExcelDataTables;

    public $defaultProperties;
    public $queryBuilder = null;

    /**
     * SucursalDataTable constructor.
     */
    public function __construct()
    {
        $this->defaultProperties = collect([
            'namePluralModel' => 'Sucursales',
            'nameSingularModel' => 'Sucursal',
            'routeNew' => route('sucursal.create')
        ]);
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract|DataTables
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($sucursal) {
                return
                    '<a role="button" href="'.route('sucursal.edit', [$sucursal->id]).'" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-animation="true" data-placement="top" title="Editar"><i class="fas fa-user-edit"></i></a>
                    <a role="button" href="'.route('sucursal.show', [$sucursal->id]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-animation="true" data-placement="top" title="Ver"><i class="fas fa-eye"></i></a>';
            })

            ->addColumn('municipio', function (Municipio $municipio) {
                return '<a class="badge badge-info" href="'.route('municipio.show', [$municipio->id]).'" data-toggle="tooltip" data-animation="true" data-placement="top" title="Ver">'.$municipio->nombre.'</a>';
            })

            ->addColumn('jefe_id', function (User $user) {
                return '<a class="badge badge-info" href="'.route('user.show', [$user->id]).'" data-toggle="tooltip" data-animation="true" data-placement="top" title="Ver">'.$user->nombre.'</a>';
            })

            ->addColumn('empresa', function (Empresa $empresa) {
                return '<a class="badge badge-info" href="'.route('empresa.show', [$empresa->id]).'" data-toggle="tooltip" data-animation="true" data-placement="top" title="Ver">'.$empresa->nombre.'</a>';
            })


            ->rawColumns(['action','municipio','jefe_id', 'estado']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Sucursal  $model
     * @return Builder
     */
    public function query(Sucursal $model)
    {
        if($this->queryBuilder != null){
            return $this->queryBuilder;
        }else{
            return $model->newQuery();
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return GeneralValuesDataTables::getDefaultValues($this->builder(), $this->defaultProperties)
            ->setTableId($this->defaultProperties['namePluralModel'].'-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->addClass('text-center')   ->name('action')
                ->title('Acciones')        ->render(null)
                ->orderable(false)          ->searchable(false)
                ->exportable(false)         ->printable(false)
                ->footer('Acciones'),
            Column::make('id')
                ->title('#')
                ->addClass('d-none d-md-table-cell text-center'),
            Column::make('nombre')->addClass('text-break'),
            Column::computed('municipio')
                ->addClass('text-center')->name('municipio.nombre')
                ->title('Municipio')->searchable(true)
                ->orderable(true)->printable(true)
                ->exportable(true)->render(null),
            Column::make('direccion')->addClass('text-break'),
            Column::make('telefono')->addClass('text-break'),
            Column::computed('jefe_id')
                ->addClass('text-center')->name('jefe_id.nombre')
                ->title('Jefe')->searchable(true)
                ->orderable(true)->printable(true)
                ->exportable(true)->render(null),
            Column::computed('empresa_id')
                ->addClass('text-center')->name('empresa_id.nombre')
                ->title('Empresa')->searchable(true)
                ->orderable(true)->printable(true)
                ->exportable(true)->render(null),
            Column::computed('estado')->addClass('text-break text-center d-md-table-cell')
                ->name('estado')->searchable(true)
                ->orderable(true)->printable(true)
                ->exportable(true)->render(null),
            Column::make('created_at')->title('Creado')->addClass('d-none d-md-table-cell'),
            Column::make('updated_at')->title('Actualizado')->addClass('d-none d-md-table-cell'),
        ];
    }

    /**
     * Export results to Excel file.
     *
     * @return \Maatwebsite\Excel\BinaryFileResponse|BinaryFileResponse
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws Exception
     */
    public function excel()
    {
        $ext = '.' . strtolower($this->excelWriter);
        return Excel::download(new SucursalDataTable(), $this->getFilename() . $ext, $this->excelWriter);
    }

    /**
     * @return View
     */
    public function view(): View
    {
        $dataForExport = collect($this->getDataForExport());
        return view('vendor.datatables.excel', compact('dataForExport'))->with('DefaultProperties', $this->defaultProperties);
    }

    /**
     * Display printable view of datatables.
     *
     * @return View
     */
    public function printPreview()
    {
        $data = $this->getDataForPrint();
        return view($this->printPreview, compact('data'))->with('DefaultProperties', $this->defaultProperties);
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeExport::class => function(BeforeExport $event) { $this->getDefaultBeforeExport($event, $this->defaultProperties); },
            AfterSheet::class => function(AfterSheet $event) { $this->getDefaultAfterSheet($event, $this->getDataForExport()); }
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return "Lista de ".$this->defaultProperties->get('namePluralModel');
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return config('app.name').'_'.$this->defaultProperties->get('namePluralModel').'_' . date('YmdHis');
    }
}
