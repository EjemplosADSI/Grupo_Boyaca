<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Procesada()
 * @method static static Pendiente()
 */
final class EstadoVenta extends Enum
{
    const Procesada = 'Procesada';
    const Pendiente = 'Pendiente';
}
