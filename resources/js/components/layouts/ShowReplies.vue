<template>
    <v-container>
        <reply 
        v-for="reply in QuestionReplies.replies" 
        :key="reply.id"  
        :reply= reply 
        :QuestionSlug = QuestionReplies.slug></reply>
    </v-container>
</template>

<script>
import reply from './ShowReply'
export default {
    data() {
        return {
            replyItself : this.QuestionReplies.replies
        }
    },
    components : {
        reply
    },
    created() {
        this.listen()
    },
    props : ['QuestionReplies'],
    methods: {
        listen(){
            Echo.private('App.User.' + User.userId())
            .notification((notification) => {
                this.replyItself.unshift(notification.reply)
            });

            Echo.channel('deleteReplyChannel')
            .listen('.DeleteReplyEvent',(e)=>{
                for (let index = 0; index < this.replyItself.length; index++) {
                    if (this.replyItself[index].id == e.id) {
                        this.replyItself.splice(index,1)
                    }
                }                
            })
        }
    },
}
</script>

<style>

</style>
