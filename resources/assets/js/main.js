var kenuo = require('./common');

$('#login-out').on('click', function(e) {

    /**退出登录*/
    kenuo.default.message.alert('','将要退出登录？', 'warning','退出','取消', function (){
        e.preventDefault();
        $('#logout-form').submit();
    });

});
