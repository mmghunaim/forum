<template>
    <div class="text-xs-center">
        <v-menu offset-y>
        <template v-slot:activator="{ on }">
            <v-btn icon=""  v-on="on">
                <v-icon :color="color">add_alert</v-icon>{{unreadCount}}
            </v-btn>
        </template>
        <v-list>
            <v-list-tile v-for="notify in unread " :key="notify.id">
                <router-link :to="notify.path">
                    <v-list-tile-title @click="markAsRead(notify)">{{notify.question}}</v-list-tile-title>
                </router-link>
            </v-list-tile>

            <v-divider></v-divider>

            <v-list-tile v-for="notify in read " :key="notify.id">
                <v-list-tile-title>{{notify.question}}</v-list-tile-title>
            </v-list-tile>
        </v-list>
        </v-menu>
  </div>
</template>

<script>
export default {
    data() {
        return {
            read : {},
            unread : {},
            unreadCount : 0
        }
    },
    created() {
        if (User.isLoggedIn()) {
            this.getNotifications();
        }

        Echo.private('App.User.' + User.userId())
            .notification((notification) => {
                this.unread.unshift(notification)
                this.unreadCount++
            });
    },
    computed:{
        color(){
            return this.unreadCount > 0 ? 'red' : 'red lighten-4'
        }
    },
    methods: {
        getNotifications(){
            axios.post('/api/notifications')
            .then(res => {                
                this.read = res.data.read
                this.unread = res.data.unread
                this.unreadCount = res.data.unread.length
                
            })
            .catch(err => console.log(err))
        },
        markAsRead(notify){
        axios.post('/api/markAsRead/',notify)
        .then(res => {
            this.getNotifications()
        })
    }
    }
}
</script>

<style>

</style>
