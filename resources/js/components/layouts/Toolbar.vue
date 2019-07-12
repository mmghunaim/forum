<template>
  <v-toolbar>
    <!-- <v-toolbar-side-icon></v-toolbar-side-icon> -->
    <v-toolbar-title>Laravel Real Time App</v-toolbar-title>
    <v-spacer></v-spacer>
    <appnotification v-if="isLogged"></appnotification>
    <div class="hidden-sm-and-down">

      <router-link
      v-for="item in items"
      :key="item.title"
      :to="item.to"
      v-show="item.show"
      >
        <v-btn flat>{{item.title}}</v-btn>
      </router-link>
 
    </div>
  </v-toolbar>
</template>

<script>
import appnotification from './AppNotification'
export default {
  data() {
    return {
      items : [
        {title : 'Forum' , to : '/forum' , show : true},
        {title : 'Ask Question' , to : '/askquestion' , show : User.isLoggedIn()},
        {title : 'Category' , to : '/category' , show : User.admin()},
        {title : 'Login' , to : '/login' , show : !User.isLoggedIn()},
        {title : 'Logout' , to : '/logout' , show : User.isLoggedIn()}
      ],
      isLogged : User.isLoggedIn()
    }
  },
  components : {
    appnotification
  },
  created() {
    // eventBus.$on('logout'),()=>{
    //   User.logout()
    // }
    eventBus.$on('logout',data=>{
      User.logout();
    });
    
  },
}
</script>
<style scoped>
a {  text-decoration: none;}
</style>