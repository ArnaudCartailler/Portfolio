<style>

.img-border{
    border-radius: 40px;
}
</style>

<template>
    <v-layout class="pa-4">
        <v-flex xs12 sm12 md6>
            <search-sum></search-sum>
        </v-flex>
        <v-flex xs12 sm12 md6>
            <summary-sum></summary-sum>
        </v-flex>
    </v-layout>
</template>

<script>
import SearchSum from  './summoner/SearchSum.vue';
import SummarySum from  './summoner/SummarySum.vue';


    export default {
        name: 'Home',

        data(){
            return {

            }
        },

        components:
        {
            "search-sum": SearchSum,
            "summary-sum": SummarySum
        }
    }
</script>