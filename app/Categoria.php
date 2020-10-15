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
 * App\Empresa
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property BasicStatus|null $estado
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property mixed|null $deleted_at

 * @method static Builder|Categoria newModelQuery()
 * @method static Builder|Categoria newQuery()
 * @method static Builder|Categoria query()
 * @method static Builder|Categoria whereId($value)
 * @method static Builder|Categoria whereNombre($value)
 * @method static Builder|Categoria whereDescripcion($value)
 * @method static Builder|Categoria whereEstado($value)
 * @method static Builder|Categoria whereCreatedAt($value)
 * @method static Builder|Categoria whereUpdatedAt($value)
 * @method static Builder|Categoria whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Categoria onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Categoria withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Categoria withoutTrashed()
 */

class Categoria extends Model
{
    use SoftDeletes;
    use CastsEnums;

    protected $enumCasts = [
        'estado' => BasicStatus::class,
    ];

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'estado'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function setNombreAttribute ($value){
        $this->attributes['nombre'] = strtoupper($value);
    }
}
