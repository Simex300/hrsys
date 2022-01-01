import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';
import {routes} from './routes';

Vue.use(VueRouter)

var router = new VueRouter({
    mode: 'history',
    routes
})

router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} - ${process.env.MIX_APP_NAME}`;
    if(to.meta.middleware == "guest") {
        if(store.state.auth.authenticated) {
            switch(to.name) {
                case "login":
                    next({name: "home"});
                    break;
                default:
                    next();
            }
        }
        else {
            next();
        }
    }
    else {
        if(store.state.auth.authenticated) {
            switch(to.name) {
                case "login":
                    next({name: "home"});
                    break;
                default:
                    next();
            }
        }
        else {
            next({name: "login"})
        }
    }
})

export default router;
