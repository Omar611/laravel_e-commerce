$(document).ready(function () {
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
                    if (res !== "Pass Matched") {
                        $('#check-pass')
                            .fadeIn()
                            .addClass('text-danger')
                            .removeClass('text-success')
                            .text(res);
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

})
