@section('title', 'Đăng nhập')
@include('layout.header')
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card p-4" style="width: 100%; max-width: 400px;">
            <h2 class="mb-4 text-center">LOGIN</h2>

            @include('alert')
            <form id="loginForm" action="{{ route('postLogin') }}" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                </div>
                <div class="mb-3 form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember_token">
                    <label class="form-check-label" for="remember">Remember</label>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCreate" style="width: 40%;">Register</button>
                    <button type="submit" class="btn btn-primary" style="width: 40%;">Login</button>
                </div>
                @csrf
            </form>
        </div>
    </div>
@include('login.modal.add')
@include('layout.footer')
</body>
</html>
