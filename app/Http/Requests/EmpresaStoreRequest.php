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

class EmpresaStoreRequest extends FormRequest
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
            'nombre'        => ['required', 'string', 'unique:empresas,nombre,'.$objectId],
            'nit'           => ['required', 'numeric', 'min:0', 'digits_between:8,15'],
            'municipio_id'  => ['required', 'integer', 'exists:municipios,id'],
            'direccion'     => ['required', 'string', 'min:5', 'max:60'],
            'telefono'      => ['required', 'numeric', 'min:0', 'digits_between:5,13'],
            'correoElectronico' => ['required', 'email', 'min:13', 'max:320'],
            'logo'          => ['required', 'string', 'min:0', 'max:80' ],
            'estado'        => ['required', 'string', Rule::in(BasicStatus::getValues())],
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
                    Rule::unique('empresas','id') ];
                break;
            }
            //case 'PUT':
            case 'PATCH':
            {
                $basicValidation['id'] = ['required', 'integer',
                    Rule::unique('empresas', 'id')->ignore($objectId) ];
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
            'nit'           => 'NIT',
            'municipio_id'  => 'Municipio',
            'direccion'     => 'Direccion',
            'telefono'      => 'Telefono',
            'correoElectronico' => 'E-Mail',
            'logo'        => 'Logo',
            'estado'        => 'Estado',
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
            'nit'           => 'trim|escape|digit',
            'municipio_id'  => 'trim|escape|digit',
            'direccion'     => 'trim|escape|capitalize',
            'telefono'      => 'trim|escape|digit',
            'correoElectronico' => 'trim|escape|lowercase',
            'logo'          => 'trim|escape|lowercase',
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
