<h1 align="center">🚀 Boilerplate Laravel Backend</h1>

<p align="center">
  <img src="https://img.shields.io/badge/version-v0.1.0-blue.svg" alt="Version" />
  <img src="https://img.shields.io/badge/GitHub-Template-blue" alt="Template" />
  <img src="https://img.shields.io/badge/php-%3E%3D8.2-777BB4?logo=php&logoColor=white" alt="PHP Version" />
  <img src="https://img.shields.io/badge/Laravel-v12.x-FF2D20?logo=laravel&logoColor=white" alt="Laravel Version" />
  <img src="https://img.shields.io/badge/FrankenPHP-v1.x-00ADD8?logo=go&logoColor=white" alt="FrankenPHP" />
  <img src="https://img.shields.io/badge/Sanctum-Auth-4F5B93" alt="Sanctum Auth" />
  <img src="https://img.shields.io/badge/license-MIT-green.svg" alt="License" />
</p>

## Laravel + Sanctum + FrankenPHP + MySQL Starter Template

A production-ready Laravel API boilerplate featuring Sanctum Bearer Authentication, Service-Repository Pattern, FrankenPHP & Octane Support, MySQL & SQLite support, Database Migrations & Seeders, Automated Exception Handling, Standardized API Responses, and Automated PHPUnit Testing.
This project provides a scalable and maintainable foundation for building modern REST APIs using Laravel while following best practices for security, clean architecture, performance, testing, and database management.

> 💡 This repository is a GitHub Template. Click **Use this template** to create a new project with all configurations and best practices already set up.

---

## ✨ Features

### 🔐 Authentication & Security

* Laravel Sanctum API Token Authentication
* Bearer Token Authorization Header
* Route Protection & Authorization Middleware
* Secure Password Hashing using `bcrypt`
* Rate Limiting API Support
* Force JSON Response Middleware

### 🗄 Database

* Eloquent ORM Integration
* MySQL Support (Production)
* SQLite Support (Development & Testing)
* Custom Eloquent Scopes & Enum Casting (`UserRole`)
* Database Migration & Seeder Management

### 🏗 Architecture

* Service-Repository Pattern (`AuthService`, `UserService`)
* Form Request DTO Validation (`RegisterRequest`, `StoreUserRequest`, etc.)
* Automated Global Exception Handling in `bootstrap/app.php`
* Standardized API Response Trait (`ApiResponseTrait`)
* Environment-Based Configuration

### ⚡ High Performance

* FrankenPHP Integration
* Laravel Octane Worker Mode Support
* Single-Binary Docker Container Setup

### 🧪 Testing

* PHPUnit & Pest Testing Suite
* Automated Auth & User CRUD Feature Tests
* In-Memory SQLite Test Database

### ⚙️ Developer Experience

* Laravel Pint Code Formatting
* Makefile Shortcuts (`make setup`, `make test`, `make octane`, `make docker-up`)
* Postman Collection (`postman_collection.json`)
* Complete API Documentation (`API_DOCUMENTATION.md`)

---

## 📁 Project Structure

```text
app/
├── Enums/
│   └── UserRole.php              # Role Enum (Admin, User)
├── Http/
│   ├── Controllers/Api/v1/
│   │   ├── AuthController.php    # Auth API Endpoints
│   │   ├── HealthCheckController.php # System Health Check
│   │   └── UserController.php    # User CRUD Endpoints
│   ├── Middleware/
│   │   ├── EnsureUserIsAdmin.php # Admin Authorization Guard
│   │   └── ForceJsonResponse.php # Force Accept: application/json
│   ├── Requests/
│   │   ├── Auth/                 # Auth Form Requests
│   │   └── User/                 # User CRUD Form Requests
│   └── Resources/
│       └── UserResource.php      # API JSON Resource Serializer
├── Models/
│   └── User.php                  # User Model + Scopes & Traits
├── Services/
│   ├── AuthService.php           # Business Logic for Authentication
│   └── UserService.php           # Business Logic for User Management
└── Traits/
    └── ApiResponseTrait.php      # Standardized Response Helper

bootstrap/
└── app.php                       # Routes & Global Exception Handler

database/
├── factories/
│   └── UserFactory.php
├── migrations/
│   └── 0001_01_01_000000_create_users_table.php
└── seeders/
    ├── DatabaseSeeder.php
    └── UserSeeder.php

routes/
└── api.php                       # Versioned API Routes (/v1)

tests/
├── Feature/
│   ├── AuthTest.php              # Auth Integration Tests
│   └── UserTest.php              # User Management Tests
└── Unit/
    └── ExampleTest.php
```

---

## 🛠 Tech Stack

| Technology      | Purpose                     |
| --------------- | --------------------------- |
| Laravel 12      | Backend Framework           |
| FrankenPHP      | High-Performance Server     |
| Laravel Sanctum | API Token Authentication    |
| Eloquent ORM    | Object-Relational Mapping   |
| MySQL           | Relational Database         |
| SQLite          | Local Development & Testing |
| Form Requests   | Request Validation          |
| PHPUnit         | Automated Testing           |
| Laravel Pint    | Code Style Fixer            |

---

## 📦 Installation

Clone the repository:

```bash
git clone https://github.com/your-username/boilerplate-laravel-backend.git

cd boilerplate-laravel-backend
```

Run automatic setup via Makefile:

```bash
make setup
```

*Or manually:*

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
```

---

## ⚙️ Environment Variables

Create a `.env` file in the project root.

Example:

```env
APP_NAME="Laravel Backend"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_TIMEZONE=Asia/Jakarta
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel_backend
# DB_USERNAME=laravel
# DB_PASSWORD=secretpassword

OCTANE_SERVER=frankenphp
```

Adjust values according to your environment.

---

## 🚀 Running the Application

### Development (Standard PHP)

```bash
make serve
```

### High Performance (FrankenPHP / Octane)

```bash
make octane
```

### Containerized Environment (Docker Compose)

```bash
make docker-up
```

---

## 🗄 Database Migration & Seeding

### Run Migrations

```bash
make migrate
```

### Seed Database

```bash
make seed
```

### Fresh Migration with Seed

```bash
make fresh
```

---

## 🔐 Authentication

This boilerplate includes Sanctum API Token authentication.

Protected endpoints require a valid Bearer Token:

```http
Authorization: Bearer <access_token>
```

Authentication module includes:

* `POST /api/v1/auth/register` - Register new user
* `POST /api/v1/auth/login` - Login and receive Bearer Token
* `GET /api/v1/auth/me` - Get current user profile
* `PUT /api/v1/auth/profile` - Update user profile
* `PUT /api/v1/auth/change-password` - Change password
* `POST /api/v1/auth/logout` - Revoke current token

---

## 👤 User Module

Example User CRUD operations:

* `GET /api/v1/users` - List Users (Supports Search, Filtering, Pagination, Sorting)
* `POST /api/v1/users` - Create User
* `GET /api/v1/users/{id}` - Get User Detail
* `PUT /api/v1/users/{id}` - Update User
* `DELETE /api/v1/users/{id}` - Delete User

---

## ⚠️ Exception Handling

Global API exception handling is implemented in:

```text
bootstrap/app.php
```

This catches `ValidationException`, `AuthenticationException`, `AuthorizationException`, and `NotFoundHttpException`, returning a consistent JSON response structure across the application.

---

## 🔄 API Response Transformation

API responses are standardized using:

```text
app/Traits/ApiResponseTrait.php
app/Http/Resources/UserResource.php
```

Sample Success Response:

```json
{
  "success": true,
  "message": "User profile retrieved successfully",
  "data": {
    "id": 1,
    "name": "Super Administrator",
    "email": "admin@boilerplate.com",
    "role": "admin",
    "role_label": "Administrator",
    "is_active": true
  }
}
```

---

## 🧪 Testing

Run PHPUnit test suite:

```bash
make test
```

*Or via artisan:*

```bash
php artisan test
```

---

## 📚 API Documentation

A complete Postman collection is available at:

```text
postman_collection.json
```

Detailed Markdown API Documentation is available at:

```text
API_DOCUMENTATION.md
```

---

## 📄 License

This project is licensed under the MIT License.
