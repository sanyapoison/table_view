FROM php:8.2-cli

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    git \
    sqlite3 \
    libsqlite3-dev \
    cron \
    nodejs \
    npm \
    jq \
    mc \
    htop \
    nano

# Установка PHP-расширений
RUN docker-php-ext-install pdo pdo_sqlite

# Установка Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Установка рабочей директории
WORKDIR /var/www/html

# Копирование файлов приложения
COPY . /var/www/html

# Установка PHP-зависимостей
RUN composer install --optimize-autoloader --no-dev

# Установка npm-зависимостей
RUN npm install && npm run build

# Настройка прав
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Запуск встроенного сервера Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
