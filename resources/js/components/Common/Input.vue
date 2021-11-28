<template>
    <label class="label">
        <span>{{label}} <span class="error" v-if="error && error.$error"> There are errors</span></span>
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
        error: Object
    }
}
</script>
