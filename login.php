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

    <div class="w-full min-h-screen flex items-center justify-center bg-gradient-to-br from-[#22819A] to-[#1b6b80] p-6">

        <div class="w-full max-w-4xl flex rounded-[40px] overflow-hidden shadow-2xl">

            <div class="w-1/2 bg-[#90C2E7] flex flex-col items-center justify-center p-10 relative">

                <img src="uploads/logo1.png" class="w-40 h-40 object-contain drop-shadow-xl mb-6">

                <p class="text-white/80 mt-3 text-center text-sm">
                    Login untuk melanjutkan
                </p>
            </div>

            <div class="w-1/2 p-12 bg-white flex flex-col justify-center">

                <h2 class="text-3xl font-bold text-[#050208] text-center mb-8">
                    Login
                </h2>

                <form action="process_login.php" method="POST" autocomplete="off" class="space-y-6">

                    <div>
                        <label class="text-[#050208] text-sm">Username</label>
                        <input type="text" name="username" placeholder="Masukkan Username" autocomplete="off" required
                            class="w-full mt-2 bg-transparent border-b border-black/60 text-black placeholder-black/60 focus:outline-none focus:border-[#90C2E7] transition duration-300">
                    </div>

                    <div>
                        <label class="text-[#050208] text-sm">Email</label>
                        <input type="email" name="email" placeholder="Masukan Email" autocomplete="off" required
                            class="w-full mt-2 bg-transparent border-b border-black/60 text-black placeholder-black/60 focus:outline-none focus:border-[#90C2E7] transition duration-300">
                    </div>

                    <div>
                        <label class="text-[#050208] text-sm">Password</label>
                        <input type="password" name="password" placeholder="Masukan Password"
                            autocomplete="new-password" required
                            class="w-full mt-2 bg-transparent border-b border-black/60 text-black placeholder-black/60 focus:outline-none focus:border-[#90C2E7] transition duration-300">
                    </div>

                    <button type="submit"
                        class="w-full bg-[#90C2E7] hover:bg-[#7fb3d8] text-black font-semibold py-3 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                        Login
                    </button>

                    <div class="text-center text-sm text-[#050208]">
                        Belum punya akun?
                        <a href="registrasi.php" class="ml-1 text-[#90C2E7] font-semibold hover:underline">
                            Daftar
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>

</body>

</html>