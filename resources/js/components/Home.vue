<style>

.img-border{
    border-radius: 40px;
}
</style>

<template>
    <v-layout class="pa-4">
        <v-flex xs12>

            <v-layout row wrap>

                <v-flex xs12 sm4 md6 class="pa-2">
                    <v-text-field
                        v-model="summoner.name"
                    >
                    </v-text-field>
                    <v-btn @click="getSummonerByName()">
                        Look 
                    </v-btn>

                    <v-btn @click="clearResult()">
                        Empty
                    </v-btn>
                    <v-btn @click="toto()">
                        toto
                    </v-btn>
                </v-flex>
                

                <v-flex xs12 sm8 md6 class="pa-2">
                    <v-card
                        v-if="error == false"
                        class="mx-auto"
                    >
                        <v-card-title class="title">
                            Info du joueur
                        </v-card-title>
                        <v-divider></v-divider>
                        <v-card-text>
                            <v-layout row wrap  class="pa-2">
                                <v-flex xs12 sm4 md4>
                                    <div v-if="!loaded">
                                        <v-img  :src="require('../../../public/profile_img/29.png')"></v-img>
                                    </div>
                                    <div v-else >
                                        <v-img  class="img-border" :src="require('../../../public/profile_img/' + result.profileIconId +'.png')"></v-img>
                                    </div>
                                </v-flex>
                                <v-flex xs12 sm8 md8>
                                    <v-list>
                                        <v-list-tile>
                                            <v-list-tile-content>
                                                <v-list-tile-title class="title text-left">Nom de l'invocateur : {{ result.name }}</v-list-tile-title>
                                                <v-list-tile-sub-title class="text-left">Niveau de l'invocateur : {{ result.summonerLevel }}</v-list-tile-sub-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>
                                </v-flex>
                            </v-layout>
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
                <v-list>
                    <v-list-tile v-for="(match, i) in match.matches" :key="i">
                        <v-list-tile-content>
                            <v-list-tile-title class="subheading">
                                {{ match.champion }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
                <!-- <div>
                    Total de game joué cette saison : {{ match.totalGames}}
                </div>
                <div>
                    <div>
                    <img class="img-border" :src="require('../../../public/champ_img/Aatrox.png')">
                    </div>
                </div> -->
            </v-layout>

        </v-flex>
    </v-layout>
</template>

<script>

import champion from '../helper/champion.json';

    export default {
        name: 'Home',

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
                errorMessage: 'azertyui',
                refresh: 0
            }
        },

        created()
        {
            this.champions = Object.values(this.champions)

            console.log(this.champions)
        
        },
        methods:{

            toto()
            {

            },
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
                        this.match = res.data.data
                        console.log(this.match)
                    })
            },
            clearResult()
            {
                this.summoner.name = ''
                this.result = ''
                this.loaded = false
            },
        },
        computed:
        {
        }

    }
</script>