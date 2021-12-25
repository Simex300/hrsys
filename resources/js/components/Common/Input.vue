<template>
    <label class="label">
        <span>{{label}} <span class="error" v-if="(error && error.$error)"> {{ error.$errors[0].$message }}</span><span class="error" v-if="(serverValidation && serverValidation[name].found)"> {{ serverValidation[name].message }}</span></span>
        <input :type="type" :name="name" :placeholder="placeholder" :value="value" v-on:input="$emit('input', $event.target.value)" @blur="manageInput" class="form__group__input">
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
        error: Object,
        serverValidation: [Function, Object],
    },
    methods: {
        manageInput(event) {
            if(!this.serverValidation)
                return;

            this.serverValidation.validate(this.value);
        }
    }
}
</script>
