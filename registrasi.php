<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Khodam Checker - Registrasi</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="styles/style.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            height: 100vh;
            background-color: black; /* Warna latar belakang awal */
            opacity: 0; /* Mulai dengan opasitas 0 */
            transition: opacity 1s ease; /* Transisi untuk efek fade-in */
        }

        body.fade-in {
            opacity: 1; /* Ubah opasitas menjadi 1 saat fade-in */
        }

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

        /* CSS untuk form registrasi */
        .register-form {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .register-form.show {
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

        /* CSS untuk posisi naik input */
        .shift-up {
            transform: translateY(-31px);
            transition: transform 0.5s ease;
        }

        /* CSS untuk background slideshow */
        .masthead {
            height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: background-image 1s ease-in-out;
        }
    </style>
</head>

<body id="page-top">
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase header-text">Register</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5 header-text">Registrasi Akun (Just for Fun Purpose)</h2>
                    <!-- Form Registrasi -->
                    <form class="register-form" id="register-form">
                        <div class="form-outline mb-4">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required />
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required />
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="confirm-password" class="form-control" placeholder="Confirm Password" required />
                        </div>

                        <div class="text-center pt-1 mb-5 pb-1">
                            <button id="register-button" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Register</button>
                        </div>
                    </form>
                    <div id="message" class="alert" style="display: none;"></div>
                </div>
            </div>
        </div>
    </header>

    <script>
        // Gambar untuk slideshow
        const images = [
            'assets/bg/wp1.jpg',
            'assets/bg/wp2.jpg',
            'assets/bg/wp3.jpg',
            'assets/bg/wp4.jpg'
        ];

        let currentImageIndex = 0;

        // Fungsi untuk mengganti background secara otomatis
        function changeBackground() {
            const masthead = document.querySelector('.masthead');
            masthead.style.backgroundImage = `url(${images[currentImageIndex]})`;
            currentImageIndex = (currentImageIndex + 1) % images.length; // Looping gambar
        }

        // Jalankan fungsi setiap 5 detik
        setInterval(changeBackground, 5000);

        // Tambahkan kelas fade-in saat halaman dimuat
        window.onload = function () {
            document.body.classList.add('fade-in'); // Tambahkan kelas fade-in ke body
            changeBackground(); // Set background pertama

            // Tampilkan h1 dan h2 dengan transisi setelah fade in selesai
            setTimeout(() => {
                const headers = document.querySelectorAll('.header-text');
                headers.forEach(header => {
                    header.classList.add('show');
                });

                // Tampilkan form registrasi setelah h1 dan h2 ditampilkan
                setTimeout(() => {
                    const registerForm = document.querySelector('.register-form');
                    registerForm.classList.add('show');
                }, 500); // Tunda 500ms setelah h1 dan h2 ditampilkan
            }, 2000); // Tunda 2 detik sebelum menampilkan h1 dan h2
        }

        // Menangani form submit
        document.querySelector('#register-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah form dari pengiriman default

            const username = document.querySelector('#username').value;
            const password = document.querySelector('#password').value;
            const confirmPassword = document.querySelector('#confirm-password').value;
            const messageDiv = document.getElementById('message');

            // Cek apakah username sudah ada
            const existingUsernames = ['admin', 'user1', 'testuser']; // Contoh username yang sudah terdaftar

            if (existingUsernames.includes(username)) {
                messageDiv.textContent = 'Username sudah terdaftar!';
                messageDiv.className = 'alert alert-danger text-center';
                messageDiv.style.display = 'block';
            } else if (password !== confirmPassword) {
                messageDiv.textContent = 'Password tidak cocok!';
                messageDiv.className = 'alert alert-danger text-center';
                messageDiv.style.display = 'block';
            } else {
                messageDiv.textContent = 'Registrasi berhasil!'; // Pesan sukses
                messageDiv.className = 'alert alert-success text-center';
                messageDiv.style.display = 'block';

                // Reset form setelah berhasil
                setTimeout(() => {
                    document.querySelector('#register-form').reset();
                    messageDiv.style.display = 'none';
                }, 2000); // Reset form setelah 2 detik
            }
        });
    </script>

</body>

</html>
