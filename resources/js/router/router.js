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
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});


export default router;