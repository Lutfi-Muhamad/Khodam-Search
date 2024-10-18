<?php
session_start(); // Memulai session

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke login.php
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username']; // Ambil username dari session

// Folder tempat menyimpan gambar
$imageFolder = 'assets/kodam/';

// Dapatkan semua file gambar dari folder
$images = glob($imageFolder . "*.{jpg,png,gif,jpeg}", GLOB_BRACE);

// Default image sebelum pencarian
$imageToShow = 'bg.jpg';
$khodamText = ''; // Variabel untuk menyimpan teks khodam

// Proses ketika tombol "Cari" ditekan
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = $_GET['query']; // Ambil query dari input pencarian

    // Jika ada gambar di folder, pilih satu secara acak
    if ($images) {
        $randomImage = $images[array_rand($images)]; // Memilih gambar acak
        $_SESSION['randomImage'] = $randomImage; // Simpan gambar acak di session
    }

    // Tentukan gambar yang akan ditampilkan setelah pencarian
    $imageToShow = $_SESSION['randomImage'] ?? 'image.jpg';

    // Menyusun teks khodam
    $khodamText = htmlspecialchars($query) . " khodam yang ada pada kamu adalah:";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/dashboard.css">
</head>

<body>
    <div class="d-flex justify-content-center">
        <div class="container text-center">
            <h1>Halo, selamat datang <?php echo htmlspecialchars($username); ?>!</h1>
            <p class="lead">Silahkan Masukan Nama Kamu Di kolom pencarian</p>

            <!-- Menambahkan input text dan tombol cari -->
            <form method="GET" class="mt-4">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Masukkan Nama Kamu" required>
                    <button type="submit" class="btn btn-primary ms-2">Cari Khodam</button>
                </div>
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Masukkan Nama Kamu" required>
                    <button type="submit" class="btn btn-primary ms-2">Cari Khodam</button>
                </div>
            </form>

            <!-- Menampilkan teks khodam jika ada -->
            <?php if ($khodamText): ?>
                <h2 class="mt-4"><?php echo $khodamText; ?></h2>
            <?php endif; ?>

            <!-- Menampilkan gambar (default atau acak setelah pencarian) -->
            <img src="<?php echo htmlspecialchars($imageToShow); ?>" alt="Dashboard Image" class="img-fluid mt-4" style="margin-bottom: 20px;">

        </div>
    </div>

    <!-- Footer Disclaimer -->
    <footer class="text-center mt-4 py-3" style="background-color: #333; color: white; margin-top: 20px;">
        <div>
            <p class="mb-0">Disclaimer: Website ini hanya untuk bersenang-senang dan hiburan semata. Semua konten di sini tidak dimaksudkan untuk diambil serius.</p>
        </div>
    </footer>


    <!-- Bootstrap JS dan dependencies (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>