<template>
    <div class="notification">
        <NotificationNode v-for="(notification, index) in this.notifications" :key="index" :class="notification.type" :icon="notification.icon" :title="notification.title" :sub="notification.sub" :data="notification" :maxTime="maxTime" @destroy="removeNotification" />
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
            notifications: [],
            maxTime: 5
        }
    },
    methods: {
        addNotification(data) {
            data.maxTime = this.maxTime;
            data.startTime = Date.now();
            this.notifications.unshift(data);
        },
        removeNotification() {
            let seconds = this.maxTime;
            setTimeout(() => {
                this.$delete(this.notifications, this.notifications.length - 1);
            }, seconds * 1000);
        }

    }
}
</script>
