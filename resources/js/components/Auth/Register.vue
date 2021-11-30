<template>
    <div class="register">
        <div class="header">
            <h1>Add User</h1>
        </div>
        <div class="body">
            <form @submit.prevent="register" class="form">
                <div class="form__group">
                    <Input type="text" name="name" label="Name" v-model="user.name"/>
                </div>
                <div class="form__group">
                    <Input type="text" name="email" label="Email" v-model="user.email"/>
                </div>
                <div class="form__group">
                    <Input type="password" name="password" label="Password" v-model="user.password" />
                    <Input type="password" name="password_confirm" label="Confirm Password" v-model="user.password_confirmation" />
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
    name: "register",
    components: {
        Input
    },
    data() {
        return {
            user:{
                name:"",
                email:"",
                password:"",
                password_confirmation:""
            },
            processing: false
        }
    },
    methods: {
        ...mapActions({
            signIn: 'auth/login'
        }),
        async register() {
            this.processing = true;
            await axios.post('/api/register',this.user).then(data=>{
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
