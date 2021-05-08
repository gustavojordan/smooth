
 - [x] MySQL 5.7 
 - [x] PHP 7.3
 - [x] Apache 2.4.38  
 - [x] Debian 10.4
 - [x] Compose file version 3.5
 
# EDR
![](eer.png)
# Commands to execute outside Docker
`docker-compose build`

`docker-compose up -d`

`docker exec -it smooth-app bash -c "sudo -u devuser /bin/bash" `

# Commands to execute inside of Docker

`composer install`
`php artisan migrate:install`
`php artisan config:clear`
`php artisan config:cache`
`php artisan migrate`
`php artisan db:seed`

# Test commands inside of Docker
`php artisan config:clear`
`php artisan config:cache --env=testing`
`composer test` OR `./vendor/bin/codecept run api`
