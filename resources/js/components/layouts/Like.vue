<template>
    <div>
        <v-btn icon="" @click="like" v-if="isLoggedIn">
            <v-icon :color="color">favorite</v-icon>{{count}}
        </v-btn>
    </div>
</template>

<script>
export default {
    props : ['reply'],
    data() {
        return {
            isLiked : this.reply.liked,
            count : this.reply.like_count,
            isLoggedIn : User.isLoggedIn()
        }
    },
    created(){
        Echo.channel('likeChannel')
        .listen('.LikeEvent', (e) => {
            if (e.id == this.reply.id) {
                e.type == 1 ? this.count++ : this.count--
            }
        });
    },
    computed:{
        color(){
            return this.isLiked ? 'red' : 'red lighten-4';
        }
    },
    methods: {
        like(){
            if (User.isLoggedIn()) {
                this.isLiked ? this.dec() : this.inc()
                this.isLiked = !this.isLiked
            }
            
        },
        inc(){
            axios.post('/api/like/'+this.reply.id)
            .then(res => this.count++)
            .catch(err => console.log(err))   
        },
        dec(){
            axios.delete('/api/like/'+this.reply.id)
            .then(res => this.count--)
            .catch(err => console.log(err)) 
        }
    },
}
</script>

<style scoped>
.redLike {color : red}
</style>
