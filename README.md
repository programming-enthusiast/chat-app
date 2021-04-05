# How to build this project
```
$ cd backend && cp .env.example .env \\ copy environment variables
$ cd frontend && cp .env.example .env \\ copy environment variables
$ docker-compose build
$ docker-compose up
$ docker-compose exec backend php artisan migrate
```
You can now access the server at http://localhost:8080
