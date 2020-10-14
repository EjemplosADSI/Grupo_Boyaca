<?php
namespace App\Enums;
use BenSampo\Enum\Enum;
/**
 * @method static static Activo()
 * @method static static Inactivo()
 */
final class BasicStatus extends Enum
{
    const Activo = 'Activo';
    const Inactivo = 'Inactivo';
}
