<template>
    <div class="employee">
        <h2 class="employee__title">Employees</h2>
        <div class="employee__options">
            <div class="search">
                <i class="fas fa-search search__icon"></i>
                <label class="search__label">
                    <span>Search</span>
                    <input type="text" class="search__input" placeholder="Search by Employee Name">
                </label>
            </div>
            <div class="actions">
                <button class="actions__add">
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
        <Card />
        <Card />
        <Card />
        <Card />
    </div>
</template>
<script>
    import Card from '../Common/Card.vue'

    export default {
        components: {
            Card,
        },
        data() {
            return {
                employees: [],
            };
        },
        created() {
            axios.get("http://localhost:8000/api/employees").then((response) => {
                this.employees = response.data;
            });
        },
        //   methods: {
        //     deleteEmployee(id) {
        //       this.axios
        //         .delete(`http://localhost:8000/api/employees/${id}`)
        //         .then((response) => {
        //           let i = this.employees.map((data) => data.id).indexOf(id);
        //           this.employees.splice(i, 1);
        //         });
        //     },
        //   },
    };
</script>
