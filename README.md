# Laravel E-commerce API

### Техническая часть
В данном API присутсвует аутентификация по пользователю. После успешной авторизации, вместе с ответом, устанавливается jwt токен в заголовок следующих запросов через cookie. Подробнее можете изучить в контроллере AuthController.
<br>
Для того, чтобы заргестрироваться, Вам будет необходимо отправить POST запрос на роут
```code
    [POST] http://localhost:8000/api/register
```

```code
    body: {
        'firstname': String|required,
        'lastname': String|required,
        'email': String|required,
        'password': String|required,
        'password_confirm': String|required|same as password  
    }
```

Для того, чтобы залогиниться, необходимо отправить POST запрос на роут:
```code
    [POST] http://localhost:8000/api/login
```

```code
    body: {
        'email': String|required,
        'password': String|required
    }
```
После чего, в ответе на запрос, Вы получите jwt токен.
<br>
Далее по роутам:

### Category
```code
    [POST] http://localhost:8000/api/categories
    body: {
        'name' => 'required',
        'parent_id' => 'required',
        'level' => 'required'
    }
    
    [GET] http://localhost:8000/api/categories
    
    [GET] http://localhost:8000/api/categories/{id}
```

### Product
Настроенты фильтры только на category и price, можно добавить фильтры в app/Http/Filters/ProductFilter.php
```code
    [POST] http://localhost:8000/api/products
    body: {
        'name' => 'required',
        'category_id' => 'required',
        'price' => 'required'
    }
    
    [GET] http://localhost:8000/api/products/{param}
    param - id or slug
    
    [GET] http://localhost:8000/api/products
    
    [GET] http://localhost:8000/api/products/?category=Skinny+Jeans&price=37267
    category - название категории
    price - цена
```

### Orders
Есть возможность выгружать список заказов пользователей, при отправке запроса на роут:
```code
    [POST] http://localhost:8000/api/export
```

### Как развернуть проект
Есть 2 варинта разворачивания проекта:

1. Через composer
2. Через docker

### Проект через Composer

1. Клонируем проект с репозитория на локальный компьютер
2. ```composer install --ignore-platform-reqs```
3. ```php artisan migrate ```
4. ```php artisan db:seed```
5. ```php artisan serve```

### Проект через Docker

1. Клонируем проект
2. ```docker compose-build```
3. ```docker compose-up```
4. ```docker exec -it название_контейнера bash```
5. ```php artisan migrate```

Файл окружения подстраивается отдельно, под каждый из методов разворачивания проекта
