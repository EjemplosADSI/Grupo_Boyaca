<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;

trait GeneralConfigExcelDataTables
{
    private static $instance;

    /**
     * Establece propiedades por defecto despues de crear la hoja
     *
     * @param AfterSheet $event
     * @param array $DataForExport
     * @return void
     */
    public function getDefaultAfterSheet (AfterSheet $event, array $DataForExport) : void
    {
        $range = $this->getCollectionSizeData($DataForExport);
        $event->sheet->getPageSetup()->setFitToPage(true);
        $event->sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $event->sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_LETTER);
        $event->sheet->getPageSetup()->setHorizontalCentered(true);
        $event->sheet->getPageSetup()->setVerticalCentered(true);
        $event->sheet->setAutoFilter($range->get('range'));

        $event->sheet->styleCells(
            $range->get('range'),
            [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ]
            ]
        );
    }

    /**
     * Devuelve un collect con el conteo, num Column, Num Letter y rango de los datos
     *
     * @param array $DataForExport
     * @param string $initCord
     * @return Collection
     */
    public function getCollectionSizeData(array $DataForExport, string $initCord = "A3") : Collection
    {
        $sizeData = collect();
        $sizeData['rows'] = count($DataForExport);
        $sizeData['columnNumber'] = \BoyacaHelper::getNumKeysArrOfArr($DataForExport);
        $sizeData['columnLetter'] = \BoyacaHelper::getLetterFromNumber($sizeData->get('columnNumber'));
        $sizeData['range'] = $initCord.":".$sizeData->get('columnLetter')."".($sizeData->get('rows')+(substr($initCord, -1)));
        return $sizeData;
    }

    /**
     * Establece propiedades por defecto antes de crear la hoja
     *
     * @param BeforeExport $event
     * @param Collection $DefaultProperties
     * @return void
     */
    public function getDefaultBeforeExport (BeforeExport $event, Collection $DefaultProperties) : void
    {
        $event->writer->getProperties()->setCreator(config('app.name'));
        $event->writer->getProperties()->setTitle('Reporte '.$DefaultProperties->get('namePluralModel'));
    }

}
