<?php

namespace App;

use App\Enums\EstadoVenta;
use App\Enums\FormaPago;
use BenSampo\Enum\Traits\CastsEnums;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Venta
 *
 * @mixin Eloquent
 * @property int $id
 * @property Carbon $fecha
 * @property double $valor_total
 * @property int $cliente_id
 * @property string $vendedor_id
 * @property int $sucursal_id
 * @property FormaPago|null $forma_pago
 * @property EstadoVenta|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property mixed|null $deleted_at
 * @property-read Collection|Municipio[] $municipios
 * @property-read int|null $municipios_count
 * @method static Builder|Venta newModelQuery()
 * @method static Builder|Venta newQuery()
 * @method static Builder|Venta query()
 * @method static Builder|Venta whereId($value)
 * @method static Builder|Venta whereFecha($value)
 * @method static Builder|Venta whereValor_total($value)
 * @method static Builder|Venta whereCliente_id($value)
 * @method static Builder|Venta whereVendedor_id($value)
 * @method static Builder|Venta whereSucursal_id($value)
 * @method static Builder|Venta whereForma_pago($value)
 * @method static Builder|Venta whereEstado($value)
 * @method static Builder|Venta whereCreatedAt($value)
 * @method static Builder|Venta whereUpdatedAt($value)
 * @method static Builder|Venta whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Venta onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Venta withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Venta withoutTrashed()
 */

class Venta extends Model
{
    use SoftDeletes;
    use CastsEnums;

    protected $enumCasts = [
        'estado' => EstadoVenta::class,
        'forma_pago' => FormaPago::class
    ];

    protected $fillable = [
        'id',
        'fecha',
        'valor_total',
        'cliente_id',
        'vendedor_id',
        'sucursal_id',
        'forma_pago',
        'estado'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function users()
    {
        return $this->hasMany('App\users');
    }

    public function sucursales()
    {
        return $this->hasMany('App\sucursales');
    }
}
