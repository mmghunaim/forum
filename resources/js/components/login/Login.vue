<template>
  <v-form @submit.prevent="login">
    <v-container>
      <v-layout>      
        <v-flex xs12 md12>

          <v-text-field
            v-model="user.email"
            label="E-mail"
            required
          ></v-text-field>

            <v-text-field
            v-model="user.password"
            type="password"
            label="Password"
            required
            ></v-text-field>
            
            <v-btn
            color="green"
            type="submit"
            >
                Login
            </v-btn>
            <router-link to="/signup"><v-btn color="blue">Sign up</v-btn></router-link>
        </v-flex>
      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
export default {
    data() {
        return {
            user : [
                email       => '' ,
                password    => ''
            ]
        }
    },
    created(){
      if(User.isLoggedIn()){
        this.$router.push({name : 'forum'})
      }
    },
    methods : {
        login(){
            User.login(this.user)
            // window.location.assign('/forum')
            // this.$router.push({name : 'forum'})
        }
    }
}
</script>

<style>

</style>
