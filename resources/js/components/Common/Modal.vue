<template>
    <div class="modal" v-show="showModal">
        <div class="modal__container">
            <button @click="closeModal" class="modal__container__close"><i class="fas fa-times"></i></button>
            <slot></slot>
        </div>
    </div>
</template>
<script>
export default {
    props:['showModal'],
    methods: {
        closeModal() {
            this.$emit('onClose')
        }
    },
}
</script>
