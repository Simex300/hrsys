<template>
    <div class="navbar">
        <div class="navbar__header">
            <i class="navbar-icons fas fa-city"></i> <span>Human Resources System</span>
        </div>
        <div class="navbar__body">
            <a :class="{'navbar-link': true, 'active': this.$route.name.includes('home')}" @click="goto('home')">
                <i class="navbar-icons fas fa-tachometer-alt"></i> <span>Dashboard</span>
            </a>
            <a :class="{'navbar-link': true, 'active': this.$route.name.includes('employee')}" @click="goto('employee')">
                <i class="navbar-icons fas fa-users"></i> <span> Employee</span>
            </a>
        </div>
        <div class="navbar__footer">
            <img class="navbar__footer__image" :src="`${this.api_url}/storage/${this.$store.state.auth.user.profile}`" alt="hugenerd" width="30" height="30">
            <span class="navbar__footer__dropdown">{{ this.$store.state.auth.user.first_name }} {{ this.$store.state.auth.user.last_name }}</span>
            <div class="navbar__footer__icon" @click.prevent="logout">
                <i class="fas fa-power-off"></i>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions } from 'vuex';

export default {
    data() {
        return {
            api_url: process.env.MIX_APP_URL
        }
    },
    methods: {
        ...mapActions({
            signOut: "auth/logout"
        }),
        async logout() {
            await axios.post(`${process.env.MIX_APP_URL}/api/logout`).then(data => {
                this.signOut()
                this.$router.push({name:"login"})
            })
        },
        goto(name) {
            this.$router.push({name});
        }
    }
}
</script>
