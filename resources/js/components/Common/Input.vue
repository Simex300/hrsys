<template>
    <label class="form__group__label label">
        <span>{{label}}</span>
        <input :type="type" :name="name" :placeholder="placeholder" :value="value" v-on:input="$emit('input', $event.target.value)" class="form__group__input">
    </label>
</template>
<script>
export default {
    props: {
        label: String,
        type: String,
        name: String,
        placeholder: String,
        value: [String, Number],
    }
}
</script>
