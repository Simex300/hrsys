<template>
    <div class="notification">
        <NotificationNode v-for="(notification, index) in this.notifications" :key="index"
        :class="notification.type"
        :icon="notification.icon"
        :title="notification.title"
        :sub="notification.sub"
        :data="notification"
        :maxTime="maxTime"
        @destroy="removeNotification(notification)"
        @pause="pauseNotification(notification)"
        @resume="resumeNotification(notification)"
        @remove="destroyNotification(notification)" />
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
            this.notifications.push(data);
        },
        removeNotification(notification) {
            let seconds = this.maxTime;
            notification.timeOut = setTimeout(() => {
                this.destroyNotification(notification);
            }, seconds * 1000);
        },
        pauseNotification(notification) {
            notification.secondsRemaining = (notification.secondsRemaining ? notification.secondsRemaining : this.maxTime * 1000) - (Date.now() - notification.startTime);
            clearTimeout(notification.timeOut);
        },
        resumeNotification(notification) {
            notification.startTime = Date.now();
            notification.timeOut = setTimeout(() => {
                this.$delete(this.notifications, this.notifications.length - 1);
            }, notification.secondsRemaining);
        },
        destroyNotification(notification) {
            this.$delete(this.notifications, this.notifications.indexOf(notification));
        }
    }
}
</script>
