<template>
    <div class="employeeForm">
        <div class="header">
            <h2>Add Employee</h2>
        </div>
        <div class="body">
            <form @submit.prevent="onSubmit" class="form">
                <div class="form__tabs">
                    <div class="form__tabs__options">
                        <div :class="{form__tabs__options__option: true, active: this.currTab == 0}" @click="changeTab($event, 0)"><span><i class="icon fas fa-user-circle"></i>Personal Information</span></div>
                        <div :class="{form__tabs__options__option: true, active: this.currTab == 1}" @click="changeTab($event, 1)"><span><i class="icon fas fa-file"></i>Employee Information</span></div>
                        <div :class="{form__tabs__options__option: true, active: this.currTab == 2}" @click="changeTab($event, 2)"><span><i class="icon fas fa-shield-alt"></i>Account Information</span></div>
                    </div>
                    <div v-show="currTab == 0" class="form__tabs__content">
                        <h3 class="form__tabs__content__title">Personal Information</h3>
                        <div class="form__group row-2 col-3">
                            <ImageInput class="r-full" name="profile" v-model="employee.profile" @getImage="getImage" />
                            <Input type="text" class="r-first-half" name="first_name" label="First Name" v-model="employee.first_name" :error="v$.employee.first_name" />
                            <Input type="text" class="r-first-half" name="middle_name" label="Middle Name" v-model="employee.middle_name"  />
                            <Input type="text" class="r-second-half c-two-third" name="last_name" label="Last Name" v-model="employee.last_name" :error="v$.employee.last_name" />
                        </div>
                        <div class="form__group">
                            <Input type="text" name="phone" label="Phone" v-model="employee.phone" />
                            <Input type="date" name="date_of_birth" label="Date of Birth" v-model="employee.date_of_birth" />
                            <Select name="gender" label="Gender" v-model="employee.gender" :options="this.options.gender" />
                        </div>
                        <div class="form__group">
                            <Input type="text" name="address1" label="Address 1" v-model="employee.address.address1" :error="v$.employee.address.address1"/>
                            <Input type="text" name="address2" label="Address 2" v-model="employee.address.address2" />
                        </div>
                        <div class="form__group">
                            <Input type="text" name="city" label="City" v-model="employee.address.city" :error="v$.employee.address.city" />
                            <Input type="text" name="state" label="State" v-model="employee.address.state" :error="v$.employee.address.state" />
                            <Input type="text" name="country" label="Country" v-model="employee.address.country" :error="v$.employee.address.country" />
                            <Input type="text" name="zipcode" label="Zip Code" v-model="employee.address.zipcode" :error="v$.employee.address.zipcode" />
                        </div>
                        <div class="form__group footer">
                            <button @click.prevent="nextTab">Next</button>
                        </div>
                    </div>
                    <div v-show="currTab == 1" class="form__tabs__content">
                        <h3 class="form__tabs__content__title">Employee Information</h3>
                        <div class="form__group">
                            <Select name="role" label="Role" v-model="employee.role" :options="this.options.role" :error="v$.employee.role" />
                            <Select name="department" label="Department" v-model="employee.department" :options="this.options.department" :error="v$.employee.department" />
                        </div>
                        <div class="form__group">
                            <Currency type="text" name="salary" label="Salary" v-model="employee.salary" :error="v$.employee.salary" />
                            <Select name="salary_rate" label="Salary Rate" v-model="employee.salary_rate" :options="this.options.salary_rate" :error="v$.employee.salary_rate" />
                            <Input type="date" name="hire_at" label="Hire At" v-model="employee.hire_at" />
                        </div>
                        <div class="form__group footer">
                            <button @click.prevent="nextTab">Next</button>
                        </div>
                    </div>
                    <div v-show="currTab == 2" class="form__tabs__content">
                        <h3 class="form__tabs__content__title">Account Information</h3>
                        <div class="form__group">
                            <Input type="text" name="email" label="Email" v-model="employee.user.email" :error="v$.employee.user.email" :serverValidation="serverValidations" @blur="checkEmail"/>
                        </div>
                        <div class="form__group">
                            <Input type="password" name="password" label="Password" v-model="employee.user.password" :error="v$.employee.user.password"/>
                            <Input type="password" name="password_confirm" label="Confirm Password" v-model="employee.user.password_confirmation" :error="v$.employee.user.password_confirmation"/>
                        </div>
                        <div class="form__group footer">
                            <button>Submit</button>
                        </div>
                    </div>
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
import { required, email, minValue, maxValue, sameAs, helpers } from '@vuelidate/validators'

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
                role: {worker: "Worker", manager: "Manager", hr: "Human Resource", president: "President"},
                department: {hr: "Human Resource", development: "Development",  executive: "Executive"},
            },
            serverValidations: {
                email: {},
                validate: this.checkEmail
            },
            profile: null,
            currTab: 0,
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
            for (const field in fields) {
                if (typeof fields[field] == "object" && field != 'profile'){
                    data.append(field, JSON.stringify(fields[field]));
                }
                else {
                    data.append(field, fields[field]);
                }
            }
            return data
        },
        personalInformationValidation() {
            return this.v$.employee.first_name.$validate() &&
                   this.v$.employee.last_name.$validate() &&
                   this.v$.employee.address.$validate()
        },
        employeeInformationValidation() {
            return this.v$.employee.role.$validate() &&
                    this.v$.employee.department.$validate() &&
                    this.v$.employee.salary.$validate() &&
                    this.v$.employee.salary_rate.$validate()
        },
        accountInformationValidation() {
            return this.v$.employee.user.$validate()
        },
        checkEmail() {
            axios.post("http://localhost:8000/api/checkEmail").then(res => {
                this.serverValidations.email = res.data;
            })
        },
        async validateTab(index) {
            // return true;
            switch(index){
                case 0:
                    return await this.personalInformationValidation();
                case 1:
                    return await this.employeeInformationValidation();
                case 2:
                    return await this.accountInformationValidation();
            }
        },
        async changeTab(e, index) {
            let nextTab = await this.validateTab(this.currTab);
            if (nextTab)
                this.currTab = index;

        },
        async nextTab() {
            let nextTab = await this.validateTab(this.currTab);
            if (nextTab)
                this.currTab++;
        },
        async AddEmployee(employee) {
            const isFormCorrect = await this.v$.$validate()
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
        const requiredMessage = helpers.withMessage('This field is required', required);
        const emailMessage = helpers.withMessage('This field requires an email', email);
        const minValueMessage = (value) => helpers.withMessage(({$params}) => `This field has a value lower than ${$params.min}`, minValue(value));
        const maxValueMessage = (value) => helpers.withMessage(({$params}) => `This field has a value greater than ${$params.max}`, maxValue(value));

        return {
            employee: {
                first_name: { required: requiredMessage },
                last_name: { required: requiredMessage },
                role: { required: requiredMessage },
                department: { required: requiredMessage },
                salary: { required: requiredMessage, minValue: minValueMessage(1), maxValue:maxValueMessage(999999.99)},
                salary_rate: { required: requiredMessage },
                hire_at: { required: requiredMessage },
                address: {
                    address1: { required: requiredMessage },
                    city: { required: requiredMessage },
                    state: { required: requiredMessage },
                    country: { required: requiredMessage },
                    zipcode: { required: requiredMessage },
                },
                user: {
                    email: { required: requiredMessage, email: emailMessage },
                    password: { required: requiredMessage },
                    password_confirmation: { required: requiredMessage, sameAs: sameAs(this.employee.user.password) },
                }
            }
        }
    }
}
</script>
