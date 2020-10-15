<?php

namespace App;

use App\Enums\BasicStatus;
use App\Enums\DepartamentoRegion;
use BenSampo\Enum\Traits\CastsEnums;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Departamento
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $nombre
 * @property DepartamentoRegion|null $region
 * @property BasicStatus|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property mixed|null $deleted_at
 * @property-read Collection|Municipio[] $municipios
 * @property-read int|null $municipios_count
 * @method static Builder|Departamento newModelQuery()
 * @method static Builder|Departamento newQuery()
 * @method static Builder|Departamento query()
 * @method static Builder|Departamento whereCreatedAt($value)
 * @method static Builder|Departamento whereEstado($value)
 * @method static Builder|Departamento whereId($value)
 * @method static Builder|Departamento whereNombre($value)
 * @method static Builder|Departamento whereRegion($value)
 * @method static Builder|Departamento whereUpdatedAt($value)
 * @method static Builder|Departamento whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Departamento onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Departamento withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Departamento withoutTrashed()
 */

class Departamento extends Model
{
    public $incrementing = false;

    use SoftDeletes;
    use CastsEnums;

    protected $enumCasts = [
        'region' => DepartamentoRegion::class,
        'estado' => BasicStatus::class,
    ];

    protected $fillable = [
        'id', 'nombre', 'region', 'estado'
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
