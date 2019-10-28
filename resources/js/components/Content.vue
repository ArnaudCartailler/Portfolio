<style>

</style>

<template>
    <v-content>

        <v-container fluid fill-height pa-0 wrap>
            <router-view></router-view>
        </v-container>

    </v-content>

</template>

<script>

    export default {

        name: 'Content',

        watch: {
            '$route'(){
            }
        },
        
    }
</script>