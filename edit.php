<?php include 'connect.php'; ?>

<?php
// Ensure ID is provided
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Sanitize ID to ensure it's an integer

    // Query to get the account details
    $result = $conn->query("SELECT * FROM accounts WHERE id = $id");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Account not found!";
        exit;
    }

    // Handle form submission for updating account
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);

        // Update query
        $sql = "UPDATE accounts SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            header("Location: view.php"); // Redirect to view page after successful update
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "Invalid account ID!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <link rel="stylesheet" href="assets/styles.css"> <!-- External styles -->
    <style>
        * {
    box-sizing: border-box; /* Ensure padding and borders are included in the element's width/height */
}
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding-top: 0px;  /* Add padding to avoid content hidden under the fixed header */
}
        h2 {
            text-align: center;
            color: #2a9d8f;
            font-size: 2rem;
        }

        form {
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
    margin: 0 auto;  /* Center the form horizontally */
    display: block;
}

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
            font-size: 1.2rem;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1.1rem;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #2a9d8f;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #21867a;
        }

        textarea {
            resize: none;
            font-size: 1rem;
        }

        /* Header and Footer Styles */
        header {
    background-color: #2A9D8F;
    color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;  /* Ensure header occupies full width */
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
}

nav a {
    text-decoration: none;
    color: white;
    font-size: 1.1rem;
    padding: 10px 15px;
    border-radius: 5px;
    background-color: #264653;
    transition: background-color 0.3s, transform 0.3s;
}

nav a:hover {
    background-color: #e76f51;
    transform: translateY(-3px);
}

        footer {
            background-color: #264653;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 1rem;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="logo">Bank Management System</div>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="search.php">Search</a>
        </nav>
    </header>

    <div style="width: 100%; text-align: center;">
        <h2>Edit Account</h2>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
            
            <label for="address">Address:</label>
            <textarea id="address" name="address" required><?php echo htmlspecialchars($row['address']); ?></textarea>
            
            <button type="submit">Update</button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2024 Bank Management System. Developed by TechTonic LTD
    </footer>

</body>
</html>
