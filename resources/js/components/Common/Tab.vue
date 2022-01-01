<template>
    <div class="tab">
        <div class="tab__options">
            <div v-for="(tab, index) in tabs" :key="index" :class="{tab__options__option: true, active: index === currTab}" @click="changeTab(index)">{{tab}}</div>
        </div>
        <template v-for="(tab, index) in tabs">
            <div :key="index" v-if="index === currTab" class="tab__content">
                <slot :name="`tabPanel-${index}`" :active="currTab"></slot>
            </div>
        </template>
    </div>
</template>
<script>
export default {
    props: ['tabs'],
    data() {
        return {
            currTab: 0,
        }
    },
    methods: {
        changeTab(index) {
            this.currTab = index;
        }
    }
}
</script>
