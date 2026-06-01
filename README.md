# Fruit Shop E-Commerce System

A complete Laravel-based e-commerce application for browsing products, managing a cart, placing orders, and handling admin operations for products, categories, and customer orders.

## Features

- Customer registration, login, logout, and profile management
- Product browsing with search, category filtering, and product details pages
- Shopping cart with quantity updates and cart clearing
- Checkout flow with order creation and stock reduction
- Order history and order detail pages for customers
- Admin dashboard with stats and recent orders
- Category management for organizing products
- Product CRUD with image upload support
- Order status management for admins
- Responsive frontend built with Blade and Bootstrap

## Tech Stack

- PHP 8.2+
- Laravel 12
- MySQL or SQLite
- Blade templates
- Bootstrap 5.3
- Font Awesome 6

## Requirements

- PHP 8.2 or newer
- Composer
- Node.js 18+ and npm
- MySQL, MariaDB, or SQLite

## Installation

1. Clone the repository.
2. Install PHP dependencies:

```bash
composer install
```

3. Install JavaScript dependencies:

```bash
npm install
```

4. Copy the environment file:

```bash
copy .env.example .env
```

5. Generate the application key:

```bash
php artisan key:generate
```

6. Configure your database credentials in `.env`.
7. Run migrations:

```bash
php artisan migrate
```

8. Seed the database with sample data:

```bash
php artisan db:seed
```

9. Build frontend assets:

```bash
npm run build
```

10. Start the development server:

```bash
php artisan serve
```

## Usage

- Home page: `/`
- Product catalog: `/shop`
- Product details: `/product/{id}`
- Search: `/search?q=keyword`
- Cart: `/cart`
- Checkout: `/checkout`
- My Orders: `/orders`
- Admin dashboard: `/admin/dashboard`

## Default Test Accounts

After seeding, you can use these accounts:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@fruitshop.com | admin123 |
| Customer | john@example.com | password |
| Customer | jane@example.com | password |

## Image Uploads

Uploaded product images are stored in `public/products` so they can be served directly by the browser.

## Project Structure

- `app/Http/Controllers` - customer and admin controllers
- `app/Models` - Eloquent models and relationships
- `database/migrations` - database schema
- `resources/views` - customer and admin Blade views
- `routes/web.php` - application routes

## Notes

- The catalog page is available at `/shop`.
- Admin routes are protected by authentication and admin middleware.
- If you use Apache or XAMPP, make sure the web root points to the `public` folder.

## License

This project is open-sourced under the MIT license.
