<template>
    <v-card>
        <v-toolbar color="cyan" dark>
          <v-toolbar-title>Categories</v-toolbar-title>
         </v-toolbar>  

         <v-list>
             <v-list-tile v-for="category in data" :key="category.id">
                 <v-list-tile-title>
                     {{category.name}}            
                     <span class="grey--text" style="font-size:11px">created by : {{category.user_name}}</span>   
                     
                 </v-list-tile-title>
                 
             </v-list-tile>
         </v-list>
    </v-card>
</template>

<script>
export default {
    props : ['data']
}
</script>

<style>

</style>
