const swal = require('./vendor/sweetalert.min');

console.log(swal);

const kenuo = (function () {
    const kenuo = {
        message: {
            alert: function (title, text, type, callback) {
                swal.Sweetalert2({
                    title: title|| "",
                    text: text|| "text message",
                    type: type || "warning",
                    showCancelButton: true,
                    cancelButtonText: "取消",
                    confirmButtonText: "退出"
                }).then(function () {
                    if (callback && typeof callback !== 'function') {
                        return false
                    } else {
                        callback()
                    }
                });
            }
        }
    }
    return kenuo
}).call(this);

 export default kenuo
