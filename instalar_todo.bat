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
if %errorlevel% equ 0 (
    echo [INFO] PHP encontrado en el PATH.
    goto :check_composer
)

if exist "C:\xampp\php\php.exe" (
    set "PHP_CMD=C:\xampp\php\php.exe"
    echo [INFO] PHP encontrado en C:\xampp\php\php.exe
    goto :check_composer
)

:: Si llegamos aqui, no hay PHP. Vamos a descargar la version portable.
echo [AVISO] No se encontro PHP instalado en el sistema.
goto :install_portable_php

:install_portable_php
echo [INFO] Iniciando descarga de PHP Portable (Opcion 3)...
if not exist "bin\php" mkdir "bin\php"

if exist "bin\php\php.exe" (
    echo [INFO] PHP Portable ya existe en bin\php.
    set "PHP_CMD=bin\php\php.exe"
    goto :check_composer
)

echo Descargando PHP 8.2...
powershell -Command "Invoke-WebRequest -Uri 'https://windows.php.net/downloads/releases/php-8.2.30-Win32-vs16-x64.zip' -OutFile 'bin\php.zip'"

if not exist "bin\php.zip" (
    color 0C
    echo [ERROR] No se pudo descargar PHP. Revisa tu conexion.
    pause
    exit /b
)

echo Descomprimiendo PHP...
powershell -Command "Expand-Archive -Path 'bin\php.zip' -DestinationPath 'bin\php' -Force"
del "bin\php.zip"

:: Configurar PHP.INI
echo Configurando php.ini...
copy "bin\php\php.ini-production" "bin\php\php.ini" >nul

powershell -Command "(Get-Content 'bin\php\php.ini') -replace ';extension_dir = \"ext\"', 'extension_dir = \"ext\"' | Set-Content 'bin\php\php.ini'"
powershell -Command "(Get-Content 'bin\php\php.ini') -replace ';extension=zip', 'extension=zip' | Set-Content 'bin\php\php.ini'"
powershell -Command "(Get-Content 'bin\php\php.ini') -replace ';extension=openssl', 'extension=openssl' | Set-Content 'bin\php\php.ini'"
powershell -Command "(Get-Content 'bin\php\php.ini') -replace ';extension=mbstring', 'extension=mbstring' | Set-Content 'bin\php\php.ini'"
powershell -Command "(Get-Content 'bin\php\php.ini') -replace ';extension=fileinfo', 'extension=fileinfo' | Set-Content 'bin\php\php.ini'"
powershell -Command "(Get-Content 'bin\php\php.ini') -replace ';extension=curl', 'extension=curl' | Set-Content 'bin\php\php.ini'"

echo [EXITO] PHP Portable instalado correctamente en bin\php.
set "PHP_CMD=bin\php\php.exe"
goto :check_composer


:check_composer
:: 2. BUSCAR COMPOSER
echo.
echo [2/3] Buscando Composer...
set "COMPOSER_CMD=composer"

where composer >nul 2>nul
if %errorlevel% equ 0 (
    echo [INFO] Composer global encontrado.
    goto :prepare_install
)

echo [AVISO] Composer no esta instalado globalmente.

if exist "composer.phar" (
    echo [INFO] Se encontro composer.phar local. Usando version local.
    set "COMPOSER_CMD=%PHP_CMD% composer.phar"
    goto :prepare_install
)

echo [INFO] Descargando Composer localmente...
"%PHP_CMD%" -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

if not exist "composer-setup.php" (
    color 0C
    echo [ERROR] No se pudo descargar el instalador de Composer.
    pause
    exit /b
)

"%PHP_CMD%" composer-setup.php
del composer-setup.php
set "COMPOSER_CMD=%PHP_CMD% composer.phar"
echo [EXITO] Composer descargado correctamente.


:prepare_install
:: 2.5 VERIFICAR EXTENSION ZIP (Solo si NO usas portable)
echo "%PHP_CMD%" | findstr "bin\php" >nul
if %errorlevel% equ 0 goto :run_install

echo.
echo [2.5/3] Verificando extension ZIP...
"%PHP_CMD%" -m | findstr /i "zip" >nul
if %errorlevel% equ 0 (
    echo [INFO] La extension ZIP esta habilitada.
    goto :run_install
)

echo [AVISO] La extension ZIP no esta habilitada en PHP. Intentando habilitarla...
if exist "C:\xampp\php\php.ini" (
    powershell -Command "(Get-Content 'C:\xampp\php\php.ini') -replace ';extension=zip', 'extension=zip' | Set-Content 'C:\xampp\php\php.ini'"
    echo [INFO] Se ha intentado habilitar la extension ZIP en C:\xampp\php\php.ini
) else (
    echo [ERROR] No se pudo encontrar php.ini para arreglarlo automaticamente.
)


:run_install
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
