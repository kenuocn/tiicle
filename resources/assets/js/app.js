require('./bootstrap');

window.Vue = require('vue');

/**话题关注组件**/
Vue.component('voted-topic-button', require('./components/VotedTopicButton.vue'));

/**关注用户组件*/
Vue.component('user-followers-button', require('./components/UserFollowersButton.vue'));

const app = new Vue({
    el: '#app'
});

require('./main');
