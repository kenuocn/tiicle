const kenuo = (function () {
    const kenuo = {
        message: {
            alert: function (title, text, type, confirm,cancel,callback) {
                swal({
                    title: title || "",
                    text: text || "默认内容",
                    type: type || "warning",
                    showCancelButton: true,
                    cancelButtonText:cancel || '取消',
                    confirmButtonText:confirm || '确定',
                }).then(function () {
                    if (callback && typeof callback !== 'function') {
                        return false
                    } else {
                        callback()
                    }
                });
            }
        }
    };

    return kenuo

}).call(this);

export default kenuo