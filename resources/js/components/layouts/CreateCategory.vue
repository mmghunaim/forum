<template>
    <v-container>
        <v-alert type="error" :value="true" v-if="errors">some fileds are required</v-alert>
        <v-form @submit.prevent="edit ? updateCategory(category.slug) : createCategory()">
            <v-text-field
            v-model="category.name"
            label="Category Name ..."
            required
          ></v-text-field>
        
        <v-btn type="submit" v-show="!edit" :disabled="disabled">Create Category</v-btn>
        <v-btn type="submit" v-show="edit"  :disabled="disabled">Update Category</v-btn>
        </v-form>

        <v-card class="mt-5">
            <v-toolbar color="#1E88E5"  dark> 
                <v-toolbar-title>Categories</v-toolbar-title>
            </v-toolbar>  

            <v-list>
                <div v-for="category in categories" :key="category.id">
                    <v-list-tile>
                        <v-list-tile-action>
                            <v-btn icon small @click="editCategory(category)">
                                <v-icon color="orange">edit</v-icon>
                            </v-btn>
                        </v-list-tile-action>
                        <v-list-tile-title>
                            {{category.name}}            
                            <span class="grey--text" style="font-size:11px">created by : {{category.user_name}}</span>   
                            
                        </v-list-tile-title>
                        <v-list-tile-action>
                            <v-btn @click="deleteCategory(category)" icon small>
                                <v-icon color="red" >delete</v-icon>
                            </v-btn>
                        </v-list-tile-action>
                    </v-list-tile>
                    <v-divider></v-divider>
                </div>
            </v-list>
        </v-card>

    </v-container>
</template>

<script>
export default {
    data() {
        return {
            category : {
                name : '',
                slug : ''
            },
            categories : [],
            edit : false,
            errors : null
        }
    },
    created(){
        if (!User.admin()) {
            this.$router.push('/forum')
        }
        this.fetchCategories()
    },
    computed: {
        disabled(){
            return !(this.category.name)
        }
    },
    methods: {
        fetchCategories(){
            axios.get('/api/category')
            .then(res => this.categories = res.data.data)
            .catch(err => console.log(err))
        },
        createCategory(){
            let self = this
            axios.post('/api/category',self.category)
            .then(function(res){
                self.categories.unshift(res.data)
                self.category.name = ''
            })
            .catch(err => this.errors = err.response.data.errors)
        },
        deleteCategory(category){
            axios.delete('/api/category/'+category.slug)
            .then(res => {
                this.fetchCategories();
            })
            .catch(err => console.log(err))
        },
        editCategory(category){
            this.category.name =category.name
            this.category.slug = category.slug
            this.edit = true 
        },
        updateCategory(slug){
            axios.put('/api/category/'+slug,this.category)
            .then(res =>{
                this.fetchCategories();
                this.edit = false;
                this.category.name = '';
            })
            .catch(err => console.log(err))

        }
    },
}
</script>

<style>

</style>
