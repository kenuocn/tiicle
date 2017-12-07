require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue'));


const app = new Vue({
    el: '#app'
});

require('./main');
