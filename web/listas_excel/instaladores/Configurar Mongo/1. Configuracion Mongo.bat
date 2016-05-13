@echo off
:: BEGIN

set /p unidad="Ingrese la unidad donde instalo Ampps: "

START "" /wait /b %unidad%":\Ampps\mongodb\bin\mongo.exe" admin "config.js"

:: SLEEP 3

:: END