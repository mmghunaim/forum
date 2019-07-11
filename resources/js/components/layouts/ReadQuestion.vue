<template>
    <div v-if="question">
        <editquestion v-if="edit" :data = question ></editquestion>
        <showquestion v-else :data = question ></showquestion>
        <replies :QuestionReplies = question></replies>
        <newreply :questionslug = question.slug></newreply>
    </div>
</template>

<script>
import showquestion from './ShowQuestion'
import editquestion from './EditQuestion'
import replies from './ShowReplies'
import newreply from './CreateReply'
export default {
    components : {
        showquestion,
        editquestion,
        replies,
        newreply
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

            eventBus.$on('commentCreated',data=>{
                this.getSingleQuestion()
                window.scrollTo(0,0)
            })
            eventBus.$on('deleteReplySuccess',data=>{
                this.getSingleQuestion()
                window.scrollTo(0,0)
            })
        }
    },
}
</script>

<style>

</style>
