import Vue from 'vue';
import VueRouter from 'vue-router';
import VueCompositionAPI from '@vue/composition-api';
import {routes} from './routes';

import App from './App.vue';
import axios from 'axios';

require('./bootstrap');

Vue.use(VueRouter);
Vue.use(VueCompositionAPI);
Vue.prototype.$http = axios;

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    components: { App },
    router
});
