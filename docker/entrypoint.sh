#!/bin/sh
set -e

cd /var/www/html

echo "🚀 Bắt đầu quá trình khởi động Laravel..."

if [ "$(id -u)" = "0" ]; then
    mkdir -p \
        storage/app/public \
        storage/app/private \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/views \
        storage/framework/testing \
        storage/logs \
        bootstrap/cache

    chown -R www-data:www-data storage bootstrap/cache
fi

if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    DB_PATH="${DB_DATABASE:-/var/www/html/storage/app/database.sqlite}"
    mkdir -p "$(dirname "$DB_PATH")"

    if [ ! -f "$DB_PATH" ]; then
        touch "$DB_PATH"
    fi

    if [ "$(id -u)" = "0" ]; then
        chown www-data:www-data "$DB_PATH" "$(dirname "$DB_PATH")"
    fi
fi

run_artisan() {
    if [ "$(id -u)" = "0" ] && command -v su-exec >/dev/null 2>&1; then
        su-exec www-data "$@"
    else
        "$@"
    fi
}

run_artisan php artisan storage:link --force 2>/dev/null || true
run_artisan php artisan migrate --force

run_artisan php artisan optimize:clear
run_artisan php artisan optimize
run_artisan php artisan view:cache
run_artisan php artisan event:cache
run_artisan php artisan filament:cache-components
run_artisan php artisan filament:optimize

echo "✅ Khởi động hoàn tất!"
