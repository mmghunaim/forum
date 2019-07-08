<template>
</template>

<script>
export default {
    created() {
        eventBus.$emit('logout','success');
    },
    
}
</script>

<style>

</style>
