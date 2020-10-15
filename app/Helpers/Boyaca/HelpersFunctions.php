<?php

namespace App\Helpers\Boyaca;

use DB;
use Illuminate\Support\Arr;
use Iterator;
use League\Csv\Exception;
use League\Csv\Reader;

class HelpersFunctions
{
    /**
     * Retorna la lectura de un archivo en formato csv
     *
     * @param string $fileName
     * @param string $delimiter
     * @param string $path
     * @return Iterator
     * @throws Exception
     */
    public static function getDataFileCVS(string $fileName, string $delimiter = ';', string $path = 'seeds\\') : Iterator
    {
        $csv = Reader::createFromPath(database_path($path.$fileName), 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter($delimiter);

        return $csv->getRecords();
    }

    /**
     * Obtener el numero de claves en un array de arrays
     *
     * @param  array  $arrOfarr
     * @return int
     */
    public static function getNumKeysArrOfArr(array $arrOfarr) : int
    {
        return collect(collect($arrOfarr)->first())->count();
    }

    /**
     * Obtener la cordenada en excel en base a numeros
     *
     * @param int $InitX
     * @param int $InitY
     * @param int $EndX
     * @param int $EndY
     * @return string
     */
    public static function getExcelCoordinates(int $InitX, int $InitY, int $EndX, int $EndY) : string
    {
        return HelpersFunctions::getLetterFromNumber($InitX).$InitY.":".HelpersFunctions::getLetterFromNumber($EndX).$EndY;
    }

    /**
     * Obtener la letra correspondiente a un numero
     *
     * @param int $number
     * @return string
     */
    public static function getLetterFromNumber (int $number ): string
    {
        $alpha = collect(range('A','Z'));
        return $alpha->get($number-1);
    }

    /**
     * Obtener los valores de un campo enum de una tabla en BD
     *
     * @param string $table
     * @param string $column
     * @return array
     */
    public static function getEnumValues(string $table, string $column) : array
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enum = Arr::add($enum, $v, $v);
        }
        return $enum;
    }

}
