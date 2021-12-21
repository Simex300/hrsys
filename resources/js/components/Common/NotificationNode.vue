<template>
    <div class="notification__node">
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
            progressWidth: 0
        }
    },
    mounted() {
        this.$emit('destroy');
        let progressInterval = setInterval(() => {
            let currTime = Date.now();
            this.progressWidth = (((currTime - this.data.startTime) / (this.maxTime * 1000) ) * 100).toFixed(2);
            if(this.$refs.progress)
                this.$refs.progress.style['width'] = `${this.progressWidth}%`;
            if(this.progressWidth > 100) {
                this.progressWidth = 100;
                clearInterval(progressInterval);
            }
        }, 20);
    }
}
</script>
