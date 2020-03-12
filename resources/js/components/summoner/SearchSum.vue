<style>

.level-sum{
    border: 1px solid goldenrod;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    margin: auto;
    margin-top: -9px;
    background-color: #2C3548;
    color: gold;
    width: 80px;
}

.card-match{
    width: 80px;
    margin-bottom: 15px;;
}

.champ-match{
    border: 1px solid lightgray;
    margin: auto;
    margin-bottom: 5px;
}

.champ-match{
    border: 1px solid lightgray;
    margin: auto;
    margin-bottom: 5px;
}
</style>
<template>
    <v-flex xs12>

        <v-layout row wrap>
            <v-flex xs12 sm8 md8 class="pa-2">
                <v-text-field
                    v-model="summoner.name"
                >
                </v-text-field>
                <v-btn @click="getSummonerByName()">
                    Chercher
                </v-btn>

                <v-btn @click="clearResult()">
                    Clear
                </v-btn>
            </v-flex>
        </v-layout>

        <v-layout row wrap>
            <v-flex xs12 sm8 md8 class="pa-2">
                <v-card
                    v-if="error == false"
                    class="mx-auto w-75"
                >
                    <v-card-title class="title">
                        Info du joueur : {{ result.name }}
                    </v-card-title>
                    <v-card-text>
                            <div v-if="!loaded">
                                <v-img class="img-border w-25 mx-auto" :src="require('../../../../public/profile_img/29.png')" fluid></v-img>
                            </div>
                            <div class="text-center title" v-else>
                                <v-img class="img-border w-25 mx-auto" :src="require('../../../../public/profile_img/' + result.profileIconId +'.png')" fluid></v-img>
                                <div class="level-sum py-2">
                                    {{ result.summonerLevel }}
                                </div>
                            </div>
                    </v-card-text>
                    <v-card-actions v-if="loaded">
                        <v-btn class="mx-auto"  @click="listMatch()">
                            See more about this summoner
                        </v-btn>
                    </v-card-actions>
                </v-card>
                <v-card
                    v-else
                    flat
                >
                    <v-card-title class="title">
                        Info du joueur
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-layout row wrap>
                            <div class="subheading danger--text">
                                Erreur
                            </div>
                        </v-layout>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>

        <v-layout row wrap>
            <v-flex xs12>
                <v-item-group mandatory>
                    <v-container>
                        <v-layout row wrap>
                            <v-flex
                                v-for="(name, i) in match" :key="i"
                                xs12 sm12 md4
                            >
                            <v-item class="pa-2 w-50 champ-match">
                                <v-layout row wrap  @click="$router.push('/details?matchId=' + name.gameId )">
                                    <v-flex xs12 sm12 md3>
                                        <div>
                                            <v-img :src="require('../../../../public/champ_img/' + getChampName( name.champion ) +'.png')"></v-img>
                                        </div>
                                    </v-flex>
                                    <v-flex xs12 sm12 md9 v-if="name.lane !== 'NONE'">
                                        <div class="subheading text-center">
                                            {{ name.lane }}
                                        </div>
                                        <div class="subheading text-center font-weigth-bold">
                                            Season : {{ name.season }}
                                        </div>
                                        <div class="subheading text-center">
                                            {{ moment(name.timestamp, "x").format("MM/DD/YYYY") }}
                                        </div>
                                </v-flex>
                                <v-flex xs12 sm12 md9 v-else>
                                    <div class="subheading text-center">
                                        ARAM
                                    </div>
                                </v-flex>
                                </v-layout>
                            </v-item>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-item-group>
            </v-flex>
        </v-layout>
    </v-flex>
</template>
<script>

import moment from 'moment';
import champion from '../../helper/champion.json';

    export default {
        name: 'SearchSum',

        data(){
            return {
                moment: moment,
                loaded: false,
                result :{},
                summoner:{
                    name: ''
                },
                champions: champion.data,
                match:[],
                error : false,
                errorMessage: 'Error',
                refresh: 0,
                idArray: [],
            }
        },

        created()
        {
            this.champions = Object.values(this.champions)              
        },
        methods:{

            getSummonerByName()
            {

                axios.get('api/summoner/show/' + this.summoner.name)
                    .then((res) => {
                        this.result = res.data.data
                        this.loaded = true
                        this.error = false
                    })
                    .catch((res) => {
                        this.error = true
                        this.clearResult()
                    }) 

            },
            listMatch()
            {
                axios.get('api/match/index/' + this.result.accountId)
                    .then((res) => {

                        this.match = res.data.data.matches

                        this.match.forEach((el) => {
                            this.idArray.push(el.champion)
                        })
                    })
                    
            },
            clearResult()
            {
                this.summoner.name = ''
                this.result = ''
                this.match = []
                this.loaded = false
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

            details()
            {

            }
        },
        computed:
        {
        }

    }
</script>