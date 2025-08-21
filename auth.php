<?php
// Start the session at the top of the page
session_start();

// Database Connection
$conn = new mysqli("localhost", "root", "", "bank_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        // Login Logic
        $email = $conn->real_escape_string($_POST['login-email']);
        $password = $conn->real_escape_string($_POST['login-password']);
        $role = $conn->real_escape_string($_POST['login-role']);

        $query = "SELECT * FROM users WHERE email='$email' AND role='$role'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Store user in session after successful login
                $_SESSION['user_id'] = $user['id']; // User ID for reference
                $_SESSION['user'] = $user; // Full user data
                $_SESSION['role'] = $user['role']; // Role (admin or customer)
                
                // Redirect based on role
                if ($role === 'admin') {
                    header("Location: index.php");
                } else {
                    header("Location: index.php");
                }
                exit(); // Stop further script execution
            } else {
                echo "<script>alert('Incorrect password!');</script>";
            }
        } else {
            echo "<script>alert('User not found or role mismatch!');</script>";
        }
    } elseif (isset($_POST['register'])) {
        // Registration Logic
        $name = $conn->real_escape_string($_POST['reg-name']);
        $email = $conn->real_escape_string($_POST['reg-email']);
        $password = password_hash($conn->real_escape_string($_POST['reg-password']), PASSWORD_DEFAULT);
        $role = $conn->real_escape_string($_POST['reg-role']);

        $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
        if ($conn->query($query)) {
            echo "<script>alert('Registration successful!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Authentication</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f3f4f6; display: flex; justify-content: center; align-items: center; height: 100vh; }
    .container { width: 400px; background: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); overflow: hidden; }
    .header { display: flex; justify-content: space-evenly; background-color: #1346af; padding: 10px; color: white; }
    .header button { background: none; border: none; color: white; font-size: 18px; cursor: pointer; transition: 0.3s; }
    .header button.active { border-bottom: 3px solid #f4f4f4; }
    .form-container { padding: 20px; }
    .form-group { margin-bottom: 15px; }
    .form-group label { font-size: 14px; }
    .form-group input, .form-group select { width: 100%; padding: 10px; margin-top: 5px; }
    .submit-btn { width: 100%; padding: 10px; color: white; background-color: #1346af; border: none; cursor: pointer; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <button id="loginTab" class="active" onclick="showForm('login')">Login</button>
      <button id="registerTab" onclick="showForm('register')">Register</button>
    </div>
    <div class="form-container">
      <!-- Login Form -->
      <form id="loginForm" method="POST">
        <div class="form-group">
          <label for="login-email">Email</label>
          <input type="email" id="login-email" name="login-email" required>
        </div>
        <div class="form-group">
          <label for="login-password">Password</label>
          <input type="password" id="login-password" name="login-password" required>
        </div>
        <div class="form-group">
          <label for="login-role">Role</label>
          <select id="login-role" name="login-role" required>
            <option value="customer">Customer</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <button type="submit" class="submit-btn" name="login">Login</button>
      </form>

      <!-- Registration Form -->
      <form id="registerForm" method="POST" style="display: none;">
        <div class="form-group">
          <label for="reg-name">Name</label>
          <input type="text" id="reg-name" name="reg-name" required>
        </div>
        <div class="form-group">
          <label for="reg-email">Email</label>
          <input type="email" id="reg-email" name="reg-email" required>
        </div>
        <div class="form-group">
          <label for="reg-password">Password</label>
          <input type="password" id="reg-password" name="reg-password" required>
        </div>
        <div class="form-group">
          <label for="reg-role">Role</label>
          <select id="reg-role" name="reg-role" required>
            <option value="customer">Customer</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <button type="submit" class="submit-btn" name="register">Register</button>
      </form>
    </div>
  </div>

  <script>
    function showForm(form) {
      document.getElementById('loginForm').style.display = form === 'login' ? 'block' : 'none';
      document.getElementById('registerForm').style.display = form === 'register' ? 'block' : 'none';
      document.getElementById('loginTab').classList.toggle('active', form === 'login');
      document.getElementById('registerTab').classList.toggle('active', form === 'register');
    }
  </script>
</body>
</html>
