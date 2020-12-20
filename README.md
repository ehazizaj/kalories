## About Repo
This repo consist on a Admin Panel based on 2 users: 
-Admin
-User
Admin can enter the dashboard and can change the number of calories that should be taken in 1 day
User can CRUD the Meals and filter them

## After Clone

Please after cloning this repo, to make it work do as following:
- run "npm install"
- run "composer install"
- run "npm run dev"
- generate .env file and set up database
- run "php artisan key:generate"
- run "php artisan migrate --seed"
The last command will also create 2 users 1) email: admin@gmail.com pass: admin1234 , 2) email: user@gmail.com pass: user1234

