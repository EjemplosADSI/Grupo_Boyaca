<?php

namespace App;

use App\Enums\BasicStatus;
use BenSampo\Enum\Traits\CastsEnums;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Municipio
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $nombre
 * @property int $departamento_id
 * @property string|null $acortado
 * @property BasicStatus|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property mixed|null $deleted_at
 * @property-read Departamento $departamento
 * @method static Builder|Municipio newModelQuery()
 * @method static Builder|Municipio newQuery()
 * @method static Builder|Municipio query()
 * @method static Builder|Municipio whereAcortado($value)
 * @method static Builder|Municipio whereCreatedAt($value)
 * @method static Builder|Municipio whereDepartamento($value)
 * @method static Builder|Municipio whereEstado($value)
 * @method static Builder|Municipio whereId($value)
 * @method static Builder|Municipio whereNombre($value)
 * @method static Builder|Municipio whereUpdatedAt($value)
 * @method static Builder|Municipio whereDepartamentoId($value)
 * @method static Builder|Municipio whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Municipio onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Municipio withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Municipio withoutTrashed()
 */

class Municipio extends Model
{
    public $incrementing = false;

    use CastsEnums;
    use SoftDeletes;

    protected $with = ['departamento:id,nombre']; //

    protected $enumCasts = [
        // 'attribute_name' => Enum::class
        'estado' => BasicStatus::class,
    ];

    protected $fillable = [
        'id', 'nombre', 'departamento_id', 'acortado', 'estado'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function departamento()
    {
        return $this->belongsTo('App\Departamento','departamento_id','id');
    }

}
