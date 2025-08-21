<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: auth.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: auth.php");
    exit;
}

// Fetch all accounts with associated user names and emails
$sql = "SELECT a.id, a.name, a.email, a.phone, a.address, a.balance FROM accounts a ORDER BY a.name ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin Dashboard</title>
<style>
    body { font-family: Arial, sans-serif; background:#f4f4f4; margin:0; padding:0;}
    header { background:#2A9D8F; padding:10px 20px; color:#fff; display:flex; justify-content:space-between; align-items:center; }
    nav a { color:#fff; margin-left:20px; text-decoration:none; background:#264653; padding:8px 15px; border-radius:5px;}
    nav a:hover { background:#e76f51;}
    main { padding: 20px; max-width: 900px; margin: 80px auto 40px; background:#fff; border-radius:10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);}
    h2 { color:#2A9D8F; text-align:center; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align:left; }
    tr:hover { background:#f1f1f1; }
    a.btn { background:#2A9D8F; color:#fff; padding:6px 12px; border-radius:5px; text-decoration:none; margin-right: 5px; }
    a.btn:hover { background:#21867A; }
</style>
</head>
<body>
<header>
    <div>Bank Management System - Admin</div>
    <nav>
        <a href="?logout=true">Logout</a>
    </nav>
</header>

<main>
    <h2>All Customer Accounts</h2>
    <?php if ($result && $result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Balance</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['address']); ?></td>
                <td>$<?php echo number_format($row['balance'], 2); ?></td>
                <td>
                    <a class="btn" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a class="btn" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure want to delete this account?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No accounts found.</p>
    <?php endif; ?>
</main>
</body>
</html>
