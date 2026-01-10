@echo off
title Instalador de Dependencias del Proyecto
color 0A

echo ==================================================
echo      INSTALADOR AUTOMATICO DE DEPENDENCIAS
echo ==================================================
echo.
echo Este script descargara e instalara todas las librerias necesarias
echo para que el proyecto funcione correctamente (incluido 2FA).
echo.

:: Comprobar si composer esta instalado
where composer >nul 2>nul
if %errorlevel% neq 0 (
    color 0C
    echo [ERROR] Composer no esta instalado o no se encuentra en el PATH.
    echo Por favor, instala Composer desde https://getcomposer.org/
    echo.
    pause
    exit /b
)

echo [INFO] Ejecutando 'composer install'...
echo Esto puede tardar unos minutos dependiendo de tu conexion.
echo.

call composer install --ignore-platform-reqs

if %errorlevel% neq 0 (
    color 0C
    echo.
    echo [ERROR] Ha ocurrido un error durante la instalacion.
    echo Revisa los mensajes anteriores.
) else (
    echo.
    echo [EXITO] Todas las dependencias se han instalado correctamente.
    echo Ya puedes usar el proyecto.
)

echo.
pause
