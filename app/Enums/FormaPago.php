<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Efectivo()
 * @method static static Cheque()
 * @method static static Otros()
 */
final class FormaPago extends Enum
{
    const Efectivo = 'Efectivo';
    const Cheque =  'Cheque';
    const otros = 'Otros';
}
