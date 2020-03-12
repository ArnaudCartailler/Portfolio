<style>
.img-detail{
    width: 60px;
}
</style>
<template>
    <v-flex xs12>
       <div v-if="isLoaded">
           Durée de la game: {{ convertToMinutes(details.gameDuration) }}  minutes
       </div>
       <!-- <v-layout row wrap>
           <v-flex xs12 sm12 md6>
            <div v-for="(joueur, i) in details.participantIdentities" :key="i">
                <div class="title pa-2">
                    {{ joueur.player.summonerName}}
                </div>
            </div>
            </v-flex>
            <v-flex xs12 sm12 md6>
            <div v-for="(detail, j) in details.participants" :key="j">
                <div class="title pa-2">
                    <v-img class="w-25" :src="require('../../../public/champ_img/' + getChampName( detail.championId ) +'.png')"></v-img>
                </div>
            </div>
           </v-flex>
       </v-layout> -->
       <v-layout row wrap class="champ-match">
            <v-flex xs12 sm6 md2>
                <v-list>
                    <v-list-tile v-for="(detail, j) in details.participants" :key="j" class="py-3">
                        <div class="img-detail">
                            <v-img :src="require('../../../public/champ_img/' + getChampName( detail.championId ) +'.png')"></v-img>
                        </div>
                        <div class="ml-3 font-weigth-bold"> {{ detail.stats.kills }} / {{ detail.stats.deaths }} / {{ detail.stats.assists }} </div>
                    </v-list-tile>
                </v-list>
           </v-flex>
           <v-flex xs12 sm6 md10>
                <v-list>
                    <v-list-tile v-for="(joueur, i) in details.participantIdentities" :key="i" class="py-3">
                        <v-list-tile-content>
                            <v-list-tile-title>
                                    {{ joueur.player.summonerName}}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
           </v-flex>
       </v-layout>
    </v-flex>
</template>
<script>

import moment from 'moment';
import champion from '../helper/champion.json';

export default {
    name: 'Details',

    data(){
            return {
                isLoaded: false,
                moment: moment,
                champions: champion.data,
                matchId: null,
                details : [],
                timeDetails: []
            }
        },

        created()
        {
            this.matchId = this.$route.query.matchId

            this.champions = Object.values(this.champions)              

            axios.get('/api/match/show/' + this.matchId)
                .then((res) => {
                    this.isLoaded = true
                    this.details = res.data.data
                    console.log(this.details)

                        axios.get('/api/match/timeDetails/' + this.matchId)
                        .then((res) => {
                            this.timeDetails = res.data.data.frames
                            console.log(this.timeDetails)
                        })
                })

        },
        methods:{

            convertToMinutes( scd )
            {
                let min = scd / 60
                return parseInt(min)
            },

            getChampName( id )
            {

                let filter = this.champions.filter(function(el){
                    return el.key == id;         
                })

                let name = ''

                filter.forEach((el) => {
                    return name = el.id
                })

                return name

            },
        },
        computed:
        {
        }
}
</script>