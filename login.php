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
        /* CSS untuk elemen h1 dan h2 */
        .header-text {
            transform: translateY(98px);
            opacity: 1;
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .header-text.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* CSS untuk form login */
        .login-form {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .login-form.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        /* CSS untuk transisi fade-out */
        .exit {
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 1.5s ease, transform 1.5s ease;
        }

        /* CSS untuk posisi naik input password dan tombol */
        .shift-up {
            transform: translateY(-31px);
            /* Naikkan 30px */
            transition: transform 0.5s ease;
            /* Durasi transisi */
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
                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required />
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required />
                        </div>

                        <div class="text-center pt-1 mb-5 pb-1">
                            <button id="login-button" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="login">Log in</button>
                        </div>
                    </form>
                    <?php
                    session_start(); // Memulai session

                    if (isset($_POST['login'])) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        // Cek apakah username dan password sesuai
                        if ($username === 'admin' && $password === 'admin') {
                            // Jika sesuai, simpan username dalam session dan arahkan ke dashboard.php
                            $_SESSION['username'] = $username;
                            echo "<script>fadeOutAndRedirect();</script>";
                        } else {
                            // Jika tidak sesuai, tampilkan pesan kesalahan
                            echo "<div class='alert alert-danger text-center'>Username atau password salah!</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>

    <script>
        // Tambahkan kelas fade-in saat halaman dimuat
        window.onload = function() {
            document.body.classList.add('fade-in');

            // Tampilkan h1 dan h2 dengan transisi setelah fade in selesai
            setTimeout(() => {
                const headers = document.querySelectorAll('.header-text');
                headers.forEach(header => {
                    header.classList.add('show');
                });

                // Tampilkan form login setelah h1 dan h2 ditampilkan
                setTimeout(() => {
                    const loginForm = document.querySelector('.login-form');
                    loginForm.classList.add('show');
                }, 500); // Tunda 500ms setelah h1 dan h2 ditampilkan
            }, 2000); // Tunda 2 detik sebelum menampilkan h1 dan h2
        }

        // Fungsi untuk transisi keluar (animasi saat login berhasil)
        function fadeOutAndRedirect() {
            const usernameInput = document.querySelector('#username');
            const passwordInput = document.querySelector('#password');
            const loginButton = document.querySelector('#login-button');
            const headers = document.querySelectorAll('.header-text');

            // Tambahkan kelas exit untuk animasi keluar (input username)
            usernameInput.classList.add('exit');

            // Tunggu sedikit agar username menghilang
            setTimeout(() => {
                // Tambahkan kelas shift-up untuk menaikkan posisi input password dan tombol
                passwordInput.classList.add('shift-up');
                loginButton.classList.add('shift-up');

                // Ubah teks tombol menjadi "Cari"
                loginButton.textContent = "Cari";

                // Tambahkan kelas exit untuk animasi keluar (h1, h2)
                headers.forEach(header => {
                    header.classList.add('exit');
                });

                // Tunggu hingga transisi selesai (1.5 detik), lalu arahkan ke dashboard.php
                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 1500);
            }, 500); // Tunda 500ms untuk memberikan waktu pada username menghilang
        }

        // Menangani form submit
        document.querySelector('.login-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form dari pengiriman default (biar transisi bisa terlihat dulu)

            const username = document.querySelector('#username').value;
            const password = document.querySelector('#password').value;

            // Cek apakah username dan password benar
            if (username === 'admin' && password === 'admin') {
                // Jika benar, jalankan transisi keluar dan kemudian redirect
                fadeOutAndRedirect();
            } else {
                // Jika salah, tampilkan pesan kesalahan
                alert('Username atau password salah!');
            }
        });
    </script>

</body>

</html>