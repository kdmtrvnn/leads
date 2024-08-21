## Development deploy order

System requirements:
- PHP v8.3
- MySQL v8
- Composer
___
Clone repository by command
```
git clone URL
```
Go to your project directory
```
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
php artisan queue:work --queue=register_confirm
npm i
npm run dev
```

Routes      http://127.0.0.1:8000
```
1.1. GET /leads/create
1.2. POST /leads
1.3. GET /leads
1.4. GET /leads/get
1.5. DELETE /leads/{id}
1.6. PATCH /leads/{id}
1.7. POST /leads/{id}
```
