<template>
  <v-layout>
    <v-flex xs12 >
        
        <router-link :to="data.path">
            <v-card>
                <v-card-title primary-title>
                <div>  
                    <h3 class="headline mb-0">
                        {{data.title}}
                    </h3>
                    <div class="grey--text">
                        BY : {{data.user}}, 
                        {{data.created_at}}
                        </div>
                </div>
                </v-card-title>
                <v-card-text>
                    {{data.body}}
                </v-card-text>
            </v-card>
      </router-link>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
    props : ["data"],
}
</script>

<style>
a {text-decoration: none}

</style>
