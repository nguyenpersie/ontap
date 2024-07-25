<div class="modal fade" id="modalEdit{{ $product->product_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modaleditLabel{{ $product->product_id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{ route('product.update.post',$product->product_id)}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modaleditLabel{{ $product->product_id }}">{{ $titleEdit }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}">
            </div>
            <div>
                <label for="floatingInputValue">giá bán</label>
                <input type="text" class="form-control" id="product_price" name="product_price" placeholder="VND" value="{{ $product->product_price }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Mô tả</label>
                <textarea name="deccription" id="deccription" cols="20" rows="3" class="form-control">{{ $product->deccription }}</textarea>
            </div>
            <div class="col-md-5">
            <select class="form-select" aria-label="Default select example" name="is_sales">
                <option selected style="user-select: none">Trạng thái</option>
                <option value="1"  {{ $product->is_sales == 1 ? 'selected' : '' }}>Đang bán</option>
                <option value="2"  {{ $product->is_sales == 2 ? 'selected' : '' }}>Ngừng bán</option>
                <option value="3"  {{ $product->is_sales == 3 ? 'selected' : '' }}>Hết hàng</option>
            </select>
            </div>
            <div class="mb-3">
            <label for="productImage" class="form-label">Hình ảnh</label>
            <div class="input-group">
                <input type="file" class="form-control" id="product_image" name="product_image" value="product_image">
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

