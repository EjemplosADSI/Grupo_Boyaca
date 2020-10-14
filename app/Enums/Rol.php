<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Adminisitrador()
 * @method static static Proveedor()
 * @method static static Vendedor()
 * @method static static JefeBodega()
 * @method static static JefeSucursal()
 * @method static static Cliente()
 */
final class Rol extends Enum
{
    const Adminisitrador =   'Adminisitrador';
    const Proveedor =   'Proveedor';
    const Vendedor = 'Vendedor';
    const JefeBodega = 'Jefe Bodega';
    const JefeSucursal = 'Jefe Sucursal';
    const Cliente = 'Cliente';
}
