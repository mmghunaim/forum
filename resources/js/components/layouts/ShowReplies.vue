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
    components : {
        reply
    },
    props : ['QuestionReplies']
}
</script>

<style>

</style>
