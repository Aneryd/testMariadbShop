ТЕСТОВОЕ ЗАДАНИЕ "API интернет-магазина с помощью mariadb"

.env файл - конфигурация БД
```sh
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=testMariadbShop
DB_USERNAME=root
DB_PASSWORD=password
```

Запуск с помощью Makefile:
```sh
make env - для создания и копировния из .env.example в .env, для Windows - cp .env.example .env
make build - для билда контейнеров
make up - для поднятия контейнеров
make vendor - для composer install
make key - для генерации ключа
make migrate - для запуска миграций
```

Запуск с помощью docker-compose:
```sh
cp -n .env.example .env - для создания и копировния из .env.example в .env, для Windows - cp .env.example .env
docker-compose build - для билда контейнеров
docker-compose up -d - для поднятия контейнеров
docker-compose exec -it app composer install - для composer install
docker-compose exec -it app php artisan key:generate - для генерации ключа
docker-compose exec -it app php artisan migrate:refresh --seed - для запуска миграций
```

Маршруты
```sh
http://localhost/api/
login/logout - вход/выход
add_to_balance - добавить на баланс пользователя средства

baskets - корзина (get, post, delete)
orders - заказы (get, post)


Параматры для фильтрации:
price_from - цена от
price_to - цена до
```