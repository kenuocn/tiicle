window.swal = require('./vendor/sweetalert.min');

$('#login-out').on('click', function(e) {
    swal({
        title: "",
        text: "将要退出登录？",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "取消",
        confirmButtonText: "退出"
    }).then(function () {
        e.preventDefault();
        $('#logout-form').submit();
    });

    return false;
});