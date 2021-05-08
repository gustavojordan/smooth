# ERD
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

`composer test` 
