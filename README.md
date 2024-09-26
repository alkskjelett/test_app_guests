Тестовый проект - CRUD гостей.
Чтобы развернуть проект неоходимо выполнить:
1) docker compose -f docker/local/docker-compose.yml up -d --build
2) docker exec -it test-app-bon bash
3) composer install
4) php bin/console d:d:c
5) php bin/console d:m:m
