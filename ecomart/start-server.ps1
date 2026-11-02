# PowerShell Startup Script for EcoMart
Set-Location -Path $PSScriptRoot
Write-Host "==========================================" -ForegroundColor Green
Write-Host "Starting EcoMart Sustainable Marketplace..." -ForegroundColor Green
Write-Host "==========================================" -ForegroundColor Green
Write-Host "URL: http://localhost:8000" -ForegroundColor Cyan
Write-Host "Press Ctrl + C to stop the server." -ForegroundColor Yellow
Start-Process "http://localhost:8000"
php -S localhost:8000
