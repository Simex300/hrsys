<template>
    <div class="notification__node">
        <i :class="['icon', 'fas', icon]"></i>
        <h2 class="title">{{title}}</h2>
        <p class="sub">{{sub}}</p>
    </div>
</template>
<script>
export default {
    props: ['icon', 'title', 'sub'],
    mounted() {
        this.$emit('destroy');
    }
}
</script>
