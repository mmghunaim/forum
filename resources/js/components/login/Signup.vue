<template>
  <v-form @submit.prevent="signup">
    <v-container>
      <v-layout>      
        <v-flex xs12 md12>
            <v-text-field
            v-model="user.name"
            label="Name"
            type="text"
            required
            ></v-text-field>
            <span v-if="errors.name" style="color:red">{{errors.name[0]}}</span>

            <v-text-field
            v-model="user.email"
            label="E-mail"
            type="email"
            required
            ></v-text-field>
            <span v-if="errors.email" style="color:red">{{errors.email[0]}}</span>

            <v-text-field
            v-model="user.password"
            type="password"
            label="Password"
            required
            ></v-text-field>
            <span v-if="errors.password" style="color:red">{{errors.password[0]}}</span>

            <v-text-field
            v-model="user.password_confirmation"
            type="password"
            label="Confirm Password"
            required
            ></v-text-field>

            <v-btn
            color="green"
            type="submit"
            >
                Sign Up
            </v-btn>

            <router-link to="/login"><v-btn color="blue">Login</v-btn></router-link>
        </v-flex>
      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
export default {
    data() {
        return {
            user : {
                name : '',
                email : '',
                password : '' ,
                password_confirmation  : ''
            },
            errors : {

            }
        }
    },
    created(){
      if(User.isLoggedIn()){
        this.$router.push({name : 'forum'})
      }
    },
    methods: {
        signup(){
            axios.post('/api/auth/signup',this.user)
            .then(function(response){
                User.sotreAfterResponse(response)
            })
            .catch(err => console.log(this.errors = err.response.data.errors))

        }
    }
}
</script>

<style>

</style>
