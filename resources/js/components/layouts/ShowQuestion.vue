<template>
    <v-card>
        <v-container flud>
            <v-card-title>
                <div>
                    <div class="headline">
                        {{data.title}}
                    </div>
                    <span class="grey--text">
                    By : {{data.user}}, {{data.created_at}} 
                    </span>
                </div>
                <v-spacer></v-spacer>
                <v-btn color="teal">5 Replies</v-btn>
            </v-card-title>
            <v-card-text v-html="body"></v-card-text>
            
            <v-card-actions v-if="own">
                <v-btn icon small >
                    <v-icon color="orange" @click="edit">edit</v-icon>
                </v-btn>
                <v-btn icon small >
                    <v-icon color="red" @click="deleteQuestion">delete</v-icon>
                </v-btn>
            </v-card-actions>
        </v-container>
    </v-card>
</template>

<script>

export default {
    props : ['data'],
    data() {
        return {
            own : User.own(this.data.user_id)
        }
    },
    computed:{
        body(){
            return md.parse(this.data.body)
        }
    },
    methods: {
        deleteQuestion(){
            axios.delete('/api/question/'+this.data.slug)
            .then(res => this.$router.push('/forum'))
            .catch(err => console.log(err))
        },
        edit(){
            eventBus.$emit('editIsTrue','edit');
        }
    },
}
</script>

<style>

</style>
