# Comigest - Windows/XAMPP setup
$ErrorActionPreference = "Stop"

Write-Host "== Comigest setup ==" -ForegroundColor Cyan

if (-not (Test-Path ".env")) {
    Copy-Item ".env.example" ".env"
    Write-Host ".env created from .env.example" -ForegroundColor Green
} else {
    Write-Host ".env already exists; keeping it." -ForegroundColor Yellow
}

New-Item -ItemType Directory -Force -Path "database" | Out-Null
if (-not (Test-Path "database/database.sqlite")) {
    New-Item -ItemType File -Path "database/database.sqlite" | Out-Null
}

php artisan key:generate --force
php artisan optimize:clear
php artisan migrate --seed --force
php artisan storage:link

npm ci
npm run build

Write-Host ""
Write-Host "Setup termine. Lance: php artisan serve" -ForegroundColor Green
Write-Host "Puis ouvre http://127.0.0.1:8000"
