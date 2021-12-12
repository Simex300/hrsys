<template>
    <div :class="{'screen': true, 'full': !this.$store.state.auth.authenticated}">
        <div v-if="this.$store.state.auth.authenticated" class="sidebar-container">
            <Sidebar />
        </div>
        <div class="page-container">
            <router-view @add-notification="addNotification"></router-view>
        </div>
        <Notification ref="notification"/>
    </div>
</template>
<script>
    import Sidebar from "./components/Common/Sidebar.vue";
    import Notification from './components/Common/Notification.vue';

    export default {
        components: {
            Sidebar,
            Notification,
        },
        methods: {
            addNotification(data) {
                this.$refs.notification.addNotification(data);
            }
        }
    }
</script>
