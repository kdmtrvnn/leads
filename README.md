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
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
npm i
npm run dev
```

Routes
```
1.1. GET /leads/create
1.2. POST /leads
1.3. GET /leads
1.4. GET /leads
1.5. GET /leads/get
1.6. DELETE /leads/{id}
1.7. PATCH /leads/{id}
1.8. PUT /leads/{id}
```
