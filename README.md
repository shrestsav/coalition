## Project Installation
1) run "composer install"
2) run "php artisan key:generate" to generate keys
3) To setup database, setup database name in .env and then run php artisan migrate
4) run npm install && npm run watch (Not Important as compilted js files are already included)
5) run php artisan serve and goto served url
6) you can register a new account and goto http://localhost:8000/task to access the application

## About Project
This project has been developed using Laravel and Vue JS, You can add, edit, delete tasks. To Reorder the task you can easily drag and drop in table which will automatically reorder priority in table

## BONUS POINT
I've also done the bonus point where user can filter tasks by project name (Top Left side dropdown filter). But due to insufficient time I did not create seperate join table for this task and included the project name field in the tasks table itself from which user can filter the unique projects. Sorry for design.