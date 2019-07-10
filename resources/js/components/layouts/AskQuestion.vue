<template>
  <v-form @submit.prevent="createQuestion">
    <v-container>
      <v-layout>      
        <v-flex xs12 md12>

          <v-text-field
            v-model="question.title"
            label="Question Title .."
            type="text"
            required
          ></v-text-field>
            <!-- "
            :filter="customFilter" -->
            <v-select
            :items="categories"
            v-model="question.category_id"
            item-text="name"
            item-value = "id"
            label="Select Category"
            autocomplete
            ></v-select>

            <markdown-editor v-model="question.body"></markdown-editor>

            
            <v-btn
            color="green"
            type="submit"
            >
                Create
            </v-btn>
        </v-flex>
      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
export default {
    data() {
        return {
            question : {
                title : '',
                body  : '',
                category_id: ''

            },
            categories : [],
            errors : []
        }
    },
    created() {
        this.fetchCategories()
    },
    methods: {
        createQuestion(){
            axios.post('api/question',this.question)
            .then(res => this.$router.push(res.data.path))
            .catch(err => this.errors = err.response.data)
        },
        fetchCategories(){
            axios.get('api/category')
            .then(res =>  this.categories = res.data.data)
            .catch(err => console.log(err))
        }
    },
}
</script>

<style>

</style>
