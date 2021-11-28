<template>
    <label class="form__group__label label">
        <span>{{label}} <span class="form__group__error" v-if="error && error.$error"> There are errors</span></span>
        <select class="form__group__select" :name="name" :value="value" @change="changeValue">
            <option disabled hidden value="">{{placeholder ? placeholder : "Select an option"}}</option>
            <option v-for="(option, key) in options" :key="key" :value="key">{{option}}</option>
        </select>
    </label>
</template>
<script>
export default {
    props: {
        label: String,
        name: String,
        placeholder: String,
        value: String,
        options: Object,
        error: Object
    },
    methods: {
        changeValue(e) {
            this.$emit('input', e.target.value);
        }
    }
}
</script>
