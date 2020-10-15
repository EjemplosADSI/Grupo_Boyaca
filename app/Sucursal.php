<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Sucursal
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $nombre
 * @property int $municipio_id
 * @property string $direccion
 * @property int $telefono
 * @property int $jefe_id
 * @property int $empresa_id
  * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property mixed|null $deleted_at
 * @property-read Collection|Municipio[] $municipios
 * @property-read int|null $municipios_count
 * @method static Builder|Sucursal newModelQuery()
 * @method static Builder|Sucursal newQuery()
 * @method static Builder|Sucursal query()
 * @method static Builder|Sucursal whereId($value)
 * @method static Builder|Sucursal whereNombre($value)
 * @method static Builder|Sucursal whereMunicipio($value)
 * @method static Builder|Sucursal whereDireccion($value)
 * @method static Builder|Sucursal whereTelefono($value)
 * @method static Builder|Sucursal whereJefe($value)
 * @method static Builder|Sucursal whereEmpresa($value)
 * @method static Builder|Sucursal whereCreatedAt($value)
 * @method static Builder|Sucursal whereUpdatedAt($value)
 * @method static Builder|Sucursal whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Sucursal onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Sucursal withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Sucursal withoutTrashed()
 */

class Sucursal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'nombre',
        'municipio_id',
        'direccion',
        'telefono',
        'jefe_id',
        'empresa_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function municipios()
    {
        return $this->hasMany('App\Municipio');
    }

    public function jefe()
    {
        return $this->hasMany('App\User');
    }

    public function empresa()
    {
        return $this->hasMany('App\Empresa');
    }

    public function setNombreAttribute ($value){
        $this->attributes['nombre'] = ucfirst($value);
    }

}
