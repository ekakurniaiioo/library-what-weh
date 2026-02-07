<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center">

    <div class="bg-stone-400 w-full max-w-md p-8 rounded-3xl">
        <h2 class="text-3xl text-black text-center mb-10">Login</h2>

        <form action="process_login.php" method="POST" class="space-y-6">
            <div>
                <label>Username</label>
                <input type="text" name="username" required
                    class="w-full px-4 py-3 rounded-xl border bg-gray-50 text-gray-900">
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-3 rounded-xl border bg-gray-50 text-gray-900">
            </div>
            
            <div>
                <label>Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl border bg-gray-50 text-gray-900">
            </div>

            <button type="submit" class="w-full bg-black text-white py-3 rounded-xl">
                Login
            </button>

            <div>
                <a href="registrasi.php">Register</a>
            </div>
        </form>
    </div>

</body>

</html>