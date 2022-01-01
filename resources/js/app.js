import Vue from 'vue';
import VueRouter from 'vue-router';
import VueCompositionAPI from '@vue/composition-api';
import VueCalendarHeatmap from 'vue-calendar-heatmap';
import VCalendar from 'v-calendar';

import router from './router';
import axios from 'axios';

import App from './App.vue';

import store from './store';

require('./bootstrap');

Vue.use(VueRouter);
Vue.use(VueCalendarHeatmap);
Vue.use(VCalendar);
Vue.use(VueCompositionAPI);
Vue.prototype.$http = axios;

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
