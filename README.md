# PHP Bookstore System

A web-based bookstore application built with **Laravel 8**. The system supports separate customer and administrator workflows, including book browsing, search and filtering, shopping cart management, checkout, order history, inventory management, and sales history.

## Features

### Customer
- Register, log in, and log out.
- Browse available books and view book details.
- Search books by title or description.
- Filter books by category and price range.
- Sort books alphabetically.
- Add books to a shopping cart.
- Update quantities and remove cart items.
- Select specific cart items for checkout.
- Validate requested quantities against available stock.
- Complete a simulated card checkout.
- View personal order history.

### Administrator
- Access an administrator-only book management area.
- Create, view, update, and delete books.
- Assign one or more categories to books.
- Upload book cover images.
- Manage book prices, stock, publisher, page count, and descriptions.
- View sales history across customers.

## Authorization

The application uses Laravel authentication together with authorization policies and role-based route protection.

Two application roles are used:

- **User** — can browse books, manage their own cart, checkout, and view their own orders.
- **Admin** — can manage the bookstore catalogue and view sales history.

Authorization checks are also used to ensure that users can only access or modify resources belonging to them, such as cart items and orders.

## Tech Stack

| Area | Technology |
| --- | --- |
| Backend | PHP, Laravel 8 |
| Frontend | Blade templates, Bootstrap 5 |
| Database | MySQL |
| ORM | Laravel Eloquent |
| Authentication | Laravel UI / Laravel Auth |
| Authorization | Laravel Policies and Gates |
| Asset Build | Laravel Mix, npm |
| Testing | PHPUnit |

## Project Structure

```text
app/
├── Http/Controllers/    # Book, cart, order, user and authentication logic
├── Models/              # Eloquent models
└── Policies/            # Authorization rules

database/
├── migrations/          # Database schema
└── seeders/             # Sample books, categories and admin account

resources/
└── views/               # Blade views for users, admins and authentication

routes/
└── web.php              # Main web routes
```

## Getting Started

### Prerequisites

Make sure the following are installed:

- PHP 7.3+ or PHP 8.x
- Composer
- MySQL
- Node.js and npm

### 1. Clone the repository

```bash
git clone https://github.com/TXX588356/php_bookstore_system.git
cd php_bookstore_system
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install frontend dependencies

```bash
npm install
```

### 4. Create the environment file

```bash
cp .env.example .env
```

On Windows Command Prompt:

```cmd
copy .env.example .env
```

### 5. Generate the Laravel application key

```bash
php artisan key:generate
```

### 6. Configure the database

Create a MySQL database, then update the following values in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

For local development, the database can also be created using tools such as phpMyAdmin.

### 7. Run migrations

```bash
php artisan migrate
```

### 8. Seed sample data

```bash
php artisan db:seed
```

The seeders populate the database with sample categories, books, and an administrator account.

> For security, review and change the administrator credentials in `database/seeders/AdminSeeder.php` before using the application outside a local development environment.

### 9. Compile frontend assets

For development:

```bash
npm run dev
```

For a production build:

```bash
npm run prod
```

### 10. Start the application

```bash
php artisan serve
```

Then open:

```text
http://127.0.0.1:8000
```

## Main Application Flow

### Customer flow

```text
Browse / Search Books
        ↓
View Book Details
        ↓
Add to Cart
        ↓
Select Items + Update Quantity
        ↓
Checkout
        ↓
Order Created + Stock Reduced
        ↓
View Order History
```

### Administrator flow

```text
Admin Login
    ↓
Book Management
    ├── Create Book
    ├── Update Book
    ├── Delete Book
    └── Manage Categories / Stock
    ↓
View Sales History
```

## Database Entities

The application includes models for:

- Users
- Books
- Categories
- Carts
- Orders
- Order items

Books can belong to multiple categories, while orders contain one or more purchased books with their quantity and unit price recorded at the time of purchase.

## Checkout Note

The checkout page validates card-input format for demonstration purposes. The project does **not** integrate with a real payment gateway and should not be used to process real payment-card information.

## License

This project was developed as an academic / learning project.
