<?php

namespace App;

use App\Enums\BasicStatus;
use App\Enums\EstadoSucursalBodega;
use App\Enums\FormaPago;
use BenSampo\Enum\Traits\CastsEnums;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\SucursalBodega
 *
 * @mixin Eloquent
 * @property int $id
 * @property int $sucursal_id
 * @property int $bodega_id
 * @property BasicStatus|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property mixed|null $deleted_at
 * @method static Builder|SucursalBodega newModelQuery()
 * @method static Builder|SucursalBodega newQuery()
 * @method static Builder|SucursalBodega query()
 * @method static Builder|SucursalBodega whereId($value)
 * @method static Builder|SucursalBodega whereFecha($value)
 * @method static Builder|SucursalBodega whereValor_total($value)
 * @method static Builder|SucursalBodega whereCliente_id($value)
 * @method static Builder|SucursalBodega whereVendedor_id($value)
 * @method static Builder|SucursalBodega whereSucursal_id($value)
 * @method static Builder|SucursalBodega whereForma_pago($value)
 * @method static Builder|SucursalBodega whereEstado($value)
 * @method static Builder|SucursalBodega whereCreatedAt($value)
 * @method static Builder|SucursalBodega whereUpdatedAt($value)
 * @method static Builder|SucursalBodega whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|SucursalBodega onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|SucursalBodega withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SucursalBodega withoutTrashed()
 */

class SucursalBodega extends Model
{
    use SoftDeletes;
    use CastsEnums;

    protected $enumCasts = [
        'estado' => EstadoSucursalBodega::class,
    ];

    protected $fillable = [
        'id',
        'sucursal_id',
        'bodega_id',
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

