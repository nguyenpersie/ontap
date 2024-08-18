// function noPreview() {
//     $("#image-preview-div").css("display", "none");
//     $("#preview-img").attr("src", "https://via.placeholder.com/300");
//     $("#upload-button").attr("disabled", "disabled");
// }

// $(document).ready(function (e) {
//     var maxsize = 500 * 1024; // 500 KB

//     $("#max-size").html((maxsize / 1024).toFixed(2));

//     $("#upload-image-form").on("submit", function (e) {
//         e.preventDefault();

//         $("#message").empty();
//         $("#loading").show();

//         $.ajax({
//             url: "", // Đảm bảo URL đúng
//             type: "POST",
//             data: new FormData(this),
//             contentType: false,
//             cache: false,
//             processData: false,
//             success: function (data) {
//                 $("#loading").hide();

//                 if (data.success) {
//                     // Hiển thị thông báo thành công
//                     toastr.success(data.message);

//                     // Hiển thị hình ảnh đã tải lên nếu có
//                     if (data.image_path) {
//                         $("#image-preview-div").show();
//                         $("#preview-img").attr("src", data.image_path);
//                     }
//                 } else {
//                     // Hiển thị thông báo lỗi
//                     toastr.error(
//                         "An error occurred while uploading the image."
//                     );
//                 }
//             },
//             error: function () {
//                 $("#loading").hide();
//                 toastr.error("An unexpected error occurred.");
//             },
//         });
//     });

//     $("#file").change(function () {
//         $("#message").empty();

//         var file = this.files[0];
//         var match = ["image/jpeg", "image/png", "image/jpg"];

//         if (
//             !(
//                 file.type == match[0] ||
//                 file.type == match[1] ||
//                 file.type == match[2]
//             )
//         ) {
//             noPreview();

//             $("#message").html(
//                 '<div class="alert alert-warning" role="alert">Unvalid image format. Allowed formats: JPG, JPEG, PNG.</div>'
//             );

//             return false;
//         }

//         if (file.size > maxsize) {
//             noPreview();

//             $("#message").html(
//                 '<div class="alert alert-danger" role="alert">The size of image you are attempting to upload is ' +
//                     (file.size / 1024).toFixed(2) +
//                     " KB, maximum size allowed is " +
//                     (maxsize / 1024).toFixed(2) +
//                     " KB</div>"
//             );

//             return false;
//         }

//         $("#upload-button").removeAttr("disabled");

//         var reader = new FileReader();
//         reader.onload = selectImage;
//         reader.readAsDataURL(this.files[0]);
//     });
// });

$(document).ready(function () {
    //todo:image preview
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

    //todo:update image
    // $(document).on("submit", "#image_upload_form", function (e) {
    //     e.preventDefault();
    //     let form_data = new FormData(this);
    //     let productId = $(this).data("product_id");

    //     $.ajax({
    //         url: $(this).attr("action"), //"{{ route('product.update.post', ':id') }}".replace(':id', productId),
    //         method: "post",
    //         data: form_data,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         success: function (res) {
    //             $(".error_success_msg_container").html("");
    //             $(".image_preview").hide();
    //             if (res.status == "success") {
    //                 $(".error_success_msg_container").html(
    //                     '<p class="text-success">Image Successfully Uploaded</p>'
    //                 );
    //                 // Construct the modal ID
    //                 let modalId = "#modalEdit" + productId;

    //                 // Hide the modal
    //                 let modalElement = document.querySelector(modalId);
    //                 if (modalElement) {
    //                     let bootstrapModal = new bootstrap.Modal(modalElement);
    //                     bootstrapModal.hide(); // Correct method to hide the modal
    //                 }
    //             }
    //         },
    //         error: function (err) {
    //             let error = err.responseJSON;
    //             $(".error_success_msg_container").html("");
    //             $.each(error.errors, function (index, value) {
    //                 $(".error_success_msg_container").append(
    //                     '<p class="text-danger">' + value + "<p>"
    //                 );
    //             });
    //         },
    //     });
    // });
});
