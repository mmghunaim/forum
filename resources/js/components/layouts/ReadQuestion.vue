<template>
    <div v-if="question">
        <editquestion v-if="edit" :data = question ></editquestion>
        <showquestion v-else :data = question ></showquestion>
        
    </div>
</template>

<script>
import showquestion from './ShowQuestion'
import editquestion from './EditQuestion'
export default {
    components : {
        showquestion,
        editquestion
    },
    data() {
        return {
            question : null,
            edit : false
        }
    },
    created() {
        this.getSingleQuestion()
        this.listenToEdit()
    },
    methods: {
        getSingleQuestion(){
            axios.get('/api/question/'+this.$route.params.slug)
            .then(res => this.question = res.data.data)
            .catch(err => console.log(err))
        },
        listenToEdit(){
            eventBus.$on('editIsTrue',data=>{
                this.edit = true
            });

            eventBus.$on('cancelEditing' , data=>{
                this.edit = false
            })
        }
    },
}
</script>

<style>

</style>
