<template>
    <v-container>
        <markdown-editor v-model="reply.body"></markdown-editor>

        <v-card-actions>
            <v-btn icon>
                <v-icon small color="green" @click="updateReqly">save</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon small color="black" @click="cancelEdit">cancel</v-icon>
            </v-btn>
        </v-card-actions>
    </v-container>
</template>

<script>
export default {
    props : ['reply'],
    methods: {
        updateReqly(){
            axios.patch('/api/question/'+this.reply.question_slug+'/reply/'+this.reply.id,this.reply)
            .then( res => this.cancelEdit())
            .catch(err => console.log(err))
        },
        cancelEdit(){
            eventBus.$emit('cancelEditing','success')
        }
    },
}
</script>

<style>

</style>
