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
class MunicipioStoreRequest extends FormRequest
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
            'id'                => ['required', 'integer', 'between:5001,99773'],
            'nombre'            => ['required', 'string', 'unique:municipios,nombre,'.$objectId, 'regex:/^[\pL\s\-]+$/u' ],
            'departamento_id'   => ['required', 'integer', 'exists:departamentos,id', 'between:5,99'],
            'acortado'          => ['nullable', 'string', 'min:3', 'max:40'],
            'estado'            => ['nullable','string', Rule::in(BasicStatus::getValues())],
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
                $basicValidation['id'] = ['required', 'integer', 'between:5001,99773',
                    Rule::unique('municipios','id')];
                break;
            }
            //case 'PUT':
            case 'PATCH':
            {
                $basicValidation['id'] = ['required', 'integer', 'between:5001,99773',
                    Rule::unique('municipios', 'id')->ignore($objectId) ];
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
            'id'                => 'Código DANE',
            'nombre'            => 'Nombre',
            'departamento_id'   => 'Departamento',
            'acortado'          => 'Nombre Acortado',
            'estado'            => 'Estado',
            'created_at'        => 'Creado',
            'updated_at'        => 'Actualizado'
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
            'region'        => 'trim|escape|capitalize',
            'acortado'      => 'trim|escape|capitalize',
            'estado'        => 'trim|escape|capitalize',
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
