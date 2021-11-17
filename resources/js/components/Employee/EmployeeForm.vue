<template>
    <div class="employeeForm">
        <div class="header">
            <h2>Add Employee</h2>
        </div>
        <div class="body">
            <form @submit.prevent="onSubmit" class="form">
                <div class="form__group row-2 col-3">
                    <ImageInput class="r-full" name="profile" v-model="employee.profile" />
                    <Input type="text" class="r-first-half" name="first_name" label="First Name" v-model="employee.first_name" />
                    <Input type="text" class="r-first-half" name="middle_name" label="Middle Name" v-model="employee.middle_name" />
                    <Input type="text" class="r-second-half c-two-third" name="last_name" label="Last Name" v-model="employee.last_name" />
                </div>
                <div class="form__group">
                    <Input type="text" name="email" label="Email" v-model="employee.email" />
                    <Input type="text" name="phone" label="Phone" v-model="employee.phone" />
                </div>
                <div class="form__group">
                    <Input type="date" name="date_of_birth" label="Date of Birth" v-model="employee.date_of_birth" />
                    <Select name="gender" label="Gender" v-model="employee.gender" :options="this.gender" />
                </div>
                <div class="form__group">
                    <Input type="text" name="address1" label="Address 1" v-model="employee.address1" />
                    <Input type="text" name="address2" label="Address 2" v-model="employee.address2" />
                </div>
                <div class="form__group">
                    <Input type="text" name="city" label="City" v-model="employee.city" />
                    <Input type="text" name="state" label="State" v-model="employee.state" />
                    <Input type="text" name="country" label="Country" v-model="employee.country" />
                </div>
                <div class="form__group">
                    <Currency type="text" name="salary" label="Salary" v-model="employee.salary" />
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

export default {
    components: {
        Currency,
        ImageInput,
        Input,
        Select
    },
    props: ['employee'],
    data() {
        return {
            gender: {male: "Male", female: "Female"}
        }
    },
    methods: {
        onSubmit(e) {
            this.AddEmployee(this.employee);
        },
        AddEmployee(employee) {
            if(employee.id > 0) {
                axios.patch(`http://localhost:8000/api/employees/${employee.id}`, employee)
                .then(res => {
                    this.$emit('editEmployee', res);
                })
            }
            else {
                axios.post("http://localhost:8000/api/employees", employee)
                .then(res => {
                    this.$emit('addEmployee', res.data);
                })
            }
        }
    }
}
</script>
