import Login from '../components/Auth/Login.vue';
import Register from '../components/Auth/Register.vue';

export default [
    {
        name:"login",
        path:"/login",
        component: Login,
        meta:{
            middleware:"guest",
            title:`Login`
        }
    },
    {
        name:"register",
        path:"/register",
        component: Register,
        meta:{
            middleware:"guest",
            title:`Register`
        }
    },
]
