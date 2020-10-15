<?php

namespace App\Traits;
use App\Charts\GeneralChart;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait ChartConfigController
{
    private static $instance;

    private $colors;
    private $degradado = '0.3';

    /**
     * Genera el grafico de registros
     *
     * @param string $model
     * @param string $nameDataSet
     * @param string $type
     * @param string $degradado
     * @return GeneralChart
     */

    public function generateRegistersChart(string $model, string $nameDataSet, string $type = 'line', string $degradado = "0.3") : GeneralChart
    {
        $model = 'App\\' . $model;
        $dataChartRegistros = [
            "values" => [
                $model::whereBetween('created_at',[today()->subMonth(1), today()])->count(), //Mes Pasado
                $model::whereBetween('created_at',[today()->subDays(7), today()])->count(), //Semana Pasada
                $model::whereDate('created_at','=',  today())->count(), //Hoy
            ], "labels" => ['Ultimo Mes', 'Ultima Semana', 'Hoy']
        ];
        return $this->generateBasicChart($dataChartRegistros, $nameDataSet, $type, $degradado);
    }

    /**
     * Genera un char basico
     *
     * @param array $dataChar
     * @param string $nameDataSet
     * @param string $type
     * @param string $degradado
     * @return GeneralChart
     */

    public function generateBasicChart(array $dataChar, string $nameDataSet, string $type, string $degradado = "0.3") : GeneralChart
    {
        $this->degradado = $degradado;
        $this->setColors();
        $numElements = count($dataChar["labels"]);
        $randomColors = collect($this->colors->random($numElements));
        $basicChart = new GeneralChart();
        $basicChart->labels($dataChar["labels"]);
        $basicChart->dataset($nameDataSet, $type, $dataChar["values"])->options([
            'backgroundColor' => $randomColors,
            'borderColor' => $randomColors->map(function ($value) {
                return str_replace(", ".$this->degradado, "",$value);
            }),
        ]);
        return $basicChart;
    }

    /**
     * Genera diferentes colores para los graficos
     *
     * @return Collection
     */
    public function setColors() : Collection
    {
        return $this->colors = collect([
            "rgba(38, 70, 83, ".$this->degradado.")", "rgba(255, 99, 132, ".$this->degradado.")",
            "rgba(255, 159, 64, ".$this->degradado.")", "rgba(255, 173, 173, ".$this->degradado.")",
            "rgba(255, 205, 86, ".$this->degradado.")", "rgba(75, 192, 192, ".$this->degradado.")",
            "rgba(54, 162, 235, ".$this->degradado.")", "rgba(202, 255, 191, ".$this->degradado.")",
            "rgba(42, 157, 143, ".$this->degradado.")", "rgba(233, 196, 106, ".$this->degradado.")",
            "rgba(189, 178, 255, ".$this->degradado.")", "rgba(153, 102, 255, ".$this->degradado.")",
            "rgba(231, 111, 81, ".$this->degradado.")", "rgba(201, 203, 207, ".$this->degradado.")",
            "rgba(255, 231, 76, ".$this->degradado.")", "rgba(255, 89, 100, ".$this->degradado.")",
            "rgba(53, 167, 255, ".$this->degradado.")", "rgba(154, 3, 30, ".$this->degradado.")",
            "rgba(251, 139, 36, ".$this->degradado.")", "rgba(227, 100, 20, ".$this->degradado.")",
            "rgba(15, 76, 92, ".$this->degradado.")", "rgba(239, 121, 138, ".$this->degradado.")",
            "rgba(247, 169, 168, ".$this->degradado.")", "rgba(125, 130, 184, ".$this->degradado.")",
            "rgba(97, 63, 117, ".$this->degradado.")", "rgba(229, 195, 209, ".$this->degradado.")",
            "rgba(188, 231, 132, ".$this->degradado.")", "rgba(93, 211, 158, ".$this->degradado.")",
            "rgba(52, 138, 167, ".$this->degradado.")", "rgba(82, 81, 116, ".$this->degradado.")",
            "rgba(81, 59, 86, ".$this->degradado.")", "rgba(255, 89, 94, ".$this->degradado.")",
            "rgba(255, 202, 58, ".$this->degradado.")", "rgba(138, 201, 38, ".$this->degradado.")",
            "rgba(25, 130, 196, ".$this->degradado.")", "rgba(106, 76, 147, ".$this->degradado.")",
        ]);
    }

    /**
     * Genera un grafico en base a un enum
     *
     * @param string $model
     * @param string $nameEnum
     * @param string $nameDataSet
     * @param string $type
     * @param string $degradado
     * @return GeneralChart
     */

    public function generateEnumChart(string $model, string $nameEnum, string $nameDataSet, string $type = 'bar', string $degradado = "0.3") : GeneralChart
    {
        $model = 'App\\' . $model;

        $dataEnum = $model::select($nameEnum, \DB::raw('count('.$nameEnum.') as count'))->groupBy($nameEnum)->get();
        $dataChartEnum = [
            "values" => $dataEnum->map(function ($tmpModel) { return $tmpModel->count; }),
            "labels" => $dataEnum->map(function ($tmpModel) use ($nameEnum) { return $tmpModel->$nameEnum->value; })
        ];
        return $this->generateBasicChart($dataChartEnum,$nameDataSet,$type, $degradado);
    }

    /**
     * Genera un grafico en base a una relacion
     *
     * @param string $model
     * @param string $fieldRelation
     * @param string $modelRelation
     * @param $nameFieldRelation
     * @param string $nameDataSet
     * @param string $type
     * @param string $degradado
     * @return GeneralChart
     */

    public function generateRelationChart(string $model, string $fieldRelation, string $modelRelation, string $nameFieldRelation, string $nameDataSet, string $type = 'bar', string $degradado = "0.3") : GeneralChart
    {
        $model = 'App\\' . $model;

        $dataEnum = $model::select($fieldRelation, \DB::raw( 'count('.$fieldRelation.') as count'))->with($modelRelation)->groupBy($fieldRelation)->get();

        $dataChartEnum = [
            "values" => $dataEnum->map(function ($tmpModel) { return $tmpModel->count; }),
            "labels" => $dataEnum->map(function ($tmpModel) use ($modelRelation, $nameFieldRelation) { return Str::limit($tmpModel->$modelRelation->$nameFieldRelation, $limit = 15, $end = '...');})
        ];
        return $this->generateBasicChart($dataChartEnum,$nameDataSet,$type, $degradado);
    }

}
