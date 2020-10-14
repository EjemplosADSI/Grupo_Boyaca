<?php

namespace App\Enums;
use BenSampo\Enum\Enum;

/**
 * @method static static CC()
 * @method static static CE()
 * @method static static PASAPORTE()
 * @method static static REGISTRO()
 * @method static static TARJETA()
 */
//https://www.datos.gov.co/Salud-y-Protecci-n-Social/General-Tipos-de-documento/shc6-n6i6/data
final class TipoDocumento extends Enum
{
    const CC    = 'Cédula de Ciudadanía';
    const CE    = 'Cédula de Extranjería';
    const PASAPORTE    = 'Pasaporte';
    const REGISTRO    = 'Registro Civil';
    const TARJETA    = 'Tarjeta de Identidad';
}
