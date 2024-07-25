<form action="{{ route('product.add.post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $titleAdd }}</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form>
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Tên sản phẩm</label>
                  <input type="text" class="form-control" id="product_name" name="product_name">
              </div>
              <form class="form-floating">
              <label for="floatingInputValue">giá bán</label>
                  <input type="text" class="form-control" id="product_price" name="product_price" placeholder="VND">
              </form>
              <div class="mb-3">
                  <label for="address" class="form-label">Mô tả</label>
                  <textarea name="deccription" id="deccription" cols="20" rows="3" class="form-control"></textarea>
              </div>
              <div class="col-md-5">
                <select class="form-select" aria-label="Default select example" name="is_sales">
                    <option selected style="user-select: none">Trạng thái</option>
                    <option value="1">Đang bán</option>
                    <option value="2">Ngừng bán</option>
                    <option value="3">Hết hàng</option>
                </select>
                </div>
              </form>
              <div class="mb-3">
                <label for="productImage" class="form-label">Hình ảnh</label>
                <div class="input-group">
                  <input type="file" class="form-control" id="product_image" name="product_image">
                  <button class="btn btn-danger" type="button">Xóa file</button>
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

