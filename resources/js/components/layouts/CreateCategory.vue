<template>
    <v-container>
        <v-form @submit.prevent="edit ? updateCategory(category.slug) : createCategory">
            <v-text-field
            v-model="category.name"
            label="Category Name ..."
            required
          ></v-text-field>
        
        <v-btn type="submit" v-show="!edit">Create Category</v-btn>
        <v-btn type="submit" v-show="edit">Update Category</v-btn>
        </v-form>

        <v-card>
            <v-toolbar color="indigo" dark> 
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
            categories : {},
            edit : false
        }
    },
    created(){
        if (!User.admin()) {
            this.$router.push('/forum')
        }
        this.fetchCategories()
    },
    methods: {
        fetchCategories(){
            axios.get('/api/category')
            .then(res => this.categories = res.data.data)
            .catch(err => console.log(err))
        },
        createCategory(){
            let self = this
            axios.post('/api/category',this.category)
            .then(function(res){
                this.categories.unshift(res.data)
                self.category.name = ''
            })
            .catch(err => console.log(err))
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
