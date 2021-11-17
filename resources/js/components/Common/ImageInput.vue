<template>
    <div class="image-input">
        <input type="file" ref="inputFile" class="image-input__file" accept="image/*" name="" id="" @change="previewImage"/>
        <img :class="{'image-input__image': true, 'hidden': this.src == ''} " :src="this.src" alt=""  @click="openImageSearch">
        <div :class="{'image-input__button': true, 'with-image': this.src != ''}" @click="openImageSearch">
            <span class="image-input__button__label">Upload Image</span>
            <i class="image-input__button__icon fas fa-upload"></i>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            src: ""
        }
    },
    methods: {
        openImageSearch() {
            this.$refs.inputFile.click();
        },
        previewImage(e) {
            const file = e.target.files[0];
            this.src = URL.createObjectURL(file);
        }
    }
}
</script>
