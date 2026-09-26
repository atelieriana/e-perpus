# E-Perpus Kelompok 1
E-Perpus merupakan capstone project dari kelompok 1

# Stack
1. Laravel 13
2. MySQL
3. Redis

# Docker Compose
```bash
name: e-perpus
services:
  app:
    image: ibnuauliana/php83:alpine-nginx-mysql
    container_name: "app"
    working_dir: /application
    ports:
      - "80:80"
    volumes:
      - ../:/application
  database:
    image: mysql:oraclelinux9
    container_name: "database"
    ports:
      - "3306:3306"
    volumes:
      - YOUR_HOST_LOCATION:/var/lib/mysql
    environment:
      MYSQL_ROOT_PASSWORD: "P!sang#123"
  redis:
    image: redis:8.0-rc1-alpine3.21
    container_name: "redis"
    ports:
      - "6379:6379"
    command: redis-server --requirepass "YOUR_PASSWORD"

```

# How To Run
1. Copy docker compose above into deployment dir (create if not exist)
2. Copy .env.example to .env inside same dir
3. Adjust .env to your local env
4. Enter into app container
5. Run `yarn install` to install dependency and `npm run build` to build into public dir