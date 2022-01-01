<template>
    <div class="login">
        <div class="header">
            <h1>Login</h1>
        </div>
        <div class="body">
            <form @submit.prevent="login" class="form">
                <div class="form__group">
                    <Input type="text" name="email" label="Email" v-model="auth.email"/>
                </div>
                <div class="form__group">
                    <Input type="password" name="password" label="Password" v-model="auth.password" />
                </div>
                <div class="form__group footer">
                    <button>Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { mapActions } from 'vuex'

import Input from '../Common/Input.vue';

export default {
    name: "login",
    components: {
        Input
    },
    data() {
        return {
            auth: {
                email: "",
                password: ""
            },
            processing: false
        }
    },
    methods: {
        ...mapActions({
            signIn: 'auth/login'
        }),
        async login() {
            this.processing = true;
            await axios.get(`${process.env.MIX_APP_URL}/sanctum/csrf-cookie`)
            await axios.post(`${process.env.MIX_APP_URL}/api/login`, this.auth).then(({data})=>{
                this.signIn()
            }).catch(({response:{data}})=>{
                alert(data.message)
            }).finally(()=>{
                this.processing = false
            })
        }
    }
}
</script>
