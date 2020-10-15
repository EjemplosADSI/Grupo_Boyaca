<?php

namespace App\Traits;
use Illuminate\Support\Facades\Schema;

trait GeneralMethodsCommands
{
    private static $instance;

    private $defaultDateColumns = ['created_at', 'updated_at', 'deleted_at', 'email_verified_at'];

    /**
     * Get the columns table to be used or Generate un string con valores
     *
     * @param array $columns
     * @param array $stringReplace
     * @param string $textDummy
     * @param int $indentation
     * @return string
     */

    public function getStubColumns(array $columns, array $stringReplace, string $textDummy, int $indentation = 12) : string
    {
        $stub    = '';
        foreach ($columns as $key => $column) {
            if($column === 'id'){
                $stub  .= str_replace($textDummy, $column, $stringReplace['idTemplate']);
            }elseif ( in_array($column, $this->defaultDateColumns)){
                $stub  .= str_replace($textDummy, $column, $stringReplace['defaultDatesTemplate']);
            }elseif ( $column === 'estado' ){
                $stub  .= str_replace($textDummy, $column, $stringReplace['statusTemplate']);
            }else{
                $stub  .= str_replace($textDummy, $column, $stringReplace['basicTemplate']);
            }

            if ($key < count($columns) - 1) {
                $stub .= PHP_EOL . str_repeat(' ', $indentation);
            }
        }
        return $stub;
    }

    /**
     * Get array columns of a table
     *
     * @param string $tableName
     * @return array
     */
    public function getColumnsTable(string $tableName) : array
    {
        $colSchema = Schema::getColumnListing($tableName);
        return is_array($colSchema) ? $colSchema : explode(',', (string) $colSchema);
    }

    /**
     * Replace DUMMY_TABLE_NAME in stub.
     *
     * @param string $stub
     * @return object
     */
    protected function replaceNameTable(string &$stub) : object
    {
        $stub  = str_replace('DUMMY_TABLE_NAME_LOWER', strtolower($this->option('table')), $stub);
        $stub  = str_replace('DUMMY_TABLE_NAME', $this->option('table'), $stub);

        return $this;
    }

    /**
     * Replace DUMMY_MODEL_NAME in stub.
     *
     * @param string $stub
     * @return object
     */
    protected function replaceModel(string &$stub) : object
    {
        $stub  = str_replace('DUMMY_MODEL_NAME_LOWER', strtolower($this->option('model')), $stub);
        $stub  = str_replace('DUMMY_MODEL_NAME', $this->option('model'), $stub);

        return $this;
    }

}
