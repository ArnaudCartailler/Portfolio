
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import BootstrapVue from 'bootstrap-vue';
import Vue from 'vue';
import Vuetify from 'vuetify';
import router from './router/router.js';
import 'vuetify/dist/vuetify.min.css';
import VueRouter from 'vue-router';
Vue.use(Vuetify, {
    theme: {
        secondary: '#97A0D9',
        accent: '#282A4C',
        accent2: '#4e3a6f',
        light: '#F0E9E9',
        error: '#FF5252',
        danger: '#db4545',
        info: '#2196F3',
        success: '#4CAF50',
        warning: '#FFC107',
        svgaccent: '#000080',
        svgaccent2: '#191970',
        svgprimary1: '#00FF7F',
        svgprimary2: '#90EE90',
        svgsecondary1: '#9370DB',
        svgsecondary2: '#6A5ACD',
        svglight1: '#FFFAFA',
        svglight2: '#F5F5F5',
    }
});
Vue.use(BootstrapVue);
Vue.use(VueRouter)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('arnaudcartailler-portfolio', require('./components/Content').default)

const app = new Vue({
    el: '#app',
    router,

    watch: {
        '$router'() {
            // listen for route changes
        }
    },
});
