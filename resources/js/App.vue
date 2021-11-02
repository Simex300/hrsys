<template>
    <div class="screen">
        <div class="sidebar-container">
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
