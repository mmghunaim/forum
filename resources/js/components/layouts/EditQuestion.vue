<template>
  <v-form @submit.prevent="updateQuestion">
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
            <v-autocomplete
            :items="categories"
            v-model="question.category_id"
            item-text="name"
            item-value = "id"
            label="Select Category"
            autocomplete
            ></v-autocomplete>

            <markdown-editor v-model="question.body"></markdown-editor>

            
            <v-btn
            color="yellow"
            type="submit"
            >
                Update
            </v-btn>

            <v-btn
            color="green"
            @click="returnToQuestion"
            >Cancle</v-btn>
        </v-flex>
      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
export default {
    props : ['data'],
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
        this.question = this.data
        
        
        console.log(this.data)
    },
    methods: {
        updateQuestion(){
            axios.put('/api/question/'+this.data.slug,this.question)
            .then(res => this.returnToQuestion())
            .catch(err => this.errors = err.response.data)
        },
        fetchCategories(){
            axios.get('/api/category')
            .then(res =>  this.categories = res.data.data)
            .catch(err => console.log(err))
        },
        returnToQuestion(){
            eventBus.$emit('cancelEditing','canceld')
            this.$router.push(this.data.path)
            
        }
    },
}
</script>

