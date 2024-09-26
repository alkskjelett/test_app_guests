Тестовый проект - CRUD гостей.
Чтобы развернуть проект неоходимо выполнить:
1) docker compose -f docker/local/docker-compose.yml up -d --build
2) docker exec -it test-app-bon bash
3) composer install
4) php bin/console d:d:c
5) php bin/console d:m:m

Информация о роутах и примеры postman:
https://api.postman.com/collections/17469947-752a840a-46ea-458b-a386-add3438ed600?access_key=<postman-key>
