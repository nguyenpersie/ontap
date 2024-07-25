  <div class="modal fade" id="modalEdit{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modaleditLabel{{ $user->id }}" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('user.update.post',$user->id)}}" method="POST">
          @csrf
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modaleditLabel{{ $user->id }}">Chỉnh sửa user</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="floatingInputValue">Gmail</label>
                  <input type="email" class="form-control" id="usermail" name="email" placeholder="@gmail.com" value="{{ $user->email }}"readonly>
              </div>
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Tên</label>
                  <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="name" value="{{ $user->name }}">
              </div>
                  <select class="form-select" aria-label="Default select example" name="group_role">
                      <option>Nhóm</option>
                      <option value="1"  {{ $user->group_role == 1 ? 'selected' : '' }}>Admin</option>
                      <option value="2"  {{ $user->group_role == 2 ? 'selected' : '' }}>Reviewer</option>
                      <option value="3"  {{ $user->group_role == 3 ? 'selected' : '' }}>Editor</option>
                  </select>
              <div class="mb-3 form-check">
                  <label class="form-check-label" for="exampleCheck1">Trạng thái</label>
                  <fieldset class="form-group row">
                    <div class="col-sm-10">
                      <div class="form-check">
                        <label class="form-check-label col-sm-3">
                          <input class="form-check-input radio-inline" type="radio" name="is_active" id="is_active" value="1" {{ ($user->is_active == 1) ? 'checked' : null }}>Yes</label>
                          <label class="form-check-label">
                          <input class="form-check-input radio-inline" type="radio" name="is_active" id="is_active" value="0" {{ ($user->is_active == 0) ? 'checked' : null }}>No</label>
                      </div>
                   </div>
                </fieldset>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-primary">Lưu</button>
          </div>
        </div>
      </div>
    </div>
</form>


