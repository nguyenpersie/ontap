

<form action="<?php echo e(route('user.add.post')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo e($titleAdd); ?></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form>
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Tên</label>
                  <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="name">
              </div>
              <form class="form-floating">
              <label for="floatingInputValue">Gmail</label>
                  <input type="email" class="form-control" id="usermail" name="email" placeholder="@gmail.com">
              </form>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                  <input type="password" class="form-control" id="userpass" name="password">
              </div>
              <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Xác nhận mật khẩu</label>
                  <input type="password" class="form-control" id="userverifypass" name="userverifypass">
              </div>
                <label for="exampleInput" class="form-label">Nhóm</label>
                  <select class="form-select" aria-label="Default select example" name="group_role">
                      <option selected style="user-select: none">Nhóm</option>
                      <option value="1">Admin</option>
                      <option value="2">Reviewer</option>
                      <option value="3">Editor</option>
                  </select>
              <div class="mb-3 form-check">
                  <label class="form-check-label" for="exampleCheck1">Trạng thái</label>
                  <fieldset class="form-group row">
                    <div class="col-sm-10">
                      <div class="form-check">
                        <label class="form-check-label col-sm-3">
                          <input class="form-check-input radio-inline" type="radio" name="is_active" id="is_active" value="1" checked>Yes</label>
                          <label class="form-check-label">
                          <input class="form-check-input radio-inline" type="radio" name="is_active" id="is_active" value="2">No</label>
                      </div>
                     </div>
                  </fieldset>
              </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
              <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>
      </div>
</form>

<?php /**PATH /var/www/review/resources/views/user/modal/add.blade.php ENDPATH**/ ?>