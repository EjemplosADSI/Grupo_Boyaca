<?php

namespace App\Http\Requests;

use App\Enums\BasicStatus;
use App\Traits\GeneralMethodsStoreRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Waavi\Sanitizer\Laravel\SanitizesInput;

/**
 * @property mixed id
 */

class ProductoStoreRequest extends FormRequest
{

    use SanitizesInput;
    use GeneralMethodsStoreRequest;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return $this->arrayRules($this->method(), $this->id);
    }

    /**
     * Metodo creado para reutilizar las reglas en los controladores de API
     *
     * @param string $method
     * @param int $objectId
     * @return array
     */
    public function arrayRules(string $method, int $objectId) : array
    {
        $basicValidation = [
            'id'            => ['required', 'integer'],
            'nombre'        => ['required', 'string', 'unique:productos,nombre,'.$objectId],
            'categoria_id'  => ['required', 'integer', 'exists:categorias,id'],
            'referencia_fabrica' => ['nullable', 'string', 'min:0', 'max:60' ],
            'codigo_barras' => ['required', 'integer'],
            'unidad_medida' => ['string', 'min:0', 'max:80' ],
            'descripcion'          => ['required', 'string', 'min:0', 'max:80' ],
            'stock'            => ['required', 'integer'],
            'iva'            => ['required', 'integer'],
            'precio'            => ['required', 'double'],
            'created_at'    => 'nullable|date',
            'updated_at'    => 'nullable|date',
            'deleted_at'    => 'nullable|date'
        ];

        switch($method)
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                $basicValidation['id'] = ['required', 'integer',
                    Rule::unique('productos','id') ];
                break;
            }
            //case 'PUT':
            case 'PATCH':
            {
                $basicValidation['id'] = ['required', 'integer',
                    Rule::unique('productos', 'id')->ignore($objectId) ];
                break;
            }
            default:break;
        }

        return $basicValidation;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() : array
    {
        return [
            'id'            => 'Id',
            'nombre'        => 'Nombre',
            'categoria_id'  => 'Categoria',
            'referencia_fabrica'  => 'Referencia Fabrica',
            'codigo_barras'     => 'Código de Barras',
            'unidad_medida'      => 'Unidad de Medida',
            'correoElectronico' => 'E-Mail',
            'descripcion'        => 'Descripción',
            'stock'        => 'Stock',
            'iva'        => 'IVA',
            'precio'        => 'Precio',
            'created_at'    => 'Creado',
            'updated_at'    => 'Actualizado'
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters() : array
    {
        return [
            'id'            => 'trim|escape',
            'nombre'        => 'trim|escape|uppercase',
            'categoria_id'  => 'trim|escape|digit',
            'referencia_fabrica'=> 'trim|escape|uppercase',
            'codigo_barras' => 'trim|escape|digit',
            'unidad_medida'  => 'trim|escape|capitalize',
            'descripcion'    => 'trim|escape|lowercase',
            'stock'          => 'trim|escape|digit',
            'iva'            => 'trim|escape|digit',
            'precio'         => 'trim|escape|digit',
            'created_at'    => 'trim|escape',
            'updated_at'    => 'trim|escape'
        ];
    }

    /**
     * Get the validator instance for the request.
     *
     * @return Validator
     */
    protected function getValidatorInstance() : Validator
    {
        $this->getInputSource()->replace( $this->replaceRouteId($this->all(), $this->path()) );
        return parent::getValidatorInstance();
    }

    /**
     * Metodo que permite manipular los campos depues de ser validados
     * @param  null  $keys
     * @return array
     */
    public function all($keys = null) : array
    {
        return parent::all();
    }

    /**
     * Metodo que permite manipular los campos previamete a ser validados
     */
    protected function prepareForValidation() : void
    {

    }

}
