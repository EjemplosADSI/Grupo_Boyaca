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
     * @property int $descuento
     * @property int $cantidad
     * @property int $producto_id
     * @property int $venta_id
     * @property EstadoVenta|null $estado
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property mixed|null $deleted_at
     * @property-read Collection|Municipio[] $municipios
     * @property-read int|null $municipios_count
     * @method static Builder|DetalleVenta newModelQuery()
     * @method static Builder|DetalleVenta newQuery()
     * @method static Builder|DetalleVenta query()
     * @method static Builder|DetalleVenta whereId($value)
     * @method static Builder|DetalleVenta whereValor_unitario($value)
     * @method static Builder|DetalleVenta whereDescuento($value)
     * @method static Builder|DetalleVenta whereCantidad($value)
     * @method static Builder|DetalleVenta whereProducto_id($value)
     * @method static Builder|DetalleVenta whereVenta_id($value)
     * @method static Builder|DetalleVenta whereEstado($value)
     * @method static Builder|DetalleVenta whereCreatedAt($value)
     * @method static Builder|DetalleVenta whereUpdatedAt($value)
     * @method static Builder|DetalleVenta whereDeletedAt($value)
     * @method static \Illuminate\Database\Query\Builder|DetalleVenta onlyTrashed()
     * @method static \Illuminate\Database\Query\Builder|DetalleVenta withTrashed()
     * @method static \Illuminate\Database\Query\Builder|DetalleVenta withoutTrashed()
     */

class DetalleVenta extends Model
{
    use SoftDeletes;
    use CastsEnums;

    protected $enumCasts = [
        'estado' => EstadoVenta::class,
    ];

    protected $fillable = [
        'id',
        'valor_unitario',
        'descuento',
        'cantidad',
        'producto_id',
        'venta_id',
        'estado'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function productos()
    {
        return $this->hasMany('App\productos');
    }

    public function ventas()
    {
        return $this->hasMany('App\ventas');
    }
}
