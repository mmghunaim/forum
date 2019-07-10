
require('./bootstrap');

const axios = require('axios');
const token = 'Bearer '+localStorage.getItem('token');
window.axios.defaults.headers.common['Authorization'] = token
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
import Vue from 'vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify);

import User from './Helpers/User'
window.User = User;

window.eventBus = new Vue({})


import VueSimplemde from 'vue-simplemde'
import 'simplemde/dist/simplemde.min.css'
Vue.use(VueSimplemde)
import md from 'marked'
window.md = md
window.Vue = require('vue');

Vue.component('apphome', require('./components/AppHome.vue').default);
Vue.component('toolbar', require('./components/layouts/Toolbar.vue').default);

import router from './Router/router.js'
const app = new Vue({
    el: '#app',
    router
});
