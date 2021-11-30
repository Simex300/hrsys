<template>
    <div :class="{'screen': true, 'full': !this.$store.state.auth.authenticated}">
        <div v-if="this.$store.state.auth.authenticated" class="sidebar-container">
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
        }
    }
</script>
