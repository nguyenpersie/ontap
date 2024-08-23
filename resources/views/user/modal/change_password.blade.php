<div class="d-flex flex-column justify-content-center" style="height: calc(100vh - 114px)">
    <div class="d-flex justify-content-center">
        <div class="card" style="width: 40%;">
            <div class="card-body">
                <h3 class="card-title">Change Password</h3>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form class="mt-4" action="{{ route('update-password') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="old_password" class="form-label">Old Password</label>
                                    <input type="password" class="form-control" id="old_password" name="old_password"
                                        required>
                                    @if ($errors->has('old_password'))
                                        <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                    @endif
                                </div>
                                <div class="mb-4">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password"
                                        required>
                                    @if ($errors->has('new_password'))
                                        <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                    @endif
                                </div>
                                <div class="mb-5">
                                    <label for="new_password_confirmation" class="form-label">
                                        Confirm New Password
                                    </label>
                                    <input type="password" class="form-control" id="new_password_confirmation"
                                        name="new_password_confirmation" required>
                                    @if ($errors->has('new_password_confirmation'))
                                        <span class="text-danger">
                                            {{ $errors->first('new_password_confirmation') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
