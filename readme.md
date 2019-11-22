SET UP ENVORONMENT 
- Create .env
- composer install
- php artisan migrate:fresh --seed
- php artisan key:generate


API

Headers:
- Content-Type => application/json
- X-Requested-With => XMLHttpRequest
Body:
- Raw => JSON


RUN TESTS
 
- vendor/bin/phpunit --filter METHOD