<div class="modal-header">
    <h1 class="modal-title fs-5" id="modaleditLabel{{ $product->product_id }}">Edit</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <!-- Cột bên trái -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="product_name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="product_name_{{ $product->product_id }}" name="product_name" value="{{ $product->product_name }}">
            </div>
            <div class="mb-3">
                <label for="product_price" class="form-label">Giá bán</label>
                <input type="text" class="form-control" id="product_price_{{ $product->product_id }}" name="product_price" placeholder="VND" value="{{ $product->product_price }}">
            </div>
            <div class="mb-3">
                <label for="deccription" class="form-label">Mô tả</label>
                <textarea name="deccription" id="deccription_{{ $product->product_id }}" cols="20" rows="3" class="form-control">{{ $product->deccription }}</textarea>
            </div>
        </div>

        <!-- Cột bên phải -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="is_sales" class="form-label">Trạng thái</label>
                <select class="form-select" id="is_sales_{{ $product->product_id }}" aria-label="Default select example" name="is_sales">
                    <option selected style="user-select: none">Trạng thái</option>
                    <option value="1" {{ $product->is_sales == 1 ? 'selected' : '' }}>Đang bán</option>
                    <option value="2" {{ $product->is_sales == 2 ? 'selected' : '' }}>Ngừng bán</option>
                    <option value="3" {{ $product->is_sales == 3 ? 'selected' : '' }}>Hết hàng</option>
                </select>
            </div>
            <div class="mb-3">
                <div class="error_success_msg_container my-3"></div>

                <img src="{{ asset($product->product_image) }}" width="200px" height="200px" id="image_preview_{{ $product->product_id }}">

                <div class="form-group mt-3">
                    <input class="form-control" type="file" name="product_image" id="imageEdit_{{ $product->product_id }}">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
    <button type="submit" class="btn btn-primary">Lưu</button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        let originalImageSrc = $('#image_preview_{{ $product->product_id }}').attr('src');

        $(document).on("change", "#imageEdit_{{ $product->product_id }}", function () {
            $(".error_success_msg_container").html("");
            if (this.files && this.files[0]) {
                let img = document.querySelector('#image_preview_{{ $product->product_id }}');
                img.src = URL.createObjectURL(this.files[0]);
            }
        });

        $(document).on("click", ".btn-secondary", function () {
        // Assuming the cancel button has the class btn-secondary
        var productId = "{{ $product->product_id }}";

        $.ajax({
            type: "GET",
            url: "{{ route('product.edit', $product->product_id) }}",
            processData: false,
            success: function(data) {
            // Reset the image preview to the original source
            $('#image_preview_' + productId).attr('src', originalImageSrc);

            // Clear the file input field
            $('#imageEdit_' + productId).val('');

            $('#product_price_' + productId).val('{{ $product->product_price }}');
            $('#product_name_' + productId).val('{{ $product->product_name }}');
            $('#deccription_' + productId).val('{{ $product->deccription }}');
            $('#is_sales_' + productId).val('{{ $product->is_sales }}');

            // Clear error and success messages
            $(".error_success_msg_container").html("");
            },
            error: function(xhr, status, error) {
            console.log(xhr.responseText);
            }
        });
        });

        $(document).on("submit", ".image_upload_form", function (e) {
            e.preventDefault();
            let form_data = new FormData(this);
            let productId = $(this).data("product_id");
            let $form = $(this);

            $.ajax({
                url: "{{ route('product.update.post', $product->product_id) }}",  //$(this).attr("action"),
                method: "POST",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {
                    console.log(form_data);
                    for (var pair of form_data.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
    }
                    $(".error_success_msg_container").html("");
                    $(".image_preview").hide();

                    if (res.status == "success") {
                        toastr.success('Image Successfully Uploaded');
                        $('#product_price_' + productId).val($form.find('input[name="product_price"]').val());
                        $('#product_name_' + productId).val($form.find('input[name="product_name"]').val());
                        $('#deccription_' + productId).val($form.find('textarea[name="deccription"]').val());
                        $('#is_sales_' + productId).val($form.find('input[name="is_sales"]').val());

                        // close modal
                        $(".modal.fade").modal('hide');
                        $(".modal-backdrop").remove();
                    }
                },
                error: function (err) {
                    let error = err.responseJSON;
                    $(".error_success_msg_container").html("");
                    if (error.errors) {
                    $.each(error.errors, function (index, value) {
                        toastr.error(value);
                    });
                    } else {
                        toastr.error('An unexpected error occurred. Please try again.');
                    }
                    // Log the error for debugging
                    console.error("Error:", err);
                    },
                });
        });
    });
</script>
