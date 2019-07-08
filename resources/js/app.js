
require('./bootstrap');
const axios = require('axios');

import Vue from 'vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify);

import User from './Helpers/User'
window.User = User;

window.eventBus = new Vue({})

window.Vue = require('vue');

Vue.component('apphome', require('./components/AppHome.vue').default);
Vue.component('toolbar', require('./components/layouts/Toolbar.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import router from './Router/router.js'
const app = new Vue({
    el: '#app',
    router
});
