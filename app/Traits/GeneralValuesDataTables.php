<?php

namespace App\Traits;
use Yajra\DataTables\Html\Builder;

trait GeneralValuesDataTables
{
    private static $instance;

    /**
     * Metodo que devuelve los valores por defecto de las DataTables
     *
     * @param Builder $builder
     * @param array $dataTable
     * @return Builder
     */

    public static function getDefaultValues(Builder $builder, $dataTable = array()) : Builder
    {
        return $builder->lengthChange(true)
            ->processing(true)
            ->lengthChange(true)
            ->pagingType("full_numbers")
            ->dom('<\'row rowButtons\'<\'col-sm-12\'<\'text-center bg-body-light py-2 mb-2\'B>>> <\'row rowColVis\'<\'col-sm-12\' <\'text-center bg-body-light divBtnsColVis\'>>> <\'row\'<\'col-sm-12 col-md-6\'l><\'col-sm-12 col-md-6\'f>><\'row table-responsive-sm table-responsive-md table-responsive-lg\'<\'col-sm-12\'tr>><\'row\'<\'col-sm-12 col-md-5 text-break\'i><\'col-sm-12 col-md-7\'p>>')
            ->stateSave(true)
            ->responsive([
                'details' => [
                    //'display' => '$.fn.dataTable.Responsive.display.childRowImmediate'
                ]
            ])
            ->stateSave(true)
            ->fixedColumns(true)
            ->colReorder([
                "realtime" => false
            ])
            ->lengthMenu([
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Todos"]
            ])
            ->language([
                'url' => asset('js/custom/Spanish.json'),
            ])
            ->parameters([
                'initComplete' => "function (settings, json) {
                        $('.divBtnsColVis').prepend(\"<div id='groupColVis' class='btn-group-sm push mb-1' role='group'></div>\");
                        var table = this.api();
                        var nColumns = table.settings().init().columns;

                        if (table.button('.buttons-columnVisibility').length > 0) {
                            let \$colVisButtonCollectionContainer = $(table.button('.buttons-columnVisibility').node()).parent();
                            \$colVisButtonCollectionContainer.children('[data-cv-idx]').each(function( index ) {
                              $( this ).addClass( \"btn btn-outline-primary\" );
                            }).appendTo(\"#groupColVis\");
                        }

                        table.columns().every(function (index) {
                            if(nColumns[index].searchable){
                                var column = this;
                                var input = document.createElement('input');
                                $(input).addClass('form-control form-control-sm').attr('placeholder', 'Buscar '+nColumns[index].title).attr('type', 'search');
                                $(input).appendTo($(column.footer()).empty())
                                .on('change clear', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            }
                        });

                        if (table.buttons('.button-action').length > 0) {
                            table.buttons('.button-action').nodes().attr('data-toggle', 'tooltip').attr('data-animation', 'true');
                        }

                    }",
                'buttons' => [
                    //['extend' => 'colvis', 'background' => false, 'className' => 'btn btn-primary dropdown-toggle'],
                    //['extend' => 'columnVisibility', 'text'=> 'Show all', 'className' => 'btn btn-hero-sm btn-hero-primary', 'visibility' => true],
                    //['extend' => 'collection', 'text'=> 'Export', 'background' => false, 'buttons' => [ 'csv', 'excel', 'pdf' ]],
                    /*[   'extend' => 'colvis',
                        'columnsToggle',
                        'text' => "<button class='btn btn-default' id='btnColvis' style='margin-right:0px !important;background-color:inherit;'>Columnas<span class='fa fa-caret-down' aria-hidden='true' style='margin-bottom:3px;'></span></button>",
                        'columns' => ':not(.noVis)',
                        'background' => false],*/

                    ['key' => [ 'shiftKey' => 'true', 'key' => 'n'], 'className' => 'btn btn-hero-sm btn-hero-info button-action', 'titleAttr' => 'Crear un '.$dataTable->get('nameSingularModel').' (shift + n)',
                        'text' =>'<i class="fa fa-plus-circle"></i> <u>N</u>uevo', 'action' =>
                        "function ( e, dt, node, config ) {
                                window.location.href = '".$dataTable->get('routeNew')."';
                            }"
                    ],
                    ['extend' => 'copy', 'exportOptions' => ['columns' => ':visible'], 'key' => [ 'shiftKey' => 'true', 'key' => 'c'], 'className' => 'btn btn-hero-sm btn-hero-primary button-action', 'titleAttr' => 'Copiar todos los resultados (shift + c)', 'text' =>'<i class="fa fa-copy"></i> <u>C</u>opiar'],
                    ['extend' => 'excel', 'exportOptions' => ['columns' => ':visible'], 'key' => [ 'shiftKey' => 'true', 'key' => 'x'], 'className' => 'btn btn-hero-sm btn-hero-success button-action', 'titleAttr' => 'Generar archivo Excel \'.xlsx\' (shift + x)', 'text' =>'<i class="fa fa-file-excel"></i> E<u>x</u>cel'],
                    ['extend' => 'csv', 'exportOptions' => ['columns' => ':visible'], 'key' => [ 'shiftKey' => 'true', 'key' => 's'], 'fieldSeparator' => ';', 'className' => 'btn btn-hero-sm btn-hero-info button-action', 'titleAttr' => 'Generar archivo separado por comas (shift + s)', 'text' =>'<i class="fa fa-file-csv"></i> C<u>S</u>V'],
                    ['extend' => 'pdf', 'exportOptions' => ['columns' => ':visible'], 'key' => [ 'shiftKey' => 'true', 'key' => 'd'], 'className' => 'btn btn-hero-sm btn-hero-danger button-action', 'titleAttr' => 'Generar un archivo PDF (shift + d)', 'text' =>'<i class="fa fa-file-pdf"></i> P<u>D</u>F'],
                    ['extend' => 'print', 'exportOptions' => ['columns' => ':visible'], 'key' => [ 'shiftKey' => 'true', 'key' => 'p'], 'className' => 'btn btn-hero-sm btn-hero-warning button-action', 'titleAttr' => 'Generar una vista lista para impresión (shift + p)', 'text' =>'<i class="fa fa-print"></i> <u>P</u>rint'],
                    ['extend' => 'reset', 'key' => [ 'shiftKey' => 'true', 'key' => 'r'], 'className' => 'btn btn-hero-sm btn-hero-secondary button-action', 'titleAttr' => 'Recargar el contenido de la tabla (shift + r)', 'text' =>'<i class="fa fa-sync"></i>'],
                    ['extend' => 'columnToggle', 'key' => [ 'shiftKey' => 'true', 'key' => 'v'], 'className' => 'btn btn-hero-sm btn-hero-primary button-action', 'titleAttr' => 'Mostrar/Ocultar columnas (shift + v)', 'text' => '<i class="fa fa-eye"></i>'],
                    ['extend' => 'columnsToggle'], //Columnas de Visualizacion
                    //['extend' => 'selectAll'],
                    //['extend' => 'pageLength'],
                    //['extend' => 'colvisRestore'],
                    //['extend' => 'columnsVisibility'],
                ],
            ]);

    }
}
