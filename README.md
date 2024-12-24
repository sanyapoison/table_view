# Table View Project

Проект представляет собой приложение на Laravel с использованием Vue.js и Element Plus для фронтенда. Запуск осуществляется через Docker Compose с поддержкой SQLite.

---
## **Содержание**
- [Технологии](#технологии)
- [Требования](#требования)
- [Установка и запуск](#установка-и-запуск)
- [Команды для разработки](#команды-для-разработки)
---

## **Технологии**
- **PHP 8.2** (Laravel 11)
- **Vue.js 3** (с Element Plus)
- **SQLite** (для базы данных)
- **Vite** (для сборки фронтенда)
- **Docker Compose** (для контейнеризации)

---

## **Требования**
Перед началом убедитесь, что у вас установлены:
- **Docker** (v20.10 или выше)
- **Docker Compose** (v2.0 или выше)

---

## **Установка и запуск**

### 1. Клонирование репозитория
Клонируйте репозиторий проекта:
```bash
git clone https://github.com/sanyapoison/table_view.git
cd table_view
```

### 2. Создайте файл базы данных SQLite
Убедитесь, что файл базы данных SQLite существует:
```bash
touch database/database.sqlite
```

### 3. Настройка окружения
Создайте файл .env из шаблона:
```bash
cp .env.example .env
```

Обновите файл .env, чтобы указать использование SQLite:
```bash
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
```

### 4. Запуск контейнеров
Запустите проект через Docker Compose:
```bash
docker-compose up -d
```

### 5. Примените миграции и сидеры
После запуска контейнеров выполните миграции и наполнение базы данных:
```bash
docker exec -it laravel_app php artisan migrate --seed
```

---

## **Команды для разработки**
Для запуска приложения используйте:
```bash
docker-compose up -d
```

Если необходимо перезапустить контейнер:
```bash
docker-compose down
docker-compose up -d
```

Чтобы выполнить команды Laravel внутри контейнера
```bash
docker exec -it laravel_app php artisan <command>
```

Установка зависимостей фронтенда
```bash
docker exec -it laravel_app npm install --no-bin-links
```

Сборка ассетов для разработки
```bash
docker exec -it laravel_app npm run dev
```