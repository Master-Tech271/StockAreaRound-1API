first you can clone this project.

then open this project on terminal or CMD.

run this command 'composer install'

after that rename the env.example to env.

then, remove all the content from env file and copy this content -: 

#start

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:9tB613byWyAuvOoQOOr+XpJHyc3W3YrAqeVdIgAobBw=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=sqlite
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=laravel
#DB_USERNAME=root
#DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=demopurpose186@gmail.com
MAIL_PASSWORD=12345678demo
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=demopurpose@gmail.com
MAIL_FROM_NAME="Book Management"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

#end

After that, create the database.sqlite file inside database folder or run this command 'touch database/database.sqlite'

After this, run this command 'php artisan migrate'

then, run this comman 'php artisan passport:install'

congratulations, all configurations is done.

Now, run this project -: run 'php artisan serve' this command.

Now, you can use my API on POSTMAN or any other api consumption software or website.

NOTE -: before you can register yourself using form-data with name, email, password, confirmPassword field on 'http://127.0.0.1:8000/api/register' this url using post method. I think you can read the code and understand the logic.

After registeration you can use the api with your token (oauth2.0).

All the api routes available on 'routes/api.php'


