<template>
    <v-container>
        <markdown-editor v-model="reply.body"></markdown-editor>
        <v-btn color="green" @click="createcomment">
            Comment
        </v-btn>
    </v-container>
</template>

<script>
export default {
    props : ['questionslug'],
    data() {
        return {
            reply : {
                body : ''
            }
        }
    },
    methods:{
        createcomment(){
            axios.post('/api/question/'+this.questionslug+'/reply',this.reply)
            .then(res => {
                this.reply.body = ''
                eventBus.$emit('commentCreated',res.data.reply)
            })
            .catch(err => console.log(err))
        }
    }
}
</script>

<style>

</style>
