<template>
  <v-toolbar>
    <!-- <v-toolbar-side-icon></v-toolbar-side-icon> -->
    <v-toolbar-title>Laravel Real Time App</v-toolbar-title>
    <v-spacer></v-spacer>
    <div class="hidden-sm-and-down">
      <router-link to="/forum">
        <v-btn flat>Forum</v-btn>
      </router-link>

      <router-link to="/forum">
        <v-btn flat>Ask Question</v-btn>
      </router-link>

      <router-link to="/forum">
        <v-btn flat>Category</v-btn>
      </router-link >

      <router-link to="/login">
        <v-btn flat>Login</v-btn>
      </router-link>  
    </div>
  </v-toolbar>
</template>

<style scoped>
a {  text-decoration: none;}
</style>
