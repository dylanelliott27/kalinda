chmod -R 777 .git

cp .env.example .env

docker compose up --force-recreate node composer