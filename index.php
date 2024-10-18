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
      /* Menghapus margin agar tidak ada ruang putih */
      height: 100vh;
      /* Mengatur tinggi penuh untuk body */
      background-color: black;
      /* Pastikan latar belakang berwarna hitam */
    }

    .button {
      opacity: 1;
      /* Mulai dengan opasitas 1 */
      transition: opacity 1s ease;
      /* Durasi transisi */
    }

    .button.hide {
      opacity: 0;
      /* Menghilangkan tombol */
      pointer-events: none;
      /* Menghindari interaksi saat tombol disembunyikan */
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
          <a class="btn btn-primary button" href="login.php" onclick="fadeOut(event, 'login.php')">Login</a>
          <a class="btn btn-primary button" href="registrasi.php" onclick="fadeOut(event, 'registrasi.php')">Register</a>
        </div>
      </div>
    </div>
  </header>

  <script>
    function fadeOut(event, url) {
      event.preventDefault(); // Hentikan tautan agar tidak langsung berpindah halaman
      const buttons = document.querySelectorAll('.button');
      buttons.forEach(button => {
        button.classList.add('hide'); // Menghilangkan tombol terlebih dahulu
      });

      setTimeout(() => {
        window.location.href = url; // Pindah ke halaman setelah tombol dihilangkan
      }, 10); // Waktu delay yang sama dengan durasi transisi
    }
  </script>

</body>

</html>