<?php

namespace App\DataTables;


use App\Sucursal;
use App\Traits\GeneralConfigExcelDataTables;
use App\Traits\GeneralValuesDataTables;
use App\User;
use App\Venta;
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

class VentaDataTable extends DataTable implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    use GeneralValuesDataTables;
    use GeneralConfigExcelDataTables;

    public $defaultProperties;
    public $queryBuilder = null;

    /**
     * VentaDataTable constructor.
     */
    public function __construct()
    {
        $this->defaultProperties = collect([
            'namePluralModel' => 'Ventas',
            'nameSingularModel' => 'Venta',
            'routeNew' => route('venta.create')
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
            ->addColumn('action', function ($venta) {
                return
                    '<a role="button" href="'.route('venta.edit', [$venta->id]).'" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-animation="true" data-placement="top" title="Editar"><i class="fas fa-user-edit"></i></a>
                    <a role="button" href="'.route('venta.show', [$venta->id]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-animation="true" data-placement="top" title="Ver"><i class="fas fa-eye"></i></a>';
            })
            ->addColumn('estado', function ($venta) {
                return "<a class='badge btn-change-status ".(($venta->estado == 'Activo') ? "badge-success" : "badge-warning")."' data-item-id='".$venta->id."' data-item-name='".$venta->nombre."' data-item-status='".$venta->estado."' href='#'>$venta->estado</a>";
            })

            ->addColumn('cliente_id', function (User $user) {
                return '<a class="badge badge-info" href="'.route('user.show', [$user->id]).'" data-toggle="tooltip" data-animation="true" data-placement="top" title="Ver">'.$user->nombre.'</a>';
            })
            ->addColumn('vendedor_id', function (User $user) {
                return '<a class="badge badge-info" href="'.route('user.show', [$user->id]).'" data-toggle="tooltip" data-animation="true" data-placement="top" title="Ver">'.$user->nombre.'</a>';
            })

            ->addColumn('sucursal_id', function (Sucursal $sucursal) {
                return '<a class="badge badge-info" href="'.route('sucursal.show', [$sucursal->id]).'" data-toggle="tooltip" data-animation="true" data-placement="top" title="Ver">'.$$sucursal->nombre.'</a>';
            })

            ->rawColumns(['action','cliente_id','vendedor_id','sucursal_id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Venta  $model
     * @return Builder
     */
    public function query(Venta $model)
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

            Column::make('fecha')->addClass('text-break'),
            Column::make('valor_total')->addClass('text-break'),
            Column::computed('cliente_id')
                ->addClass('text-center')->name('user.nombre')
                ->title('user')->searchable(true)
                ->orderable(true)->printable(true)
                ->exportable(true)->render(null),

            Column::computed('vendedor_id')
                ->addClass('text-center')->name('user.nombre')
                ->title('user')->searchable(true)
                ->orderable(true)->printable(true)
                ->exportable(true)->render(null),
            Column::computed('sucursal_id')
                ->addClass('text-center')->name('sucursal.nombre')
                ->title('sucursal')->searchable(true)
                ->orderable(true)->printable(true)
                ->exportable(true)->render(null),
            Column::computed('forma_pago')->addClass('text-break text-center d-md-table-cell')
                ->name('forma_pago')->searchable(true)
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
        return Excel::download(new VentaDataTable(), $this->getFilename() . $ext, $this->excelWriter);
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
