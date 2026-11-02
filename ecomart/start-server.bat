@echo off
title EcoMart Server
echo ==========================================
echo Starting EcoMart Sustainable Marketplace...
echo ==========================================
cd /d "%~dp0"
echo Server running at: http://localhost:8000
echo Press Ctrl+C in this window to stop the server.
echo.
start http://localhost:8000
php -S localhost:8000
pause
