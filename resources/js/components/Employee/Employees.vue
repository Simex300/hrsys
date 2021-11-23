<template>
    <div class="employee">
        <h2 class="employee__title">Employees</h2>
        <div class="employee__options">
            <div class="search">
                <i class="fas fa-search search__icon"></i>
                <Input label="Search" type="text" class="search__input" placeholder="Search by Employee Name" @input="searchEmployee" v-model="search" />
            </div>
            <div class="actions">
                <button class="actions__add" @click="openModal($event, false)">
                    <i class="fas fa-plus"></i>
                </button>
                <button class="actions__edit" @click="openModal($event, true)" >
                    <i class="fas fa-edit"></i>
                </button>
                <button class="actions__delete" @click="deleteEmployee">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
        <Card v-for="(employee, index) in this.employees" :key="index" :title="(`${employee.first_name} ${employee.middle_name[0]} ${employee.last_name}`)" :profile="employee.profile" :data="employee" @click.native="toggleSelect($event, index)" />
        <Modal ref="employeeModal" :showModal="modalShow" @onClose="closeModal">
            <EmployeeForm :employee="this.employee" @addEmployee="loadEmployee" />
        </Modal>
    </div>
</template>
<script>
    import Modal from '../Common/Modal.vue'
    import Input from '../Common/Input.vue'
    import Card from '../Common/Card.vue'
    import EmployeeForm from './EmployeeForm.vue'

    export default {
        components: {
            Card,
            Input,
            Modal,
            EmployeeForm
        },
        data() {
            return {
                modalShow: false,
                search: "",
                list: [],
                employees: [],
                employee: {
                    id: 0,
                    first_name: "",
                    middle_name: "",
                    last_name: "",
                    date_of_birth: "",
                    gender: "",
                    address1: "",
                    address2: "",
                    city: "",
                    state: "",
                    country: "",
                    salary: "0.00",
                    salary_rate: "",
                    hire_at: this.dateFormat(Date.now()),
                }
            };
        },
        created() {
            axios.get("http://localhost:8000/api/employees").then((response) => {
                for (let index = 0; index < response.data.length; index++) {
                    response.data[index] = {...response.data[index], selected: false}
                }
                this.employees = response.data;
            });
        },
        methods: {
            openModal(e, edit) {
                this.resetEmployee();
                if(edit) {
                    this.employee = this.employees.find(val => {
                        return val.selected == true
                    });
                }
                this.modalShow = true;
            },
            closeModal() {
                this.modalShow = false;
                this.resetEmployee();
            },
            toggleSelect(e, index) {
                this.employees[index].selected = !this.employees[index].selected
            },
            loadEmployee(data) {
                data.selected = false;
                this.modalShow = false;
                this.employees = [data, ...this.employees];
            },
            resetEmployee() {
                this.employee = {
                    id: 0,
                    first_name: "",
                    middle_name: "",
                    last_name: "",
                    date_of_birth: "",
                    gender: "",
                    address1: "",
                    address2: "",
                    city: "",
                    state: "",
                    country: "",
                    salary: "",
                    salary_rate: "",
                    hire_at: this.dateFormat(Date.now()),
                }
            },
            searchEmployee(){
                if(this.list.length == 0) {
                    this.list = this.employees;
                }
                this.employees = this.list.filter(employee => {
                    return `${employee.first_name.toLowerCase()} ${employee.middle_name.toLowerCase()} ${employee.last_name.toLowerCase()}`.includes(this.search.toLowerCase());
                })
            },
            deleteEmployee() {
                const selectedEmployees = this.employees.filter(employee => {
                    return employee.selected
                });
                selectedEmployees.forEach(employee => {
                    axios.delete(`http://localhost:8000/api/employees/${employee.id}`)
                    .then(res => {
                        let index = this.employees.indexOf(employee);
                        this.employees.splice(index, 1);
                    })
                })
            },
            dateFormat(date) {
                let format = [{year: 'numeric'}, {month: 'numeric'}, {day: 'numeric'}];
                return format.map(val => {
                    return new Intl.DateTimeFormat('es', val).format(date)
                }).join("-");
            }
        },
    };
</script>
