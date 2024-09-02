#!/bin/bash

# Cambiar a la ruta del proyecto si no estás ya en ella
cd C:\xampp\htdocs\ShereKhan

# Añadir cambios
git add .

# Hacer commit con una descripción automática basada en la fecha y hora
git commit -m "Automated commit on $(date)"

# Enviar cambios al repositorio remoto
git push origin master
