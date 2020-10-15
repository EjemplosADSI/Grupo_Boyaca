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
 * @property double $valor_unitario
 * @property int $cantidad
 * @property int $producto_id
 * @property int $compra_id
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


class DetalleCompra extends Model
{
    public $incrementing = false;

    use SoftDeletes;
    use CastsEnums;

    protected $fillable = [
        'id',
        'valor_unitario',
        'cantidad',
        'producto_id',
        'compra_id',
        'estado'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function producto()
    {
        return $this->hasMany('App\Producto');
    }

    public function Compra()
    {
        return $this->hasMany('App\Compra');
    }

}
