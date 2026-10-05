<?php
session_start();
require_once __DIR__ . '/includes/db.php';

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();

            // Using password_verify if hashed, or fallback to plain text for this initial setup
            if ($admin && (password_verify($password, $admin['password']) || $password === $admin['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $admin['username'];
                header('Location: index.php');
                exit;
            } else {
                $error = 'Invalid username or password.';
            }
        } catch (PDOException $e) {
            $error = 'Database error. Make sure the admins table exists.';
        }
    } else {
        $error = 'Please enter both username and password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - C House</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Manrope', sans-serif; background-color: #1C1A18; }
    </style>
</head>
<body class="h-screen flex items-center justify-center">
    <div class="bg-[#2A2623] p-8 rounded-xl shadow-2xl w-full max-w-md border border-[#3A3633]">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">C House Admin</h1>
            <p class="text-gray-400">Sign in to manage your website</p>
        </div>
        
        <?php if ($error): ?>
            <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded-lg mb-6">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-5">
                <label for="username" class="block text-sm font-medium text-gray-300 mb-2">Username</label>
                <input type="text" id="username" name="username" class="w-full bg-[#1C1A18] border border-[#3A3633] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37]" required>
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full bg-[#1C1A18] border border-[#3A3633] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37]" required>
            </div>
            
            <button type="submit" class="w-full bg-[#D4AF37] hover:bg-[#B3932E] text-black font-semibold rounded-lg px-4 py-3 transition duration-200">
                Sign In
            </button>
        </form>
    </div>
</body>
</html>
