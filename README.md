Laravel Contacts Management System

===============================

A simple, secure Contacts Management System built with Laravel 12, featuring
authentication, user roles (Superadmin), private contacts per user, AJAX search,
Bootstrap UI, and modal-based delete confirmations.

--------------------------------------------------
FEATURES
--------------------------------------------------

Authentication
- User registration & login (Laravel Breeze)
- Secure password hashing
- Logout with proper redirect
- CSRF protection

Contacts (Per User)
- Create, edit, delete contacts
- Fields: Name, Company, Email, Phone
- Contacts are private per user
- Pagination
- AJAX-based search
- Bootstrap modal confirmation on delete

Superadmin
- Superadmin role
- Manage users (create, delete)
- Seed users & contacts for testing
- Protected admin routes

UI & UX
- Bootstrap 5
- Responsive layout
- Clean tables
- Modal dialogs instead of browser confirm

--------------------------------------------------
TECH STACK
--------------------------------------------------

Backend: Laravel 12
Auth: Laravel Breeze (Blade)
Frontend: Blade + Bootstrap 5
Database: MySQL / SQLite
Build Tool: Vite
AJAX: Vanilla JavaScript (Fetch API)

--------------------------------------------------
REQUIREMENTS
--------------------------------------------------

- PHP >= 8.2
- Composer >= 2.x
- Node.js >= 18.x
- NPM >= 9.x
- MySQL 8.x or SQLite
- Git

--------------------------------------------------
SETUP INSTRUCTIONS
--------------------------------------------------

1. Clone repository
git clone https://github.com/johntepacia17/contacts-app.git
cd contacts-app

2. Install PHP dependencies
composer install

3. Install JS dependencies
npm install

4. Environment setup
cp .env.example .env
php artisan key:generate

5. Configure database in .env

MySQL example:
DB_CONNECTION=mysql
DB_DATABASE=contacts_db
DB_USERNAME=root
DB_PASSWORD=

SQLite example:
DB_CONNECTION=sqlite
touch database/database.sqlite

6. Run migrations
php artisan migrate

7. Seed database (optional)
php artisan db:seed

Default superadmin:
Email: admin@example.com
Password: password1234

8. Build frontend assets
npm run dev
or
npm run build

9. Start server
php artisan serve

Open browser:
http://127.0.0.1:8000

--------------------------------------------------
ROUTES
--------------------------------------------------

Login: /login
Register: /register
Contacts: /contacts
Admin (Superadmin): /admin/users

--------------------------------------------------
USER ROLES
--------------------------------------------------

user       - Manage own contacts
superadmin - Manage users and system data

--------------------------------------------------
IMPORTANT NOTES
--------------------------------------------------

- After login redirect: /contacts
- After logout redirect: /login
- CSRF enabled by default
- Contacts scoped per authenticated user

--------------------------------------------------
COMMON COMMANDS
--------------------------------------------------

php artisan migrate:fresh --seed
php artisan optimize:clear
php artisan route:list

--------------------------------------------------
LICENSE
--------------------------------------------------

Free to use for learning and internal projects.
