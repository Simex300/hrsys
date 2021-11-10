<template>
    <div class="employeeForm">
        <div class="header">
            <h2>Add Employee</h2>
        </div>
        <div class="body">
            <form @submit.prevent="onSubmit" class="form">
                <div class="form__group">
                    <Input name="firstName" label="First Name" v-model="employee.firstName" />
                    <Input name="middleName" label="Middle Name" v-model="employee.middleName" />
                    <Input name="lastName" label="Last Name" v-model="employee.lastName" />
                </div>
                <div class="form__group">
                    <Input name="dateOfBirth" label="Date of Birth" v-model="employee.dateOfBirth" />
                    <Input name="gender" label="Gender" v-model="employee.gender" />
                </div>
                <div class="form__group">
                    <Input name="address1" label="Address 1" v-model="employee.address1" />
                    <Input name="address2" label="Address 2" v-model="employee.address2" />
                </div>
                <div class="form__group">
                    <Input name="city" label="City" v-model="employee.city" />
                    <Input name="state" label="State" v-model="employee.state" />
                    <Input name="country" label="Country" v-model="employee.country" />
                </div>
                <div class="form__group">
                    <Input name="salary" label="Salary" v-model="employee.salary" />
                    <Input name="hireAt" label="Hire At" v-model="employee.hireAt" />
                </div>
                <div class="form__group footer">
                    <button>Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import Input from "../Common/Input.vue"

export default {
    components: {
        Input
    },
    data() {
        return {
            employee: {
                firstName: "",
                middleName: "",
                lastName: "",
                dateOfBirth: "",
                gender: "",
                address1: "",
                address2: "",
                city: "",
                state: "",
                country: "",
                salary: "0",
                hireAt: this.dateFormat(Date.now())
            }
        }
    },
    methods: {
        onSubmit(e) {
            this.AddEmployee(this.employee);
        },
        AddEmployee(employee) {
            axios.post("http://localhost:8000/api/employees", employee)
            .then(res => {
                console.log(res);
            })
        },
        dateFormat(date) {
            let format = [{year: 'numeric'}, {month: 'numeric'}, {day: 'numeric'}];
            return format.map(val => {
                return new Intl.DateTimeFormat('es', val).format(date)
            }).join("-");
        }
    },
    setup() {

    },
}
</script>
