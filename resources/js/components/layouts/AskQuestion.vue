<template>
  <v-container>
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
            <div style="color : red" v-if="errors.title">{{errors.title[0]}}</div>
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
              <div style="color : red" v-if="errors.category_id" class="mb-4">{{errors.category_id[0]}}</div>
              <markdown-editor v-model="question.body"></markdown-editor>
              <div style="color : red" v-if="errors.body"  class="mb-4 mt-0">{{errors.body[0]}}</div>

              <v-btn
              color="#1E88E5"
              type="submit"
               :disabled=" ! (question.title && question.body && question.category_id) "

              >
                  Create
              </v-btn>
            </v-flex>
          </v-layout>
        </v-container>
      </v-form>
  </v-container>
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
            .catch(err => {
              this.errors = err.response.data.errors
              console.log(err.response.data.errors)
            })
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
