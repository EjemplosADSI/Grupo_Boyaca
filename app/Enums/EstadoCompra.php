<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pendiente()
 * @method static static Recibida()
 */
final class EstadoCompra extends Enum
{
    const Pendiente = 'Pendiente';
    const Recibida = 'Recibida';
}
