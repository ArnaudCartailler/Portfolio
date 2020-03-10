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
                        class="mx-auto"
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
                <v-list two-line>
                    <v-list-tile v-for="(name, i) in match" :key="i">
                        <v-list-tile-content>
                            <div class="w-100">
                                <v-img :src="require('../../../../public/champ_img/' + getChampName( name.champion ) +'.png')"></v-img>
                            </div>
                            <v-list-tile-title class="subheading" v-if="name.lane !== 'NONE'">
                                {{ name.lane }}
                            </v-list-tile-title>
                            <v-list-tile-sub-title class="subheading" v-else>
                                ARAM
                            </v-list-tile-sub-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-layout>
        </v-flex>
</template>
<script>
import champion from '../../helper/champion.json';

    export default {
        name: 'SearchSum',

        data(){
            return {
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
                popo: []
            }
        },

        created()
        {
            this.champions = Object.values(this.champions)  

            console.log(this.champions)

            
        },
        methods:{

            getSummonerByName()
            {

                axios.get('api/summoner/show/' + this.summoner.name)
                    .then((res) => {
                        this.result = res.data.data
                        this.loaded = true
                        this.error = false
                        console.log(this.result)
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
                        console.log(this.idArray)
                    })
                    
            },
            clearResult()
            {
                this.summoner.name = ''
                this.result = ''
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

            }
        },
        computed:
        {
        }

    }
</script>