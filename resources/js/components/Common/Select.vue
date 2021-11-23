<template>
    <label class="form__group__label label">
        <span>{{label}}</span>
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
        options: Object
    },
    methods: {
        changeValue(e) {
            this.$emit('input', e.target.value);
        }
    }
}
</script>
