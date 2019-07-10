<template>
  <v-container grid-list-md >
    <v-layout row wrap>
        <v-flex xs8>
            <question 
            v-for="question in questions"
            :key="question.body"
            :data = question
            ></question>
      </v-flex>
      Category
    </v-layout> 
   </v-container>    
</template>
<script>
import question from './question'
export default {
    components : {
        question
    },
    data() {
        return {
            questions : {}
        }
    },
    created() {
        this.fetchQuestions()
    },
    methods: {
        fetchQuestions(){
            axios.get('api/question')
            .then(res => this.questions = res.data.data)
            .then(err => console.log(err))
        }
    },
}
</script>

<style>

</style>
