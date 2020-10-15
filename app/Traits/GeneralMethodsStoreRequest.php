<?php

namespace App\Traits;

trait GeneralMethodsStoreRequest
{
    private static $instance;

    /**
     * Metodo creado para remplazar la ruta con el ID
     *
     * @param array $data
     * @param string $path
     * @return array
     */
    protected function replaceRouteId(array $data, string $path) : array
    {
        $route = explode("/", $path);
        if (count($route) == 2 and is_numeric($route[1])){
            $data['id'] = $route[1];
        }
        return $data;
    }

}
