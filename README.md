## MAILBOY v1.0
A newsletter SAAS service membership application with 3 role levels (admin, client and subscriber). 

A PHP (v8.2) Laravel (v11.9) application with Laravel Breeze. The platform provides an intuitive interface for subscribers to explore newsletters and a simple subscribe/unsubscribe option, account page with option to edit account, change password and delete account.

Clients can manage their own newsletters and se their subscribers. Mail is sent using mailprovider Postmarkapp.com. Error pages in star wars style. Registration is also included.

This project was developed as part of a student project at Medieinstitutet in 2024.

In public there is a sql file.

## Getting Started
To run this project, you first need to ensure that you have Xamp or similar installed on your computer, and start Apache and Mysql server.

### Step 1: Clone the project
Clone this project to your local computer.

### Step 2: Install dependencies:

  "require": {
  
        "php": "^8.2",
        
        "laravel/framework": "^11.9",
        
        "laravel/tinker": "^2.9",
        
        "spatie/laravel-permission": "^6.9"
        
    },
    
    "require-dev": {
    
        "fakerphp/faker": "^1.23",
        
        "laravel/breeze": "^2.1",
        
        "laravel/pint": "^1.13",
        
        "laravel/sail": "^1.26",
        
        "mockery/mockery": "^1.6",
        
        "nunomaduro/collision": "^8.0",
        
        "pestphp/pest": "^2.0",
        
        "pestphp/pest-plugin-laravel": "^2.0"
        
    },
    

### Step 3: The Database
Create a MySql db and upload the sql file in phpmyadmin.

### Step 4: The ENV file
Put the .env content in a new .env file in your folder root folder.

Add mysql connection and mail provider settings here.

### Step 5: Start
Start the application by running: php artisan serve
