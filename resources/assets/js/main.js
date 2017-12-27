var kenuo = require('./common');

/**退出登录*/
$('#login-out').on('click', function(e) {

    kenuo.default.message.alert('','将要退出登录？', 'warning','退出','取消', function (){
        e.preventDefault();
        $('#logout-form').submit();
    });

});

/**公共提示要登录**/
$('#login').on('click', function(e) {

    kenuo.default.message.alert('','需要登录以后才能执行此操作。', 'warning','前往登录','取消', function (){
        location.href = '/login';
    });

});

/**公共删除内容*/
$('[data-method]').append(function(){

    let token = document.head.querySelector('meta[name="csrf-token"]');

    return "\n"+
        "<form action='"+$(this).attr('data-url')+"' method='POST' style='display:none'>\n"+
        "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "   <input type='hidden' name='_token' value='"+token.content+"'>\n"+
        "</form>\n"
}).attr('style','cursor:pointer;')
.click(function() {
    var that = $(this);
    if ($(this).attr('data-method') == 'delete') {

        kenuo.default.message.alert('','将你确定要删除此内容吗？', 'warning','删除','取消', function (){
            that.find("form").submit();
        });

    }

    if ($(this).attr('data-method') == 'post') {
        $(this).find("form").submit();
    }

});

function login() {
    kenuo.default.message.alert('','需要登录以后才能执行此操作。', 'warning','前往登录','取消', function (){
        location.href = '/login';
    });
}
