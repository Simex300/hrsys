<template>
    <div class="notification">
        <NotificationNode v-for="(notification, index) in this.notifications" :key="index" :class="notification.type" :icon="notification.icon" :title="notification.title" :sub="notification.sub" @destroy="removeNotification" />
        <!-- <div class="notification__node success">
            <i class="icon fas fa-cog"></i>
            <h2 class="title">Success</h2>
            <p class="sub">The configuration has been done sucessfully</p>
        </div>
        <div class="notification__node warning">
            <i class="icon fas fa-cog"></i>
            <h2 class="title">Success</h2>
            <p class="sub">The configuration has been done sucessfully</p>
        </div>
        <div class="notification__node error">
            <i class="icon fas fa-cog"></i>
            <h2 class="title">Success</h2>
            <p class="sub">The configuration has been done sucessfully</p>
        </div>
        <div class="notification__node info">
            <i class="icon fas fa-cog"></i>
            <h2 class="title">Success</h2>
            <p class="sub">The configuration has been done sucessfully</p>
        </div> -->
    </div>
</template>
<script>
import NotificationNode from './NotificationNode.vue';

export default {
    components: {
        NotificationNode
    },
    data() {
        return {
            notifications: []
        }
    },
    methods: {
        addNotification(data) {
            this.notifications.unshift(data);
        },
        removeNotification() {
            setTimeout(() => {
                this.$delete(this.notifications, this.notifications.length - 1);
            }, 5 * 1000)
        }

    }
}
</script>
