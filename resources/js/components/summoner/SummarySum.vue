<style>

</style>
<template>
    <v-flex xs12>
        Résumé du summoner
    </v-flex>
</template>
<script>
import champion from '../../helper/champion.json';

    export default {
        name: 'SummarySum',

        data(){
            return {
                champion: champion.data
            }
        },

        created()
        {

        },
        methods:{

        },
        computed:
        {
        }

    }
</script>