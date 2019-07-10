import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login  from '../components/login/Login.vue'
import Signup from '../components/login/Signup'
import Forum  from '../components/layouts/Forum' 
import Logout  from '../components/login/Logout'
import ReadQuestion from '../components/layouts/ReadQuestion'
import AskQuestion from '../components/layouts/AskQuestion'
import EditQuestion from '../components/layouts/EditQuestion'
const routes = [
    { path: '/login', component: Login },
    { path: '/logout' , component: Logout},
    { path: '/signup' , component: Signup },
    { path: '/forum' , component: Forum , name:'forum'},
    { path: '/question/:slug' , component: ReadQuestion , name:'readquestion'},
    { path: '/askquestion' , component : AskQuestion},
    { path : '/editquestion' , component : EditQuestion }
    
]

const router = new VueRouter({
    routes ,// short for `routes: routes`
    hashbang :false,
    mode:'history'
})

export default router