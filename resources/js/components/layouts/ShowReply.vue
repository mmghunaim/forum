<template>
    <div>
        <v-card class="mb-3">
            <v-card-title>
                <div class="headline">{{ reply.user }}</div>
                <div class="ml-2">{{ reply.created_at }}</div>
            </v-card-title>
            <v-divider></v-divider>

            <editreply v-if="edit" :reply ="reply"></editreply>
            <v-card-text v-else v-html="body"></v-card-text>

            <div v-if="!edit">
                <v-card-actions v-if="replyActionsVisible">
                    <v-btn icon>
                        <v-icon small color="orange" @click="editReqly">edit</v-icon>
                    </v-btn>
                    <v-btn icon>
                        <v-icon small color="red" @click="deleteReply">delete</v-icon>
                    </v-btn>
                </v-card-actions>
            </div>
            
        </v-card>
    </div>
</template>

<script>
import editreply from './EditReply'
export default {
    components:{
        editreply
    },
    props : ['reply','QuestionSlug'],
    data() {
        return {
            replyActionsVisible : false,
            edit : false
        }
    },
    created() {
        if (User.own(this.reply.user_id)) {
            this.replyActionsVisible = true
        }
        eventBus.$on('cancelEditing',data=>{
            this.edit = false
        })
    },
    computed: {
        body(){
            return md.parse(this.reply.body)
        }
    },
    methods: {
        deleteReply(){
            axios.delete('/api/question/'+this.QuestionSlug+'/reply/'+this.reply.id)
            .then(res => {
                eventBus.$emit('deleteReplySuccess','success')
            })
            .catch(err => console.log(err))
        },
        editReqly(){
            this.edit = true
        }
    },
}
</script>

<style>

</style>
