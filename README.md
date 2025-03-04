Этот проект — простое веб-приложение на Laravel для управления товарами и заказами.  
Позволяет создавать, редактировать, удалять товары и оформлять заказы.

---

##  Развертывание проекта

### 1️⃣ **Клонирование репозитория**
Склонируйте проект с GitHub:
```sh
git clone git@github.com:OlegYap/testMPF.git
```
2️⃣ Запуск контейнеров
Запустите Docker-контейнеры:

```sh
docker compose up -d
```

3️⃣ Установка зависимостей
```sh
docker compose exec php-fpm composer install
```

4️⃣ Настройка .env
Создайте .env на основе .env.example:

```sh
cp .env.example .env
```
Сгенерируйте ключ приложения:

```shell
docker compose exec php-fpm php artisan key:generate
```

5️⃣ Запуск миграций и сидов

```shell
docker compose exec php-fpm php artisan migrate --seed
```
6️⃣ Приложение доступно по адресу http://localhost:86

Тестирование 
<br>
Для запуска тестов выполните следующее:

```shell
docker compose exec php-fpm php artisan test
```

