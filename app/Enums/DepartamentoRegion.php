<?php
namespace App\Enums;
use BenSampo\Enum\Enum;
/**
 * @method static static Caribe()
 * @method static static Oriente()
 * @method static static Sur()
 * @method static static Cafetero()
 * @method static static Llano()
 * @method static static Pacifico()
 */
final class DepartamentoRegion extends Enum
{
    const Caribe    =   'Caribe';
    const Oriente   =   'Centro Oriente';
    const Sur       =   'Centro Sur';
    const Cafetero  =   'Eje Cafetero - Antioquia';
    const Llano     =   'Llano';
    const Pacifico  =   'Pacífico';
}
