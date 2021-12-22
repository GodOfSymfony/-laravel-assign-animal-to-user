## Tamagotchi

The task is for:
- assign one of the 4 animals (cat, god, racoon, penguin) to the user
- check animal state - sleep, hunger and care

## How to start it locally
- create project directory, e.g. g325

- copy **.env.example** to **.env**

`cp .env.example .env`

- open **.env** file and change next variables if you want

- check DB connection variables (username, password)

- inside the container

`composer install`

`php artisan key:generate`

`php artisan migrate --seed`

`npm install`

`npm run dev` it is possible will be required couple times - run it

- add to the cron task according to [the official documentation](https://laravel.com/docs/8.x/scheduling#running-the-scheduler)

- open in your browser

`http://localhost/`

- test user data **test@test.com** and **12345678**
