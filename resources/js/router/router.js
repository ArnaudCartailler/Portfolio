import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [{
        path: '/',
        name: 'home',
        component: Vue.component('Home', require('.././components/Home.vue').default),
         meta: {
            requiresAuth: 0,
        }
    },
    {
        path: '/details',
        name: 'details',
        component: Vue.component('Details', require('.././components/Details.vue').default),
         meta: {
            requiresAuth: 0,
        }
    }
];

const router = new VueRouter({
    routes: routes,
    hashbang: false,
    mode: 'history'
});


export default router;