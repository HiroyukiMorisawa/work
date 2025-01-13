コンテナ起動
docker-compose up -d


Laravel実行
docker-compose exec app php artisan serve --host=0.0.0.0 --port=8000


Vite実行
docker-compose exec app npm run dev


画面
http://localhost:8000/