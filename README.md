# Mobile API

API документировано по стандарту [OpenAPI](https://ru.wikipedia.org/wiki/OpenAPI_(%D1%81%D0%BF%D0%B5%D1%86%D0%B8%D1%84%D0%B8%D0%BA%D0%B0%D1%86%D0%B8%D1%8F))

Для просмотра подробного описания данного REST API стоит воспользоваться [Swagger UI](https://petstore.swagger.io/).

В открывшейся странице в текстовое поле в самом вверху вставить ссылку `https://raw.githubusercontent.com/shining-mind/course3-mobile-api/master/openapi.yaml` и нажать кнопку "Explore".

## Краткое описание входных точек API

1. Создание пользователя `POST /users`
2. Поиск пользователя по имени или никнейму `GET /users/search?query=name`
3. Авторизация по никнейму и паролю или с использованием refresh токена `POST /auth/token`
4. Выход из системы `DELETE /auth/token`
5. Просмотр информации о текущем пользователе `GET /auth/me`
6. Просмотр списка команд `GET /teams`

## TODO

* Создание команды
* Создание задачи
* Создание подзадачи
* Добавление членов в команду
