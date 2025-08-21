<?php
session_start(); // Start the session to track user login



include 'connect.php'; // Include the database connection

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy(); // End the session
    header("Location: auth.php"); // Redirect to login page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Add Money</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        header {
            background-color: #2A9D8F;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        nav {
            display: flex;
            gap: 20px;
            padding-right: 20px;
        }

        nav a {
            text-decoration: none;
            color: white;
            font-size: 1rem;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #264653;
            transition: background-color 0.3s, transform 0.3s;
        }

        nav a:hover {
            background-color: #e76f51;
            transform: translateY(-3px);
        }

        main {
            margin-top: 100px;
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #2A9D8F;
            margin-bottom: 10px;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #2A9D8F;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #21867A;
        }

        textarea {
            resize: none;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 1rem;
            color: #2A9D8F;
        }

        .error {
            color: red;
        }

        .home-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .home-button a {
            text-decoration: none;
            background-color: #2A9D8F;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .home-button a:hover {
            background-color: #21867A;
        }

        footer {
            background-color: #264653;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">Bank Management System</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="search.php">Search</a>
        <a href="?logout=true">Logout</a>
    </nav>
</header>

<main>
    <h2>Add Money to Account</h2>
    <form method="POST" action="">
        <label>Email Address:</label>
        <input type="email" name="email" required>
        <label>Amount to Add:</label>
        <input type="number" name="amount" required min="1">
        <button type="submit" name="submit">Add Money</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $amount = $_POST['amount'];

        // Check if the email exists
        $check_sql = "SELECT * FROM accounts WHERE email = '$email'";
        $result = $conn->query($check_sql);

        if ($result->num_rows > 0) {
            // Account exists, add money
            $row = $result->fetch_assoc();
            $current_balance = $row['balance'];
            $new_balance = $current_balance + $amount;

            // Update the account balance
            $update_sql = "UPDATE accounts SET balance = '$new_balance' WHERE email = '$email'";

            if ($conn->query($update_sql) === TRUE) {
                echo "<p class='message'>Money added successfully! New Balance: $" . $new_balance . "</p>";
            } else {
                echo "<p class='message error'>Error: " . $conn->error . "</p>";
            }
        } else {
            echo "<p class='message error'>Account not found!</p>";
        }
    }
    ?>
</main>

<footer>
    &copy; 2024 Bank Management System. All Rights Reserved.
</footer>
</body>
</html>
