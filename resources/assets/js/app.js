
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import VueRouter from 'vue-router';
import router from './routes';
import Auth from './auth';
import Api from './api';
import moment from 'moment';
require('./bootstrap');



window.Vue = require('vue');
window.api = new Api();
Vue.use(VueRouter);
window.auth = new Auth();
window.Event = new Vue;
Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('DD.mm.YYYY');
    }
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('vue-layout', require('./views/Layout.vue'));


const app = new Vue({
    el: '#app',
    router,

});
