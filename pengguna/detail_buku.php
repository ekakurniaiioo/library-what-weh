<?php
session_start();
include '../koneksi.php';

if (!isset($_GET['id'])) {
    die('Buku tidak ditemukan');
}

$id_buku = (int) $_GET['id'];

$queryDetailBuku = mysqli_query(
    $koneksi,
    "SELECT buku.*, kategori.nama_kategori, penulis.nama_penulis
     FROM buku
     JOIN kategori ON buku.id_kategori = kategori.id_kategori
     JOIN penulis ON buku.id_penulis = penulis.id_penulis
     WHERE buku.id_buku = $id_buku
     LIMIT 1"
);

if (mysqli_num_rows($queryDetailBuku) == 0) {
    die('Data buku tidak ada');
}

$buku = mysqli_fetch_assoc($queryDetailBuku);

$queryBukuRekomendasi = mysqli_query(
    $koneksi,
    "SELECT buku.*, kategori.nama_kategori
FROM buku
JOIN kategori ON buku.id_kategori = kategori.id_kategori
ORDER BY RAND() LIMIT 6"
);

$queryBukuTerbaru = mysqli_query(
    $koneksi,
    "SELECT buku.*, kategori.nama_kategori
FROM buku
JOIN kategori ON buku.id_kategori = kategori.id_kategori
ORDER BY buku.created_at DESC LIMIT 6"
);

$queryPenulis = mysqli_query(
    $koneksi,
    "SELECT penulis.*, buku.judul_buku
FROM penulis
JOIN buku ON buku.id_penulis = penulis.id_penulis"
);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Pustaka What Weh</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-900">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r px-6 py-6 sticky top-0 h-screen">
            <img src="../uploads/pustaka-logo.png" class="w-32 h-28 ml-9 mb-8">

            <div class="mb-8">
                <p class="text-xs font-semibold text-gray-400 uppercase mb-3 tracking-wide">
                    Discover
                </p>

                <ul class="space-y-1">
                    <li>
                        <a href="home.php" class="flex items-center px-4 py-2 rounded-lg
                       text-gray-500 hover:bg-gray-200 hover:text-black
                       transition">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="komunitas.php" class="flex items-center px-4 py-2 rounded-lg
                       text-gray-500 hover:bg-gray-200 hover:text-black
                       transition">
                            Komunitas
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase mb-3 tracking-wide">
                    Pustaka
                </p>

                <ul class="space-y-1">
                    <li>
                        <a href="favorit.php" class="flex items-center px-4 py-2 rounded-lg
                       text-gray-500 hover:bg-gray-200 hover:text-black
                       transition">
                            Daftar Buku
                        </a>
                    </li>

                    <li>
                        <a href="trending.php" class="flex items-center px-4 py-2 rounded-lg
                       text-gray-500 hover:bg-gray-200 hover:text-black
                       transition">
                            Trending
                        </a>
                    </li>

                    <li>
                        <a href="settings.php" class="flex items-center px-4 py-2 rounded-lg
                       text-gray-500 hover:bg-gray-200 hover:text-black
                       transition">
                            Peminjaman Buku
                        </a>
                    </li>

                    <li>
                        <a href="settings.php" class="flex items-center px-4 py-2 rounded-lg
                       text-gray-500 hover:bg-gray-200 hover:text-black
                       transition">
                            Saya
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="flex-1 px-10 py-6 pt-40">

            <!-- Topbar -->
            <div id="topbar"
                class="fixed top-0 left-64 right-0 z-40 bg-gray-50 border-b-2 transition-transform duration-300">

                <div class="flex items-center justify-between px-10 py-4">
                    <div class="flex gap-4">
                        <div class="flex items-center gap-2 bg-gray-100 p-1 rounded-xl">
                            <button class="px-5 py-2 text-sm font-medium rounded-lg bg-white shadow text-black">
                                Home
                            </button>

                            <button
                                class="px-5 py-2 text-sm font-medium rounded-lg text-gray-500 hover:text-black hover:bg-white transition">
                                History
                            </button>

                            <button
                                class="px-5 py-2 text-sm font-medium rounded-lg text-gray-500 hover:text-black hover:bg-white transition">
                                Kategori
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="flex items-center bg-gray-100 rounded-xl px-4 py-3 w-[620px] shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M16.65 10.5a6.15 6.15 0 11-12.3 0 6.15 6.15 0 0112.3 0z" />
                            </svg>

                            <input id="searchInput" type="text" placeholder="Browse..."
                                class="bg-transparent w-full focus:outline-none text-gray-700 placeholder-gray-400" />

                            <button onclick="clearSearch()" class="text-gray-400 hover:text-black">
                                ✕
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div class="flex items-center gap-3">
                                <div class="relative flex items-center bg-gray-100 hover:bg-gray-200 p-2 rounded-full gap-2 cursor-pointer"
                                    id="avatarBtn">
                                    <img src="../uploads/profile/<?= $_SESSION['avatar'] ?? 'user.jpg'; ?>"
                                        class="w-10 h-10 rounded-full object-cover border">

                                    <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" id="arrowIcon"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>

                                    <div id="dropdownMenu"
                                        class="absolute right-0 top-full mt-3 w-64 bg-white rounded-2xl shadow-xl border hidden overflow-hidden">

                                        <div class="flex items-center gap-3 px-4 py-4 bg-gray-50">
                                            <img src="../uploads/profile/<?= $_SESSION['avatar'] ?? 'user.jpg'; ?>"
                                                class="w-12 h-12 rounded-full object-cover border">

                                            <div class="leading-tight">
                                                <p class="text-sm font-semibold text-gray-800">
                                                    <?= htmlspecialchars($_SESSION['username']); ?>
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    <?= htmlspecialchars($_SESSION['email']); ?>
                                                </p>
                                                <span
                                                    class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full bg-black text-white">
                                                    <?= htmlspecialchars($_SESSION['role']); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="border-t"></div>

                                        <a href="profile.php"
                                            class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100">
                                            Ubah Foto Profil
                                        </a>

                                        <a href="ubah_username.php"
                                            class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100">
                                            Ubah Username
                                        </a>

                                        <div class="border-t"></div>

                                        <a href="../logout.php"
                                            class="flex items-center gap-2 px-4 py-3 text-sm text-red-600 hover:bg-red-50">
                                            Logout
                                        </a>
                                    </div>

                                </div>
                            </div>

                        <?php else: ?>
                            <a href="../registrasi.php"
                                class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                                Daftar
                            </a>

                            <a href="../login.php" class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800">
                                Login
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Detail Buku -->
            <h2 class="text-3xl font-bold">Detail Buku</h2>
            <div class="max-w-5xl mx-auto px-6 py-10">
                <div class="relative">

                    <!-- Background abu -->
                    <div class="absolute top-48 -left-16 w-[1000px] h-[520px] bg-gray-200 rounded-3xl shadow-2xl">
                    </div>

                    <!-- Header -->
                    <div class="relative z-10 flex gap-10 pt-8">

                        <!-- Cover Buku -->
                        <div class="w-56 shrink-0 relative">
                            <img src="../uploads/buku/<?= $buku['cover']; ?>"
                                alt="<?= htmlspecialchars($buku['judul_buku']); ?>"
                                class="rounded-2xl w-full h-80 shadow-2xl" />
                        </div>

                        <!-- Info + Action -->
                        <div class="flex-1 pt-16">

                            <h1 class="text-4xl font-bold mb-1">
                                <?= htmlspecialchars($buku['judul_buku']); ?>
                            </h1>
                            <p class="text-gray-500 text-lg mb-16">
                                <?= htmlspecialchars($buku['nama_penulis']); ?>
                            </p>

                            <!-- Action -->
                            <div class="flex items-center gap-6 mb-10">
                                <button class="bg-black text-white px-10 py-3 rounded-full font-semibold
                               shadow-md hover:shadow-xl hover:-translate-y-0.5
                               transition-all duration-200">
                                    Pinjam
                                </button>

                                <div class="flex items-center gap-4 text-black">
                                    <!-- icon placeholder -->
                                </div>
                            </div>

                            <hr class="border-black/80 w-[600px]">
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="relative z-10 mt-16">
                        <div class="grid grid-cols-3 gap-10">
                            <!-- Sipnosis -->
                            <div class="col-span-2">
                                <h2 class="text-3xl font-bold mb-4">Sipnosis Buku</h2>
                                <p class="text-gray-700 leading-relaxed">
                                    <?= nl2br(htmlspecialchars($buku['sinopsis'])); ?>
                                </p>
                            </div>

                            <!-- Meta -->
                            <div class="space-y-10">
                                <div>
                                    <h3 class="font-semibold text-lg">Bahasa</h3>
                                    <p class="text-gray-700">
                                        <?= htmlspecialchars($buku['bahasa']); ?>
                                    </p>
                                </div>

                                <div>
                                    <h3 class="font-semibold text-lg">Tahun Terbit</h3>
                                    <p class="text-gray-700">
                                        <?= htmlspecialchars($buku['tahun_terbit']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <script>
        let lastScroll = 0;
        const topbar = document.getElementById('topbar');

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll <= 0) {
                topbar.classList.remove('-translate-y-full', 'shadow-md');
                return;
            }

            if (currentScroll > lastScroll) {
                topbar.classList.add('shadow-md');
            }

            lastScroll = currentScroll;
        });

        function clearSearch() {
            document.getElementById('searchInput').value = '';
        }

        const avatarBtn = document.getElementById('avatarBtn');
        const dropdown = document.getElementById('dropdownMenu');
        const arrow = document.getElementById('arrowIcon');

        avatarBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        });

        document.addEventListener('click', () => {
            dropdown.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        });
    </script>

</body>

</html>