<style>

</style>

<template>
    <v-content>
        <nav-bar></nav-bar>
            <v-container fluid fill-height pa-0 wrap>
                <router-view></router-view>
            </v-container>
    </v-content>
</template>

<script>

import NavBar from './header/NavBar.vue';

    export default {

        name: 'Content',

        components:{
            "nav-bar": NavBar
        },

        watch: {
            '$route'(){
            }
        },
        
    }
</script>