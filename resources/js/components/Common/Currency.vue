<template>
    <label class="form__group__label label">
        <span>{{label}} <span class="error" v-if="error && error.$error"> {{ error.$errors[0].$message }}</span></span>
        <input type="hidden" :value="value" v-on:input="$emit('input', $event.target.value)">
        <input type="text" :name="name" :placeholder="placeholder" :value="formattedValue" @input="$emit('input', formatCurrency($event))" @keydown="avoidDelete" class="form__group__input">
    </label>
</template>
<script>
export default {
    props: {
        label: String,
        name: String,
        placeholder: String,
        value: [String, Number],
        error: Object
    },
    data() {
        return {
            formattedValue: "0.00",
        }
    },
    mounted() {
        if(this.value)
            this.formattedValue = this.value;
    },
    methods: {
        formatCurrency(e) {
            if(e.inputType == "deleteContentBackward"){
                let formattedFloat = parseFloat(this.formattedValue) / 10;
                formattedFloat = formattedFloat.toFixed(2);
                this.formattedValue = formattedFloat;
            }
            else {
                this.formattedValue += e.data;
                let formattedFloat = parseFloat(this.formattedValue) * 10;
                formattedFloat = formattedFloat.toFixed(2);
                this.formattedValue = formattedFloat;
            }
            return this.formattedValue;
        },
        avoidDelete(e) {
            if (e.key == "Backspace" && this.formattedValue == "0.00")
                e.preventDefault()
        }
    }
}
</script>
