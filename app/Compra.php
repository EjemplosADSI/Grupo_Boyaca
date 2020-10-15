<?php

namespace App;

use App\Enums\EstadoCompra;
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
 * @property carbon $fecha
 * @property double $valor_total
 * @property int $proveedor_id
 * @property int $bodega_id
 * @property EstadoCompra|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property mixed|null $deleted_at
 * @method static Builder|Compra newModelQuery()
 * @method static Builder|Compra newQuery()
 * @method static Builder|Compra query()
 * @method static Builder|Compra whereId($value)
 * @method static Builder|Compra whereValor_total($value)
 * @method static Builder|Compra whereProveedor_id($value)
 * @method static Builder|Compra whereBodega_id($value)
 * @method static Builder|Compra whereEstado($value)
 * @method static Builder|Compra whereCreatedAt($value)
 * @method static Builder|Compra whereUpdatedAt($value)
 * @method static Builder|Compra whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Compra onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Compra withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Compra withoutTrashed()
 */


class Compra extends Model
{
    public $incrementing = false;

    use SoftDeletes;
    use CastsEnums;

    protected $fillable = [
        'id',
        'fecha',
        'valor_total',
        'proveedor_id',
        'bodega_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function proveedor()
    {
        return $this->hasMany('App\User');
    }

    public function bodega()
    {
        return $this->hasMany('App\Bodega');
    }

}
