<?php

namespace App\Http\Requests;

use App\Enums\EstadoVenta;
use App\Enums\FormaPago;
use App\Traits\GeneralMethodsStoreRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Waavi\Sanitizer\Laravel\SanitizesInput;

/**
 * @property mixed id
 */

class VentaStoreRequest extends FormRequest
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
            'id'                => ['required', 'integer'],
            'fecha'             => ['required', 'date', 'date_format:Y-m-d', 'before:'.Carbon::now()->subDays(365)],
            'valor_total'       => ['required', 'numeric'],
            'cliente_id'        => ['required', 'integer', 'exists:users,id'],
            'vendedor_id'       => ['required', 'integer', 'exists:users,id'],
            'sucursal_id'       => ['required', 'integer', 'exists:sucursales,id'],
            'forma_pago'        => ['required', 'string', Rule::in(FormaPago::getValues())],
            'estado'            => ['required', 'string', Rule::in(EstadoVenta::getValues())],
            'created_at'        => 'nullable|date',
            'updated_at'        => 'nullable|date',
            'deleted_at'        => 'nullable|date'
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
                    Rule::unique('ventas','id') ];
                break;
            }
            //case 'PUT':
            case 'PATCH':
            {
                $basicValidation['id'] = ['required', 'integer',
                    Rule::unique('ventas', 'id')->ignore($objectId) ];
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
            'id'         => 'Id',
            'fecha'      => 'fecha',
            'Valor_total'=> 'Valor Total',
            'cliente_id' => 'Cliente',
            'vendedor_id'=> 'Vendedor',
            'sucursal_id'=> 'Sucursal',
            'forma_pago' => 'Forma de Pago',
            'estado'     => 'Estado',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado'
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
            'id'          => 'trim|escape',
            'fecha'       => 'trim|escape',
            'valor_total' => 'trim|escape|digit',
            'cliente_id'  => 'trim|escape|digit',
            'vendedor_id' => 'trim|escape|digit',
            'sucursal_id' => 'trim|escape|digit',
            'forma_pago'  => 'trim|escape|capitalize',
            'estado'      => 'trim|escape|capitalize',
            'created_at'  => 'trim|escape',
            'updated_at'  => 'trim|escape'
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
