@echo off
title Instalador de Dependencias del Proyecto
color 0A

echo ==================================================
echo      INSTALADOR AUTOMATICO DE DEPENDENCIAS
echo ==================================================
echo.

:: 1. BUSCAR PHP
echo [1/3] Buscando PHP...
set "PHP_CMD=php"
where php >nul 2>nul
if %errorlevel% neq 0 (
    if exist "C:\xampp\php\php.exe" (
        set "PHP_CMD=C:\xampp\php\php.exe"
        echo [INFO] PHP encontrado en C:\xampp\php\php.exe
    ) else (
        color 0C
        echo [ERROR] No se encontro PHP en el sistema ni en XAMPP default.
        echo Necesitas tener XAMPP instalado.
        pause
        exit /b
    )
) else (
    echo [INFO] PHP encontrado en el PATH.
)

:: 2. BUSCAR COMPOSER
echo.
echo [2/3] Buscando Composer...
set "COMPOSER_CMD=composer"
where composer >nul 2>nul
if %errorlevel% neq 0 (
    echo [AVISO] Composer no esta instalado globalmente.
    
    if exist "composer.phar" (
        echo [INFO] Se encontro composer.phar local. Usando version local.
        set "COMPOSER_CMD=%PHP_CMD% composer.phar"
    ) else (
        echo [INFO] Descargando Composer localmente...
        %PHP_CMD% -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
        
        if exist "composer-setup.php" (
            %PHP_CMD% composer-setup.php
            del composer-setup.php
            set "COMPOSER_CMD=%PHP_CMD% composer.phar"
            echo [EXITO] Composer descargado correctamente.
        ) else (
            color 0C
            echo [ERROR] No se pudo descargar el instalador de Composer.
            pause
            exit /b
        )
    )
) else (
    echo [INFO] Composer global encontrado.
)

:: 2.5 VERIFICAR EXTENSION ZIP (Fix para el error de la foto)
echo.
echo [2.5/3] Verificando extension ZIP...
%PHP_CMD% -m | findstr /i "zip" >nul
if %errorlevel% neq 0 (
    echo [AVISO] La extension ZIP no esta habilitada en PHP. Intentando habilitarla...
    
    set "PHP_INI=C:\xampp\php\php.ini"
    if exist "C:\xampp\php\php.ini" (
        powershell -Command "(Get-Content 'C:\xampp\php\php.ini') -replace ';extension=zip', 'extension=zip' | Set-Content 'C:\xampp\php\php.ini'"
        echo [INFO] Se ha intentado habilitar la extension ZIP en C:\xampp\php\php.ini
    ) else (
        echo [ERROR] No se pudo encontrar php.ini para arreglarlo automaticamente.
    )
) else (
    echo [INFO] La extension ZIP esta habilitada.
)

:: 3. INSTALAR DEPENDENCIAS
echo.
echo [3/3] Instalando librerias...
echo Ejecutando: %COMPOSER_CMD% install
echo.

%COMPOSER_CMD% install --ignore-platform-reqs

if %errorlevel% neq 0 (
    color 0C
    echo.
    echo [ERROR] Hubo un error en la instalacion.
) else (
    echo.
    echo [EXITO] Todas las dependencias estan listas.
    echo [INFO] Si se descargo 'composer.phar', puedes borrarlo si quieres,
    echo        pero es util tenerlo para futuras actualizaciones.
)

echo.
pause
