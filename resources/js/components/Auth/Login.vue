<template>
    <div class="login">
        <div class="header">
            <h2>Login</h2>
        </div>
        <div class="body">
            <form @submit.prevent="onSubmit" class="form">
                <div class="form__group">
                    <Input type="text" name="email" label="Email" v-model="auth.email"/>
                </div>
                <div class="form__group">
                    <Input type="password" name="password" label="Password" v-model="auth.date_of_birth" />
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

export default {
    name: "login",
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
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/login',this.auth).then(({data})=>{
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
