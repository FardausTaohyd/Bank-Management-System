# Bank Management System

A comprehensive web-based application for managing bank accounts, built with PHP and MySQL. This system provides a simple and intuitive interface for both customers and administrators to perform various banking operations.

## Features

* **User Authentication:** Secure login for customers and administrators.

* **Customer Dashboard:** Customers can view their account details and current balance.

* **Admin Dashboard:** Administrators have full control over user accounts.

* **Create Account:** Ability to create new bank accounts with unique email addresses.

* **Manage Funds:** Functionality to deposit (`add_money`) and withdraw funds (`withdraw_money`).

* **User Management:** Admins can view, edit, and delete user accounts.

* **Search Functionality:** Easily search for specific accounts.

## Technologies Used

* **Backend:** PHP

* **Database:** MySQL

* **Frontend:** HTML, CSS, JavaScript

## Prerequisites

Before you can run this project, ensure you have the following software installed:

* A local server environment (e.g., XAMPP, WAMP, MAMP)

* A web browser

## Installation

Follow these steps to set up and run the project on your local machine.

### 1. Clone the Repository

```bash
git clone [https://github.com/your-username/bank-management-system.git](https://github.com/your-username/bank-management-system.git)
cd bank-management-system
```

### 2. Database Setup

1. Open your preferred database management tool (e.g., phpMyAdmin).

2. Create a new database named `bank_management`.

3. Execute the following SQL queries to set up the tables and insert sample data. You can find these queries in the `database_file/bank_management.sql` file.

```sql
-- Create database
CREATE DATABASE IF NOT EXISTS bank_management;
USE bank_management;

-- Table structure for table `accounts`
CREATE TABLE accounts (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL UNIQUE,
  phone varchar(15) NOT NULL,
  address text NOT NULL,
  balance decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert sample data into `accounts`
INSERT INTO accounts (id, name, email, phone, address, balance) VALUES
(8, 'niloy', 'taohyd30@gmail.com', '01751275757', 'fdfd', 600.00),
(9, 'siyam', 'w111@gmail.com', '01751275757', 'ghghg', 190.00);

-- Table structure for table `users`
CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL UNIQUE,
  password varchar(255) NOT NULL,
  role enum('customer','admin') NOT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert sample data into `users`
INSERT INTO users (id, name, email, password, role, created_at) VALUES
(1, 'taohyd', 'taohyd30@gmail.com', '$2y$10$HMdN4HrtE6qTEJOsDen.L.I43pVBN6thnQp3BrlrZDKguj.XMPnNG', 'customer', '2024-12-05 19:40:11'),
(2, 'taohyd', 'taohyd20@gmail.com', '$2y$10$cUuauDzwAQlQsBBbYt.9kuJCGGq3Ky01L0dmEIkq8u9vSOZDeu0zy', 'admin', '2024-12-05 22:04:15');
```

### 3. Configure the Database Connection

* Locate the `connect.php` file in the project directory.

* Update the database credentials to match your local server configuration.

### 4. Run the Application

* Place the entire project folder in your local server's root directory (e.g., `htdocs` for XAMPP).

* Open your web browser and navigate to the project URL:
  `http://localhost/your-project-folder/index.php`

## Usage

* **Admin Login:**

  * **Email:** `taohyd20@gmail.com`

  * **Password:** `test` (the password hash in the database corresponds to "test")

* **Customer Login:**

  * **Email:** `taohyd30@gmail.com`

  * **Password:** `niloy` (the password hash in the database corresponds to "niloy")

## Contributing

Contributions are what make the open-source community an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project

2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)

3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)

4. Push to the Branch (`git push origin feature/AmazingFeature`)

5. Open a Pull Request

## License

Distributed under the MIT License.
