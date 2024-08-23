<form action="{{ route('postRegister') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Register</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form>
              <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name"
                  value="{{ old('name') }}" autofocus>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
              <div class="mb-3">
              <label for="email">Gmail</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="@gmail.com" required
                  value="{{ old('name') }}" autofocus>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                  @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
              </div>
              <div class="mb-3">
                  <label for="password_confirmation" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                  @if ($errors->has('password_confirmation'))
                      <span class="text-danger">
                          {{ $errors->first('password_confirmation') }}
                      </span>
                  @endif
              </div>
              <div class="mb-3">
                <label for="exampleInput" class="form-label">Group</label>
                  <select class="form-select" aria-label="Default select example" name="group_role">
                      <option selected style="user-select: none">Group</option>
                      <option value="1">Admin</option>
                      <option value="2">Reviewer</option>
                      <option value="3">Editor</option>
                  </select>
              </div>
              <div class="mb-3">
                  <label class="form-check-label" for="exampleCheck1">Status</label>
                  <fieldset class="form-group row">
                    <div class="col-sm-10">
                      <div class="form-check">
                        <label class="form-check-label col-sm-3">
                          <input class="form-check-input radio-inline" type="radio" name="is_active" id="is_active_1" value="1" checked>Yes</label>
                          <label class="form-check-label">
                          <input class="form-check-input radio-inline" type="radio" name="is_active" id="is_active_2" value="2">No</label>
                      </div>
                     </div>
                  </fieldset>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">OK</button>
            </div>
          </div>
        </div>
      </div>
</form>

