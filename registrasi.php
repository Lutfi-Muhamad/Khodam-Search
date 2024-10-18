<?php
session_start(); // Memulai session

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan kembali ke login.php
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username']; // Ambil username dari session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container text-center mt-5">
        <h1>Halo, selamat datang <?php echo htmlspecialchars($username); ?>!</h1>
        <p class="lead">Ini adalah halaman dashboard Anda.</p>
    </div>

    <!-- Bootstrap JS dan dependencies (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>