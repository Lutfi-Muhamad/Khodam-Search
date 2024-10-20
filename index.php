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
    body {
      margin: 0;
      height: 100vh;
      background-color: black;
      opacity: 1;
      transition: opacity 1s ease;
    }

    body.fade-out {
      opacity: 0;
    }

    .button {
      opacity: 1;
      transition: opacity 1s ease;
    }

    .button.hide {
      pointer-events: none;
    }
  </style>
</head>

<body id="page-top">
  <header class="masthead">
    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
      <div class="d-flex justify-content-center">
        <div class="text-center">
          <h1 class="mx-auto my-0 text-uppercase">Khodam</h1>
          <h2 class="text-white-50 mx-auto mt-2 mb-5">Cek Khodam Online (Just for Fun Purpose)</h2>
          <!-- Tombol Login tanpa efek fade-out -->
          <a class="btn btn-primary button" href="login.php">Login</a>
          <!-- Tombol Register dengan efek fade-out -->
          <a class="btn btn-primary button" href="registrasi.php" onclick="fadeOut(event, 'registrasi.php')">Register</a>
        </div>
      </div>
    </div>
  </header>

  <script>
    function fadeOut(event, url) {
      event.preventDefault(); // Mencegah langsung berpindah halaman
      document.body.classList.add('fade-out'); // Tambahkan kelas 'fade-out' ke body

      setTimeout(() => {
        window.location.href = url; // Pindah ke halaman setelah transisi selesai
      }, 1000); // Tunggu 1 detik sebelum berpindah halaman (durasi transisi)
    }
  </script>
</body>

</html>
