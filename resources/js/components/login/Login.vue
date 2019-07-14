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
            // let myemail = this.user.email
            // let mypass = this.user.password
            // axios({
            //     method: 'post',
            //     url: '/api/auth/login',
            //     data: {
            //         email: myemail,
            //         password: mypass
            //     }
            // })
            // .then(res => 
            //     console.log(res.data) 
            // )
            // .catch(function (error) {
            //     console.log('fuck you');
            // });
            User.login(this.user)
        }
    }
}
</script>

<style>

</style>
