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
      <v-flex xs4>
          <sidbar :data = categories></sidbar>
      </v-flex>
    </v-layout> 
   </v-container>    
</template>
<script>
import question from './question'
import sidbar from './CategorySidebar'
export default {
    components : {
        question,
        sidbar
    },
    data() {
        return {
            questions : {},
            categories : {}
        }
    },
    created() {
        this.fetchCategories()
        this.fetchQuestions()
    },
    methods: {
        fetchQuestions(){
            axios.get('/api/question')
            .then(res => this.questions = res.data.data)
            .then(err => console.log(err))
        },
        fetchCategories(){
            axios.get('/api/category')
            .then(res => this.categories = res.data.data)
            .catch(err => console.log(err))
        }
    },
}
</script>

<style>

</style>
