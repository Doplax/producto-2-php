<?php

namespace App\Helpers;

class ProfileMessageHelper
{

    const EXITO_DATOS = 'exito_datos';
    const EXITO_PASS = 'exito_pass';
    const ERROR_DATOS = 'error_datos';
    const ERROR_BD_PASS = 'error_bd_pass';
    const ERROR_PASS_MISMATCH = 'error_pass_mismatch';
    const ERROR_DESCONOCIDO = 'error_desconocido';

    const ERROR_PASS_SHORT = 'error_pass_short';

    public static function getText(?string $mensaje): string
    {
        return match ($mensaje) {
            self::EXITO_DATOS => '¡Datos personales actualizados con éxito!',
            self::EXITO_PASS => '¡Contraseña actualizada con éxito!',
            self::ERROR_DATOS => 'Error al actualizar los datos personales. Inténtalo de nuevo.',
            self::ERROR_BD_PASS => 'Error al guardar la nueva contraseña en la base de datos.',
            self::ERROR_PASS_MISMATCH => 'Las contraseñas no coinciden o están vacías. Inténtalo de nuevo.',
            self::ERROR_PASS_SHORT => 'Tu contraseña es muy corta. Por favor, usa al menos 8 caracteres.',
            default => '',
        };
    }

    public static function getClaseAlerta(?string $mensaje): string
    {
        return match ($mensaje) {
            self::EXITO_DATOS, 
            self::EXITO_PASS => 'alert-success',
            
            self::ERROR_DATOS, 
            self::ERROR_BD_PASS, 
            self::ERROR_PASS_MISMATCH => 'alert-danger',

            default => '',
        };
    }
}