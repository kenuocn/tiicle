require('./bootstrap');

// window.Vue = require('vue');
//
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
//
// const app = new Vue({
//     el: '#app'
// });

var kenuo = require('./main');

console.log(kenuo)
// title, text, type, callback
kenuo.default.message.alert(`标题信息`, `文字信息`, `success`, function () {
    kenuo.default.message.alert(`你点击了退出`, `文字信息`, `success`)
})
