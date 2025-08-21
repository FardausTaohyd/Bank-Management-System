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
    <title>About Us</title>
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

        /* About Section */
        .about-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 cards per row by default */
            gap: 20px;
            padding: 40px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: contain; /* Ensure image is fully contained without cropping */
            border-bottom: 2px solid #2A9D8F;
        }

        .card-info {
            padding: 20px;
        }

        .card-info h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #2A9D8F;
        }

        .card-info p {
            margin: 5px 0;
            color: #555;
            font-size: 1rem;
        }

        /* Media Query for smaller screens (2 cards per row) */
        @media (max-width: 768px) {
            .about-container {
                grid-template-columns: repeat(2, 1fr); /* 2 cards per row on smaller screens */
                justify-items: center; /* Center the items horizontally */
            }
        }

        /* Media Query for 2nd row (center the 2 cards) */
        @media (min-width: 769px) and (max-width: 1024px) {
            .about-container {
                grid-template-columns: repeat(3, 1fr); /* Keep 3 cards per row by default */
            }

            /* Center the 2nd row (4th and 5th cards) */
            .about-container > .card:nth-child(4), .about-container > .card:nth-child(5) {
                grid-column: span 1;
                justify-self: center; /* Center these cards */
            }
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

    <!-- Main Content: About Section -->
    <section>
        <h2 style="text-align: center; margin-top: 20px; color: #2A9D8F;">Meet Our Team</h2>
        <div class="about-container">
            <!-- Card 1 -->
            <div class="card">
                <img src="assets/r.jpg" alt="Team Member 1">
                <div class="card-info">
                    <h3>Md. Muktadir Hossain Shuvo</h3>
                    <p>ID:221-15-5680</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card">
                <img src="assets/Profile.jpeg" alt="Team Member 2">
                <div class="card-info">
                    <h3>Mahi Shahriar Niloy</h3>
                    <p>ID:213-15-4574</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="card">
                <img src="assets/s.jpg" alt="Team Member 3">
                <div class="card-info">
                    <h3>Md. Shoriful Islam</h3>
                    <p>ID:221-15-5676</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="card">
                <img src="assets/h.jpg" alt="Team Member 4">
                <div class="card-info">
                    <h3>Fardaus Taohyd</h3>
                    <p>ID:221-15-7890</p>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="card">
                <img src="assets/a.jpg" alt="Team Member 5">
                <div class="card-info">
                    <h3>Md. Wahiduzzaman Khan Siyam</h3>
                    <p>ID:221-15-4909</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        &copy; 2025 Bank Management System. All Rights Reserved.
    </footer>

</body>
</html>
