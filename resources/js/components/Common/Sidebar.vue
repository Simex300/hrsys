<template>
    <div class="navbar">
        <div class="navbar__header">
            <i class="navbar-icons fas fa-city"></i> <span>Human Resources System</span>
        </div>
        <div class="navbar__body">
            <a href="#" class="navbar-link">
                <i class="navbar-icons fas fa-table"></i> <span> Orders</span>
            </a>
            <a href="#" class="navbar-link">
                <i class="navbar-icons fas fa-tachometer-alt"></i> <span>Dashboard</span>
            </a>
            <a href="#" class="navbar-link">
                <i class="navbar-icons fas fa-user-friends"></i> <span>Customers</span>
            </a>
        </div>
        <div class="navbar__footer">
            <img class="navbar__footer__image" src="https://i.redd.it/9rwqt4hld3q71.jpg" alt="hugenerd" width="30" height="30">
            <span class="navbar__footer__dropdown">Name</span>
            <div class="navbar__footer__icon" @click.prevent="logout">
                <i class="fas fa-power-off"></i>
            </div>
        </div>
    </div>
</template>
<script>
import {mapActions} from 'vuex';

export default {
    methods: {
        ...mapActions({
            signOut: "auth/logout"
        }),
        async logout() {
            await axios.post('/api/logout').then(data => {
                this.signOut()
                this.$router.push({name:"login"})
            })
        }
    }
}
</script>
