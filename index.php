<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // If not logged in, redirect to the login page
    echo "<script>
        alert('You must be logged in to access this page!');
        window.location.href = 'auth.php';
    </script>";
    exit;
}

// Get the user role from session
$user_role = $_SESSION['user']['role']; // Ensure this is how you store the user's role in the session

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('assets/file.jpg') no-repeat center center fixed;
            background-size: cover;
            opacity: 0.5; /* Adjust this value to control the transparency */
            z-index: -1; /* This places the background behind other content */
        }

        /* Header Styles */
        header {
            background-color: #2A9D8F;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        nav {
            display: flex;
            gap: 20px;
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

        /* Main Content Styles */
        .main-content {
            padding: 20px;
            text-align: center;
            color: white;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #264653;
            font-size: 50px;
            text-shadow: 2px 2px 0 white, -2px -2px 0 white, 2px -2px 0 white, -2px 2px 0 white;
        }

        p {
            color: #264653;
            font-size: 36px;
            text-shadow: 2px 2px 0 white, -2px -2px 0 white, 2px -2px 0 white, -2px 2px 0 white;
        }

        /* Button Styles */
        .buttons-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .button {
            background-color: #2A9D8F;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            width: 200px;
        }

        .button:hover {
            background-color: #21867A;
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .button:active {
            background-color: #1F6A64;
            transform: scale(1);
        }

        /* Footer Styles */
        footer {
            background-color: #264653;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <div class="logo">Bank Management System</div>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="search.php">Search</a>
            <a href="?logout=true">Logout</a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Welcome to the Bank Management System</h1>
        <p>Manage your bank accounts with ease and efficiency.</p>

        <!-- Buttons Container -->
        <div class="buttons-container">
            <button class="button" onclick="window.location.href='create.php'">Create Account</button>
            <button class="button" onclick="window.location.href='view.php'">View Accounts</button>

            <?php if ($user_role === 'customer') : ?>
                <!-- Customer-specific functionalities -->
                
                <button class="button" onclick="window.location.href='withdraw_money.php'">Withdraw Money</button>
            <?php endif; ?>

            <?php if ($user_role === 'admin') : ?>
                <!-- Customer-specific functionalities -->
                <button class="button" onclick="window.location.href='add_money.php'">Add Money</button>
                
            <?php endif; ?>

        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        &copy; 2025 Bank Management System. All Rights Reserved.
    </footer>

</body>
</html>
