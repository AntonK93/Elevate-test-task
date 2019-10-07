<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

Installation:
1. Download dependencies: npm install --save-prod
2. Edit your .env file
3. Run migrations: php artisan migrate
4. Run seeders: php artisan db:seed
5. Run compilation: npm run dev

Site model:
- vue components: resources\assets\js\components
- RESTful api's for vue views: app\Http\Controllers\Api
- cookie's controller for setting/obtaining user location: app\Http\Controllers\Cookie
- open-map service controller for calculating distance between two locations: app\Http\Controllers\Services
- Eloquent ORM models for working with database: app\
- migrations for creating tables: database\migrations
- seeders for filling tables: database\seeds
