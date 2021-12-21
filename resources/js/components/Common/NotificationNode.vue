<template>
    <div class="notification__node" @mouseenter="this.pauseNotification" @mouseleave="resumeNotification">
        <i :class="['icon', 'fas', icon]"></i>
        <h2 class="title">{{title}}</h2>
        <p class="sub">{{sub}}</p>
        <div ref="progress" class="progress"></div>
    </div>
</template>
<script>
export default {
    props: ['icon', 'title', 'sub', 'data', 'maxTime'],
    data() {
        return {
            progressWidth: 0,
            progressInterval: null
        }
    },
    mounted() {
        this.$emit('destroy');
        this.progressInterval = setInterval(() => {
            let currTime = Date.now();
            this.progressWidth = (((currTime - this.data.startTime) / (this.maxTime * 1000) ) * 100).toFixed(2);
            this.addWidth()
            this.clear()
        }, 20);
    },
    methods: {
        pauseNotification() {
            this.$emit('pause');
            clearInterval(this.progressInterval);
        },
        resumeNotification() {
            const newStartTime = Date.now()
            const seconds = (this.progressWidth / 100) * this.maxTime;
            this.$emit('resume');
            this.progressInterval = setInterval(() => {
                let currTime = Date.now();
                this.progressWidth = (((currTime - newStartTime + (seconds * 1000)) / (this.maxTime * 1000) ) * 100).toFixed(2);
                this.addWidth()
                this.clear()
            }, 20)
        },
        addWidth() {
            if(this.$refs.progress)
                this.$refs.progress.style['width'] = `${this.progressWidth}%`;
        },
        clear() {
            if(this.progressWidth > 100) {
                this.progressWidth = 100;
                clearInterval(this.progressInterval);
            }
        }
    }
}
</script>
