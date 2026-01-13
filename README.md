# TODO API

Простое REST API для управления задачами, реализованное на Laravel 11.

## Технологии
- PHP 8.2+
- Laravel 11
- SQLite
- REST API

## Установка и запуск

### 1. Клонирование репозитория
```bash
git clone <ваш-репозиторий>
cd todo-api
```

### 2. Установка зависимостей
```bash
composer install
```

### 3. Настройка базы данных
```bash
touch database/database.sqlite
```


### 4. Запуск миграций
```bash
php artisan migrate
```


### 5. Запуск сервера
```bash
php artisan serve
```


Сервер запустится по адресу: `http://localhost:8000`

## API Endpoints

Все эндпоинты доступны по префиксу `/api`

### 1. Получить все задачи

GET /api/tasks

**Пример ответа:**

```json
[
    {
        "id": 1,
        "title": "Изучить Laravel",
        "description": "Познакомиться с основами Laravel",
        "status": "in_progress",
        "created_at": "2024-01-05T10:00:00.000000Z",
        "updated_at": "2024-01-05T10:00:00.000000Z"
    }
]
```

### 2. Создать задачу

POST /api/tasks
Content-Type: application/json

```json
{
    "title": "Новая задача",
    "description": "Описание задачи",
    "status": "pending"
}
```

**Поля:**

title (обязательный, строка, min:1, max:255)

description (необязательный, строка)

status (обязательный: pending, in_progress, completed)

**Пример ответа (201 Created):**

```json
{
    "id": 2,
    "title": "Новая задача",
    "description": "Описание задачи",
    "status": "pending",
    "created_at": "2024-01-05T10:30:00.000000Z",
    "updated_at": "2024-01-05T10:30:00.000000Z"
}
```

### 3. Получить задачу по ID

GET /api/tasks/{id}

**Пример ответа:**

```json
{
    "id": 1,
    "title": "Задача 1",
    "description": "Выполнить задачу 1",
    "status": "in_progress",
    "created_at": "2024-01-05T10:00:00.000000Z",
    "updated_at": "2024-01-05T10:00:00.000000Z"
}
```

**Ошибки:**

404 если задача не найдена

### 4. Обновить задачу

PUT /api/tasks/{id}
Content-Type: application/json

```json
{
    "title": "Обновленный заголовок",
    "status": "completed"
}
```

**Поля (все необязательные для частичного обновления):**

title (строка, min:1, max:255)

description (строка)

status (pending, in_progress, completed)

### 5. Удалить задачу

DELETE /api/tasks/{id}

**Ответ:** 204 No Content

## Валидация

**API** возвращает ошибки валидации в формате:

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "field_name": ["Error message"]
    }
}
```

## Тестирование
Для тестирования **API** используйте **Postman**, curl или аналогичные инструменты. Не забудьте добавить заголовоки:

Accept: application/json

Content-Type: application/json

## Тестовые данные

Примеры валидных статусов:

pending

in_progress

completed
