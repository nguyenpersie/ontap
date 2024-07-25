$(document).ready(function () {
    $(".edit-button").on("click", function () {
        var id = $(this).data("id");
        $.get("/users/" + id + "/edit", function (data) {
            $("#editModal").modal("show");
            $("#editForm #user_id").val(data.id);
            $("#editForm #name").val(data.name);
            $("#editForm #email").val(data.email);
            $("#editForm #group_role").val(data.group_role);
            $("#editForm #is_active").val(data.is_active);
            $("#editForm").attr("action", "/users/" + id);
        });
    });

    $("#editForm").on("submit", function (e) {
        e.preventDefault();
        var url = $(this).attr("action");
        $.ajax({
            type: "PUT",
            url: url,
            data: $(this).serialize(),
            success: function (response) {
                $("#editModal").modal("hide");
                alert(response.success);
                location.reload(); // Reload the page to see the changes
            },
            error: function (error) {
                console.log(error);
                alert("Something went wrong. Please try again.");
            },
        });
    });
});
