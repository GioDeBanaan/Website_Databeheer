# Website Databeheer

A web-based data management application built with PHP and MySQL, using a custom MVC architecture. The project was made as a school assignment (eindopdracht) and allows users to manage games, customers, employees, suppliers, and transactions through a clean Bootstrap interface.

---

## Features

### Game List
- View all games in a paginated table
- Search by title, description, genre, platform, or rating
- Sort by newest or oldest
- Add, edit, and delete games (CRUD)
- Displays personal rating and RAWG rating side by side

### Customers
- View, add, edit, and delete customers (CRUD)
- Customer data includes name, contact details, and company

### Employees
- View, add, edit, and delete employees (CRUD)
- Employee data includes name, role, and contact details

### Suppliers
- View all suppliers in a paginated table
- Search by ID, code, company name, contact person, email, city, or country
- Sort by multiple columns (ID, code, company, contact, delivery time, rating)
- Add, edit, and delete suppliers (CRUD)
- Data includes KVK/BTW numbers, bank account, delivery time, rating, and status

### Transactions
- View all transactions
- Add, edit, and delete transactions (CRUD)
- Data includes transaction type, customer, game, payment method, payment status, and order status

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8+ |
| Database | MySQL |
| Frontend | Bootstrap 5.3.8 |
| Local server | XAMPP |

---

## Project Structure

```
Website_Databeheer/
├── Controller/         # Controllers for each module
├── Create/             # Create and edit forms
├── Delete/             # Delete handlers
├── Models/             # Database models (PDO)
├── Pages/              # Routers / entry points
├── views/              # HTML views
├── sql/                # SQL dump for database setup
├── index.html          # Homepage
└── Models/config.php   # Database connection (not in repo)
```

---

## Contributors

- [Gio R.](https://github.com/GioDeBanaan)
- [Kai H.](https://github.com/halloman123)
- [Kacper R.](https://github.com/kacperrejowski)
- [Sam S.](https://github.com/rikkert-cfx)

---

## License

This project was made for educational purposes as a school assignment.
