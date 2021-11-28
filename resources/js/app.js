import Vue from 'vue';
import VueRouter from 'vue-router';
import VueCompositionAPI from '@vue/composition-api';
import router from './router';

import App from './App.vue';
import axios from 'axios';

import store from './store';

require('./bootstrap');

Vue.use(VueRouter);
Vue.use(VueCompositionAPI);
Vue.prototype.$http = axios;

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
