<div class="modal fade" id="modalReview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Review user</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update-password') }}" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tên</label>
                        <span id="username" aria-describedby="emailHelp" name="name">: {{ $user->name }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="usermail" class="form-label">Gmail</label>
                        <span id="usermail" name="email" placeholder="@gmail.com">: {{ $user->email }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Nhóm</label>
                        <span>: {{ $user->group_role == 1 ? 'Admin' : ($user->group_role == 2 ? 'Reviewer' : 'Editor') }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="exampleCheck1">Trạng thái</label>
                        <span>: {{ $user->is_active == 1 ? 'Đang hoạt động' : 'Tạm khóa' }}</span>
                    </div>
                    <div class="mb-3" id="change_password_field" style="display: none;">
                        <label for="oldPassword" class="form-label">Old password</label>
                        <input type="password" id="oldPassword" name="old_password" class="form-control">
                        <br>
                        <label for="newPassword" class="form-label">New password</label>
                        <input type="password" id="newPassword" name="new_password" class="form-control">
                        <br>
                        <label for="newPasswordConfirm" class="form-label">Confirm new password</label>
                        <input type="password" id="newPasswordConfirm" name="new_password_confirmation" class="form-control">
                    </div>
                    <div id="password-update-message" style="display: none;"></div>
                </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-primary" id="change_password">Change password</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
        var passwordFieldVisible = false;
        var $changePasswordButton = $('#change_password');
        $changePasswordButton.on('click', function() {
            if (!passwordFieldVisible) {
                $('#change_password_field').show();
                passwordFieldVisible = true;
                $changePasswordButton.text('Save');
            } else {
                var oldPassword = $('#oldPassword').val();
                var newPassword = $('#newPassword').val();
                var newPasswordConfirm = $('#newPasswordConfirm').val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route("update-password") }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'old_password': oldPassword,
                        'new_password': newPassword,
                        'new_password_confirmation': newPasswordConfirm
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#password-update-message').html('<div class="alert alert-success">Password changed successfully!</div>').fadeIn();
                        $('#change_password_field').hide();
                        passwordFieldVisible = false;
                        $changePasswordButton.text('Change password');
                    },
                    error: function(xhr, status, error) {
                        $('#password-update-message').html('<div class="alert alert-danger">Error updating password: ' + xhr.responseText + '</div>').fadeIn();
                    }
                });
            }
        });
    });
</script>

