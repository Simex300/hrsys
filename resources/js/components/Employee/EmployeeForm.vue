<template>
    <div class="employeeForm">
        <div class="header">
            <h2>Add Employee</h2>
        </div>
        <div class="body">
            <form @submit.prevent="onSubmit" class="form">
                <div class="form__group row-2 col-3">
                    <ImageInput class="r-full" name="profile" v-model="employee.profile" @getImage="getImage" />
                    <Input type="text" class="r-first-half" name="first_name" label="First Name" v-model="employee.first_name" :error="v$.employee.first_name" />
                    <Input type="text" class="r-first-half" name="middle_name" label="Middle Name" v-model="employee.middle_name"  />
                    <Input type="text" class="r-second-half c-two-third" name="last_name" label="Last Name" v-model="employee.last_name" :error="v$.employee.last_name" />
                </div>
                <div class="form__group">
                    <Input type="text" name="email" label="Email" v-model="employee.email" :error="v$.employee.email"/>
                    <Input type="text" name="phone" label="Phone" v-model="employee.phone" />
                </div>
                <div class="form__group">
                    <Input type="date" name="date_of_birth" label="Date of Birth" v-model="employee.date_of_birth" />
                    <Select name="gender" label="Gender" v-model="employee.gender" :options="this.options.gender" />
                </div>
                <div class="form__group">
                    <Input type="text" name="address1" label="Address 1" v-model="employee.address1" :error="v$.employee.address1"/>
                    <Input type="text" name="address2" label="Address 2" v-model="employee.address2" />
                </div>
                <div class="form__group">
                    <Input type="text" name="city" label="City" v-model="employee.city" :error="v$.employee.city" />
                    <Input type="text" name="state" label="State" v-model="employee.state" :error="v$.employee.state" />
                    <Input type="text" name="country" label="Country" v-model="employee.country" :error="v$.employee.country" />
                </div>
                <div class="form__group">
                    <Currency type="text" name="salary" label="Salary" v-model="employee.salary" :error="v$.employee.salary" />
                    <Select name="salary_rate" label="Salary Rate" v-model="employee.salary_rate" :options="this.options.salary_rate" :error="v$.employee.salary_rate" />
                    <Input type="date" name="hire_at" label="Hire At" v-model="employee.hire_at" />
                </div>
                <div class="form__group footer">
                    <button>Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import Currency from "../Common/Currency.vue"
import ImageInput from "../Common/ImageInput.vue"
import Input from "../Common/Input.vue"
import Select from "../Common/Select.vue"

import useVuelidate from '@vuelidate/core'
import { required, email } from '@vuelidate/validators'

export default {
    setup() {
        return {v$: useVuelidate()}
    },
    components: {
        Currency,
        ImageInput,
        Input,
        Select
    },
    props: ['employee'],
    data() {
        return {
            options: {
                gender: {male: "Male", female: "Female"},
                salary_rate: {Hourly: 'Hourly', Weekly: 'Weekly', Monthly: 'Monthly', Anually: 'Anually'},
            },
            profile: null,
            formConfig: {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
        }
    },
    methods: {
        onSubmit(e) {
            this.AddEmployee(this.employee);
        },
        getImage(file) {
            this.profile = file;
        },
        getFormDataFields(fields) {
            let data  = new FormData();
            for(const field in fields) {
                data.append(field, fields[field]);
            }
            return data
        },
        async AddEmployee(employee) {
            // console.log("Employee: ", employee);
            const isFormCorrect = await this.v$.$validate()
            // you can show some extra alert to the user or just leave the each field to show it's `$errors`.
            if (!isFormCorrect) return
            if (this.profile) {
                employee.profile = this.profile
            }
            const formFields = this.getFormDataFields(employee);

            if(employee.id > 0) {
                axios.patch(`http://localhost:8000/api/employees/${employee.id}`, formFields, this.formConfig)
                .then(res => {
                    this.$emit('editEmployee', res);
                })
            }
            else {
                axios.post("http://localhost:8000/api/employees", formFields, this.formConfig)
                .then(res => {
                    this.$emit('addEmployee', res.data);
                })
            }
        },
    },
    validations () {
        return {
            employee: {
                first_name: { required },
                last_name: { required },
                email: { required, email },
                address1: { required },
                city: { required },
                state: { required },
                country: { required },
                salary: { required },
                salary_rate: { required },
            }
        }
    }
}
</script>
