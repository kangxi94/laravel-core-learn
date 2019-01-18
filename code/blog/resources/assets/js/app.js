
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('go-top', require('./components/GoTop.vue'));
Vue.component('share', require('./components/Share.vue'));
Vue.component('zan', require('./components/Zan.vue'));

Vue.component('comment-post', require('./components/comments/CommentPost.vue'));
Vue.component('comment-root', require('./components/comments/CommentRoot.vue'));
Vue.component('comment-child', require('./components/comments/CommentChild.vue'));

const app = new Vue({
    el: '#app'
});
