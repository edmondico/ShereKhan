# Cambiar a la ruta del proyecto si no estás ya en ella
Set-Location -Path "C:\xampp\htdocs\ShereKhan"

# Añadir cambios
git add .

# Hacer commit con una descripción automática basada en la fecha y hora
$commitMessage = "Automated commit on $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')"
git commit -m $commitMessage

# Enviar cambios al repositorio remoto
git push origin master
