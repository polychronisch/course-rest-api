# 📦Laravel 12 + PHP 8.2 CRUD

## 🚀 Features

* Postman Collection
* Laravel backend

✅ CRUD endpoints for Courses

✅ Input validation with FormRequests

✅ Soft deletes (trash-friendly 🗑️)

✅ PHPUnit tests with high coverage 🧪

## 🔨 Future Improvements

* Security issues, Swagger implementation, rate limiting via middleware and use of docker

## 🛠️ Tech Stack

* **Backend:** Laravel, PHP
* **Testing:** PHP Unit

## 📁 Project Structure

```
📂 project-root/
└── Course-rest-api/ (Laravel)
```

## 📝 Prerequisites

* PHP (v8.2+)
* Composer
* Laravel 12

## ⚙️ Installation

1. Clone the repository

2. Set up the backend (Laravel):
   
   * cd course-rest-api
   * composer install
   * cp .env.example .env
   * php artisan key:generate
   * php artisan migrate
   * php artisan serve

## 💡 Usage

* Run the Laravel server (usually at `http://localhost:8000`).
* Find postman collection in the Courses REST Api.postman_collection.json file 
* Tests are running with:  ./vendor/bin/phpunit tests