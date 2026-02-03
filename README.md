# Book & Author Management System

A simple Laravel backend application to manage **Authors** and their **Books**, demonstrating CRUD operations, model relationships, and request validation.

---

## Features

- **Authors**
  - Create, Read, Update, Delete authors
  - Input validation for required fields

- **Books**
  - Create, Read, Update, Delete books
  - Each book is linked to an author (One-to-Many relationship)
  - Input validation for required fields

---

## Technology Stack

- **Framework:** Laravel 12  
- **Language:** PHP 8+  
- **Database:** MySQL  
- **Dependency Management:** Composer

---

## Installation & Setup

1. **Clone the repository**

```bash
git clone https://github.com/Arthanarieswaran/Author-Books-management-system.git
cd Author-Books-management-system
composer install
cp .env.example .env

# Edit your environment variables in the .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

# Key generation
php artisan key:generate

# Migrate Database
php artisan migrate

# php artisan serve
php artisan serve

