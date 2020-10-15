<?php

namespace App;

use App\Enums\BasicStatus;
use BenSampo\Enum\Traits\CastsEnums;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Bodega
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $nombre
 * @property int $municipio_id
 * @property string $direccion
 * @property int $telefono
 * @property int $jefe_id
 * @property BasicStatus|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property mixed|null $deleted_at
 * @property-read Collection|Municipio[] $municipios
 * @property-read int|null $municipios_count
 * @method static Builder|Empresa newModelQuery()
 * @method static Builder|Empresa newQuery()
 * @method static Builder|Empresa query()
 * @method static Builder|Empresa whereId($value)
 * @method static Builder|Empresa whereNombre($value)
 * @method static Builder|Empresa whereNit($value)
 * @method static Builder|Empresa whereMunicipio($value)
 * @method static Builder|Empresa whereDireccion($value)
 * @method static Builder|Empresa whereTelefono($value)
 * @method static Builder|Sucursal whereJefe($value)
 * @method static Builder|Empresa whereEstado($value)
 * @method static Builder|Empresa whereCreatedAt($value)
 * @method static Builder|Empresa whereUpdatedAt($value)
 * @method static Builder|Empresa whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Empresa onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Empresa withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Empresa withoutTrashed()
 */

class Bodega extends Model
{
    use SoftDeletes;
    use CastsEnums;

    protected $enumCasts = [
        'estado' => BasicStatus::class,
    ];

    protected $fillable = [
        'id',
        'nombre',
        'municipio_id',
        'direccion',
        'telefono',
        'jefe_id',
        'estado'
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

    public function setNombreAttribute ($value){
        $this->attributes['nombre'] = strtoupper($value);
    }

}
