<?php 
include 'connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['role']) || !isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: auth.php");
    exit;
}

// Get role and user ID from session
$userRole = $_SESSION['role'];
$userId   = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
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

        h2 {
            text-align: center;
            color: #2A9D8F;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        form input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        form button {
            background-color: #2A9D8F;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #21867A;
        }

        table {
            width: 100%;
            max-width: 900px;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 10px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2A9D8F;
            color: white;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
            transition: background-color 0.3s;
        }

        td a.edit {
            background-color: #4CAF50; /* Green */
        }

        td a.edit:hover {
            background-color: #45A049;
        }

        td a.delete {
            background-color: #F44336; /* Red */
        }

        td a.delete:hover {
            background-color: #E53935;
        }

        p {
            text-align: center;
            font-size: 1rem;
            color: #555;
        }

        /* Footer Styles */
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

    <script>
        function confirmDeletion() {
            return confirm("Are you sure you want to delete this account?");
        }
    </script>

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
    <h2>Search Account</h2>
    <form method="GET" action="">
        <input type="text" name="query" placeholder="Enter name, email, or phone" required>
        <button type="submit">Search</button>
    </form>

    <?php
    if (isset($_GET['query'])) {
        $query = $_GET['query'];

        if ($userRole === 'admin') {
            // Admin can search all accounts
            $sql = "SELECT * FROM accounts 
                    WHERE name LIKE '%$query%' 
                    OR email LIKE '%$query%' 
                    OR phone LIKE '%$query%'";
            $result = $conn->query($sql);
        } else {
            // Customer can only search their own account
            $stmt = $conn->prepare("SELECT * FROM accounts 
                                    WHERE id = ? AND 
                                    (name LIKE ? OR email LIKE ? OR phone LIKE ?)");
            $likeQuery = "%$query%";
            $stmt->bind_param("isss", $userId, $likeQuery, $likeQuery, $likeQuery);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if ($result && $result->num_rows > 0) {
            echo "<h3 style='text-align: center; color: #2A9D8F;'>Search Results:</h3>";
            echo "<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['address']}</td>
                        <td>";

                if ($userRole === 'admin') {
                    echo "<a href='edit.php?id={$row['id']}' class='edit'>Edit</a>
                          <a href='delete.php?id={$row['id']}' class='delete' onclick='return confirmDeletion()'>Delete</a>";
                } elseif ($userRole === 'customer' && $row['id'] == $userId) {
                    echo "<a href='edit.php?id={$row['id']}' class='edit'>Edit</a>";
                }

                echo "</td></tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<p>No results found for '$query'.</p>";
        }
    }
    ?>

    <!-- Footer Section -->
    <footer>
        &copy; 2024 Bank Management System. All Rights Reserved.
    </footer>
</body>
</html>
