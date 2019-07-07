<template>
    <div>
        <router-view></router-view>
        <appfooter></appfooter>
        
    </div>
</template>

<script>
import appfooter from './layouts/AppFooter.vue'
import login from './login/Login.vue'
export default {
    components : {
        appfooter,
        login
    }
}
</script>

<style scoped>

</style>
