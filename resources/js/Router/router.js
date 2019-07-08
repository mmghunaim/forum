import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login  from '../components/login/Login.vue'
import Signup from '../components/login/Signup'
import Forum  from '../components/layouts/Forum' 
import Logout  from '../components/login/Logout'
const routes = [
    { path: '/login', component: Login },
    { path: '/signup' , component: Signup },
    { path: '/forum' , component: Forum , name:'forum'},
    { path: '/logout' , component: Logout}
]

const router = new VueRouter({
    routes ,// short for `routes: routes`
    hashbang :false,
    mode:'history'
})

export default router