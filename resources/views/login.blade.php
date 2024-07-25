<!DOCTYPE html>
<html lang="vi">

<head>
<title>{{ $title }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card p-4" style="width: 100%; max-width: 400px;">
            <h2 class="mb-4 text-center">ĐĂNG NHẬP</h2>

            @include('alert')
            <form id="loginForm" action="/admin/users/login" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember_token">
                    <label class="form-check-label" for="remember">Remember</label>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm" style="width: 40%;">Đăng nhập</button>
                </div>
                @csrf
            </form>
        </div>
    </div>

@include('footer')

    <!-- <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var emailError = document.getElementById('emailError');
            var passwordError = document.getElementById('passwordError');

            emailError.textContent = '';
            passwordError.textContent = '';

            if (email === '') {
                emailError.textContent = 'Email không được để trống';
                document.getElementById('email').focus();
                return;
            }

            if (password === '') {
                passwordError.textContent = 'Mật khẩu không được để trống';
                document.getElementById('password').focus();
                return;
            }

            // Nếu cả email và mật khẩu đều không trống, submit form hoặc xử lý logic đăng nhập ở đây
            // alert('Đăng nhập thành công!');
        });
    </script> -->
</body>
</html>
