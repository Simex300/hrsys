<template>
    <div class="employee">
        <h2 class="employee__title">Employees</h2>
        <div class="employee__options">
            <div class="search">
                <i class="fas fa-search search__icon"></i>
                <label class="search__label label">
                    <span>Search</span>
                    <input type="text" class="search__input" placeholder="Search by Employee Name">
                </label>
            </div>
            <div class="actions">
                <button class="actions__add" @click="openModal">
                    <i class="fas fa-plus"></i>
                </button>
                <button class="actions__edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="actions__delete">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
        <Card v-for="employee in this.employees" :key="employee.id" :title="(`${employee.first_name} ${employee.middle_name[0]} ${employee.last_name}`)" />
        <Modal ref="employeeModal" :showModal="modalShow" @onClose="closeModal">
            <EmployeeForm/>
        </Modal>
    </div>
</template>
<script>
    import Modal from '../Common/Modal.vue'
    import Card from '../Common/Card.vue'
    import EmployeeForm from './EmployeeForm.vue'

    export default {
        components: {
            Card,
            Modal,
            EmployeeForm
        },
        data() {
            return {
                modalShow: false,
                employees: [],
            };
        },
        created() {
            axios.get("http://localhost:8000/api/employees").then((response) => {
                this.employees = response.data;
            });
        },
        methods: {
            openModal() {
                this.modalShow = true
            },
            closeModal() {
                this.modalShow = false
            },
            deleteEmployee(id) {
                this.axios
                .delete(`http://localhost:8000/api/employees/${id}`)
                .then((response) => {
                    let i = this.employees.map((data) => data.id).indexOf(id);
                    this.employees.splice(i, 1);
                });
            },
        },
    };
</script>
