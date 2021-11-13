<template>
    <label class="form__group__label label">
        <span>{{label}}</span>
        <select class="form__group__select" :name="name" :placeholder="placeholder" :value="value">
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
}
</script>
