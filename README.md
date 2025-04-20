Setup guide.

software needed if not yet installed
1. Composer
2. Xampp/Laragon
3. Node.Js
4. VSCode
5. Git

Steps to deploy
1. Clone the repository
2. Open VSCode Terminal
3. run -> composer install (install laravel dependencies)
4. run -> npm install (install node dependencies)
5. create .env file and copy the .env.example
6. run -> php artisan migrate (migrate database)
7. run -> php artisan db:seed (run database seeders)
8. run -> php artisan serve (if u encounter key error)
9. run -> php artisan key:generate (php artisan serve again)
10. if you encounter image not displaying (run -> php artisan storage:link)

Godbless reviewing my code.

ERD/DFD -> https://imgur.com/a/El0O3xD
