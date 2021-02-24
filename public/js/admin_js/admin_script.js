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
        }
    }
    $("#admin_image").change(function () {
        readURL(this);
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

})
