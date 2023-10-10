# TasksApp

This project is web application that allows users to manage a simple task list.
Technologies:
- Laravel 8  (Backend)  
- Vue.js 3 (Frontend)
- php v-7.4.30
- Mysql

  Project Description
- Implement user registration and login functionality using Laravel's built-in authentication.
-  dashboard where users can:
      - View a list of tasks.
      - Add new tasks with a description and unique title .
      - Mark tasks as completed.
      - Delete tasks.
      - Implement validation .


Login Page
![Capture d'écran 2023-10-10 135427](https://github.com/kaouanine/TasksApp/assets/97893374/1e97021b-580d-4d02-9df2-813832a8dc39)



Registre page


![Capture d'écran 2023-10-10 135707](https://github.com/kaouanine/TasksApp/assets/97893374/36ffdf63-4c7c-401c-b12e-d4b13d3d8780)


Home Page


![Capture d'écran 2023-10-10 140502](https://github.com/kaouanine/TasksApp/assets/97893374/b319f6d4-b081-48e3-8ffa-3fbdf56a0295)


-Backend Setup 

Clone the project

      git clone https://github.com/kaouanine/TasksApp.git

      cd TasksApp/Backend

Install composer dependencies

      composer install

Create e .env file and update its content if needed

     cp .env.example .env

Run migrations
  
     php artisan migrate
    
Start Laravel server

     php artisan serve

-Frontend Setup

      cd TasksApp/Frontend

Install Npm dependencies

      npm i
      
Start server

      npm run dev
      
