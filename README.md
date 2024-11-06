# Eshop
Eshop practice project

## Основные зависимости
* Docker, docker-compose
* Nginx:1.27
* PHP 8.3
* Symfony 7.1
* Postgres
* Kafka
* Redis

## Установка
```
docker compose up --build -d
```

## Ссылки
* API documentation - http://localhost:86/eshop/api/doc
* Web profiler - http://localhost:86/eshop/_profiler

## Команды
* PHPStan - ```vendor/bin/phpstan analyse -l 6 src```
* CS fixer check - ```php vendor/friendsofphp/php-cs-fixer/php-cs-fixer check --verbose```
* CS fixer fix - ```php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix --verbose```

### Список переменных окружения:
- ``APP_ENV`` - окружение приложения
