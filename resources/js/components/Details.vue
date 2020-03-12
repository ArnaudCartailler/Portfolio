<style>

</style>
<template>
    <v-flex xs12>
        azertyu
    </v-flex>
</template>
<script>
export default {
    name: 'Details',

    data(){
            return {
                matchId: null,
                details : []
            }
        },

        created()
        {
            this.matchId = this.$route.query.matchId

            axios.get('/api/match/show/' + this.matchId)
                .then((res) => {
                    this.details = res.data.data
                    console.log(this.details)
                })
        },
        methods:{

        },
        computed:
        {
        }
}
</script>