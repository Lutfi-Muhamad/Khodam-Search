<?php
session_start(); // Memulai session

// Cek apakah user sudah login (hanya contoh sederhana, sesuaikan dengan sistem login)
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = 'guest'; // Set username sebagai guest jika belum login
}

// Folder tempat menyimpan gambar
$imageFolder = 'assets/kodam/';

// Dapatkan semua file gambar dari folder
$images = glob($imageFolder . "*.{jpg,png,gif,jpeg}", GLOB_BRACE);

// Default image sebelum pencarian
$imageToShow = 'assets/default.jpg'; // Default image jika tidak ada gambar yang dicari
$khodamText = ''; // Variabel untuk menyimpan teks khodam
$showModal = false; // Variabel untuk menentukan apakah modal akan ditampilkan

// Proses ketika tombol "Cari" ditekan
if (isset($_POST['query']) && !empty($_POST['query'])) {
    $query = $_POST['query']; // Ambil query dari input pencarian

    // Jika ada gambar di folder, pilih satu secara acak
    if ($images) {
        $randomImage = $images[array_rand($images)]; // Memilih gambar acak
        $_SESSION['randomImage'] = $randomImage; // Simpan gambar acak di session
    }

    // Tentukan gambar yang akan ditampilkan setelah pencarian
    $imageToShow = $_SESSION['randomImage'] ?? 'assets/default.jpg';

    // Menyusun teks khodam
    $khodamText = htmlspecialchars($query) . " khodam yang ada pada kamu adalah:";

    // Setel flag modal untuk menampilkan modal setelah pemilihan gambar
    $showModal = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Khodam Checker</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="styles/style.css" rel="stylesheet" />
    <style>
        /* CSS untuk elemen h1 dan h2 tanpa transisi */
        .header-text {
            transform: translateY(-31px);
            opacity: 1;
        }

        /* CSS untuk form login tanpa transisi */
        .login-form {
            opacity: 1;
            transform: translateY(0);
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
            /* Hitam gelap transparan */
        }

        .modal-content {
            background-color: rgba(0, 0, 0, 0.9);
            /* Hitam transparan untuk konten modal */
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            color: white;
            /* Mengubah warna teks menjadi putih untuk kontras */
            opacity: 0;
            /* Awal tidak terlihat */
            transition: opacity 0.5s ease;
            /* Efek transisi */
        }

        .modal-content.show {
            opacity: 1;
            /* Tampilkan konten modal */
        }

        .loading {
            text-align: center;
            font-size: 24px;
            color: white;
            opacity: 1;
            /* Awal terlihat */
            transition: opacity 0.5s ease;
            /* Efek transisi */
            margin-top: 20px;
            /* Jarak atas untuk elemen loading */
        }

        .loading.hide {
            opacity: 0;
            /* Sembunyikan animasi loading */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: white;
            /* Mengubah warna close button saat hover */
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body id="page-top">
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase header-text">Khodam</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5 header-text">Cek Khodam Online (Just for Fun Purpose)</h2>
                    <!-- Form Login -->
                    <form class="login-form" method="POST" action="">
                        <div class="form-outline mb-4">
                            <input type="text" name="query" class="form-control" placeholder="Masukkan Nama Kamu" required>
                        </div>

                        <div class="text-center pt-1 mb-5 pb-1">
                            <button id="login-button" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="login">cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Modal -->
    <div id="khodamModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="loading" class="loading">Loading...</div> <!-- Elemen loading -->
            <img id="modalImage" src="" alt="Gambar Khodam" style="width: 100%; height: auto; display: none;"> <!-- Gambar disembunyikan awalnya -->
            <p id="khodamText" style="display: none;"></p> <!-- Teks khodam disembunyikan awalnya -->
        </div>
    </div>

    <script>
        function closeModal() {
            document.getElementById('khodamModal').style.display = "none";
            const modalContent = document.querySelector('.modal-content');
            modalContent.classList.remove('show'); // Hilangkan kelas 'show' saat modal ditutup
        }

        window.onload = function() {
            // Tampilkan modal setelah pencarian
            <?php if ($showModal): ?>
                const modal = document.getElementById('khodamModal');
                const loading = document.getElementById('loading');
                const modalImage = document.getElementById('modalImage');
                const khodamText = document.getElementById('khodamText');

                modal.style.display = "block"; // Tampilkan modal
                const modalContent = document.querySelector('.modal-content');
                modalContent.classList.add('show'); // Tambahkan kelas 'show' untuk efek fade-in

                loading.classList.remove('hide'); // Tampilkan animasi loading

                // Tampilkan gambar dan teks setelah 2 detik
                setTimeout(() => {
                    loading.classList.add('hide'); // Sembunyikan animasi loading
                    modalImage.src = "<?php echo htmlspecialchars($imageToShow); ?>"; // Set gambar
                    khodamText.innerHTML = "<?php echo $khodamText; ?>"; // Set teks khodam
                    modalImage.style.display = "block"; // Tampilkan gambar
                    khodamText.style.display = "block"; // Tampilkan teks
                }, 2000); // Waktu delay 2 detik
            <?php endif; ?>
        }
    </script>
</body>

</html>