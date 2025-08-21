<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login E-luna</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font Awesome & Google Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #d55a00;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 20px;
        }

        .login-title {
            color: white;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .login-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            display: flex;
            flex-direction: row;
            max-width: 900px;
            width: 100%;
        }

        .login-image {
            width: 50%;
            background-color: #fff;
        }

        .login-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-form {
            width: 50%;
            padding: 40px;
        }

        .form-control {
            margin-bottom: 16px;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .btn-login {
            background-color: #d55a00;
            color: white;
            font-weight: bold;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #c14f00;
        }

        .alert {
            position: absolute;
            top: 20px;
            z-index: 10;
        }

        .logo-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .logo-container img {
            height: 60px;
            object-fit: contain;
        }

        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
                max-width: 95%;
            }

            .login-image,
            .login-form {
                width: 100%;
            }

            .login-image {
                display: none;
            }

            .login-title {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container position-relative">
        {{-- Judul Tengah --}}
        <div class="login-title">Login E-luna</div>

        @if (session('logout_success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'success',
                        title: '{{ session('logout_success') }}'
                    });

                    // Paksa redirect setelah 2.2 detik (toast selesai)
                    setTimeout(function () {
                        window.location.href = "{{ route('login') }}"; // arahkan ke login
                    }, 2200);
                });
            </script>
        @endif

        {{-- Notifikasi Error Login Toast --}}
        @if ($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'error',
                        title: '{{ $errors->first() }}'
                    });
                });
            </script>
        @endif
        {{-- Notifikasi jika belum login --}}
        @if (session('auth_required'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops!',
                        text: '{{ session('auth_required') }}',
                        timer: 2500,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif
        {{-- Kartu Login --}}
        <div class="login-card">
            <!-- Gambar Samping -->
            <div class="login-image">
                <img src="{{ asset('storage/login/bpbd1.webp') }}" alt="Login Image">
            </div>

            <!-- Form -->
            <div class="login-form">
                <form method="POST" action="{{ url('/login') }}">
                    @csrf

                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email"
                        required autofocus>

                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Masukkan password" required>

                    <button type="submit" class="btn btn-login mt-2">Login</button>
                </form>
            </div>
        </div>

        {{-- Logo BPBD & Jabar --}}
        <div class="logo-container">
            <img src="{{ asset('storage/login/bpbd_logo.png') }}" alt="Logo BPBD">
            <img src="{{ asset('storage/login/prov_jabar.png') }}" alt="Logo Provinsi Jawa Barat">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>