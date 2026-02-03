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

- **Framework:** Laravel 10  
- **Language:** PHP 8+  
- **Database:** MySQL / SQLite  
- **Dependency Management:** Composer

---

## Installation & Setup

1. **Clone the repository**

```bash
git clone https://github.com/Arthanarieswaran/Author-Books-management-system.git
cd Author-Books-management-system
composer install
cp .env.example .env

