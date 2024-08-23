<form action="{{ route('product.add.post') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Add product</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <!-- Left Column: Tên sản phẩm, Giá bán, Mô tả -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="product_name" class="form-label">Tên sản phẩm</label>
                              <input type="text" class="form-control" id="product_name" name="product_name">
                          </div>
                          <div class="mb-3">
                              <label for="product_price">Giá bán</label>
                              <input type="text" class="form-control" id="product_price" name="product_price" placeholder="$">
                          </div>
                          <div class="mb-3">
                              <label for="deccription" class="form-label">Mô tả</label>
                              <textarea name="deccription" id="deccription" cols="20" rows="3" class="form-control"></textarea>
                          </div>
                      </div>

                      <!-- Right Column: Trạng thái, Image Upload -->
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label for="is_sales" class="form-label">Trạng thái</label>
                              <select class="form-select" aria-label="Default select example" name="is_sales">
                                  <option selected style="user-select: none">Trạng thái</option>
                                  <option value="1">Đang bán</option>
                                  <option value="2">Ngừng bán</option>
                                  <option value="3">Hết hàng</option>
                              </select>
                          </div>
                          <div class="mb-3">
                            <form id="image_upload_formAdd" method="" action="" enctype="multipart/form-data">
                                <div class="error_success_msg_containerAdd my-3"></div>
                                    <img src="" width="200px" height="200px" id="image_previewAdd" class="image_previewAdd">
                                    <div class="form-group mt-3">
                                        <input class="form-control" type="file" name="product_image" id="imageAdd">
                                    </div>
                            </form>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
$(document).on("change", "#imageAdd", function () {
        $(".error_success_msg_containerAdd").html("");
        if (this.files && this.files[0]) {
            let img = document.querySelector(".image_previewAdd");
            img.onload = () => {
                URL.revokeObjectURL(img.src);
            };
            img.src = URL.createObjectURL(this.files[0]);
            document.querySelector(".image_previewAdd").files = this.files;
        }
    });
</script>


