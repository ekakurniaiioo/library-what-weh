<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center">

    <div class="bg-stone-400 w-full max-w-md p-8 rounded-3xl">
        <h2 class="text-3xl text-center mb-8 text-gray-800">Registrasi</h2>

        <form action="process_registrasi.php" method="POST" class="space-y-5">

            <div>
                <label>Username</label>
                <input type="text" name="username" required
                    class="w-full px-4 py-3 rounded-xl border focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl border focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <input type="hidden" name="role" value="petugas">

            <button type="submit"
                class="w-full bg-black text-white py-3 rounded-xl">
                Daftar
            </button>

            <div>
                <a href="login.php">Login</a>
            </div>
        </form>
    </div>

</body>
</html>