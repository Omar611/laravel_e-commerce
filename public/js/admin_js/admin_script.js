$(document).ready(function () {

    // Start Check inputed Admin current password in form
    $('#check-pass').fadeOut();
    $('#current_pwd').blur(function () {
        var token = $("#updatePasswordForm > input[type=hidden]").val();
        var current_pwd = $('#current_pwd').val();
        if (current_pwd) {
            $.ajax({
                type: "post",
                url: "/admin/check-current-pwd",
                data: {
                    _token: token,
                    current_pwd: current_pwd,
                },
                success: function (res) {
                    if (res !== "1") {
                        $('#check-pass')
                            .fadeIn()
                            .addClass('text-danger')
                            .removeClass('text-success')
                            .text('Password is not matched with our records');
                    } else {
                        $('#check-pass')
                            .fadeIn()
                            .addClass('text-success')
                            .removeClass('text-danger')
                            .text("Password Confirmed");
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            });
        } else {
            $('#check-pass')
                .fadeIn()
                .addClass('text-danger')
                .removeClass('text-success')
                .text("Please enter password");
        }
    })
    // End Check inputed Admin current password in form

    // Start Preview Admin Image before upload
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#output').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
            // $('#output').slideDown(800);
        }
    }
    $("#upload_image").change(function () {
        readURL(this);
        $("#deleted_message").fadeOut();
    });
    // End Preview Admin Image before upload

    // Start Shop Sections DataTable
    $(function () {
        $("#sections").DataTable();
    });
    // End Shop Sections DataTable

    // Start update Sections status
    $(".updateSectionStatus").click(function () {
        var status = $(this).text();
        var section_id = $(this).attr('section_id');
        var id = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "/admin/update-section-status",
            data: {
                status: status,
                section_id: section_id
            },
            success: function (res) {
                if (res == 0) {
                    $("#" + id).text("Inactive").addClass("text-danger").removeClass("text-success");
                } else {
                    $("#" + id).text("Active").addClass("text-success").removeClass("text-danger");
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
    // End update Sections status

    // Start update Categories status
    $(".updateCategoryStatus").click(function () {
        var status = $(this).text();
        var category_id = $(this).attr('category_id');
        console.log(status, category_id);
        var id = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "/admin/update-category-status",
            data: {
                status: status,
                category_id: category_id
            },
            success: function (res) {
                if (res == 0) {
                    $("#" + id).text("Inactive").addClass("text-danger").removeClass("text-success");
                } else {
                    $("#" + id).text("Active").addClass("text-success").removeClass("text-danger");
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
    // End update Categories status

    //Initialize Select2 Elements
    $('.select2').select2()


    // Start Append Category Level
    $("#section_id").change(function () {
        var section_id = $(this).val();
        $.ajax({
            type: "post",
            url: "/admin/append-categories-level",
            data: {
                section_id: section_id,
            },
            success: function (res) {
                console.log(res);
                $('#parent_id').html(`<option selected="selected" value="0">Main Category</option>`)
                res.forEach(cat => {
                    $('#parent_id').append(`<option value="${cat.id}">${cat.category_name}</option>`)
                    if (cat.subcategories) {
                        cat.subcategories.forEach(subcat => {
                            $('#parent_id').append(`<option value="${subcat.id}"> --- ${subcat.category_name}</option>`)
                        })
                    }
                });
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
    // End Append Category Level

    // Start Delete Category Image
    if(!$("#old_img").val()){
        $("#delete_image").fadeOut(0);
    }
    $("#delete_image").click(function (e) {
        e.preventDefault();
        var id = $(this).attr('cat-id');
        var img = $("#old_img").val();
        $.ajax({
            type: "post",
            url: "/admin/delete-category-image",
            data: {
                id: id,
                img: img
            },
            success: function (res) {
                $('#output').attr("src", "");
                $("#delete_image").fadeOut();
                $("#deleted_message").text("Image Deleted Successfully").slideDown();
                $("#old_img").remove();
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
    // End Delete Category Image
})
