<template>
  <div>
    <div class="container">
      <h2>Add Employee</h2>
      <div class="panel panel-primary">
        <div class="panel-heading">
            Add Employee
            <router-link to="/" class="btn btn-info pull-right" style="margin-top:-7px;margin-left:2px;">Employee List</router-link>
        </div>
        <div class="panel-body">
          <form @submit.prevent="addEmployee">
            <div class="form-group">
              <label>First Name</label>
              <input type="text" class="form-control" v-model="employee.first_name" />
            </div>
            <div class="form-group">
              <label>Middle Name</label>
              <input type="text" class="form-control" v-model="employee.middle_name" />
            </div>
            <div class="form-group">
              <label>Last Name</label>
              <input type="text" class="form-control" v-model="employee.last_name" />
            </div>
            <div class="form-group">
              <label>Salary</label>
              <input type="text" class="form-control" v-model="employee.salary" />
            </div>
            <div class="form-group">
              <label>Hire at</label>
              <input type="text" class="form-control" v-model="employee.hire_at" />
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      employee: {},
    };
  },
  methods: {
    addEmployee() {
      this.axios
        .post("http://localhost:8000/api/employees", this.employee)
        .then((response) => this.$router.push({ name: "home" }))
        .catch((err) => console.log(err))
        .finally(() => (this.loading = false));
    },
  },
};
</script>
