<template>
    <div :class="{'screen': true, 'full': !this.authenticated}">
        <div v-if="this.authenticated" class="sidebar-container">
            <Sidebar />
        </div>
        <div class="page-container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import Sidebar from "./components/Common/Sidebar.vue";

    export default {
        components: {
            Sidebar
        },
        data() {
            return {
                authenticated: this.$store.state.auth.authenticated
            }
        }
    }
</script>
