<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Producto
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $nombre
 * @property int $categoria_id
 * @property string $referencia_fabrica
  * @property int $codigo_barras
 * @property string $unidad_medida
 * @property string $descripcion
 * @property int $stock
 * @property int $iva
 * @property double $precio
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property mixed|null $deleted_at
 *
 * @property-read Collection|Categoria[] $categorias

 * @method static Builder|Producto newModelQuery()
 * @method static Builder|Producto newQuery()
 * @method static Builder|Producto query()
 * @method static Builder|Producto whereId($value)
 * @method static Builder|Producto whereNombre($value)
 * @method static Builder|Producto whereCategoriaId($value)
 * @method static Builder|Producto whereReferenciaFabrica($value)
 * @method static Builder|Producto whereCodigoBarras($value)
 * @method static Builder|Producto whereUnidadMedida($value)
 * @method static Builder|Producto whereDescripcion($value)
 * @method static Builder|Producto whereStock($value)
 * @method static Builder|Producto whereIva($value)
 * @method static Builder|Producto wherePrecio($value)
 * @method static Builder|Empresa whereCreatedAt($value)
 * @method static Builder|Producto whereUpdatedAt($value)
 * @method static Builder|Producto whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Producto onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Producto withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Producto withoutTrashed()
 */

class Producto extends Model
{
    use SoftDeletes;



    protected $fillable = [
        'id',
        'nombre',
        'categoria_id',
        'referencia_fabrica',
        'codigo_barras',
        'unidad_medida',
        'descripcion',
        'stock',
        'iva',
        'precio'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function categorias()
    {
        return $this->hasMany('App\Categoria');
    }

    public function setNombreAttribute ($value){
        $this->attributes['nombre'] = strtoupper($value);
    }

}
